<?php

/*
 * Description of PeriodoLetivo
 *
 * @author Karol Oliveira
 */

class PeriodoLetivo extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');


        if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['bolsas'] = $this->coordenador_model->getTable('bolsas', 'descricao');
        $page_data['page_name'] = 'periodoLetivo/list';
        $page_data['page_title'] = 'Periodo Letivo';
        $this->load->view('index', $page_data);
    }

}
