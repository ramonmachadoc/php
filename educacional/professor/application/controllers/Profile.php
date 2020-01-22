<?php

/**
 * Description of Profile
 *
 * @author Karol Oliveira
 */
class Profile extends CI_Controller {

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


        $page_data['DadosProfessor'] = $this->professor_model->getTableRow('professor', 'professor_id', 'professor_id', $this->session->userdata('login'));
        $page_data['page_name'] = 'profile/edit';
        $page_data['page_title'] = 'Minha Agenda';
        $this->load->view('index', $page_data);
    }

    public function edit($param1 = '') {

        $dados = array(
            "nome" => $this->input->post('nome'),
            "senha" => $this->input->post('senha'),
        );


        if ($this->professor_model->update($dados, 'professor', $param1)) {

            $this->session->set_flashdata('message', '<strong>DADOS</strong> alterados com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'profile');
        } else {
            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao alterar DADOS!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'profile');
        }
    }

}
