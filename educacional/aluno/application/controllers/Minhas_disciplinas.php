<?php

/**
 * Description of minhas_disciplinas
 *
 * @author Karol Oliveira
 */

class Minhas_disciplinas extends CI_Controller {

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


        $page_data['page_name'] = 'minhas_disciplinas/list';
        $page_data['page_title'] = 'Minhas Disciplinas';
        $this->load->view('index', $page_data);
    }

    public function PlanoEnsino($param1 = '') {

        $page_data['infoPlano'] = $this->aluno_model->InfoPlanoEnsino($param1);
        $resultado = $this->aluno_model->InfoPlanoEnsino($param1);
        $page_data['infoPlanoDesc'] = $this->aluno_model->InfoPlanoDesc($param1);
        $resultadoPE = $this->aluno_model->InfoPlanoDesc($param1);
        $page_data['ementa'] = $this->aluno_model->InfoEmenta($resultado['disciplina_id']);
        $page_data['aulas'] = $this->aluno_model->ConteudoAula($resultadoPE['pe_nb_codigo']);
        $page_data['page_name'] = 'minhas_disciplinas/plano_ensino';
        $page_data['page_title'] = 'Plano de Ensino';
        $this->load->view('index', $page_data);
    }

}
