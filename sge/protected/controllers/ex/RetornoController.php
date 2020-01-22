<?php

class RetornoController extends Controller
{
    public $layout = '//layouts/column1';

    public $defaultAction = 'reagendar';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('admin','view','reagendar', 'adminanteriores'),
                'users'   => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }


    public function actionReagendar($id){
        $model = Cliente::model()->findByPk($id);
        $model->scenario = 'formRetorno';

        if ( isset($_POST['Cliente']) ) {
            $model->attributes       = $_POST['Cliente'];
            $model->aniversario      = $model->dia . '/' .$model->mes;
            $model->data_atualizacao = new CDbExpression('NOW()');


            if($model->data_retorno != '' ){
                $model->data_retorno = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_retorno)));
            } else {
                $model->data_retorno = null;
			}
            if($model->data_venda != '' ){
				$model->venda = $model->data_venda;
                $model->data_venda = date('Y-m-d', strtotime(str_replace('/', '-', $model->data_venda)));
            } else {
                $model->data_venda = null; 
            }

            //seta cenario
            if( $model->status == Cliente::REAGENDADO )
                $model->scenario = 'reagendado';
            else if( $model->status == Cliente::VENDA )
                $model->scenario = 'venda';            


            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $model->save();
                    $justificativa = new Justificativa;
                    $justificativa->id_cliente = $model->id_cliente;
                    $justificativa->dtCadastro = new CDbExpression('NOW()');
                    $justificativa->status     = $model->status;
                    $justificativa->texto      = nl2br($model->justificativa);
                    $justificativa->save();
                    
                    //reagenda para 2 anos a frente 
                    if( $model->status == Cliente::VENDA )
                        $this->reagendar2Anos($model);
            
                    $transaction->commit();
                    $this->redirect(array('view', 'id' => $model->id_cliente));

                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }
            }
        }


        $this->render('reagendamento', array(
            'model'    => $model,
        ));
    }

     private function reagendar2Anos($model){
        $model->data_retorno = date('Y-m-d', strtotime("+730 days",strtotime($model->data_venda)));
        $model->status = Cliente::REAGENDADO;
        $model->save();

        $justificativa = new Justificativa;
        $justificativa->id_cliente = $model->id_cliente;
        $justificativa->status     = Cliente::REAGENDADO;
        $justificativa->texto      = "REAGENDAMENTO AUTOMATICO DO SISTEMA - 2 anos após a venda que foi realizada em: (".date('d/m/Y', strtotime(str_replace('-','/',$model->data_venda))).").";
        $justificativa->dtCadastro =  new CDbExpression('NOW()');
        $justificativa->save();
     }

    public function actionAdmin()
    {
        $model = new Cliente('search');
        $model->unsetAttributes();
        $model->filter_data_retorno_hoje  = date('Y-m-d');
        $model->pagination = array('pageSize' => 100);

        if (isset($_GET['Cliente'])){
            $model->attributes = $_GET['Cliente'];
        }
        if (Yii::app()->user->perfil == Funcionario::VENDEDOR) {
            $model->id_funcionario = Yii::app()->user->id;
        } elseif (Yii::app()->user->perfil == Funcionario::SUPERVISOR) {
            $model->filter_supervisor = Yii::app()->user->id;
        }
        $this->render('admin_hoje', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdminAnteriores()
    {
        $model = new Cliente('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Cliente'])) {
            $model->attributes = $_GET['Cliente'];
            /*$resultData = Utils::comparar($model->data_retorno);
            //dbg('data info: ' . $model->data_retorno. ' data hoje: ' . date('d/m/Y ') . $resultData);
            if($resultData < 3){
                $model->data_retorno = '';
                $model->data_posterior = 1;
            }*/
        }

        if (Yii::app()->user->perfil == Funcionario::VENDEDOR) {
            $model->id_funcionario = Yii::app()->user->id;
        } elseif (Yii::app()->user->perfil == Funcionario::SUPERVISOR) {
            $model->filter_supervisor = Yii::app()->user->id;
        }

        $model->filter_retorno_anterior = true;
        $model->pagination = array('pageSize' => 100);
        $this->render('admin_anteriores', array(
            'model' => $model,
        ));
    }

    public function actionView($id)
    {
        $this->render('view', array(
            'model' =>  Cliente::model()->findByPk($id),
        ));
    }

}
