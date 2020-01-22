<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of eventos
 *
 * @author Karol Oliveira
 */



class Eventos extends CI_Controller {

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

    public function evento($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'create') {

            if ($this->input->post('publicar') == "") {
                $publicar = 2;
            } else {
                $publicar = 1;
            }

            $dados = array(
                'nome' => $this->input->post('nome'),
                'data_evento' => $this->input->post('dia'),
                'horario_evento' => $this->input->post('horario'),
                'publicar' => $publicar,
                'usuario_id' => $this->session->userdata('login')
            );

          
            $result = $this->agape_model->save('evento', $dados);
            move_uploaded_file($_FILES['img']['tmp_name'], 'template/imagens_upload/evento/' . $result . '.jpg');
            $this->session->set_flashdata('message', '<strong>EVENTO</strong> cadastrado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'eventos/evento');
        }

        if ($param1 == 'update') {

            if ($this->input->post('publicar') == "") {
                $publicar = 2;
            } else {
                $publicar = 1;
            }

            $dados = array(
                'nome' => $this->input->post('nome'),
                'data_evento' => $this->input->post('dia'),
                'horario_evento' => $this->input->post('horario'),
                'publicar' => $publicar,
            );

            $this->agape_model->update($dados, 'evento', $param2);
            move_uploaded_file($_FILES['img']['tmp_name'], 'template/imagens_upload/evento/' . $param2 . '.jpg');
            $this->session->set_flashdata('message', '<strong>EVENTO</strong> atualizado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'eventos/evento');
        }


        if ($param1 == 'delete') {

            $this->agape_model->delete('evento', $param2);
            $this->session->set_flashdata('message', '<strong>EVENTO</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'eventos/evento');
        }

        $page_data['dadosEvento'] = $this->agape_model->getJoin('evento', 'usuario', 'evento_id');
        $page_data['page_title'] = 'Eventos';
        $page_data['page_name'] = 'evento/list';
        $this->load->view('index', $page_data);
    }

    public function add() {

        $page_data['page_title'] = 'Adicionar Evento';
        $page_data['page_name'] = 'evento/add';
        $this->load->view('index', $page_data);
    }

    public function update($param1 = '') {

        $page_data['updateEvento'] = $this->agape_model->getUpdate('evento', $param1);
        $page_data['page_title'] = 'Evento';
        $page_data['page_name'] = 'evento/edit';
        $this->load->view('index', $page_data);
    }

}
