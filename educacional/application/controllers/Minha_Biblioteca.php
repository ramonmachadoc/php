<?php

/**
 * @Description: Classe usada para gerenciar o sistema MINHA BIBLIOTECA 
 * @author Karol Oliveira
 */
class Minha_Biblioteca {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['calendario'] = $this->educacional_model->GetWhere('*', 'calendario', 'tipo', 1);
        $page_data['page_name'] = 'dashboard/dashboard';
        $page_data['page_title'] = 'Dashboard Biblioteca';
        $this->load->view('index', $page_data);
    }
}
