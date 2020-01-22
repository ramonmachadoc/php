<?php
/**
 * Description of Bolsa
 *
 * @author Karol Oliveira
 */

class Bolsa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function bolsas($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $this->agape_model->save('bolsas', $this->input->post());
            $this->session->set_flashdata('message', '<strong>BOLSA</strong> cadastrada com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'educacional/bolsas/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->from('bolsa_periodo');
            $this->db->where('bolsas_id', $param2);

            $numrows2 = $this->db->count_all_results();
            if ($numrows2 >= 1) {

                $this->session->set_flashdata('message', '<strong>Esta Bolsa tem vínculos em bolsas período e não pode ser excluída.</strong>');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->db->where('bolsas_id', $param2);
                $this->db->delete('bolsas');
                $this->session->set_flashdata('message', '<strong> <strong>excluída com sucesso!');
                $this->session->set_flashdata('type', 'warning');
            }

            redirect(base_url() . 'bolsa/bolsas', 'refresh');
        }

        $page_data['bolsas'] = $this->agape_model->getTable('bolsas', 'descricao');
        $page_data['page_name'] = 'bolsa/list';
        $page_data['page_title'] = 'Nova Bolsa';
        $this->load->view('index', $page_data);
    }

    function bolsasAdd() {

        $page_data['page_name'] = 'bolsa/add';
        $page_data['page_title'] = 'Nova Bolsa';
        $this->load->view('index', $page_data);
    }

    function update($param1 = '') {


        $page_data['page_name'] = 'bolsa/edit';
        $page_data['page_title'] = 'Editar Bolsa';
        $page_data['bolsas'] = $this->agape_model->GetWhere('bolsas', 'bolsas_id', $param1);
        $this->load->view('index', $page_data);

        if ($this->input->post()) {

            $resultUpdate = $this->agape_model->update($this->input->post(), 'bolsas', $param1);
            $this->session->set_flashdata('message', '<strong>BOLSA</strong> editada com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'bolsa/bolsas', 'refresh');
        }
    }

}
