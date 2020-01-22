<?php

class PlanoacaoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(

			array('allow',
				'actions'    => array('create','view'),
				'users'      => array('@'),
				//'expression' => 'Yii::app()->user->auditado == Usuario::SIM',
				'expression' => 'Yii::app()->user->auditado == Usuario::SIM OR (Yii::app()->user->auditado == Usuario::NAO && Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO)',
			),

			array('allow',
				'actions'    => array('avaliar'),
				'users'      => array('@'),
				'expression' => 'isset(Yii::app()->user->perfil) and
				( Yii::app()->user->perfil == Permissao::ADMINISTRADOR or
				Yii::app()->user->perfil == Permissao::GERENTE       or
				Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO       or
				Yii::app()->user->perfil == Permissao::AUDITOR )',
			),


			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','avaliar'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),*/


			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($planoacaoid)
	{
		$model = $this->loadModel(Utils::decodeGET($planoacaoid));

		$this->render('view',array(
			'model' => $model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($eventoid)
	{
		$model    = new Planoacao;
		$evento   = Evento::model()->findByPk(Utils::decodeGET($eventoid));
		//$porque   = new Porque;
		//$ishikawa = new Ishikawa;
		$causaraiz = new Causaraiz('search');

		$model->scenario = 'cadastro';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Planoacao']) or isset($_POST['Porque']) or isset($_POST['Ishikawa'])) {
			$model->attributes     = $_POST['Planoacao'];
			//$porque->attributes    = $_POST['Porque'];
			//$ishikawa->attributes  = $_POST['Ishikawa'];

			$model->arquivo = CUploadedFile::getInstance($model,'arquivo');

			$model->evento_id    = $evento->evento_id;
			$model->datacadastro = date('Y-m-d');
			$model->status       = Planoacao::ENVIADO;
			//dbg($model->attributes);
			//valida todos os models pra poder alimentar as variaveis de erro ($model->getErrors())
			//$ishikawa->validate();
			//$porque->validate();
			$model->validate();

			if($_FILES['Planoacao']['tmp_name']['arquivo'][0] != ""){
               	try {
               		$model->arquivo = Utils::salvaArquivo($evento->codigo, 'Planoacao', $_FILES);
				} catch (Exception $e) {
					echo CJSON::encode(array($e->getMessage()));
					exit();
				}
			}

		if( ($model->getErrors() == null) /*and ($porque->getErrors() == null) and ($ishikawa->getErrors() == null)*/ ) {

				$model->save();

				/*$porque->planoacao_id = $model->planoacao_id;
				$porque->save();

				$ishikawa->planoacao_id = $model->planoacao_id;
				$ishikawa->save();*/

				$evento->statusplanoacao = Planoacao::ENVIADO;
				$evento->status          = Evento::PENDENTE;

				$evento->save(false);

				//======[ ENVIAR EMAIL ]======//
				$retorno = Email::Send(
					'SGE - MAP Linhas Aéreas - PAC Respondido ('.$evento->codigo.')',
					//array('faxandre@gmail.com' => 'André Assunção'),
					Usuario::buscarEmailsByArea($evento->area_id), //array com todos os usuario/email do setor em questao
					'contencao_pac_enviado',
					$evento
				);


				$this->redirect(array('view','planoacaoid'=>Utils::encodeGET($model->planoacao_id)));
			}
		}

		$this->render('create',array(
			'model'    => $model,
			//'ishikawa' => $ishikawa,
			//'porque'   => $porque,
			'evento'   => $evento,
			'causaraiz'=>$causaraiz,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Planoacao']))
		{
			$model->attributes=$_POST['Planoacao'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->planoacao_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAvaliar()
	{
		$evento = Evento::model()->findByPk(Utils::decodeGET($_GET['evento']));
		$model  = new Planoacao;

		foreach($evento->planosacao as $key=>$plano){
			if($plano->status == Planoacao::ENVIADO)
				$model = $plano;
		}

		if(isset($_POST['Planoacao']))
		{
			$model->datacadastro = date('Y-m-d');
			$model->attributes   = $_POST['Planoacao'];

			if($model->statusavaliacao == Planoacao::EFICAZ or $model->statusavaliacao == "")
				$model->scenario = 'pac_eficaz';
			else if($model->statusavaliacao == Planoacao::INEFICAZ)
				$model->scenario = 'pac_ineficaz';


			if( $model->validate() ) {

				$model->status = $model->statusavaliacao;

				if($model->save()){
					if($model->status == Planoacao::EFICAZ){
						$evento->dataencerramento = date('Y-m-d');
						$evento->statusplanoacao = Planoacao::EFICAZ;
						$evento->status = Evento::FINALIZADO;
						$viewEmail = 'contencao_pac_avaliado';
					} else if($model->status == Planoacao::INEFICAZ){
						$evento->statusplanoacao = Planoacao::INEFICAZ;
						$evento->status = Evento::ENVIADO;
						$viewEmail = 'pac_ineficaz';
					}

					$evento->save(false);

					//======[ ENVIAR EMAIL ]======//
					$retorno = Email::Send(
						'SGE - MAP Linhas Aéreas - PAC Avaliado ('.$evento->codigo.')',
						//array('faxandre@gmail.com' => 'André Assunção'),
						Usuario::buscarEmailsBySetor($evento->setor_id), //array com todos os usuario/email do setor em questao
						$viewEmail,
						$evento,
						$model->motivo
					);

					Yii::app()->user->setFlash('success', "<strong>Plano de Ação</strong> Avaliado com Sucesso!");
					$this->redirect(array('evento/indexadministrador'));
				}
            }
		}

		$this->render('avaliar',array(
			'model'    => @$model,
			'evento'   => @$evento,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Planoacao');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Planoacao('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Planoacao']))
			$model->attributes=$_GET['Planoacao'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Planoacao the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Planoacao::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Planoacao $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='planoacao-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
