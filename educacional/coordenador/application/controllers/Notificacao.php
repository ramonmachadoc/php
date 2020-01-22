<?php

/**
 * Description of Notificacao
 *
 * @author Karol Oliveira
 */
class Notificacao extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');
    }

    public function notificacao($param1 = '') {

        $page_data['notificacao'] = $this->coordenador_model->GetWhereArray('notificacao', 'matricula_aluno_id', $param1);
        $page_data['turma'] = $this->coordenador_model->SituationStudent($param1);
        $page_data['historicoPagamentos'] = $this->coordenador_model->HistoricoPagamentos($param1);
        $page_data['matricula_aluno_id'] = $param1;
        $page_data['page_name'] = 'notificacao/list';
        $page_data['page_title'] = 'Notificação para Aluno';
        $this->load->view('index', $page_data);
    }

}
