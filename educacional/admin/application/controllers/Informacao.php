<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Informacao
 *
 * @author Karol
 */
class Informacao extends CI_Controller {

    function __construct() {
        parent::__construct();

        //$this->load->library('m2brimagem');

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'banner/banner', 'refresh');
    }

    public function informacao($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'update') {

            $dados = array(
                "pastores" => $this->input->post('pastores'),
                "redes" => $this->input->post('redes'),
                "celulas" => $this->input->post('celulas'),
                "membros" => $this->input->post('membros')
            );

            $this->agape_model->update($dados, 'informacoes', 1);
            $this->session->set_flashdata('message', '<strong>INFORMAÇÕES</strong> atualizadas com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'informacao/informacao');
        }

        $page_data['dadosInformacao'] = $this->agape_model->getTable('informacoes');
        $page_data['page_title'] = 'Informações';
        $page_data['page_name'] = 'informacao/edit';
        $this->load->view('index', $page_data);
    }

}
