<?php

/**
 * Description of Categoria
 *
 * @author Karol Oliviera
 */
class Categoria extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');


        if ($this->session->userdata('admin_loginp') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['categorias'] = $this->financeiro_model->getTable('categoria', 'cat_tx_descricao');
        $page_data['page_name'] = 'categoria/list';
        $page_data['page_title'] = 'Nova Categoria';
        $this->load->view('index', $page_data);
    }

    public function ValidateExists($param1 = '') {

        $uName = $this->input->post('cat_tx_descricao');
        $isUNameCount = $this->financeiro_model->isVarExists('categoria', $uName, 'cat_tx_descricao');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function add() {

        if ($this->input->post()) {
            if ($this->financeiro_model->save('categoria', $this->input->post())) {
                $this->session->set_flashdata('message', '<strong>CATEGORIA</strong> cadastrada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'categoria');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar CATEGORIA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'categoria');
            }
        } else {
            
            $page_data['page_name'] = 'categoria/add';
            $page_data['page_title'] = 'Nova Categoria';
            $this->load->view('index', $page_data);
        }
    }

    public function delete($param1 = '') {

        $return = $this->financeiro_model->delete('categoria', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>CATEGORIA</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'categoria');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir CATEGORIA');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'categoria');
        }
    }

    public function edit($param1 = '') {

        if ($this->input->post()) {
            if ($this->financeiro_model->update($this->input->post(), 'categoria', $param1)) {

                $this->session->set_flashdata('message', '<strong>CATEGORIA</strong> alterada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'categoria');
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao alterar CATEGORIA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'categoria');
            }
        } else {
            $page_data['CategoriaEdit'] = $this->financeiro_model->getUpdate('categoria', $param1);
            $page_data['page_name'] = 'categoria/edit';
            $page_data['page_title'] = 'Editar Categoria';
            $this->load->view('index', $page_data);
        }
    }

}
