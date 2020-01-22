<?php

/**
 * Description of Despesas
 *
 * @author Karol Oliveira
 */
class Despesas extends CI_Controller {

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

        $page_data['depesas'] = $this->financeiro_model->GetDespesa();
        $page_data['page_name'] = 'ContasPagar/list';
        $page_data['page_title'] = 'Controle de Despesas';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->input->post()) {

            $hoje = date("Y-m-d");

            if ($this->input->post('cpr_nb_ocorrencia') == '1') {


                $data_vencimento = $this->input->post('cpr_dt_vencimento');

                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];

                $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('cpr_db_valor')));

                $dadosOC1 = array(
                    "for_nb_codigo" => $this->input->post('for_nb_codigo'),
                    "cpr_dt_vencimento" => $ano . '-' . $mes . '-' . $dia,
                    "cpr_db_valor" => $Valor_maskara,
                    "cpr_tx_num_documento" => $this->input->post('cpr_tx_num_documento'),
                    "cpr_tx_historico" => $this->input->post('cpr_tx_historico'),
                    "cat_nb_codigo" => $this->input->post('cat_nb_codigo'),
                    "cpr_nb_ocorrencia" => $this->input->post('cpr_nb_ocorrencia'),
                    "cpr_nb_qtde_parcela" => '1',
                    "cpr_nb_numero_parcela" => '1',
                    "cpr_dt_emissao" => $hoje,
                    "cpr_nb_tipo" => '2',
                    "cpr_nb_status" => $this->input->post('pago'),
                );

                $cpr_id = $this->financeiro_model->save('conta_pagar_receber', $dadosOC1);

                if ($this->input->post('pago') == '1') {
                    $dataPago = array(
                        "mf_dt_pgto" => $hoje,
                        "mf_db_valor" => $Valor_maskara,
                        "mf_nb_status" => '2',
                        "login_nb_codigo" => $this->session->userdata('login'),
                        "cpr_nb_codigo" => $cpr_id,
                        "mf_nb_forma_pagamento" => $hoje,
                    );

                    $mf_id = $this->financeiro_model->save('movimento_financeiro', $dataPago);


                    $datau['cpr_nb_status'] = $this->input->post('pago');
                    $this->db->where('conta_pagar_receber_id', $cpr_id);
                    $this->db->update('conta_pagar_receber', $datau);
                }
            } else if ($this->input->post('cpr_nb_ocorrencia') == '3') {
                /*                 * DESPESAS PARCELADAS* */

                $contador = 1;
                $quantidade_parcela = $this->input->post('parcelas');
                $data_vencimento = $this->input->post('cpr_dt_vencimento');
                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];


                $data['for_nb_codigo'] = $this->input->post('for_nb_codigo');
                $data['cpr_tx_num_orcamento'] = $this->input->post('cpr_tx_num_orcamento');

                if (($dia == '31') && ($mes == '04')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($dia == '31') && ($mes == '06')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($dia == '31') && ($mes == '09')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($dia == '31') && ($mes == '11')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($mes == '02') && ($dia >= '29') && ($ano > '2016')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '28';
                } else if (($mes == '02') && ($dia >= '30') && ($ano == '2016')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '29';
                } else {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;
                }
                $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('cpr_db_valor')));
                $data['cpr_db_valor'] = $Valor_maskara;
                $data['cpr_tx_num_documento'] = $this->input->post('cpr_tx_num_documento');
                $data['cpr_tx_historico'] = $this->input->post('cpr_tx_historico');
                $data['cat_nb_codigo'] = $this->input->post('cat_nb_codigo');
                $data['cpr_nb_ocorrencia'] = $this->input->post('cpr_nb_ocorrencia');
                $data['cpr_nb_qtde_parcela'] = $this->input->post('parcelas');
                $data['cpr_nb_numero_parcela'] = $contador;
                $data['cpr_dt_emissao'] = $hoje;
                $data['cpr_nb_tipo'] = '2';
                $data['cpr_nb_status'] = '1';
                $this->db->insert('conta_pagar_receber', $data);
                $despesa_id = mysql_insert_id();


                $quantidade_parcelan = $quantidade_parcela - 1;
                while ($contador <= $quantidade_parcelan) {

                    $contador++;
                    if ($mes == '12') {
                        $mes = '1';
                        $ano = $ano + '1';
                    } else {
                        $mes = $mes + '1';
                    }

                    $data['for_nb_codigo'] = $this->input->post('for_nb_codigo');
                    $data['cpr_tx_num_orcamento'] = $this->input->post('cpr_tx_num_orcamento');

                    if (($dia == '31') && ($mes == '04')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($dia == '31') && ($mes == '06')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($dia == '31') && ($mes == '09')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($dia == '31') && ($mes == '11')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($mes == '02') && ($dia >= '29') && ($ano > '2016')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '28';
                    } else if (($mes == '02') && ($dia >= '30') && ($ano == '2016')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '29';
                    } else {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;
                    }

                    $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('cpr_db_valor')));
                    $data['cpr_db_valor'] = $Valor_maskara;
                    $data['cpr_tx_num_documento'] = $this->input->post('cpr_tx_num_documento');
                    $data['cpr_tx_historico'] = $this->input->post('cpr_tx_historico');
                    $data['cat_nb_codigo'] = $this->input->post('cat_nb_codigo');
                    $data['cpr_nb_ocorrencia'] = $this->input->post('cpr_nb_ocorrencia');
                    $data['cpr_nb_qtde_parcela'] = $this->input->post('parcelas');
                    $data['cpr_nb_numero_parcela'] = $contador;
                    $data['cpr_dt_emissao'] = $hoje;

                    $data['cpr_nb_tipo'] = '2';
                    $data['cpr_nb_status'] = '1';
                    $data['cpr_primeira_parcela'] = $despesa_id;
                    $this->db->insert('conta_pagar_receber', $data);
                    $despesa_id_outros = mysql_insert_id();
                }
            }

            redirect(base_url() . 'Despesas');
        } else {
            $page_data['fornecedores'] = $this->financeiro_model->getTable('fornecedor', 'for_tx_razao_social');
            $page_data['categorias'] = $this->financeiro_model->getTable('categoria', 'cat_tx_descricao');
            $page_data['page_name'] = 'ContasPagar/add';
            $page_data['page_title'] = 'Controle de Despesas';
            $this->load->view('index', $page_data);
        }
    }

    public function efetuarPagamento() {


        $data_pagamento = explode('/', $this->input->post('data_pagamento'));
        $data_pagamento = $data_pagamento[2] . "-" . $data_pagamento[1] . "-" . $data_pagamento[0];

        $valor_pagamento = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pagamento')));


        $dados = array(
            "mf_dt_pgto" => $data_pagamento,
            "mf_db_valor" => $valor_pagamento,
            "login_nb_codigo" => $this->session->userdata('login'),
            "cpr_nb_codigo" => $this->input->post('cpr_codigo'),
            "mf_nb_forma_pagamento" => $this->input->post('cpr_codigo'),
        );


        $result = $this->financeiro_model->save('movimento_financeiro', $dados);

        if ($result) {

            $data2['cpr_nb_status'] = '2';
            $this->db->where('conta_pagar_receber_id', $this->input->post('cpr_codigo'));
            $this->db->update('conta_pagar_receber', $data2);
            $this->session->set_flashdata('message', '<strong>DESPESA</strong> paga com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'despesas');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao pagar DESPESA!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'despesas');
        }
    }

    public function deleteConta($param1 = '') {

        $this->db->where('cpr_nb_codigo', $param1);
        $this->db->delete('movimento_financeiro');

        $return = $this->financeiro_model->delete('conta_pagar_receber', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>DESPESA</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'despesas');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DESPESA');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'despesas');
        }
    }

    public function edit($param1 = '') {

        if ($this->input->post()) {

            $hoje = date("Y-m-d");

            if ($this->input->post('cpr_nb_ocorrencia') == '1') {


                $data_vencimento = $this->input->post('cpr_dt_vencimento');

                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];

                $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('cpr_db_valor')));

                $dadosOC1 = array(
                    "for_nb_codigo" => $this->input->post('for_nb_codigo'),
                    "cpr_dt_vencimento" => $ano . '-' . $mes . '-' . $dia,
                    "cpr_db_valor" => $Valor_maskara,
                    "cpr_tx_num_documento" => $this->input->post('cpr_tx_num_documento'),
                    "cpr_tx_historico" => $this->input->post('cpr_tx_historico'),
                    "cat_nb_codigo" => $this->input->post('cat_nb_codigo'),
                    "cpr_nb_ocorrencia" => $this->input->post('cpr_nb_ocorrencia'),
                    "cpr_nb_qtde_parcela" => '1',
                    "cpr_nb_numero_parcela" => '1',
                    "cpr_dt_emissao" => $hoje,
                    "cpr_nb_tipo" => '2',
                    "cpr_nb_status" => $this->input->post('pago'),
                );

                $cpr_id = $this->financeiro_model->save('conta_pagar_receber', $dadosOC1);

                if ($this->input->post('pago') == '1') {
                    $dataPago = array(
                        "mf_dt_pgto" => $hoje,
                        "mf_db_valor" => $Valor_maskara,
                        "mf_nb_status" => '2',
                        "login_nb_codigo" => $this->session->userdata('login'),
                        "cpr_nb_codigo" => $cpr_id,
                        "mf_nb_forma_pagamento" => $hoje,
                    );

                    $mf_id = $this->financeiro_model->save('movimento_financeiro', $dataPago);


                    $datau['cpr_nb_status'] = $this->input->post('pago');
                    $this->db->where('conta_pagar_receber_id', $cpr_id);
                    $this->db->update('conta_pagar_receber', $datau);
                }
            } else if ($this->input->post('cpr_nb_ocorrencia') == '3') {
                /*                 * DESPESAS PARCELADAS* */

                $contador = 1;
                $quantidade_parcela = $this->input->post('parcelas');
                $data_vencimento = $this->input->post('cpr_dt_vencimento');
                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];


                $data['for_nb_codigo'] = $this->input->post('for_nb_codigo');
                $data['cpr_tx_num_orcamento'] = $this->input->post('cpr_tx_num_orcamento');

                if (($dia == '31') && ($mes == '04')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($dia == '31') && ($mes == '06')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($dia == '31') && ($mes == '09')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($dia == '31') && ($mes == '11')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                } else if (($mes == '02') && ($dia >= '29') && ($ano > '2016')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '28';
                } else if (($mes == '02') && ($dia >= '30') && ($ano == '2016')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '29';
                } else {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;
                }
                $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('cpr_db_valor')));
                $data['cpr_db_valor'] = $Valor_maskara;
                $data['cpr_tx_num_documento'] = $this->input->post('cpr_tx_num_documento');
                $data['cpr_tx_historico'] = $this->input->post('cpr_tx_historico');
                $data['cat_nb_codigo'] = $this->input->post('cat_nb_codigo');
                $data['cpr_nb_ocorrencia'] = $this->input->post('cpr_nb_ocorrencia');
                $data['cpr_nb_qtde_parcela'] = $this->input->post('parcelas');
                $data['cpr_nb_numero_parcela'] = $contador;
                $data['cpr_dt_emissao'] = $hoje;
                $data['cpr_nb_tipo'] = '2';
                $data['cpr_nb_status'] = '1';
                $this->db->insert('conta_pagar_receber', $data);
                $despesa_id = mysql_insert_id();


                $quantidade_parcelan = $quantidade_parcela - 1;
                while ($contador <= $quantidade_parcelan) {

                    $contador++;
                    if ($mes == '12') {
                        $mes = '1';
                        $ano = $ano + '1';
                    } else {
                        $mes = $mes + '1';
                    }

                    $data['for_nb_codigo'] = $this->input->post('for_nb_codigo');
                    $data['cpr_tx_num_orcamento'] = $this->input->post('cpr_tx_num_orcamento');

                    if (($dia == '31') && ($mes == '04')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($dia == '31') && ($mes == '06')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($dia == '31') && ($mes == '09')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($dia == '31') && ($mes == '11')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    } else if (($mes == '02') && ($dia >= '29') && ($ano > '2016')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '28';
                    } else if (($mes == '02') && ($dia >= '30') && ($ano == '2016')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '29';
                    } else {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;
                    }

                    $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('cpr_db_valor')));
                    $data['cpr_db_valor'] = $Valor_maskara;
                    $data['cpr_tx_num_documento'] = $this->input->post('cpr_tx_num_documento');
                    $data['cpr_tx_historico'] = $this->input->post('cpr_tx_historico');
                    $data['cat_nb_codigo'] = $this->input->post('cat_nb_codigo');
                    $data['cpr_nb_ocorrencia'] = $this->input->post('cpr_nb_ocorrencia');
                    $data['cpr_nb_qtde_parcela'] = $this->input->post('parcelas');
                    $data['cpr_nb_numero_parcela'] = $contador;
                    $data['cpr_dt_emissao'] = $hoje;

                    $data['cpr_nb_tipo'] = '2';
                    $data['cpr_nb_status'] = '1';
                    $data['cpr_primeira_parcela'] = $despesa_id;
                    $this->db->insert('conta_pagar_receber', $data);
                    $despesa_id_outros = mysql_insert_id();
                }
            }

            redirect(base_url() . 'Despesas');
        } else {
            $page_data['ContaEdit'] = $this->financeiro_model->getUpdate('conta_pagar_receber', $param1);
            $page_data['fornecedores'] = $this->financeiro_model->getTable('fornecedor', 'for_tx_razao_social');
            $page_data['categorias'] = $this->financeiro_model->getTable('categoria', 'cat_tx_descricao');
            $page_data['page_name'] = 'ContasPagar/edit';
            $page_data['page_title'] = 'Controle de Despesas';
            $this->load->view('index', $page_data);
        }
    }

}
