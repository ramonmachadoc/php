<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {


        if ($this->session->userdata('admin_loginp') == 1)
            redirect(base_url() . 'dashboard/', 'refresh');

        $config = array(
            array(
                'field' => 'usuario',
                'label' => 'text',
                'rules' => 'required'
            ),
            array(
                'field' => 'senha',
                'label' => 'password',
                'rules' => 'required|xss_clean|callback__validate_login'
            )
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('_validate_login', ucfirst($this->input->post('login_type')) . ' Login failed!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            if ($this->session->userdata('admin_loginp') == 1)
                redirect(base_url() . 'dashboard/', 'refresh');
        }
    }

    function validate_login() {

        $query = $this->db->get_where("professor", array(
            'login' => $this->input->post('usuario'),
            'senha' => $this->input->post('senha'),
            'situacao' => 'A'
        ));

        if ($query->num_rows() > 0) {

            $row = $query->row();
            $this->session->set_userdata('admin_loginp', '1');
            $this->session->set_userdata('login', $row->professor_id);
            $this->session->set_userdata('nome', $row->nome);
            $this->session->set_userdata('LoginNome', $row->login);
            $this->session->set_userdata('login_type', 'admin');
            redirect(base_url() . 'dashboard/', 'refresh');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    function logout() {

        $query = $this->db->get_where("professor", array(
            $this->session->userdata('admin_loginp') => '',
        ));

        // $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . 'login', 'refresh');
    }

}
