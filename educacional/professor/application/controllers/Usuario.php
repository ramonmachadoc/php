<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Usuario
 *
 * @author Karol
 */
class Usuario extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginp') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        if ($this->session->userdata('admin_loginp') != 1)
            redirect(base_url(), 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'banner/banner', 'refresh');
    }

    public function usuario($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $dados = array(
                "usuario" => $this->input->post('nome'),
                "senha" => $this->input->post('senha'),
                "status" => 1,
                "login" => $this->input->post('login'),
            );

            $this->financeiro_model->save('usuario', $dados);
            $this->session->set_flashdata('message', '<strong>USUÁRIO</strong> cadastrado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'usuario/usuario', 'refresh');
        }


        if ($param1 == 'update') {


            $dados = array(
                "usuario" => $this->input->post('nome'),
                "senha" => $this->input->post('senha'),
                "login" => $this->input->post('login'),
            );

            $this->financeiro_model->update($dados, 'usuario', $param2);
            $this->session->set_flashdata('message', '<strong>USUÁRIO</strong> atualizado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'usuario/usuario');
        }

        if ($param1 == 'delete') {

            $this->financeiro_model->delete('usuario', $param2);
            $this->session->set_flashdata('message', '<strong>USUÁRIO</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'usuario/usuario');
        }

        $page_data['dadosUsuario'] = $this->financeiro_model->GetWhere('usuario', 'login <>', 'admin');
        $page_data['page_title'] = 'Usuário';
        $page_data['page_name'] = 'usuario/list';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_title'] = 'Adicionar Usuário';
        $page_data['page_name'] = 'usuario/add';
        $this->load->view('index', $page_data);
    }

    public function update($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['updateUsuario'] = $this->financeiro_model->getUpdate('usuario', $param1);
        $page_data['page_title'] = 'Usuário';
        $page_data['page_name'] = 'usuario/edit';
        $this->load->view('index', $page_data);
    }

}
