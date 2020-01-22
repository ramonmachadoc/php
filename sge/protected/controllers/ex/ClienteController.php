<?php

class ClienteController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    public $defaultAction = 'admin';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'reagendar'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'adminaniversarios'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model    = new Cliente;
        $model->scenario = 'cadastro';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset($_POST['Cliente']) ) {
            $model->attributes    = $_POST['Cliente'];
            $model->status        = Cliente::AGENDADO;
            $model->aniversario   = $model->dia . '/' .$model->mes;
            $model->data_cadastro = date('Y-m-d H:i:s');
            $model->data_retorno  = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_retorno)));
            if (Yii::app()->user->perfil == Funcionario::VENDEDOR) {
                $model->id_funcionario = Yii::app()->user->id;
            }
            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $model->save(false);
                    $transaction->commit();
                    //Yii::app()->user->setFlash('success', 'Alteração Efetuada com Sucesso!');
                    $this->redirect(array('view', 'id' => $model->id_cliente));
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }
            }
        }

        $this->render('create', array(
            'model'    => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model           = $this->loadModel($id);
        $cliente_migrado = new ClienteMigrado();
	    $model->scenario = 'editar';
        $model->origem   = $_GET['origem'];

        if ( isset($_POST['Cliente']) ) {

            if ($model->id_funcionario != $_POST['Cliente']['id_funcionario']) {
                $cliente_migrado->id_cliente            = $model->id_cliente;
                $cliente_migrado->id_funcionario_antigo = $model->id_funcionario;
                $cliente_migrado->id_funcionario_novo   = $_POST['Cliente']['id_funcionario'];
                $cliente_migrado->data_migracao         = date('Y-m-d H:i:s');

                $model->migrado = 1;
            }

            $model->attributes       = $_POST['Cliente'];
            $model->aniversario      = $model->dia . '/' .$model->mes;
            $model->data_retorno     = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_retorno)));
            $model->data_atualizacao = date('Y-m-d H:i:s');

            if( $model->data_venda != null )
                $model->data_venda    = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_venda)));

            $model->origem = $_POST['Cliente']['origem'];
            $model->dataConsulta = $_POST['Cliente']['dataConsulta'];

            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
					$model->save(false);
                    if ($model->id_funcionario != $_POST['Cliente']['id_funcionario']) {
                        $cliente_migrado->save(false);
                    }
                    $transaction->commit();
                    //Yii::app()->user->setFlash('success', 'Alteração Efetuada com Sucesso!');
                    if($model->origem == 'modalC'){
                        $this->redirect(array('ranking/buscaclientes', 'id' => $model->id_funcionario,'data'=>$model->dataConsulta));
                    }else if($model->origem == 'modalV'){
                        $this->redirect(array('ranking/buscavendedores', 'id' => $model->vendedor->supervisor_id,'data'=>$model->dataConsulta));
                    }
                    $this->redirect(array('view', 'id' => $model->id_cliente));
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }
            }
        }
        if($model->origem == 'modalV' or $model->origem == 'modalC'){
            $this->layout  = 'semhead';
            $model->dataConsulta = $_GET['data'];
        }
        $this->render('update', array(
            'model'    => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $vendedor = $model->id_funcionario;

            foreach($model->justificativas as $justificativa){
                $justificativa->delete();
            }

            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])){
                if(Yii::app()->user->perfil == Funcionario::GERENTE){
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }else{
                    $this->redirect(array('funcionario/view', 'id' => $vendedor));
                }

            }
        } else
            throw new CHttpException(400, 'Requisição Inválida. Por favor não repetir essa requisição novamente.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Cliente('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Cliente']))
            $model->attributes = $_GET['Cliente'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Gerencia todos os aniversários.
     */
    public function actionAdminAniversarios()
    {
        $model = new Cliente('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Cliente']))
            $model->attributes = $_GET['Cliente'];
        $model->filter_aniversario = date('d/m');
		if (!Yii::app()->user->isGuest and Yii::app()->user->perfil == Funcionario::VENDEDOR ) {
			$model->id_funcionario = Yii::app()->user->id;
		} elseif (!Yii::app()->user->isGuest and Yii::app()->user->perfil == Funcionario::SUPERVISOR) {
			$model->filter_supervisor = Yii::app()->user->id;
		}
        $this->render('admin_aniversarios', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Cliente::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cliente-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
