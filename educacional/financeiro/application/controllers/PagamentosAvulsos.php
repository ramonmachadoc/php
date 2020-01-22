<?php

/**
 * Description of PagamentosAvulsos
 *
 * @author Karol Oliveira
 */
class PagamentosAvulsos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

          if ($this->session->userdata('admin_loginf') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['ContasReceber'] = $this->financeiro_model->GetContasReceber();
        $page_data['page_name'] = 'pagamentos_avulsos/list';
        $page_data['page_title'] = 'Receber Pagamentos de Alunos';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->input->post()) {

            $data_pagamento = explode('/', $this->input->post('data_pagamento'));
            $data_pagamento = $data_pagamento[2] . "-" . $data_pagamento[1] . "-" . $data_pagamento[0];
            $valor = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));

            $dados = array(
                "cliente" => $this->input->post('cliente'),
                "cpr_dt_vencimento" => $data_pagamento,
                "cpr_db_valor" => $valor,
                "cpr_tx_historico" => $this->input->post('historico'),
                "cat_nb_codigo" => $this->input->post('cat_nb_codigo'),
                "cpr_nb_ocorrencia" => 1,
                "cpr_nb_qtde_parcela" => 1,
                "cpr_nb_numero_parcela" => 1,
                "cpr_dt_emissao" => date('Y-m-d'),
                "cpr_nb_tipo" => 1,
                "cpr_nb_status" => 2,
            );

            $result = $this->financeiro_model->save('conta_pagar_receber', $dados);

            if ($result) {

                $dadosMovFinan = array(
                    "mf_dt_pgto" => $data_pagamento,
                    "mf_db_valor" => $valor,
                    "mf_nb_status" => 2,
                    "login_nb_codigo" => $this->session->userdata('login'),
                    "cpr_nb_codigo" => $result,
                    "mf_nb_forma_pagamento" => "",
                );

                $resultMovFinan = $this->financeiro_model->save('movimento_financeiro', $dadosMovFinan);

                if ($resultMovFinan) {

                    $this->session->set_flashdata('message', '<strong>PAGAMENTO</strong> cadastrado com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'PagamentosAvulsos');
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar PAGAMENTO!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'PagamentosAvulsos');
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar PAGAMENTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'PagamentosAvulsos');
            }
        } else {
            $page_data['categorias'] = $this->financeiro_model->getTable('categoria', 'cat_tx_descricao');

            $page_data['page_name'] = 'pagamentos_avulsos/add';
            $page_data['page_title'] = 'Adicionar Pagamento Avulso';
            $this->load->view('index', $page_data);
        }
    }

    public function PrintComprovante() {
        
        
    }

}
