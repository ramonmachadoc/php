<?php

class Chamado extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('chamado_model');
    $this->load->model('departamento_model');
    $this->load->helper('url_helper');
  }
  function lista()
  {
    $responsavel = $this->session->userdata('login');
echo $responsavel;
    $page_data['chamados'] = $this->chamado_model->getChamados($responsavel);
    $page_data['page_name'] = 'chamados/lista';
    $page_data['page_title'] = 'Chamados';

    $this->load->view('index',$page_data);
  }
  function lista_pendente()
  {
    $responsavel = $this->session->userdata('login');

    $page_data['interacoes'] = $this->chamado_model->getInteracoesResp($responsavel);
    $page_data['page_name'] = 'chamados/lista_pendente';
    $page_data['page_title'] = 'Pendentes de resposta';

    $this->load->view('index',$page_data);
  }
  function edit($param1,$param2 = '')
  {
    $solicitante = $this->session->userdata('login');

    if ($this->input->post()) {

        if($this->input->post('situacao') == 1){
          $dados = array(
              "chamados_id" => $param1,
              "chamados_interacao_data" => date('y/m/d'),
              "chamados_interacao_texto" => $this->input->post('texto'),
              "solicitante_id" => $solicitante,
              "responsavel_id" => $this->input->post('responsavel')
          );

            $dados2 = array(
            'chamados_status' => $this->input->post('situacao')
          );
        }else{
          $dados = array(
              "chamados_id" => $param1,
              "chamados_interacao_data" => date('y/m/d'),
              "chamados_interacao_texto" => $this->input->post('texto'),
              "solicitante_id" => $solicitante,
              "responsavel_id" => $solicitante
          );

            $dados2 = array(
            'chamados_status' => $this->input->post('situacao'),
            'chamados_encerramento' => date('y/m/d')
        );
        }

        if ($this->agape_model->save('chamados_interacao',$dados)) {

            $this->agape_model->update($dados2,'chamados',$param1);
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
        $page_data['ChamadoEdit'] = $this->agape_model->getUpdate('chamados', $param1);
        $page_data['responsaveis'] = $this->departamento_model->getResponsavel();
        $page_data['page_name'] = 'chamados/edit';
        $page_data['page_title'] = 'Encaminhar chamado';
        $this->load->view('index', $page_data);
    }
}

  function interacao($param)
  {
    $responsavel = $this->session->userdata('login');

    $page_data['interacoes'] = $this->chamado_model->getInteracoesChamados($param);
    $page_data['page_name'] = 'chamados/lista_interacoes';
    $page_data['page_title'] = 'Interações';

    $this->load->view('index',$page_data);

  }
}
