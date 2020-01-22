<?php

/**
 * Description of Agenda
 *
 * @author Karol Oliveira 
 */
class Agenda extends CI_Controller {

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

        $page_data['agenda'] = $this->professor_model->GetWhere('calendario', 'tipo', 2, 'professor_id', $this->session->userdata('login'));
        $page_data['page_name'] = 'agenda/list';
        $page_data['page_title'] = 'Minha Agenda';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->input->post()) {

            $datainicio = explode('/', $this->input->post('data_inicio'));
            $datainicio = $datainicio[2] . "-" . $datainicio[1] . "-" . $datainicio[0];

            $datafim = explode('/', $this->input->post('data_fim'));
            $datafim = $datafim[2] . "-" . $datafim[1] . "-" . $datafim[0];


            $dados = array(
                "data_evento" => $datainicio,
                "titulo" => $this->input->post('titulo'),
                "data_fim" => $datafim,
                "tipo" => 2,
                "professor_id" => $this->session->userdata('login')
            );

            if ($this->professor_model->save('calendario', $dados)) {

                $this->session->set_flashdata('message', '<strong>EVENTO</strong> cadastrado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'agenda');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar EVENTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'agenda');
            }
        } else {

            $page_data['page_name'] = 'agenda/add';
            $page_data['page_title'] = 'Adicionar Evento';
            $this->load->view('index', $page_data);
        }
    }

    public function delete($param1 = '') {

        $return = $this->professor_model->delete('calendario', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>EVENTO</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'agenda');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir EVENTO');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'agenda');
        }
    }

}
