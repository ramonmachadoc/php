<?php
// api/PesquisaController.php

class AuthenticateController extends WRestController{

    protected $_modelName = "Usuario";

    public function actionLogin()
    {
        $funcionario = Funcionario::model()->findByAttributes(array('login' => $_POST['login'], 'senha' => md5($_POST['senha'])));

        /*if ($funcionario != null){
            $resposta['sucesso'] = true;
            $resposta['nome'] = $funcionario->nome;
            echo json_encode($resposta);
        }

        else {
            $resposta['sucesso'] = false;
            echo json_encode($resposta);
        }*/

        if($funcionario != null) {
            if($funcionario->status == Funcionario::ATIVO){
                $resposta['sucesso'] = true;
                $resposta['id']      = $funcionario->id_funcionario;
                $resposta['perfil']  = $funcionario->perfil;
                $resposta['nome']    = $funcionario->nome;
                $resposta['login']   = $funcionario->login;
                $resposta['senha']   = $funcionario->senha;
                $resposta['status']  = $funcionario->status;
				$resposta['data']    = date('Y-m-d H:i:s');
            }else if($funcionario->status == Funcionario::INATIVO){
                $resposta['sucesso'] = false;
                $resposta['inativo'] = true;
            }
        }else{
            $resposta['sucesso'] = false;
            $resposta['inativo'] = false;
        }

        echo json_encode($resposta);
    }
}
?>