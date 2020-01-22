<?php

class Matriz extends CI_Controller {

      public function __construct()
      {
          parent::__construct();
          $this->load->model('matriz_model');
          $this->load->helper('url_helper');
          if ($this->session->userdata('admin_loginaluno') != 1) {
              redirect(base_url(), 'refresh');
          }
      }
      public function index()
      {
        $matricula = $this->session->userdata('login');
        $usuarios = $this->aluno_model->getTableRow('usuarios','usu_tx_login','usu_tx_login',$matricula);

        $data['validacao'] = $this->criaValidacao($usuarios['usuarios_id'],0);

        $disc = [];
        $desc = [];
        $data['curso'] = $this->matriz_model->get_Matriz_Cur($matricula);
        $data['matriz'] = $this->matriz_model->get_Matriz($matricula,$disc,$desc);
        $data['page_name'] = 'matriz/matriz_layout';
        $data['page_title'] = 'Matriz curricular';

        if(empty($data['curso']) || empty($data['matriz'])){
          $data['page_name'] = 'validacao/naoexiste';
          $this->load->view('index',$data );
        }

        $this->load->view('index',$data);

      }
      function criaValidacao($usuario,$tipo){
        $codigo = $this->geraCodigo();
        $dados = array(
          "validacao_relatorio_data" => date('y/m/d'),
          "validacao_relatorio_usuario" => $usuario,
          "validacao_relatorio_tipo" => $tipo, // 0 - Histórico, 1 - Declaracao, 2 - Matriz
          "validacao_relatorio_chave" => $codigo
        );
        if ($n = $this->aluno_model->save('validacao_relatorio', $dados)) {
          return $codigo;
        }else{
          return null;
        }
      }
      function geraCodigo(){
        $retorno = strtoupper(uniqid());

        return $retorno;
      }
}
