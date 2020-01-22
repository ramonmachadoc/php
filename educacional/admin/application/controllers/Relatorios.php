<?php

/**
 * Description of Relatorios
 *
 * @author TI.PROG
 */
class Relatorios extends CI_Controller {

    public function relatorio($param1) {
 
        $page_data['turma'] = $this->agape_model->SituationStudent($param1);
        $page_data['page_name'] = 'relatorios/relatorios';
        $page_data['page_title'] = 'Relatorios';
        $this->load->view('index', $page_data);
    }

}
