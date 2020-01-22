<?php

/**
 * Description of Fornecedor
 *
 * @author Karol Oliveira
 */

class Fornecedor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginf') != 1)
            redirect(base_url(), 'refresh');
    }

    public function ValidateExists($param1 = '') {

        $uName = $this->input->post('razaosocial');
        $isUNameCount = $this->financeiro_model->isVarExists('fornecedor', $uName, 'for_tx_razao_social');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function add() {

        if ($this->input->post()) {

            $dados = array(
                'for_tx_razao_social' => $this->input->post('razaosocial'),
                'for_tx_fone' => $this->input->post('telefone'),
                'for_tx_celular' => $this->input->post('celular'),
                'for_tx_endereco' => $this->input->post('endereco'),
                'for_tx_bairro' => $this->input->post('bairro'),
                'for_tx_cidade' => $this->input->post('cidade'),
                'for_tx_uf' => $this->input->post('uf'),
                'for_tx_cnpj' => $this->input->post('cnpj'),
                'for_nb_tipo_pessoa' => $this->input->post('tipo_pessoa'),
                'for_tx_insc_estadual' => $this->input->post('inscestadual'),
                'for_tx_cpf' => $this->input->post('cpf'),
                'for_tx_rg' => $this->input->post('rg'),
                'for_tx_cep' => $this->input->post('cep'),
                'for_tx_numero' => $this->input->post('numero'),
                'for_tx_complemento' => $this->input->post('complemento'),
                'for_tx_email' => $this->input->post('email'),
                'for_tx_fantazia' => $this->input->post('nome_fantasia'),
                'for_tx_insc_municipal' => $this->input->post('inscmunicipal'),
                'for_tx_seguimento' => $this->input->post('seguimento'),
            );

            if ($this->financeiro_model->save('fornecedor', $dados)) {
                $this->session->set_flashdata('message', '<strong>FORNECEDOR</strong> cadastrado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'fornecedor');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar FORNECEDOR!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'fornecedor');
            }
        } else {
            $page_data['page_name'] = 'fornecedor/add';
            $page_data['page_title'] = 'Novo Fornecedor';
            $this->load->view('index', $page_data);
        }
    }

    public function index() {

        $page_data['fornecedores'] = $this->financeiro_model->getTable('fornecedor', 'for_tx_razao_social');
        $page_data['page_name'] = 'fornecedor/list';
        $page_data['page_title'] = 'Novo Fornecedor';
        $this->load->view('index', $page_data);
    }

    public function edit($param1 = '') {

        if ($this->input->post()) {

            $dados = array(
                'for_tx_razao_social' => $this->input->post('razaosocial'),
                'for_tx_fone' => $this->input->post('telefone'),
                'for_tx_celular' => $this->input->post('celular'),
                'for_tx_endereco' => $this->input->post('endereco'),
                'for_tx_bairro' => $this->input->post('bairro'),
                'for_tx_cidade' => $this->input->post('cidade'),
                'for_tx_uf' => $this->input->post('uf'),
                'for_tx_cnpj' => $this->input->post('cnpj'),
                'for_nb_tipo_pessoa' => $this->input->post('tipo_pessoa'),
                'for_tx_insc_estadual' => $this->input->post('inscestadual'),
                'for_tx_cpf' => $this->input->post('cpf'),
                'for_tx_rg' => $this->input->post('rg'),
                'for_tx_cep' => $this->input->post('cep'),
                'for_tx_numero' => $this->input->post('numero'),
                'for_tx_complemento' => $this->input->post('complemento'),
                'for_tx_email' => $this->input->post('email'),
                'for_tx_fantazia' => $this->input->post('nome_fantasia'),
                'for_tx_insc_municipal' => $this->input->post('inscmunicipal'),
                'for_tx_seguimento' => $this->input->post('seguimento'),
            );

            if ($this->financeiro_model->update($dados, 'fornecedor', $param1)) {

                $this->session->set_flashdata('message', '<strong>FORNECEDOR</strong> alterado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'fornecedor');
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao alterar FORNECEDOR!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'fornecedor');
            }
        } else {
            $page_data['FornecedorEdit'] = $this->financeiro_model->getUpdate('fornecedor', $param1);
            $page_data['page_name'] = 'fornecedor/edit';
            $page_data['page_title'] = 'Editar Fornecedor';
            $this->load->view('index', $page_data);
        }
    }

    public function delete($param1 = '') {

        $return = $this->financeiro_model->delete('fornecedor', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>FORNECEDOR</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'fornecedor');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir FORNECEDOR');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'fornecedor');
        }
    }

}
