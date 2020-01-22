<?php

/*
 * Description of PeriodoLetivo
 *
 * @author Karol Oliveira
 */

class PeriodoLetivo extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $page_data['periodos'] = $this->agape_model->getTable('periodo_letivo', 'periodo_letivo_id');
        $page_data['page_name'] = 'periodoLetivo/list';
        $page_data['page_title'] = 'Periodo Letivo';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->input->post()) {

            $data_banco = explode('/', $this->input->post('data_inicio'));
            $data_inicio = $data_banco[2] . "-" . $data_banco[1] . "-" . $data_banco[0];

            $datPrev = explode('/', $this->input->post('data_prev_termino'));
            $data_termino = $datPrev[2] . "-" . $datPrev[1] . "-" . $datPrev[0];

            $datTermino = explode('/', $this->input->post('data_termino'));
            $dataTermino = $datTermino[2] . "-" . $datTermino[1] . "-" . $datTermino[0];


            $dados = array(
                'periodo_letivo' => $this->input->post('periodo_letivo'),
                'periodo_letivo_descricao' => $this->input->post('periodo_letivo_descricao'),
                'dias_letivos' => $this->input->post('dias_letivos'),
                'data_inicio' => $data_inicio,
                'data_prev_termino' => $data_termino,
                'data_termino' => $dataTermino,
                'periodo_encerrado' => $this->input->post('periodo_encerrado'),
                'ano' => $this->input->post('ano'),
                'semestre' => $this->input->post('semestre'),
            );


            if ($this->agape_model->save('periodo_letivo', $dados)) {

                $this->session->set_flashdata('message', '<strong>PERÍODO LETIVO</strong> cadastrado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'PeriodoLetivo');
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar PERÍODO LETIVO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'PeriodoLetivo');
            }
        } else {

            $page_data['page_name'] = 'periodoLetivo/add';
            $page_data['page_title'] = 'Novo Período Letivo';
            $this->load->view('index', $page_data);
        }
    }

    public function edit($param1 = '') {

        if ($this->input->post()) {

            $data_banco = explode('/', $this->input->post('data_inicio'));
            $data_inicio = $data_banco[2] . "-" . $data_banco[1] . "-" . $data_banco[0];

            $datPrev = explode('/', $this->input->post('data_prev_termino'));
            $data_termino = $datPrev[2] . "-" . $datPrev[1] . "-" . $datPrev[0];

            $datTermino = explode('/', $this->input->post('data_termino'));
            $dataTermino = $datTermino[2] . "-" . $datTermino[1] . "-" . $datTermino[0];


            $dados = array(
                'periodo_letivo' => $this->input->post('periodo_letivo'),
                'periodo_letivo_descricao' => $this->input->post('periodo_letivo_descricao'),
                'dias_letivos' => $this->input->post('dias_letivos'),
                'data_inicio' => $data_inicio,
                'data_prev_termino' => $data_termino,
                'data_termino' => $dataTermino,
                'periodo_encerrado' => $this->input->post('periodo_encerrado'),
                'ano' => $this->input->post('ano'),
                'semestre' => $this->input->post('semestre'),
            );


            if (($this->agape_model->update($dados, 'periodo_letivo', $param1))) {

                $this->session->set_flashdata('message', '<strong>PERÍODO LETIVO</strong> editado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'PeriodoLetivo');
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao editar PERÍODO LETIVO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'PeriodoLetivo');
            }
        } else {

            $page_data['PeriodoEdit'] = $this->agape_model->getUpdate('periodo_letivo', $param1);
            $page_data['page_name'] = 'periodoLetivo/edit';
            $page_data['page_title'] = 'Novo Período Letivo';
            $this->load->view('index', $page_data);
        }
    }

    public function delete($param1 = '') {

        $return = $this->agape_model->delete('periodo_letivo', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>PERÍODO LETIVO</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'PeriodoLetivo');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir PERÍODO LETIVO');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'PeriodoLetivo');
        }
    }

    public function bolsas($param1 = '') {

        $page_data['InfoPeriodo'] = $this->agape_model->getUpdate('periodo_letivo', $param1);
        $page_data['bolsas'] = $this->agape_model->getTable('bolsas', 'descricao');
        $page_data['BolsasPeriodo'] = $this->agape_model->bolsasPeriodo($param1);
        $page_data['page_name'] = 'periodoLetivo/bolsas';
        $page_data['page_title'] = 'Vincular Bolsas';
        $this->load->view('index', $page_data);
    }

    public function vinculoBolsaPeriodo() {

        $data = array(
            "periodo_letivo_id" => $this->input->post('periodo_letivo'),
            "bolsas_id" => $this->input->post('bolsa_id')
        );

        if ($this->agape_model->save('bolsa_periodo', $data)) {

            $this->session->set_flashdata('message', '<strong>BOLSA</strong> vinculada com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'PeriodoLetivo/bolsas/'.$this->input->post('periodo_letivo'));
        }
    }

    public function deleteBolsa($param1 = '', $param2 = '') {

        $return = $this->agape_model->delete('bolsa_periodo', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>BOLSA </strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'PeriodoLetivo/bolsas/' . $param2);
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir BOLSA');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'PeriodoLetivo/bolsas/' . $param2);
        }
    }

}
