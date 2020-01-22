<?php

class SiteController extends Controller
{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		/*if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}*/

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				//$this->redirect('index');
				$this->redirect(array("usuario/index"));
			}
		}
		

		// display the login form
		$this->layout = '//layouts/semhead';
		$this->render('login',array('model'=>$model));
	}

	/**
	 *  So serve pra entrar na tela inicial de cada perfil
	 */
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest) {
			$this->actionLogin();
			exit;
		}

		$this->redirect(array("usuario/index"));

		/*if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR ) {
			$this->render('index');
		} else if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::GERENTE ) {
			$this->render('index');
		} else if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::AUDITOR ) {
			$this->render('index');
		} else if( Yii::app()->user->auditado == Usuario::SIM ) {			
			$this->render('index');
		}*/

	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	/*public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}*/


	/**
	*	Funcao que setar o ID da area na sessao
	*/
	public function actionPreenchesessao(){
		Yii::app()->user->setState('area_id', $_POST['area_id']);
				
		print json_encode(Yii::app()->user->getState('area_id'));
	}


	public function actionFlush()
	{
		if (Yii::app()->cache->flush()) {
			echo 'Cache esvaziado com sucesso!';
		} else {
			echo 'Erro ao tentar esvaziar o cache!';
		}
	}

	public function actionTesteEmail() {

		$andre = array(
			'faxandre@gmail.com' => 'André Assunção - gmail',
			'faxandre@live.com'  => 'André Assunção - live'
		);

		//dbg($andre,false);
		//dbg(Usuario::buscarEmailsBySetor(11));

		$model = Evento::model()->findByPk(2);
		//dbg($model->attributes);
		
		//======[ ENVIAR EMAIL ]======// 
		$retorno = Email::Send(
			'SGE - MAP Linhas Aéreas - Evento encontrado ('.$model->codigo.')',
			//array('faxandre@gmail.com' => 'André Assunção'),
			//Usuario::buscarEmailsBySetor(11), //array com todos os usuario/email do setor em questao
			$andre,
			'evento_enviado',
			$model
		);

		dbg( Yii::app()->getBaseUrl(true).'/images/email/eventoencontrado.jpg' , false);
		dbg($retorno);

	}

}