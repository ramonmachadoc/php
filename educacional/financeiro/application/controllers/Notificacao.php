<?php

/**
 * Description of Notificacao
 *
 * @author Karol Oliveira
 */
class Notificacao extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginf') != 1)
            redirect(base_url(), 'refresh');
    }

    public function notificacao($param1 = '') {

        $page_data['notificacao'] = $this->financeiro_model->GetWhereArray('notificacao', 'matricula_aluno_id', $param1);
        $page_data['turma'] = $this->financeiro_model->SituationStudent($param1);
        $page_data['historicoPagamentos'] = $this->financeiro_model->HistoricoPagamentos($param1);
        $page_data['matricula_aluno_id'] = $param1;
        $page_data['page_name'] = 'notificacao/list';
        $page_data['page_title'] = 'Notificação para Aluno';
        $this->load->view('index', $page_data);
    }

    public function add($param1 = '') {

        if ($this->input->post()) {

            $dataInicio = FormataDataBanco($this->input->post('DataInicio'));
            $dataFim = FormataDataBanco($this->input->post('DataFim'));

            $dados = array(
                'texto' => $this->input->post('descricao'),
                'matricula_aluno_id' => $param1,
                'data_inicio' => $dataInicio,
                'data_fim' => $dataFim,
            );

            if ($this->financeiro_model->save('notificacao', $dados)) {

                $this->session->set_flashdata('message', '<strong>NOTIFICAÇÃO</strong> cadastrada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'notificacao/notificacao/' . $param1);
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar NOTIFICAÇÃO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'notificacao/notificacao/' . $param1);
            }
        } else {

            $page_data['page_name'] = 'notificacao/add';
            $page_data['matricula_aluno_id'] = $param1;
            $page_data['page_title'] = 'CADASTRAR NOTIFICAÇÃO PARA ALUNO';
            $this->load->view('index', $page_data);
        }
    }

    public function delete($param1 = '', $param2 = '') {


        $return = $this->financeiro_model->delete('notificacao', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>NOTIFICAÇÃO</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'notificacao/notificacao/' . $param2);
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir NOTIFICAÇÃO');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'notificacao/notificacao/' . $param2);
        }
    }

}
