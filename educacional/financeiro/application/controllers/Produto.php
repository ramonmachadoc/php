<?php

/**
 * @Description: Classe Produto, usada para fazer o @CRUD - (create, update, delete, view)
 * @author Karol Oliveira
 */
class Produto extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');


         if ($this->session->userdata('admin_loginf') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['produtos'] = $this->financeiro_model->getTable('produto', 'nome');
        $page_data['page_name'] = 'produto/list';
        $page_data['page_title'] = 'Novo Produto';
        $this->load->view('index', $page_data);
    }

    public function ValidateExists($param1 = '') {

        $uName = $this->input->post('nome');
        $isUNameCount = $this->financeiro_model->isVarExists('produto', $uName, 'nome');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function add() {

        if ($this->input->post()) {
            if ($this->financeiro_model->save('produto', $this->input->post())) {
                $this->session->set_flashdata('message', '<strong>PRODUTO</strong> cadastrado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'produto');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar PRODUTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'produto');
            }
        } else {
            $page_data['page_name'] = 'fornecedor/add';
            $page_data['page_title'] = 'Novo Fornecedor';
            $this->load->view('index', $page_data);
        }
    }

    public function delete($param1 = '') {

        $return = $this->financeiro_model->delete('produto', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>PRODUTO</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'produto');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir PRODUTO');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'produto');
        }
    }

    public function edit($param1 = '') {

        if ($this->input->post()) {
            if ($this->financeiro_model->update($this->input->post(), 'produto', $param1)) {

                $this->session->set_flashdata('message', '<strong>PRODUTO</strong> alterado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'produto');
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao alterar PRODUTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'produto');
            }
        } else {
            $page_data['ProdutoEdit'] = $this->financeiro_model->getUpdate('produto', $param1);
            $page_data['page_name'] = 'produto/edit';
            $page_data['page_title'] = 'Novo Produto';
            $this->load->view('index', $page_data);
        }
    }

}
