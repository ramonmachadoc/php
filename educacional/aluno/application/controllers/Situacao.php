<?php

/**
 * Description of Situacao
 *
 * @author Karol Oliveira
 */
class Situacao extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

         if ($this->session->userdata('admin_loginaluno') != 1)
            redirect(base_url(), 'refresh');
        
    }

    public function index() {
        
        $matricula = $this->aluno_model->getTableRow('matricula_aluno', 'registro_academico', 'registro_academico', $this->session->userdata('login'));
        $page_data['turma'] = $this->aluno_model->SituationStudent($matricula['matricula_aluno_id']);
        $page_data['historicoPagamentos'] = $this->aluno_model->HistoricoPagamentos($matricula['matricula_aluno_id']);
        
        $page_data['page_name'] = 'situacao/list';
        $page_data['page_title'] = 'Pagamentos';
        $this->load->view('index', $page_data);
    }

}
