<?php

class Historico extends CI_Controller {

      public function __construct()
      {
        parent::__construct();
        $this->load->model('historico_model');
        $this->load->model('matriz_model');
        $this->load->helper('url_helper');
        if ($this->session->userdata('admin_loginaluno') != 1) {
            redirect(base_url(), 'refresh');
        }
      }
      function historico_aluno()
      {
        $matricula = $this->session->userdata('login');

        $usuarios = $this->aluno_model->getTableRow('usuarios','usu_tx_login','usu_tx_login',$matricula);

        $page_data['validacao'] = $this->criaValidacao($usuarios['usuarios_id'],0);

        $page_data['historico'] = $this->historico_model->get_Historico($matricula);
        $matricula = $page_data['historico']['matricula'];

        $page_data['cursos'] = $this->historico_model->get_Historico_Disc($matricula);
        $page_data['periodo'] = $this->historico_model->get_Periodo();
        $page_data['page_name'] = 'historico/historico_layout';
        $page_data['page_title'] = 'HISTÓRICO ALUNO';


        $disciplinas = [];
        $descricao = [];
        for($n = 0;$n < sizeof($page_data['cursos']);$n++){

            array_push($disciplinas,$page_data['cursos'][$n]['disciplina_id']);
            array_push($descricao,$page_data['cursos'][$n]['disctex']);
            $page_data['ultimosemestre'] = $page_data['cursos'][$n]['discsem'];
        }
        $matricula = $this->session->userdata('login');
        $page_data['pendentes'] = $this->matriz_model->get_Matriz($matricula,$disciplinas,$descricao);

        if(empty($page_data['historico']) || empty($page_data['cursos']))
        {
          $data['page_name'] = 'validacao/naoexiste';
          $this->load->view('index',$data );
        }

        $this->load->view('index',$page_data);

      }
      function criaValidacao($usuario,$tipo){
        $codigo = $this->geraCodigo();
        $dados = array(
          "validacao_relatorio_data" => date('y/m/d'),
          "validacao_relatorio_usuario" => $usuario,
          "validacao_relatorio_tipo" => 0, // 0 - Histórico, 1 - Declaracao, 2 - Matriz
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
