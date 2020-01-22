<?php

class Declaracao extends CI_Controller {

      public function __construct()
      {
        parent::__construct();
          $this->load->model('declaracao_model');
          $this->load->helper('url_helper');
          if ($this->session->userdata('admin_loginaluno') != 1) {
              redirect(base_url(), 'refresh');
          }
      }
      public function index()
      {
        $matricula = $this->session->userdata('login');

        $usuarios = $this->aluno_model->getTableRow('usuarios','usu_tx_login','usu_tx_login',$matricula);
        $data['validacao'] = $this->criaValidacao($usuarios['usuarios_id'],1);

        $data['declaracao'] = $this->declaracao_model->get_Declaracao($matricula);
        $data['periodo'] = $this->declaracao_model->get_Periodo();
        $data['inst'] = $this->declaracao_model->get_Inst();
        $data['page_name'] = 'declaracao/matriculado_layout';
        $data['page_title'] = 'Declaração de Matrícula';

        if(empty($data['declaracao']))
        {
          $data['page_name'] = 'validacao/naoexiste';
          $this->load->view('index',$data );
        }

        //$data['title'] = 'Histórico Escolar';

        $this->load->view('index', $data);


      }

      public function index2()
      {
        //$data['historico'] = $this->historico_model->get_Historico();
        //$data['cursos'] = $this->historico_model->get_Historico_Disc();

        //if(empty($data['declaracao']))
        //{
          //show_404();
        //}

        //$data['title'] = 'Histórico Escolar';

        $this->load->view('declaracao/cursou_layout');


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
