<?php

class EventoController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				  'actions'   => array('index','indexadministrador','view','viewall','download','create','delete',
				  					   'update','acompanhar','realizaracompanhamento'),
				  'users'      => array('@'),
				  'expression' => 'isset(Yii::app()->user->perfil) and
								  ( Yii::app()->user->perfil == Permissao::ADMINISTRADOR or
								    Yii::app()->user->perfil == Permissao::GERENTE       or
								    Yii::app()->user->perfil == Permissao::AUDITOR 		 OR
								    Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO
								)',
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'   => array('indexauditado','viewall','download'),
				'users'      => array('@'),
				'expression' => 'Yii::app()->user->auditado == Usuario::SIM OR (Yii::app()->user->auditado == Usuario::NAO && Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO)',
	  		),
			array('deny',  // deny all users
				'users' => array('*'),
			),

		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Evento');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lista todos os eventos de um auditado de acordo com o seu setor
	 */
	public function actionIndexAuditado()
	{
		$model = new Evento('searchauditado');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Evento']))
			$model->attributes = $_GET['Evento'];

		$this->render('auditado/index_auditado',array(
			'model' => $model,
		));
	}

	/**
	 * Lista todos os eventos de um administrador
	 */
	public function actionIndexAdministrador()
	{
		//$model = new Evento('searchadministradorcontencao');
		$model = new Evento();
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Evento']))
			$model->attributes = $_GET['Evento'];

		$this->render('administrador/index_administrador',array(
			'model' => $model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($eventoid)
	{
		$this->render('view',array(
			'model'=>$this->loadModel(Utils::decodeGET($_GET['eventoid'])),
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewAll($evento)
	{
		$this->render('viewall',array(
			'model'=>$this->loadModel(Utils::decodeGET($_GET['evento'])),
		));
	}

	/**
	 * Visualizacao do planos de acao pelo Auditado
	 */
	/*public function actionViewplanoacao($id)
	{
		$this->render('viewplanoacao',array(
			'model'=>$this->loadModel(UtilsdecodeGET($_GET['id'])),
		));
	}*/

	/**
	 * Avalia uma contencao
	 */
	/*public function actionAvaliarContencao($id)
	{
		$this->render('view_avaliarcontencao',array(
			'model'=>$this->loadModel($id),
		));
	}*/

	/**
	 * Avalia uma plano de acao
	 */
	/*public function actionAvaliarPlanoacao($id)
	{
		$this->render('view_avaliarplanoacao',array(
			'model'=>$this->loadModel($id),
		));
	}*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Evento;

		if( (isset(Yii::app()->user->area) and Yii::app()->user->area == 'SGSO') ){
			//gerente/auditor
			$model->scenario = 'SGSO_ANALISERISCO_NAO';
		}elseif ( Yii::app()->user->getState('perfil') == Permissao::GERENTE_AUDITADO ) {
			$model->scenario = 'GERENTE_AUDITADO';
		}else{
			//adm - nao tem sessao:area
			$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_NAO';
		}


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);



		if(isset($_POST['Evento'])) {

			$str = json_decode($_POST['str'], true);

			$model->attributes   = $_POST['Evento'];
			$model->datacadastro = date('d/m/Y');
			$model->status       = Evento::ENVIADO;
			$model->arquivo      = CUploadedFile::getInstance($model,'arquivo');


			if( Yii::app()->user->perfil != Permissao::ADMINISTRADOR )
				$model->area_id = Yii::app()->user->area_id;

			//Escolha o Secnario
			if( Yii::app()->user->perfil == Permissao::ADMINISTRADOR ) {

				$area = Area::model()->findByAttributes(Array("area_id" => $model->area_id));

				if( $area->descricao == 'SGSO' and ($model->analisederisco == 'N' or $model->analisederisco == '') )
					$model->scenario = 'SGSO_ANALISERISCO_NAO';
				else if( $area->descricao == 'SGSO' and $model->analisederisco == 'S')
					$model->scenario = 'SGSO_ANALISERISCO_SIM';
				else if( $area->descricao != 'SGSO' and $model->analisederisco  == 'N')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_NAO';
				else if( $area->descricao != 'SGSO' and $model->analisederisco  == 'S')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_SIM';

			} else { // GERENTE / AUDITOR

				if( Yii::app()->user->area == 'SGSO' and $model->analisederisco  == 'N')
					$model->scenario = 'SGSO_ANALISERISCO_NAO';
				else if( Yii::app()->user->area == 'SGSO' and $model->analisederisco  == 'S')
					$model->scenario = 'SGSO_ANALISERISCO_SIM';

				else if( Yii::app()->user->area != 'SGSO' and $model->analisederisco  == 'N')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_NAO';
				else if( Yii::app()->user->area != 'SGSO' and $model->analisederisco  == 'S')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_SIM';

			}

			if(empty($model->analisederisco)){
				$model->analisederisco = 'N';
			}

			$model->requisito = $str[0];
			$model->descricaorequisito = $str[1];
			$model->descricaoevento = $str[2];
			$model->numerochecklist = $str[3];
			$model->criticidade = $str[4];

			$model->numeroitem = 1;

            //faz todas as validacoes do model
            if( $model->validate() ){

				if($model->save()){
					$model->codigo  = $this->mudaNumeroCodigo($model->codigo, $model->evento_id);
					$model->numeroitem = $this->mudaNumeroCodigo($model->codigo, $model->evento_id)."-1";

                	//dbg($_FILES);
                	if(isset($_FILES['Evento']['tmp_name']['arquivo'][0]) && $_FILES['Evento']['tmp_name']['arquivo'][0] != null)
                		$model->arquivo = Utils::salvaArquivo($model->codigo, 'Evento', $_FILES);
					$model->save(false);

					//======[ ENVIAR EMAIL ]======//
					//=========================================descomentar na entrega
					//=========================================descomentar na entrega
					//=========================================descomentar na entrega
					//=========================================descomentar na entrega
					/*$retorno = Email::Send(
						'SGE - MAP Linhas Aéreas - Evento encontrado ('.$model->codigo.')',
						//array('faxandre@gmail.com' => 'André Assunção'),
						Usuario::buscarEmailsBySetor($model->setor_id), //array com todos os usuario/email do setor em questao
						'evento_enviado',
						$model
					);*/

					$counter = 1;
					for($i = 5; $i < sizeof($str);$i++){
						$modelItem = new Evento();
						$modelItem = $model;
						$modelItem->isNewRecord = true;
						unset($model->evento_id);
						$counter++;
						$i = $this->preencheItem($modelItem,$str,$i,$counter);
					}
					Yii::app()->user->setFlash('success', "<strong>Evento</strong> Enviado com sucesso!");
					$this->redirect(array('evento/indexadministrador'));
				}
			}
		}

		$this->render('create',array(
			'model' => $model,
		));
	}

	private function mudaNumeroCodigo($codigo, $id){
		$id = str_pad($id, 7, '0', STR_PAD_LEFT);//zero a esquerda
		$novoCodigo = str_replace('??????', $id, $codigo);//substitui as bolinhas pelo id
		// $novoCodigo = str_replace('●●●●●●', $id, $codigo);//substitui as bolinhas pelo id

		return $novoCodigo;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 public function actionUpdate($eventoid)
 	{
 		$model = $this->loadModel($eventoid);

		if( (isset(Yii::app()->user->area) and Yii::app()->user->area == 'SGSO') ){
			//gerente/auditor
			$model->scenario = 'SGSO_ANALISERISCO_NAO';
		}elseif ( Yii::app()->user->getState('perfil') == Permissao::GERENTE_AUDITADO ) {
			$model->scenario = 'GERENTE_AUDITADO';
		}else{
			//adm - nao tem sessao:area
			$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_NAO';
		}


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);



		if(isset($_POST['Evento'])) {


			$model->attributes   = $_POST['Evento'];
			$model->datacadastro = date('d/m/Y');
			$model->status       = Evento::ENVIADO;
			$model->arquivo      = CUploadedFile::getInstance($model,'arquivo');


			if( Yii::app()->user->perfil != Permissao::ADMINISTRADOR )
				$model->area_id = Yii::app()->user->area_id;

			//Escolha o Secnario
			if( Yii::app()->user->perfil == Permissao::ADMINISTRADOR ) {

				$area = Area::model()->findByAttributes(Array("area_id" => $model->area_id));

				if( $area->descricao == 'SGSO' and ($model->analisederisco == 'N' or $model->analisederisco == '') )
					$model->scenario = 'SGSO_ANALISERISCO_NAO';
				else if( $area->descricao == 'SGSO' and $model->analisederisco == 'S')
					$model->scenario = 'SGSO_ANALISERISCO_SIM';
				else if( $area->descricao != 'SGSO' and $model->analisederisco  == 'N')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_NAO';
				else if( $area->descricao != 'SGSO' and $model->analisederisco  == 'S')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_SIM';

			} else { // GERENTE / AUDITOR

				if( Yii::app()->user->area == 'SGSO' and $model->analisederisco  == 'N')
					$model->scenario = 'SGSO_ANALISERISCO_NAO';
				else if( Yii::app()->user->area == 'SGSO' and $model->analisederisco  == 'S')
					$model->scenario = 'SGSO_ANALISERISCO_SIM';

				else if( Yii::app()->user->area != 'SGSO' and $model->analisederisco  == 'N')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_NAO';
				else if( Yii::app()->user->area != 'SGSO' and $model->analisederisco  == 'S')
					$model->scenario = 'OUTRAS_AREAS_ANALISERISCO_SIM';

			}



            //faz todas as validacoes do model
            if( $model->validate() ){

				if($model->save()){

                	//dbg($_FILES);
                	if(isset($_FILES['Evento']['tmp_name']['arquivo'][0]) && $_FILES['Evento']['tmp_name']['arquivo'][0] != null)
                		$model->arquivo = Utils::salvaArquivo($model->codigo, 'Evento', $_FILES);

					$model->save(false);

					Yii::app()->user->setFlash('success', "<strong>Evento</strong> Enviado com sucesso!");
					$this->redirect(array('view','eventoid'=>Utils::encodeGET($model->evento_id)));
				}
			}
		}

		$this->render('update',array(
			'model' => $model,
		));
	}

	public function actionAcompanhar()
	{
		$model = new Evento;
		$this->render('acompanhamento/index', array(
			'model' => $model,
		));
	}

	public function actionRealizarAcompanhamento()
	{
		$model = Evento::model()->findByPk(Utils::decodeGET($_GET['evento']));
		$model->scenario = 'ACOMPANHAMENTO';

        if(isset($_POST['Evento'])) {

        	if($_FILES['Evento']['tmp_name']['arquivo_acompanhamento'][0] != ""){
				try {
					$model->arquivo_acompanhamento = Utils::salvaArquivo($model->codigo, 'Evento', $_FILES, 'arquivo_acompanhamento');
				} catch (Exception $e) {
					echo CJSON::encode(array($e->getMessage()));
					exit();
				}
			}

			$model->attributes = $_POST['Evento'];
			$model->acompanhado = Evento::SIM;

	        if( $model->validate() ) {
				if($model->save()) {
					Yii::app()->user->setFlash('success', "<strong>Acompanhamento</strong> realizado com sucesso!");
					$this->redirect(array('viewall','evento'=>Utils::encodeGET($model->evento_id)));
				}
			}
		}

		$this->render('acompanhamento/_form', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if(isset($_POST['Evento'])) {
				if($model->delete()) {

					$model->delete(false);

					$this->redirect(array('evento/indexadministrador'));
				}
			}
			$this->render('delete',array(
				'model' => $model,
			));
		}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Evento('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Evento']))
			$model->attributes = $_GET['Evento'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return evento the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Evento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Essa página não existe!');
		return $model;
	}

	/**
	 * Forca o browser do cliente a fazer o download do arquivo
	 */
	public function actionDownload(){
		Utils::downloadArquivo($_GET['arquivo']);
	}

	/**
	 * Performs the AJAX validation.
	 * @param evento $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='evento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	private function preencheItem($modelItem,$str,$i,$counter){

					$modelItem->requisito = $str[$i];
					$modelItem->descricaorequisito = $str[$i = $i +1];
					$modelItem->descricaoevento = $str[$i = $i +1];
					$modelItem->numerochecklist = $str[$i = $i +1];
					$modelItem->criticidade = $str[$i = $i +1];
					$modelItem->numeroitem = $counter;

					if($modelItem->save()){

					$modelItem->codigo  = $this->mudaNumeroCodigo($modelItem->codigo, $modelItem->evento_id);
					$modelItem->numeroitem = $this->mudaNumeroCodigo($modelItem->codigo, $modelItem->evento_id)."-".$counter;

                	//dbg($_FILES);
                	if(isset($_FILES['Evento']['tmp_name']['arquivo'][0]) && $_FILES['Evento']['tmp_name']['arquivo'][0] != null)
                		$modelItem->arquivo = Utils::salvaArquivo($modelItem->codigo, 'Evento', $_FILES);

					$modelItem->save(false);
					}
					return $i;
	}
}//fim class
