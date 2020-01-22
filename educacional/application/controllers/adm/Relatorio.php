<?php

/**
 * Description of Relatorio
 * @author Karol Oliveira
 */
class Relatorio extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {


        $periodo = $this->educacional_model->getTableRow('periodo_letivo', null, 'atual', 1);
        $page_data['disciplinas'] = $this->educacional_model->disciplinasLiberacoes($periodo['periodo_letivo_id'], 3); //Disciplianas por período

        $page_data['page_name'] = 'admin/relatorio_notas';
        $page_data['page_title'] = 'Relatório Inconsistência Notas';
        $this->load->view('index', $page_data);
    }

}
