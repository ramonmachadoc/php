<?php

/**
 * Description of DisciplinasProfessor
 *
 * @author Karol Oliveira
 * 
 */
class DisciplinasProfessor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginp') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['disciplinas'] = $this->professor_model->DisciplinasProfessor($this->session->userdata('login'));
        $page_data['page_name'] = 'disciplinas/list';
        $page_data['page_title'] = 'Minhas Disciplinas';
        $this->load->view('index', $page_data);
    }

    public function PlanoEnsino($param1 = '') {

        $page_data['infoPlano'] = $this->professor_model->InfoPlanoEnsino($param1);
        $resultado = $this->professor_model->InfoPlanoEnsino($param1);
        $page_data['infoPlanoDesc'] = $this->professor_model->InfoPlanoDesc($param1);
        $resultadoPE = $this->professor_model->InfoPlanoDesc($param1);
        $page_data['ementa'] = $this->professor_model->InfoEmenta($resultado['disciplina_id']);
        $page_data['aulas'] = $this->professor_model->ConteudoAula($resultadoPE['pe_nb_codigo']);
        $page_data['page_name'] = 'disciplinas/plano_ensino';
        $page_data['page_title'] = 'Plano de Ensino';
        $this->load->view('index', $page_data);
    }

}
