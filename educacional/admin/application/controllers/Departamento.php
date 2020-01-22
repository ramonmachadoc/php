<?php

class Departamento extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('departamento_model');
    $this->load->model('agape_model');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
  }
  public function index() {

      $page_data['departamentos'] = $this->departamento_model->getDepartamentos();
      $page_data['page_name'] = 'departamento/list';
      $page_data['page_title'] = 'Lista Departamentos(s)';
      $this->load->view('index', $page_data);
  }
  public function add() {

      if ($this->input->post()) {

          $dados = array(
              "departamento_nome" => $this->input->post('nome'),
              "responsavel_id" => $this->input->post('responsavel')
          );


          if ($this->agape_model->save('departamento', $dados)) {

              $this->session->set_flashdata('message', '<strong>Departamento</strong> cadastrado com sucesso!');
              $this->session->set_flashdata('type', 'success');
              redirect(base_url() . 'departamento', 'refresh');
          } else {

              $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar Departamento!');
              $this->session->set_flashdata('type', 'warning');
              redirect(base_url() . 'departamento');
          }
      } else {
          $page_data['departamentos'] = $this->departamento_model->getDepartamentos();
          $page_data['responsaveis'] = $this->departamento_model->getResponsavel();
          $page_data['page_name'] = 'departamento/add';
          $page_data['page_title'] = 'CADASTRAR Departamento';
          $this->load->view('index', $page_data);
      }
  }
  public function edit($param1 = '') {

      if ($this->input->post()) {

          $dados = array(
              "departamento_nome" => $this->input->post('nome'),
              "responsavel_id" => $this->input->post('responsavel')
          );

          if ($this->agape_model->update($dados, 'departamento', $param1)) {

              $this->session->set_flashdata('message', '<strong>DEPARTAMENTO</strong> editado com sucesso!');
              $this->session->set_flashdata('type', 'success');
              redirect(base_url() . 'departamento', 'refresh');
          } else {

              $this->session->set_flashdata('message', '<strong>ERRO</strong> ao editar DEPARTAMENTO!');
              $this->session->set_flashdata('type', 'warning');
              redirect(base_url() . 'departamento');
          }
      } else {

          $page_data['DepartamentoEdit'] = $this->agape_model->getUpdate('departamento', $param1);
          $page_data['responsaveis'] = $this->departamento_model->getResponsavel();
          $page_data['page_name'] = 'departamento/edit';
          $page_data['page_title'] = 'EDITAR DEPARTAMENTO';
          $this->load->view('index', $page_data);
      }
  }
}
