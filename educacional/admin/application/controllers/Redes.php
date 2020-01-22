<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of redes
 *
 * @author Karol
 */
class Redes extends CI_Controller {

    function __construct() {
        parent::__construct();

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

    public function rede($param1 = '', $param2 = '') {

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
                'responsavel' => $this->input->post('responsavel'),
                'publicar' => $publicar,
                'usuario_id' => $this->session->userdata('login')
            );

            $result = $this->agape_model->save('rede', $dados);
            move_uploaded_file($_FILES['img']['tmp_name'], 'template/imagens_upload/rede/' . $result . '.jpg');
            $this->session->set_flashdata('message', '<strong>REDE</strong> cadastrada com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'redes/rede');
        }


        if ($param1 == 'update') {

            if ($this->input->post('publicar') == "") {
                $publicar = 2;
            } else {
                $publicar = 1;
            }

            $dados = array(
                'nome' => $this->input->post('nome'),
                'responsavel' => $this->input->post('responsavel'),
                'publicar' => $publicar,
            );

            $this->agape_model->update($dados, 'rede', $param2);
            move_uploaded_file($_FILES['img']['tmp_name'], 'template/imagens_upload/rede/' . $param2 . '.jpg');
            $this->session->set_flashdata('message', '<strong>REDE</strong> atualizada com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'redes/rede');
        }


        if ($param1 == 'delete') {

            $this->agape_model->delete('rede', $param2);
            $this->session->set_flashdata('message', '<strong>REDE</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'redes/rede');
        }


        $page_data['dadosRede'] = $this->agape_model->getJoin('rede', 'usuario', 'rede_id');
        $page_data['page_title'] = 'REDES';
        $page_data['page_name'] = 'rede/list';
        $this->load->view('index', $page_data);
    }

    public function add() {

        $page_data['page_title'] = 'Adicionar Rede';
        $page_data['page_name'] = 'rede/add';
        $this->load->view('index', $page_data);
    }

    public function update($param1 = '') {

        $page_data['updateRede'] = $this->agape_model->getUpdate('rede', $param1);
        $page_data['page_title'] = 'Atualizar Rede';
        $page_data['page_name'] = 'rede/edit';
        $this->load->view('index', $page_data);
    }

}
