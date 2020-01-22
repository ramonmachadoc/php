<?php
// api/PesquisaController.php

class ClienteController extends WRestController{

    protected $_modelName = "ClienteAPI"; //model para ser usado como fonte

    public function actions() //determinar qual das ações padrão irá suportar o controller
    {
        return array(
            'list' => array( //usado para listar objetos
                'class'    => 'WRestListAction',
                'filterBy' => array( //este parametro usado em 'expressão WHERE' quando formando uma consulta db
                    'id_funcionario' => $_GET['vendedor'], // 'nome_na_tabela' => 'nome_parametro_requisicao'/
                    'id_cliente'     => $_GET['id_cliente'],
                    'login'          => $_GET['login'],
                ),
                'limit' => 'limit', //Nome do parâmetro de solicitação que irá conter um limite de objeto
                'page'  => 'page', //Nome do parâmetro de solicitação que irá conter um núm página solicitada
                'order' => 'id_cliente DESC', //Nome do parâmetro de solicitação que irá conter a encomenda para tipo
            ),
            'delete' => 'WRestDeleteAction',
            'get'    => 'WRestGetAction',
            'create' => 'WRestCreateAction', //fornecer parametro 'cenário'
            'update' => array( //usado para listar objetos
                'class' => 'WRestUpdateAction',
                'filterBy' => array( //este parametro usado em 'expressão WHERE' quando formando uma consulta db
                    'id_funcionario' => $_GET['vendedor'], // 'nome_na_tabela' => 'nome_parametro_requisicao'/
                    'data'           => $_GET['data'],
                ),
                'limit' => 'limit', //Nome do parâmetro de solicitação que irá conter um limite de objeto
                'page' => 'page', //Nome do parâmetro de solicitação que irá conter um núm página solicitada
                'order' => 'id_cliente DESC', //Nome do parâmetro de solicitação que irá conter a encomenda para tipo
            ),
        );
    }
}
?>