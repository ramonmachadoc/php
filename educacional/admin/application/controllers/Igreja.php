<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of igreja
 *
 * @author Karol
 */
class Igreja extends CI_Controller {

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

    public function igreja($param1 = '') {


        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'update') {

            if ($_FILES["img"]["name"] == '') {

                $imagem1 = $this->input->post('imagem1');
            } else {
                $imagem1 = $_FILES["img"]["name"];
            }

            if ($_FILES["img2"]["name"] == '') {

                $imagem2 = $this->input->post('imagem2');
            } else {
                $imagem2 = $_FILES["img2"]["name"];
            }

            $dados = array(
                "descricao" => $this->input->post('descricao'),
                "img" => $imagem1,
                "img2" => $imagem2,
            );

            $this->agape_model->update($dados, 'igreja', 1);

            move_uploaded_file($_FILES['img']['tmp_name'], 'template/imagens_upload/igreja/' . $imagem1);
            move_uploaded_file($_FILES['img2']['tmp_name'], 'template/imagens_upload/igreja/' . $imagem2);

            $this->session->set_flashdata('message', '<strong>INFORMAÇÕES</strong> atualizadas com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'igreja/igreja');
        }

        $page_data['dadosIgreja'] = $this->agape_model->getTable('igreja');
        $page_data['page_title'] = 'Igreja';
        $page_data['page_name'] = 'igreja/edit';
        $this->load->view('index', $page_data);
    }

}
