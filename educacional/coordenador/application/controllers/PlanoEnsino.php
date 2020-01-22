<?php

/**
 * Description of PlanoEnsino
 *
 * @author Karol Oliveira
 */
class PlanoEnsino extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');


        if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');
    }

    public function PlanoEnsino($param1 = '') {

        $page_data['infoPlano'] = $this->coordenador_model->InfoPlanoEnsino($param1);
        $resultado = $this->coordenador_model->InfoPlanoEnsino($param1);
        $page_data['infoPlanoDesc'] = $this->coordenador_model->InfoPlanoDesc($param1);
        $resultadoPE = $this->coordenador_model->InfoPlanoDesc($param1);
        $page_data['ementa'] = $this->coordenador_model->InfoEmenta($resultado['disciplina_id']);
        $page_data['aulas'] = $this->coordenador_model->ConteudoAula($resultadoPE['pe_nb_codigo']);
        $page_data['page_name'] = 'plano_ensino/plano_ensino';
        $page_data['page_title'] = 'Plano de Ensino';
        $this->load->view('index', $page_data);
    }

}
