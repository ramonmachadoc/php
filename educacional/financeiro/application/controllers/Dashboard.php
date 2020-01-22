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
        
          if ($this->session->userdata('admin_loginf') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $semestreP = "1" . date('Y');
        $semestreS = "2" . date('Y');
        $page_data['CountAluno'] = $this->financeiro_model->CountTable('cadastro_aluno');
        $page_data['CountTurmas'] = $this->financeiro_model->CountTable('turma');
        $page_data['CountProfessor'] = $this->financeiro_model->CountTable('professor');
        $page_data['CountBolsas'] = $this->financeiro_model->CountTable('bolsas');
        $page_data['GraficoTurma'] = $this->financeiro_model->GraficoTurma($semestreP, $semestreS);
        $page_data['page_name'] = 'dashboard/dashboard';
        $page_data['page_title'] = 'Dashboard';
        $this->load->view('index', $page_data);
    }

}
