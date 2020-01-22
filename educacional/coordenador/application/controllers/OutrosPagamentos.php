<?php

/**
 * Description of OutrosPagamentos
 *
 * @author Karol Oliveira
 */
class OutrosPagamentos extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');
    }

    public function outros($param1 = '') {

        $page_data['outros'] = $this->coordenador_model->getJoin('outros_pagamentos', 'produto', 'outros_pagamentos_id', 'matricula_aluno_id', $param1);
        $page_data['turma'] = $this->coordenador_model->SituationStudent($param1);
        $page_data['historicoPagamentos'] = $this->coordenador_model->HistoricoPagamentos($param1);
        $page_data['matricula_aluno_id'] = $param1;
        $page_data['page_name'] = 'outros/list';
        $page_data['page_title'] = 'Outros Pagamentos';
        $this->load->view('index', $page_data);
    }

    public function add($param1 = '') {

        if ($this->input->post()) {

            $dataPagamento = FormataDataBanco($this->input->post('datapagamento'));

            $dados = array(
                'data_pagamento' => $dataPagamento,
                'forma_pagamento' => $this->input->post('forma_pagamento'),
                'produto_id' => $this->input->post('produto'),
                'valor_pagar' => str_replace('R$', '', str_replace(',', '.', str_replace('.', '', $this->input->post('valorpagar')))),
                'valor_pago' => str_replace('R$', '', str_replace(',', '.', str_replace('.', '', $this->input->post('valorpago')))),
                'obs' => $this->input->post('obs'),
                'matricula_aluno_id' => $param1,
            );

            if ($this->financeiro_model->save('outros_pagamentos', $dados)) {

                $this->session->set_flashdata('message', '<strong>PAGAMENTO</strong> cadastrada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'OutrosPagamentos/outros/' . $param1);
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar PAGAMENTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'OutrosPagamentos/outros/' . $param1);
            }
        } else {

            $page_data['produtos'] = $this->financeiro_model->getTable('produto', 'nome');
            $page_data['page_name'] = 'outros/add';
            $page_data['matricula_aluno_id'] = $param1;
            $page_data['page_title'] = 'CADASTRAR OUTROS PAGAMENTOS';
            $this->load->view('index', $page_data);
        }
    }

    public function imprimir($param1 = '', $param2 = '') {

        $page_data['DadosAluno'] = $this->financeiro_model->SituationStudent($param2);
        $page_data['recibo'] = $this->financeiro_model->getTableRow('outros_pagamentos', 'outros_pagamentos_id', 'outros_pagamentos_id', $param1, 'produto');
        $page_data['page_name'] = 'outros/print';
        $page_data['page_title'] = 'Imprimir Pagamento';
        $this->load->view('index', $page_data);
    }

    public function delete($param1 = '', $param2 = '') {

        $return = $this->financeiro_model->delete('outros_pagamentos', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>PAGAMENTO</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'OutrosPagamentos/outros/' . $param2);
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir PAGAMENTO');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'OutrosPagamentos/outros/' . $param2);
        }
    }

}
