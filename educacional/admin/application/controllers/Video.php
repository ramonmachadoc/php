<?php

/**
 * Description of Video
 *
 * @author Karol
 */
class Video extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'video/video', 'refresh');
    }

    public function video($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'create') {

            if ($this->input->post('publicar') == "") {
                $publicar = 2;
            } else {
                $publicar = 1;
            }

            $date = date('Y-m-d');
            $dados = array(
                "titulo" => $this->input->post('titulo'),
                "data_video" => $date,
                "url" => $this->input->post('codigo'),
                "tipo" => $publicar,
                "usuario_id" => $this->session->userdata('login'),
            );

            $result = $this->agape_model->save('video', $dados);
            $this->session->set_flashdata('message', '<strong>VÍDEO</strong> cadastrado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'video/video', 'refresh');
        }


        if ($param1 == 'update') {

            if ($this->input->post('publicar') == "") {
                $publicar = 2;
            } else {
                $publicar = 1;
            }

            $dados = array(
                "titulo" => $this->input->post('titulo'),
                "url" => $this->input->post('codigo'),
                "tipo" => $publicar,
            );

            $this->agape_model->update($dados, 'video', $param2);
            $this->session->set_flashdata('message', '<strong>VÍDEO</strong> atualizado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'video/video');
        }

        if ($param1 == 'delete') {

            $this->agape_model->delete('video', $param2);
            $this->session->set_flashdata('message', '<strong>VÍDEO</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'video/video');
        }


        $page_data['dadosVideo'] = $this->agape_model->getJoin('video', 'usuario', 'video_id');
        $page_data['page_title'] = 'Vídeo';
        $page_data['page_name'] = 'video/list';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_title'] = 'Adicionar Vídeo';
        $page_data['page_name'] = 'video/add';
        $this->load->view('index', $page_data);
    }

    public function update($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['updateVideo'] = $this->agape_model->getUpdate('video', $param1);
        $page_data['page_title'] = 'Vídeo';
        $page_data['page_name'] = 'video/edit';
        $this->load->view('index', $page_data);
    }

}
