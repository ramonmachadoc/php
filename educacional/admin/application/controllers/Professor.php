<?php

/**
 * Description of Professor
 *
 * @author Karol Oliveira
 */
class Professor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $page_data['professor'] = $this->agape_model->getTable('professor', 'nome');
        $page_data['page_name'] = 'professor/list';
        $page_data['page_title'] = 'Nova Bolsa';
        $this->load->view('index', $page_data);
    }

    public function add() {

        $page_data['page_name'] = 'professor/add';
        $page_data['page_title'] = 'Novo Professor';
        $this->load->view('index', $page_data);

        if ($this->input->post()) {

            $data_banco = explode('/', $this->input->post('nascimento'));
            $nascimento = $data_banco[2] . "-" . $data_banco[1] . "-" . $data_banco[0];

            $dados = array(
                'nome' => $this->input->post('nome'),
                'nascimento' => $nascimento,
                'sexo' => $this->input->post('sexo'),
                'endereco' => $this->input->post('endereco'),
                'bairro' => $this->input->post('bairro'),
                'cep' => $this->input->post('cep'),
                'cidade' => $this->input->post('cidade'),
                'uf' => $this->input->post('uf'),
                'situacao' => $this->input->post('situacao'),
                'email' => $this->input->post('email'),
                'login' => $this->input->post('login'),
                'senha' => $this->input->post('senha'),
            );

            $this->agape_model->save('professor', $dados);
            $this->session->set_flashdata('message', '<strong>PROFESSOR</strong> cadastrado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'professor/', 'refresh');
        }
    }

    public function ValidateExists($param1 = '') {

        $uName = $this->input->post('nome');
        $isUNameCount = $this->agape_model->isVarExists('professor', $uName, 'nome');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function update($param1 = '') {

        $page_data['page_name'] = 'professor/edit';
        $page_data['page_title'] = 'Editar Professor';
        $page_data['professores'] = $this->agape_model->GetWhere('professor', 'professor_id', $param1);
        $this->load->view('index', $page_data);

        if ($this->input->post()) {

            $data_banco = explode('/', $this->input->post('nascimento'));
            $nascimento = $data_banco[2] . "-" . $data_banco[1] . "-" . $data_banco[0];

            $dados = array(
                'nome' => $this->input->post('nome'),
                'nascimento' => $nascimento,
                'sexo' => $this->input->post('sexo'),
                'endereco' => $this->input->post('endereco'),
                'bairro' => $this->input->post('bairro'),
                'cep' => $this->input->post('cep'),
                'cidade' => $this->input->post('cidade'),
                'uf' => $this->input->post('uf'),
                'situacao' => $this->input->post('situacao'),
                'email' => $this->input->post('email'),
                'login' => $this->input->post('login'),
                'senha' => $this->input->post('senha'),
            );

            $this->agape_model->update($dados, 'professor', $param1);
            $this->session->set_flashdata('message', '<strong>PROFESSOR</strong> editado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'professor/', 'refresh');
        }
    }

    public function delete($param1 = '') {

        $this->db->where('professor_id', $param1);
        $this->db->delete('professor');
        $this->session->set_flashdata('message', '<strong>PROFESSOR <strong>excluído com sucesso!');
        $this->session->set_flashdata('type', 'warning');
        redirect(base_url() . 'professor/', 'refresh');
    }

}
