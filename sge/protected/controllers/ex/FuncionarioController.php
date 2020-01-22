<?php

class FuncionarioController extends Controller
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
                //'expression' => 'Yii::app()->user->perfil == 1',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'trocarcarteira'),
                'users' => array('@'),
                'expression' => 'Yii::app()->user->perfil == Funcionario::GERENTE',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'adminaniversarios', 'buscavendedores', 'senha'),
                'users' => array('@'),
                //'expression' => 'Yii::app()->user->perfil == 1',
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
    public function actionView($id, $error = 0, $success = 2)
    {
		$model      = $this->loadModel($id);
		$carteira   = new Cliente('search');
		$cadastros  = new Cliente('search');
		$vendedores = new Funcionario('search');

        $carteira->unsetAttributes();
        if (isset($_GET['Cliente'])) {
            $carteira->attributes = $_GET['Cliente'];
        }
        $carteira->id_funcionario = $model->id_funcionario;
        $carteira->pagination = array('pageSize' => 100);

        $cadastros->unsetAttributes();
        if (isset($_GET['Cliente'])) {
            $cadastros->attributes = $_GET['Cliente'];
        }
        $cadastros->id_funcionario  = $model->id_funcionario;
        $cadastros->filter_data_de  = date('Y-m-d') . ' 00:00:00';
        $cadastros->filter_data_ate = date('Y-m-d') . ' 23:59:59';

        if($model->perfil == 2) {
            $vendedores->unsetAttributes();
            if (isset($_GET['Funcionario'])) {
                $vendedores->attributes = $_GET['Funcionario'];
            }
            $vendedores->supervisor_id = $model->id_funcionario;
            $vendedores->perfil = 3;
        }

        $this->render('view', array(
            'model'      => $model,
            'carteira'   => $carteira,
            'cadastros'  => $cadastros,
            'vendedores' => $vendedores,
            'error'      => $error,
            'success'    => $success
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Funcionario();
        $model->scenario = 'cadastro';
        $endereco = new Endereco();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset($_POST['Funcionario']) and isset($_POST['Endereco']) ) {
            $model->attributes      = $_POST['Funcionario'];
            $model->supervisor_id   = $_POST['Funcionario']['supervisor_id'];
            $endereco->attributes   = $_POST['Endereco'];

            $model->senha           = md5('123456');
            $model->data_admissao   = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_admissao)));
            $model->data_nascimento = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_nascimento)));

            if( $model->perfil == funcionario::VENDEDOR)
                $model->scenario = 'cadastroVendedor';

            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    
                    if( $endereco->endereco != '' ){
                        $endereco->save(false);
                        $model->endereco_id = $endereco->id_endereco;
                    }

                    $model->save(false);

                    $transaction->commit();

                    //Yii::app()->user->setFlash('success', 'Alteração Efetuada com Sucesso!');
                    $this->redirect(array('view', 
                        'id' => $model->id_funcionario
                    ));

                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }
            }
        }

        $this->render('create', array(
            'model'    => $model,
            'endereco' => $endereco,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
       
        if( $model->endereco == null )
            $endereco = new Endereco;
        else 
           $endereco = $model->endereco;


        $model->scenario = 'update';
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Funcionario'])) {
            $model->attributes    = $_POST['Funcionario'];
            $endereco->attributes = $_POST['Endereco'];

            $model->data_admissao = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_admissao)));
            $model->data_nascimento = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_nascimento)));

            if($model->perfil < 3){
                $model->supervisor_id = null;
            }

            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {

                    if( $model->endereco_id == null ){
                        $endereco->save(false);
                        $model->endereco_id = $endereco->id_endereco;            
                    } else {
                        $model->endereco->attributes = $endereco->attributes;
                        $model->endereco->save(false);
                    }

                    $model->save(false);

                    $transaction->commit();
                    //Yii::app()->user->setFlash('success', 'Alteração Efetuada com Sucesso!');
                    $this->redirect(array('view', 'id' => $model->id_funcionario));
        
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }
            }
        }


        $this->render('update', array(
            'model'    => $model,
            'endereco' => $endereco,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $qtdClientes = Yii::app()
            ->db->createCommand("
				SELECT count(*) as c
				  FROM cliente
				where id_funcionario = " . $id)->queryAll();

        if ($qtdClientes[0]['c'] == 0) {
            if (Yii::app()->request->isPostRequest) {
                /*Yii::app()->db->createCommand(
                    "delete from cliente_migrado where id_funcionario_novo = $id or id_funcionario_antigo = $id")
                    ->query();*/

                $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            } else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        } else {
            $this->redirect(array('view', 'id' => $id, 'error' => 1));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Funcionario('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Funcionario']))
            $model->attributes = $_GET['Funcionario'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Troca a Cateira do Vendedor.
     */
    public function actionTrocarCarteira()
    {
        $model = new Funcionario();
        $model->vendedor_id = $_GET['id'];
        $model->scenario    = 'trocaCarteira';

        if(isset($_POST['Funcionario'])){

            $model->attributes = $_POST['Funcionario'];
            $model->clientes_id = explode(',',$_POST['Funcionario']['clientes_id']);

            if($model->validate()) {

                $transaction = Yii::app()->db->beginTransaction();
                try {
                    //dbg(count($model->clientes_id));
                    foreach ($model->clientes_id as $id) {
                        $cliente_migrado = new ClienteMigrado();
                        $cliente = Cliente::model()->findByPk((int)$id);

                        $cliente_migrado->id_cliente            = $cliente->id_cliente;
                        $cliente_migrado->id_funcionario_antigo = $cliente->id_funcionario;
                        $cliente_migrado->id_funcionario_novo   = $model->id_funcionario;
                        $cliente_migrado->data_migracao         = date('Y-m-d H:i:s');

                        $cliente_migrado->save();

                        $cliente->id_funcionario = $model->id_funcionario;
                        $cliente->migrado        = 1;
                        $cliente->update(array('id_funcionario', 'migrado'));
                    }

                    $transaction->commit();
                    $model->clientes_id = null;

                    if ($_POST['Funcionario']['origem'] == 'retorno') {
                        Yii::app()->clientScript->registerScript('fechaTroca', '
                            parent.$("#modal-troca-carteira").modal("hide");
                            parent.$("#clientes-retorno-grid").yiiGridView("update");
                        ');
                    } else {
                        Yii::app()->clientScript->registerScript('fechaTroca', '
                            parent.$("#modal-troca-carteira").modal("hide");
                            parent.$("#carteira-grid").yiiGridView("update");
                            parent.$("#cadastros-grid").yiiGridView("update");
                        ');
                    }

                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }
            }
        }

        $this->layout = "sem-head";

        if($_GET['origem'] == 'retorno'){
            $view = 'application.views.retorno._trocar_carteira';
        }else{
            $view = 'application.views.funcionario._trocar_carteira';
        }

        $this->render($view, array(
            'model' => $model,
        ));
    }

    /**
     * Troca a Senha do Funcionario.
     */
    public function actionSenha($id)
    {
        $form = new ResetForm;

        $model = Funcionario::model()->findByAttributes(array('id_funcionario' => $id));
        $form->nome = $model->nome;

        if ($model->id_funcionario != Yii::app()->user->id) {
            $model->senha = md5('123456');

            if ($model->update(array('senha'))) {
                $this->redirect(array('view',
                    'id' => $model->id_funcionario,
                    'success' => 1
                ));
            } else {
                $this->redirect(array('view',
                    'id' => $model->id_funcionario,
                    'success' => 0
                ));
            }
        }

        if (isset($_POST['ResetForm'])) {
            $form->attributes = $_POST['ResetForm'];

            if ($form->validate()) {
                $model->senha = md5($form->senha);

                if ($model->update(array('senha'))) {

                    $this->redirect(array('view',
                        'id' => $model->id_funcionario,
                        'success' => 1
                    ));
                } else {
                    $this->redirect(array('view',
                        'id' => $model->id_funcionario,
                        'success' => 0
                    ));
                }
            }
        }

        $this->render('_trocar_senha', array('model' => $form));
    }

    /**
     * Gerencia todos os aniversários.
     */
    public function actionAdminAniversarios()
    {
        $model = new Funcionario('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Funcionario']))
            $model->attributes = $_GET['Funcionario'];
        $model->filter_aniversario = date('d/m');
        $model->status = 1;
        $this->render('admin_aniversarios', array(
            'model' => $model,
        ));
    }

    public function actionBuscaVendedores($id)
    {
        $responseJSON = array();
        $vendedores = Funcionario::model()
            ->findAllByAttributes(array('supervisor_id'=>$id));
        foreach($vendedores as $vendedor){
            $responseJSON[] = array('id'=>$vendedor->id_funcionario,'nome'=>$vendedor->nome);

        }
        echo json_encode($responseJSON);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Funcionario::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'funcionario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
