<?php
/**
 * Description of Minhas_notas
 *
 * @author Karol Oliveira
 */

class Minhas_notas extends CI_Controller {

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

//        $matricula = $this->aluno_model->getTableRow('matricula_aluno', 'registro_academico', 'registro_academico', $this->session->userdata('login'));
//        $info = $this->aluno_model->GetMatriculaTurma($matricula['matricula_aluno_id']);
//        $page_data['notas'] = $this->aluno_model->NotasAluno($info['matricula_aluno_turma_id']);




        $page_data['page_name'] = 'minhas_notas/list';
        $page_data['page_title'] = 'Minhas Notas';
        $this->load->view('index', $page_data);
    }

}
