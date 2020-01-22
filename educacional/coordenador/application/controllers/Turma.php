<?php

/**
 * Description of Turma
 *
 * @author Karol Oliveira
 */
class Turma extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['turmas'] = $this->coordenador_model->GetTurmas();
        $page_data['page_name'] = 'turma/list';
        $page_data['page_title'] = 'Lista Turma(s)';
        $this->load->view('index', $page_data);
    }

}
