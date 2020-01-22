<?php

/**
 * Description of Dashboard
 *
 * @author Karol Oliveira
 */
class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        
          if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {



        $page_data['calendario'] = $this->coordenador_model->GetWhere('calendario', 'tipo', 1);
        $page_data['page_name'] = 'dashboard/dashboard';
        $page_data['page_title'] = 'Dashboard';
        $this->load->view('index', $page_data);
    }

}
