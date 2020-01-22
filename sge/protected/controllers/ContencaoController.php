<?php

class ContencaoController extends Controller
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
				  'expression' => 'Yii::app()->user->auditado == Usuario::SIM OR (Yii::app()->user->auditado == Usuario::NAO && Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO)',
			),
			array('allow',
				  'actions'    => array('avaliar'),
				  'users'      => array('@'),
				  'expression' => 'isset(Yii::app()->user->perfil) and
				  ( Yii::app()->user->perfil == Permissao::ADMINISTRADOR or
					Yii::app()->user->perfil == Permissao::GERENTE       or
					Yii::app()->user->perfil == Permissao::AUDITOR		 OR
					Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO )',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),

		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Contencao');

		$this->render('index',array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($contencao,$evento)
	{
		$model  = Contencao::model()->findByPk(Utils::decodeGET($_GET['contencao']));		
		$evento = Evento::model()->findByPk(Utils::decodeGET($_GET['evento']));

		$this->render('view',array(
			'model'  => $model,
			'evento' => $evento,
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($eventoid)
	{
		$model  = new Contencao;
		$evento = Evento::model()->findByPk(Utils::decodeGET($eventoid));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contencao']))
		{
			$model->attributes = $_POST['Contencao'];
			$model->arquivo = CUploadedFile::getInstance($model,'arquivo');
			$model->status = Contencao::ENVIADO;

			if($model->aplicavel == Contencao::NAO)
				$model->scenario = 'aplicavelNAO';
			else if($model->aplicavel == Contencao::SIM or $model->aplicavel == "")
				$model->scenario = 'aplicavelSIM';



			
			if( $model->validate() ) {

				if($_FILES['Contencao']['tmp_name']['arquivo'][0] != ""){
					try {
						$model->arquivo = Utils::salvaArquivo($evento->codigo, 'Contencao', $_FILES);
					} catch (Exception $e) {
						echo CJSON::encode(array($e->getMessage()));
						exit();
					}
				}

				if($model->save()){

					//altera os status
					$evento->statuscontencao = Contencao::ENVIADO;
					$evento->status = Evento::PENDENTE;
					$evento->save(false);

					//======[ ENVIAR EMAIL ]======// 
					$retorno = Email::Send(
						'SGE - MAP Linhas Aéreas - Contenção Respondida ('.$evento->codigo.')',
						//array('faxandre@gmail.com' => 'André Assunção'),
						Usuario::buscarEmailsByArea($evento->area_id), //array com todos os usuario/email do setor em questao
						'contencao_pac_enviado',
						$evento
					);

					$this->redirect(array('view',
						'contencao' => Utils::encodeGET($model->contencao_id),
						'evento'    => Utils::encodeGET($evento->evento_id)
					));
				}
			}
		}

		$this->render('create',array(
			'model'  => $model,
			'evento' => $evento,
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

		if(isset($_POST['Contencao']))
		{
			$model->attributes=$_POST['Contencao'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->contencao_id));
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
		$model  = Contencao::model()->findByPk(Utils::decodeGET($_GET['contencao']));
		$model->scenario = 'avaliarContecao';

		if(isset($_POST['Contencao']))
		{
			$model->attributes = $_POST['Contencao'];

			if( $model->validate() ) {
				
				if($model->save()){
					$evento->statuscontencao = $model->status;
					$evento->status = Evento::ENVIADO;
					$evento->save(false);

					//======[ ENVIAR EMAIL ]======// 
					$retorno = Email::Send(
						'SGE - MAP Linhas Aéreas - Contenção Avaliada ('.$evento->codigo.')',
						//array('faxandre@gmail.com' => 'André Assunção'),
						Usuario::buscarEmailsBySetor($evento->setor_id), //array com todos os usuario/email do setor em questao
						'contencao_pac_avaliado',
						$evento
					);
					
					
					Yii::app()->user->setFlash('success', "<strong>Contenção</strong> Avaliada com Sucesso!");
					$this->redirect(array('evento/indexadministrador'));
				}
			}
		}

		$this->render('avaliar',array(
			'model'  => $model,
			'evento' => $evento,
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contencao('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contencao']))
			$model->attributes=$_GET['Contencao'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contencao the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contencao::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contencao $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contencao-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
