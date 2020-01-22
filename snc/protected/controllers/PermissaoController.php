<?php

class PermissaoController extends Controller
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

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'    => array('create','update','view','admin','delete','deleteadm'),
				'users'      => array('@'),
				'expression' => 'isset(Yii::app()->user->perfil) and
							     ( Yii::app()->user->perfil == Permissao::ADMINISTRADOR )',
		  	),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'    => array('buscatodaspermissoesajax', 'mudadadosdapermissaonasessao'),
				'users'      => array('@'),
				'expression' => 'isset(Yii::app()->user->perfil) and
								( Yii::app()->user->perfil == Permissao::GERENTE or
								  Yii::app()->user->perfil == Permissao::AUDITOR or
								  Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO )',
			),

			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin',),
				'users'=>array('admin'),
			),*/
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Busca todas as permissoes de um usuario - AJAX
	 */
	 public function actionBuscaTodasPermissoesAjax() {

		$permissoes = Permissao::model()->findByAttributes(array(
			'usuario_id' => $_POST['usuario_id']
		));

		print json_encode($permissoes);
	}

	/**
	*	Funcao que setar o ID da area na sessao
	*/
	public function actionMudaDadosDaPermissaoNaSessao(){

		$permissoes = Permissao::model()->findAllByAttributes(Array('usuario_id'=>$_POST['usuario_id']));

		//atualiza a sessao
		//Yii::app()->user->permissoes = null;
		//Yii::app()->user->permissoes = $permissoes;

		foreach( $permissoes as $key => $permissao ){
			
			if( $permissao->area_id == $_POST['area_id'] and $permissao->empresa_id == $_POST['empresa_id']) {
				Yii::app()->user->setState("empresa_id",  $permissao->empresa_id);
				Yii::app()->user->setState("empresa",     $permissao->empresa->sigla);
				Yii::app()->user->setState("area_id",     $permissao->area_id);
				Yii::app()->user->setState("area",        $permissao->area->descricao);
				Yii::app()->user->setState("perfil",      $permissao->perfil);
				Yii::app()->user->setState("perfiltexto", $permissao->getPerfilText($permissao->perfil));		
			}
		}

		print json_encode(true);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{



		$model = new Permissao;
		$usuario = Usuario::model()->findByPk(Utils::decodeGET($_GET['usuario']));

		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		

		/*echo "<pre>";
		print_r($_POST['Permissao']);
		echo "</pre>";
		exit;*/
		if(isset($_POST['Permissao']))
		{

			if (isset($_POST['Permissao']['setor_id']) and !empty($_POST['Permissao']['setor_id']))  {
				$_POST['Permissao']['empresa_id'] = $_POST['Permissao']['empresa_id_setor'];
				unset($_POST['Permissao']['empresa_id_setor']);
				$_POST['Permissao'] = array_filter($_POST['Permissao']);
			}

			if( isset($_POST['Permissao']['setor_id']) && !empty($_POST['Permissao']['setor_id'])){ $_POST['Permissao']['area_id'] = 4; }

			$model->attributes=$_POST['Permissao'];

			if($model->perfil == Permissao::ADMINISTRADOR)
				$model->scenario = 'administrador';
			else if( $model->perfil == Permissao::GERENTE or $model->perfil == Permissao::AUDITOR || $model->perfil == Permissao::GERENTE_AUDITADO )
				$model->scenario = 'gerente_auditor';

			if($model->save()){
				//$this->redirect(array('view','id'=>$model->permissao_id));
				Yii::app()->user->setFlash('success', "<strong>Permissão</strong> Cadastrado com Sucesso!");

				/*$this->redirect(array('create',
					'model'   => $model,
					'usuario' => Utils::encodeGET($usuario->usuario_id),
				));*/

				$this->redirect(
					'create?usuario='.Utils::encodeGET($usuario->usuario_id),
					array(
						'model'   => $model,
						'usuario' => Utils::encodeGET($usuario->usuario_id),
					)
				);
			}
		}

		$this->render('create',array(
			'model'   => $model,
			'usuario' => $usuario,
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

		if(isset($_POST['Permissao']))
		{
			$model->attributes=$_POST['Permissao'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->permissao_id));
		}

		$this->render('update',array(
			'model'=>$model,
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

	public function actionDeleteAdm($id)
	{
		$model = Permissao::Model()->findByAttributes(Array('usuario_id'=>$id));
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Permissao');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Permissao('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Permissao']))
			$model->attributes=$_GET['Permissao'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Permissao the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Permissao::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Permissao $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='permissao-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
