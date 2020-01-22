<?php

class Historico extends CI_Controller {

      public function __construct()
      {
        parent::__construct();
        $this->load->model('historico_model');
        $this->load->helper('url_helper');
      }
      function historico_aluno($param1 = '')
      {

        $page_data['historico'] = $this->historico_model->get_Historico($param1);
        $page_data['cursos'] = $this->historico_model->get_Historico_Disc($param1);
        $page_data['periodo'] = $this->historico_model->get_Periodo();
        $page_data['page_name'] = 'historico/historico_layout';
        $page_data['page_title'] = 'HISTÓRICO ALUNO';

        if(empty($page_data['historico']) || empty($page_data['cursos']))
        {
          show_404();
        }

        $this->load->view('index',$page_data);

      }
}
