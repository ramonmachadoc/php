<?php

/**
 * Description of Curso
 *
 * @author Karol Oliveira
 */
class Curso extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function cursos($param1 = '', $param2 = '', $param3 = '') {



        if ($param1 == 'create') {
            $data['cur_tx_descricao'] = $this->input->post('curso');
            $data['cur_tx_abreviatura'] = $this->input->post('abreviatura');
            $data['cur_tx_coordenador'] = $this->input->post('coordenador');
            $data['cur_tx_duracao'] = $this->input->post('duracao');
            $data['cur_nb_ativ_comp_obrigatoria'] = $this->input->post('atividades_complementares');
            $data['cur_nb_estagio_obrigatoria'] = $this->input->post('estagio');
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
            $data['cur_fl_valor'] = $Valor_maskara;
            $data['instituicao_id'] = 1;
            $data['cur_tx_habilitacao'] = $this->input->post('habilidade');

            $this->agape_model->save('cursos', $data);
            $this->session->set_flashdata('message', '<strong>CURSO</strong> cadastrado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'curso/cursos/', 'refresh');
        }
        if ($param1 == 'do_update') {

            $data['cur_tx_descricao'] = $this->input->post('curso');
            $data['cur_tx_abreviatura'] = $this->input->post('abreviatura');
            $data['cur_tx_coordenador'] = $this->input->post('coordenador');
            $data['cur_tx_duracao'] = $this->input->post('duracao');
            $data['cur_nb_ativ_comp_obrigatoria'] = $this->input->post('atividades_complementares');
            $data['cur_nb_estagio_obrigatoria'] = $this->input->post('estagio');
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
            $data['cur_fl_valor'] = $Valor_maskara;
            $data['instituicao_id'] = 1;
            $data['cur_tx_habilitacao'] = $this->input->post('habilidade');

            $this->db->where('cursos_id', $param2);
            $this->db->update('cursos', $data);
            $this->session->set_flashdata('message', '<strong>CURSO</strong> editado com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'curso/cursos/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('cursos_id', $param2);
            $this->db->delete('cursos');
            $this->session->set_flashdata('message', '<strong>CURSO <strong>excluído com sucesso!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'curso/cursos/', 'refresh');
        }

        $page_data['cursos'] = $this->db->get('cursos')->result_array();
        $page_data['page_name'] = 'curso/list';
        $page_data['page_title'] = 'LISTA CURSO(S)';
        $this->load->view('index', $page_data);
    }

    public function CursoAdd() {

        $page_data['page_name'] = 'curso/add';
        $page_data['page_title'] = 'ADICIONAR CURSO';
        $this->load->view('index', $page_data);
    }

    public function update($param1 = '') {

        $page_data['page_name'] = 'curso/edit';
        $page_data['page_title'] = 'Editar Bolsa';
        $page_data['cursos'] = $this->agape_model->GetWhere('cursos', 'cursos_id', $param1);
        $this->load->view('index', $page_data);
    }

}
