<?php

/**
 * Description of InserirDisciplinaTurma
 * @author Karol Oliveira
 */
class InserirDisciplinaTurma extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
    }

    public function index() {

        if ($this->input->post()) {
            $page_data['alunosMatriculados'] = $this->educacional_model->matriculasPorTurma($this->input->post('turma_id'));
        }

        $page_data['turmas'] = $this->educacional_model->getJoin('*', 'turma', 'periodo_letivo', 'turma_id', 'atual', 1);
        $page_data['page_name'] = 'admin/inserir_disciplina_turma';
        $page_data['page_title'] = 'Inserir Disciplina Turma';
        $this->load->view('index', $page_data);
    }

    public function inconsistenciaDisciplinas() {
               
        
        var_dump($this->input->post('teste'));
        
        
        //echo $this->input->post('teste');
    }
}
