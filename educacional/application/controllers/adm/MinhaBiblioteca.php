<?php

/**
 * Description of MinhaBiblioteca
 * @author Karol Oliveira
 */

class MinhaBiblioteca extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $page_data['page_name'] = 'admin/minha_biblioteca';
        $page_data['page_title'] = 'Minha Biblioteca';
        $this->load->view('index', $page_data);
        
    }
}
