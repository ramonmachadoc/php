<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of galeria
 *
 * @author Karol
 */
class Galeria extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'banner/banner', 'refresh');
    }

    public function galeria($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'create') {

            if ($this->input->post('publicar') == "") {
                $publicar = 2;
            } else {
                $publicar = 1;
            }

            $date = date('d-m-Y');

            $dados = array(
                "nome" => $this->input->post('nome'),
                "descricao" => $this->input->post('descricao'),
                "data_album" => $date,
                "publicar" => $publicar,
                "usuario_id" => $this->session->userdata('login'),
            );

            $return = $this->agape_model->save('album', $dados);
            $this->session->set_flashdata('message', '<strong>ALBUM</strong> cadastrado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'galeria/album_fotos/' . $return, 'refresh');
        }

        if ($param1 == 'delete') {

            $this->agape_model->deleteAlbum('album_fotos', $param2);
            $this->agape_model->delete('album', $param2);
            $this->session->set_flashdata('message', '<strong>ALBUM</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'galeria/galeria');
        }


        $page_data['dadosGaleria'] = $this->agape_model->GetAlbumFoto('album', 'usuario', 'album_id');
        $page_data['page_title'] = 'Galeria';
        $page_data['page_name'] = 'galeria/list';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_title'] = 'Adicionar Banner';
        $page_data['page_name'] = 'galeria/add';
        $this->load->view('index', $page_data);
    }

    public function album_fotos($param1 = '', $param2 = '') {

        $page_data['dadosAlbum'] = $this->agape_model->GetWhere('album_fotos', 'album_id', $param1);
        $page_data['album'] = $this->agape_model->getUpdate('album', $param1);
        $page_data['id_album'] = $param1;
        $page_data['page_title'] = 'Lista de Fotos';
        $page_data['page_name'] = 'galeria/list_foto';
        $this->load->view('index', $page_data);
    }

    public function addFoto($param1 = '', $param2 = '', $param3 = '') {

        if ($param1 == 'create') {

            $capa = $this->input->post('capa');
            $retorno = $this->agape_model->verificaAlbum('album_fotos', $param2);

            if ($retorno == 0) {

                $capa = 1;
            } else {

                if ($capa == 1) {

                    $dados = array(
                        'capa_album' => 2
                    );

                    $this->agape_model->UpdateAlbum($dados, 'album_fotos', $param2);
                } else {

                    $dados = array(
                        'capa_album' => 2
                    );
                    $capa = 1;
                    $this->agape_model->UpdateAlbum($dados, 'album_fotos', $param2);
                }
            }

            $dados = array(
                "album_id" => $param2,
                "legenda" => $this->input->post('legenda'),
                "capa_album" => $capa,
            );

            $return = $this->agape_model->save('album_fotos', $dados);
            move_uploaded_file($_FILES['img']['tmp_name'], 'template/imagens_upload/galeria/' . $return . '.jpg');
            $this->session->set_flashdata('message', '<strong>FOTO</strong> cadastrada com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'galeria/album_fotos/' . $param2, 'refresh');
        }

        if ($param1 == 'update') {

            $capa = $this->input->post('capa');

            if ($capa == 1) {

                $dados = array(
                    'capa_album' => 2
                );

                $this->agape_model->UpdateAlbum($dados, 'album_fotos', $param3);
            } else {

                $dados = array(
                    'capa_album' => 2
                );

                $capa = 1;
                $this->agape_model->UpdateAlbum($dados, 'album_fotos', $param3);
            }

            $dados = array(
                "legenda" => $this->input->post('legenda'),
                "capa_album" => $capa,
            );

            $this->agape_model->update($dados, 'album_fotos', $param2);
            move_uploaded_file($_FILES['img']['tmp_name'], 'template/imagens_upload/galeria/' . $param2 . '.jpg');
            $this->session->set_flashdata('message', '<strong>FOTO</strong> alterada com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'galeria/album_fotos/' . $param3, 'refresh');
        }

        if ($param1 == 'delete') {


            $this->agape_model->delete('album_fotos', $param2);
            $this->session->set_flashdata('message', '<strong>FOTO</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'galeria/album_fotos/' . $param3);
        }


        $page_data['album_id'] = $param1;
        $page_data['page_title'] = 'Adicionar Foto';
        $page_data['page_name'] = 'galeria/add_foto';
        $this->load->view('index', $page_data);
    }

    public function update($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['updateFoto'] = $this->agape_model->getUpdate('album_fotos', $param1);
        $page_data['album_id'] = $param2;
        $page_data['page_title'] = 'Foto';
        $page_data['page_name'] = 'galeria/edit_foto';
        $this->load->view('index', $page_data);
    }

}
