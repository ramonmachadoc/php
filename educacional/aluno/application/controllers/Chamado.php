<?php

class Chamado extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('chamado_model');
    $this->load->model('aluno_model');
    $this->load->helper('url_helper');
    if ($this->session->userdata('admin_loginaluno') != 1) {
        redirect(base_url(), 'refresh');
    }
  }
  function abertura()
  {

      $page_data['servicos'] = $this->chamado_model->getServicos();
      $page_data['page_name'] = 'chamados/abertura';
      $page_data['page_title'] = 'Novo chamado';

      $this->load->view('index',$page_data);

  }
  function lista($param1 = '')
  {
    $solicitante = $this->session->userdata('login');
    echo $param1;
    $page_data['chamados'] = $this->chamado_model->getChamados($solicitante);
    $page_data['page_name'] = 'chamados/lista';
    $page_data['page_title'] = 'Novo chamado';

    $this->load->view('index',$page_data);
  }
  function add(){
    $solicitante = $this->session->userdata('login');

    if($this->input->post()){
      $dados = array(
          "solicitante_id" => $solicitante,
          "servicos_id" => $this->input->post('servico'),
          "chamados_obs" => $this->input->post('observacao'),
          "chamados_abertura" => date('y/m/d'),
          "chamados_status" => 0
      );

      if ($n = $this->aluno_model->save('chamados', $dados)) {

        $row = $this->aluno_model->getTableRow('servicos', 'servicos_id', 'servicos_id', $this->input->post('servico'));

        $dep_Id = $row['departamento_id'];

        $row = $this->aluno_model->getTableRow('departamento', 'departamento_id', 'departamento_id', $dep_Id);

        $resp_Id = $row['responsavel_id'];

        $dados_Interacao = array(
          "chamados_interacao_data" => date('y/m/d'),
          "chamados_interacao_texto" => $this->input->post('observacao'),
          "chamados_id" => $n,
          "solicitante_id" => $solicitante,
          "responsavel_id" => $resp_Id
        );
        $this->aluno_model->save('chamados_interacao', $dados_Interacao);

          $this->session->set_flashdata('message', '<strong>Chamado</strong> aberto com sucesso!');
          $this->session->set_flashdata('type', 'success');
          redirect(base_url() . 'chamado/lista', 'refresh');
      } else {

          $this->session->set_flashdata('message', '<strong>ERRO</strong> ao abrir chamado!');
          $this->session->set_flashdata('type', 'warning');
          redirect(base_url() . 'chamado/abertura');
      }
    }else{

      $solicitante = $this->session->userdata('login');

      $page_data['servicos'] = $this->chamado_model->getServicos();
      $page_data['page_name'] = 'chamados/abertura';
      $page_data['page_title'] = 'Novo chamado';

      $this->load->view('index',$page_data);
      }
  }
  function edit($param1){
    $solicitante = $this->session->userdata('login');

    if ($this->input->post()) {

        $dados = array(
              "chamados_satisfacao" => $this->input->post('fb')
          );

        if ($this->aluno_model->update($dados,'chamados',$param1)) {

            $this->session->set_flashdata('message', '<strong>CHAMADO</strong> encaminhado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'chamado/lista', 'refresh');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao encaminhar CHAMADO!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'chamado/lista');
        }
    } else {

        $page_data['responsavel'] = $solicitante;
        $page_data['ChamadoEdit'] = $this->chamado_model->getChamadosInt($param1);
        $page_data['page_name'] = 'chamados/edit';
        $page_data['page_title'] = 'Encaminhar chamado';
        $this->load->view('index', $page_data);
    }
  }
}
