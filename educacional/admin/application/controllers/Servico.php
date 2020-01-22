<?php

class Servico extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('servico_model');
    $this->load->model('agape_model');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
  }
  public function index() {

      $page_data['servicos'] = $this->servico_model->getServico();
      $page_data['page_name'] = 'servico/list';
      $page_data['page_title'] = 'Lista servicos(s)';
      $this->load->view('index', $page_data);
  }
  public function add() {

      if ($this->input->post()) {

          $dados = array(
              "servicos_descricao" => $this->input->post('descricao'),
              "servicos_sla" => $this->input->post('sla'),
              "servicos_valor" => $this->input->post('valor'),
              "departamento_id" => $this->input->post('departamento')
          );


          if ($this->agape_model->save('servicos', $dados)) {

              $this->session->set_flashdata('message', '<strong>SERVIÇO</strong> cadastrado com sucesso!');
              $this->session->set_flashdata('type', 'success');
              redirect(base_url() . 'servico', 'refresh');
          } else {

              $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar SERVIÇO!');
              $this->session->set_flashdata('type', 'warning');
              redirect(base_url() . 'servico');
          }
      } else {
          $page_data['servicos'] = $this->servico_model->getServico();
          $page_data['departamentos'] = $this->agape_model->getTable('departamento');
          $page_data['page_name'] = 'servico/add';
          $page_data['page_title'] = 'CADASTRAR servico';
          $this->load->view('index', $page_data);
      }
  }
  public function edit($param1 = '', $param2 = '') {

      if ($this->input->post()) {

          $dados = array(
            "servicos_descricao" => $this->input->post('descricao'),
            "servicos_sla" => $this->input->post('sla'),
            "servicos_valor" => $this->input->post('valor'),
            "departamento_id" => $this->input->post('departamento')
          );

          if ($this->agape_model->update($dados, 'servicos', $param1)) {

              $this->session->set_flashdata('message', '<strong>SERVIÇO</strong> editado com sucesso!');
              $this->session->set_flashdata('type', 'success');
              redirect(base_url() . 'servico', 'refresh');
          } else {

              $this->session->set_flashdata('message', '<strong>ERRO</strong> ao editar SERVIÇO!');
              $this->session->set_flashdata('type', 'warning');
              redirect(base_url() . 'servico');
          }
      } else {

          $page_data['ServicoEdit'] = $this->agape_model->getUpdate('servicos', $param1);
          $page_data['departamentos'] = $this->agape_model->getTable('departamento');
          $page_data['page_name'] = 'servico/edit';
          $page_data['page_title'] = 'EDITAR servico';
          $this->load->view('index', $page_data);
      }
  }
}
