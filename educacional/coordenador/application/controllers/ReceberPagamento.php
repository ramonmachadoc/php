<?php

/**
 * Description of ReceberPagamento
 *
 * @author Karol Oliveira
 */
class ReceberPagamento extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');


        if ($this->session->userdata('admin_loginc') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {
       
        $page_data['cursos'] = $this->coordenador_model->getTable('cursos', 'cur_tx_descricao');
        $page_data['page_name'] = 'movimentos_financeiros/receber_pagamento_aluno';
        $page_data['page_title'] = 'Receber Pagamentos de Alunos';
        $this->load->view('index', $page_data);
    }

    public function carregaPeriodoLetivo($param1 = '') {

        $ArrayPeridoLetivo = $this->coordenador_model->getPeriodoLetivo($param1);


        echo " <label>Período Letivo</label>";
        echo "<select  class='form-control'  name='periodo_letivo' id='periodo_letivo' onchange='buscar_turma()'  >";
        echo "<option value='0'> Escolha o Período Letivo</option>";

        foreach ($ArrayPeridoLetivo as $row) {
            $periodo_letivo = $row['periodo_letivo'];
            $periodo_letivo_id = $row['periodo_letivo_id'];
            if ($periodo_letivo != null) {
                $periodo_letivo_descricao = $row['periodo_letivo'];
            } else {
                $periodo_letivo_descricao = $row['ano'] . '/' . $row['semestre'];
            }
            echo "<option value='$periodo_letivo_id'> $periodo_letivo_descricao</option>";
        }
        echo " </select>";
    }

    /* USADO PARAMETRO 2 E 3 PQ A FUNÇÃO buscar_turma COLOCA UMA "/" */

    public function carregaTurma($param1 = '', $param2 = '', $param3 = '') {

        $DadosPeriodo = $this->coordenador_model->getTableRow('periodo_letivo', 'periodo_letivo', 'periodo_letivo_id', $param2);
        $periodo = $DadosPeriodo['periodo_letivo'];
        $ArrayTurma = $this->coordenador_model->getTurma($param1, $periodo = $periodo . "" . $param3);

        echo " <label>Turma</label>";
        echo "<select  class='form-control' name='turma_busca' id='turma_busca'   >";
        echo '<option value="">Selecione o Turma</option>';

        foreach ($ArrayTurma as $row) {
            $id_turma = $row['turma_id'];
            $turma = $row['turma'];

            $turno = $row['turno'];
            $periodo2 = $row['periodo'];

            if ($periodo2 == 1) {
                $periodo = 'I';
            } else if ($periodo2 == 2) {
                $periodo = 'II';
            } else if ($periodo2 == 3) {
                $periodo = 'III';
            } else if ($periodo2 == 4) {
                $periodo = 'IV';
            } else if ($periodo2 == 5) {
                $periodo = 'V';
            } else if ($periodo2 == 6) {
                $periodo = 'VI';
            } else if ($periodo2 == 7) {
                $periodo = 'VII';
            } else if ($periodo2 == 8) {
                $periodo = 'VIII';
            } else if ($periodo2 == 9) {
                $periodo = 'IX';
            } else if ($periodo2 == 10) {
                $periodo = 'X';
            }
            echo "<option value='$id_turma'> $turma /  $turno  </option>";
        }
        echo " </select>";
    }

    public function PesquisaAlunos($param1 = '', $param2 = '', $param3 = '', $param4 = '') {

        if ($param2 == 'undefined') {
            $param2 = 'null';
        }



        $param3 = explode("%20", $param3); // separando pelo espaço
        $nome = $param3 = implode(" ", $param3); // unindo os valores pelo |

        $arrayAlunos = $this->coordenador_model->GetPesquisaAlunos($param1, $param2, $nome, $param4);


        echo '<section class="panel">';
        echo '<table class="table table-striped table-advance table-hover">';
        echo '<thead>';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th class="hidden-phone"> Nome</th>';
        echo '<th> Matrícula</th>';

        echo '<th> Curso</th>';
        echo '<th> Situação</th>';
        echo '<th></th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';


        $cont = 1;
        foreach ($arrayAlunos as $rowAlunos):

            $situacao = $rowAlunos['situacao_aluno_turma'];
            if ($situacao == '1') {
                $situacao2 = 'Pré-Matriculado';
            } else if ($situacao == '2') {
                $situacao2 = 'Matriculado';
            } else if ($situacao == '3') {
                $situacao2 = 'Matricula Trancada';
            } else if ($situacao == '4') {
                $situacao2 = 'Desvinculado do curso';
            } else if ($situacao == '5') {
                $situacao2 = 'Transferido';
            } else if ($situacao == '6') {
                $situacao2 = 'Formado';
            } else if ($situacao == '0') {
                $situacao2 = 'Período Concluído';
            } else if ($situacao == '7') {
                $situacao2 = 'Falecido';
            }

            echo '<tr>';
            echo '<td>' . $cont++ . '</td>';
            echo '<td class="hidden-phone">' . $rowAlunos['nome'] . '</td>';
            echo '<td>' . $rowAlunos['registro_academico'] . '</td>';

            echo '<td>' . $rowAlunos['cur_tx_abreviatura'] . ' </td>';
            echo '<td>' . $situacao2 . '</td>';
            echo '<td><a href="ReceberPagamento/pagamentosAlunos/' . $rowAlunos['matricula'] . '"><span class="label label-primary label-mini">Consultar Dados</span></a></td>';
            echo '</tr>';

        endforeach;
        echo '</tbody>';
        echo '</table>';
        echo '</section>';
    }

    public function pagamentosAlunos($param1 = '') {

        $page_data['turma'] = $this->coordenador_model->SituationStudent($param1);
        $page_data['page_name'] = 'movimentos_financeiros/situacao_financeiro';
        $page_data['page_title'] = 'Pagamentos';
        $this->load->view('index', $page_data);
    }

    public function carnePrint($param1 = '', $param2 = '') {

        $page_data['mensalidades'] = $this->coordenador_model->MensalidadesCarne($param2);
        $page_data['DadosAluno'] = $this->coordenador_model->DadosAlunoCarne($param1, $param2);
        $page_data['page_name'] = 'movimentos_financeiros/carneMensalidades';
        $page_data['page_title'] = 'Pagamentos';
        $this->load->view('index', $page_data);
    }

    public function historicoFinanceiro($param1 = "") {

        $page_data['turma'] = $this->coordenador_model->SituationStudent($param1);
        $page_data['historicoPagamentos'] = $this->coordenador_model->HistoricoPagamentos($param1);
        $page_data['page_name'] = 'movimentos_financeiros/historico_financeiro';
        $page_data['page_title'] = 'Pagamentos';
        $this->load->view('index', $page_data);
    }

    public function reciboImpressao($param1 = '', $param2 = '', $param3 = '', $param4 = '') {

        $page_data['recibo'] = $this->coordenador_model->ReciboPagamento($param2, $param3, $param4);
        $page_data['DadosAluno'] = $this->coordenador_model->DadosAlunoCarne($param1, $param2);
        $page_data['page_name'] = 'movimentos_financeiros/comprovante_pagamento';
        $page_data['page_title'] = 'Recibo de Pagamento';
        $this->load->view('index', $page_data);
    }

    public function PagaMatricula($param1 = '', $param2 = '', $param3 = '') {

        if ($this->input->post()) {


            $matricula_aluno_turma_id = $this->input->post('matricula_aluno_turma');
            $matricula_aluno_id = $this->input->post('matricula_aluno');

            $data_vencimento = explode("/", $this->input->post('pagamento2'));
            $data_vencimento = $data_vencimento[2] . "-" . $data_vencimento[1] . '-' . $data_vencimento[0];

            $data_pagamento = explode("/", $this->input->post('pagamento'));
            $data_pagamento = $data_pagamento[2] . "-" . $data_pagamento[1] . "-" . $data_pagamento[0];

            $resultado = $this->financeiro_model->PegaPeriodoLetivo($this->input->post('matricula_aluno_turma'));


            $Valor_pago = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pago')));
            $valor_a_pagar = $this->input->post('valor_curso');
            $valor_a_pagar2 = str_replace(',', '.', str_replace('.', '', $valor_a_pagar));


            if ($Valor_pago >= $valor_a_pagar) {
                $status = '1';
            } else if ($Valor_pago < $valor_a_pagar) {
                $status = '3';
            }

            $dadosMatricula = array(
                "total_parcela" => 1,
                "matricula_aluno_id" => $this->input->post('matricula_aluno'),
                "produto_id" => 1,
                "periodo_letivo_id" => $resultado['periodo_letivo'],
                "men_dt_vencto" => $data_vencimento,
                "men_dt_emissao" => date('Y-m-d'),
                "men_fl_valor" => $valor_a_pagar2,
                "men_nb_numero_parcela" => 1,
                "men_tx_obs" => 'PAGAMENTO DE MATRÍCULA',
                "matricula_aluno_turma_id" => $this->input->post('matricula_aluno_turma'),
                "valor_total" => $this->input->post('valor_pago2'),
                "men_nb_status" => $status,
            );

            $mensalidade_id = $this->financeiro_model->save('mensalidade', $dadosMatricula);

            if ($mensalidade_id) {

                $dadosMovFin = array(
                    "mf_dt_pgto" => $data_pagamento,
                    "tipo" => 1,
                    "mf_db_valor" => $Valor_pago,
                    "mf_nb_status" => 2,
                    "mf_db_desconto" => $this->input->post('desconto2'),
                    "mf_db_juros" => $this->input->post('juros2'),
                    "multa" => $this->input->post('multa2'),
                    "bolsa" => $this->input->post('bolsa2'),
                    "financiamento" => $this->input->post('financiamento2'),
                    "mf_nb_forma_pagamento" => $this->input->post('forma_pagamento'),
                    "login_nb_codigo" => $this->session->userdata('login'),
                    "mensalidades_id" => $mensalidade_id,
                );


                $mf_id = $this->financeiro_model->save('movimento_financeiro', $dadosMovFin);


                $datau['situacao'] = '2';
                $this->db->where('matricula_aluno_id', $this->input->post('matricula_aluno'));
                $this->db->update('matricula_aluno', $datau);

                $datau2['situacao_aluno_turma'] = '2';
                $this->db->where('matricula_aluno_turma_id', $this->input->post('matricula_aluno_turma'));
                $this->db->update('matricula_aluno_turma', $datau2);


                /*                 * *****************SE GERAR MENSALIDADES************** */

                if ($this->input->post('gerar_mensalidade') == '1') {

                    $contador = 1;
                    $quantidade_parcela = $this->input->post('quantidade_mensalidade');

                    $data_vencimento2 = $this->input->post('dtvencimento');
                    $partes2 = explode("/", $data_vencimento2);
                    $dia2 = $partes2[0];
                    $mes2 = $partes2[1];
                    $ano2 = $partes2[2];

                    $quantidade_parcelan = $quantidade_parcela;

                    while ($contador <= $quantidade_parcelan) {

                        if (($dia2 == '31') && ($mes2 == '04')) {
                            $men_dt_vencto = $ano2 . '-' . $mes2 . '-' . '30';
                        } else if (($dia2 == '31') && ($mes2 == '06')) {
                            $men_dt_vencto = $ano2 . '-' . $mes2 . '-' . '30';
                        } else if (($dia2 == '31') && ($mes2 == '09')) {
                            $men_dt_vencto = $ano2 . '-' . $mes2 . '-' . '30';
                        } else if (($dia2 == '31') && ($mes2 == '11')) {
                            $men_dt_vencto = $ano2 . '-' . $mes2 . '-' . '30';
                        } else if (($mes2 == '02') && ($dia2 >= '29') && ($ano2 > '2016')) {
                            $men_dt_vencto = $ano2 . '-' . $mes2 . '-' . '28';
                        } else if (($mes2 == '02') && ($dia2 >= '30') && ($ano2 == '2016')) {
                            $men_dt_vencto = $ano2 . '-' . $mes2 . '-' . '29';
                        } else {
                            $men_dt_vencto = $ano2 . '-' . $mes2 . '-' . $dia2;
                        }

                        $dadosParcelas = array(
                            "men_dt_vencto" => $men_dt_vencto,
                            "total_parcela" => $quantidade_parcela,
                            "men_nb_numero_parcela" => $contador,
                            "matricula_aluno_id" => $this->input->post('matricula_aluno'),
                            "matricula_aluno_turma_id" => $this->input->post('matricula_aluno_turma'),
                            "produto_id" => 2,
                            "periodo_letivo_id" => $resultado['periodo_letivo'],
                            "men_dt_emissao" => date('Y-m-d'),
                            "men_fl_valor" => str_replace(',', '.', str_replace('.', '', $this->input->post('valormnesaliadde'))),
                            "men_nb_status" => 0,
                        );

                        $mensalidade_id2 = $this->financeiro_model->save('mensalidade', $dadosParcelas);

                        if ($mes2 == '12') {
                            $mes2 = '1';
                            $ano2 = $ano2 + '1';
                        } else {
                            $mes2 = $mes2 + '1';
                        }
                        $contador++;
                    }

                    $this->session->set_flashdata('message', '<strong>Matrícula</strong> paga com sucesso !');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'ReceberPagamento/pagamentosAlunos/' . $this->input->post('matricula_aluno'));
                } else {
                    $this->session->set_flashdata('message', '<strong>Matrícula</strong> paga com sucesso !');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'ReceberPagamento/pagamentosAlunos/' . $this->input->post('matricula_aluno'));
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao efetuar pagamento Matrícula !');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'ReceberPagamento/pagamentosAlunos/' . $this->input->post('matricula_aluno'));
            }
        } else {


            $page_data['turma'] = $this->financeiro_model->SituationStudent($param1);
            $page_data['mensalidade'] = $this->financeiro_model->getTableRow('mensalidade', 'mensalidade_id', 'mensalidade_id', $param3);
            $page_data['id_aluno'] = $param1;
            $page_data['matricula_turma'] = $param2;
            $page_data['page_name'] = 'movimentos_financeiros/pagar_matricula';
            $page_data['page_title'] = 'Pagar Matricula';
            $this->load->view('index', $page_data);
        }
    }

    public function efetuarPagamento($param1 = '', $param2 = '', $param3 = '') {

        if ($this->input->post()) {

            $dt_pgto = explode('/', $this->input->post('pagamento'));
            $dt_pgto = $dt_pgto[2] . "-" . $dt_pgto[1] . "-" . $dt_pgto[0];

            $dadosMensalidade = array(
                "mf_dt_pgto" => $dt_pgto,
                "mf_db_valor" => str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pago'))),
                "mf_db_desconto" => str_replace(',', '.', str_replace('.', '', $this->input->post('desconto2'))),
                "mf_db_juros" => str_replace(',', '.', str_replace('.', '', $this->input->post('juros2'))),
                "multa" => str_replace(',', '.', str_replace('.', '', $this->input->post('multa2'))),
                "bolsa" => $this->input->post('bolsa2'),
                "financiamento" => $this->input->post('financiamento2'),
                "login_nb_codigo" => $this->session->userdata('login'),
                "mensalidades_id" => $this->input->post('mensalidade_id'),
                "mf_nb_forma_pagamento" => $this->input->post('forma_pagamento'),
            );


            if ($this->financeiro_model->save('movimento_financeiro', $dadosMensalidade)) {

                $Valor_pago = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pago')));
                $valor_a_pagar2 = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_curso')));
                $valor_total = $this->input->post('valor_pago2');

                $mensalidade_id = $this->input->post('mensalidade_id');
                $mensalideRow = $this->financeiro_model->Mensalidade($mensalidade_id);

                if ($Valor_pago >= $valor_total) {

                    $statux = '1';
                } else if ($Valor_pago < $valor_total) {
                    $statux = '3';
                }
                if ($mensalideRow['men_nb_status'] == 0) {
                    $data2['valor_total'] = $valor_total;
                }

                $updateMensalide = array(
                    "men_nb_status" => $statux,
                    "valor_total" => $valor_total,
                    "men_tx_obs" => $mensalideRow['nome'],
                );

                $resultado = $this->financeiro_model->update($updateMensalide, 'mensalidade', $this->input->post('mensalidade_id'));


                if ($resultado) {

                    $this->session->set_flashdata('message', '<strong>PAGAMENTO</strong> efetuado com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao alterar CATEGORIA!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                }
            } else {

                echo "erro";
            }
        } else {

            $page_data['turma'] = $this->financeiro_model->SituationStudent($param1);
            $page_data['mensalidade'] = $this->financeiro_model->getTableRow('mensalidade', 'mensalidade_id', 'mensalidade_id', $param3);
            $page_data['id_aluno'] = $param1;
            $page_data['page_name'] = 'movimentos_financeiros/pagamento';
            $page_data['page_title'] = 'Pagamentos';
            $this->load->view('index', $page_data);
        }
    }

    public function cancelar($param1 = '', $param2 = '') {


        $sql22 = "select * from periodo_letivo
                        where atual = '1'";

        $CarneArray22 = $this->db->query($sql22)->result_array();
        foreach ($CarneArray22 as $row22):
            $periodo_letivo_atual = $row22['periodo_letivo'];
        endforeach;

        $DadosMensalidade = $this->financeiro_model->getTableRow('mensalidade', 'mensalidade_id', 'mensalidade_id', $param2);

        if (($DadosMensalidade['men_nb_numero_parcela'] == '1') && ($DadosMensalidade['periodo_letivo_id'] == $periodo_letivo_atual)) {


            $dados = array(
                'situacao' => 1
            );

            if ($this->financeiro_model->update($dados, 'matricula_aluno', $param1)) {


                $dadosT = array(
                    'situacao_aluno_turma' => 1
                );

                if ($this->financeiro_model->update($dadosT, 'matricula_aluno_turma', $DadosMensalidade['matricula_aluno_turma_id'])) {

                    $dadosM = array(
                        'men_nb_status' => 0
                    );

                    if ($this->financeiro_model->update($dadosM, 'mensalidade', $param2)) {

                        if ($this->financeiro_model->DeleteWhere('movimento_financeiro', 'mensalidades_id', $param2)) {

                            $this->session->set_flashdata('message', '<strong>PAGAMENTO</strong> cancelado com sucesso!');
                            $this->session->set_flashdata('type', 'success');
                            redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                        } else {

                            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cancelar PAGAMENTO!');
                            $this->session->set_flashdata('type', 'warning');
                            redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                        }
                    } else {

                        $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cancelar PAGAMENTO!');
                        $this->session->set_flashdata('type', 'warning');
                        redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                    }
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cancelar PAGAMENTO!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cancelar PAGAMENTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
            }
        } else {

            $dadosM = array(
                'men_nb_status' => 0
            );

            if ($this->financeiro_model->update($dadosM, 'mensalidade', $param2)) {

                if ($this->financeiro_model->DeleteWhere('movimento_financeiro', 'mensalidades_id', $param2)) {

                    $this->session->set_flashdata('message', '<strong>PAGAMENTO</strong> cancelado com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cancelar PAGAMENTO!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cancelar PAGAMENTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param1);
            }
        }
    }

    public function delete($param1 = '', $param2 = '') {



        if ($this->financeiro_model->DeleteWhere('movimento_financeiro', 'mf_nb_codigo', $param1)) {

            if ($this->financeiro_model->DeleteWhere('mensalidade', 'mensalidade_id', $param1)) {

                $this->session->set_flashdata('message', '<strong>PAGAMENTO</strong> excluido com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param2);
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir PAGAMENTO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param2);
            }
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir PAGAMENTO!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'ReceberPagamento/historicoFinanceiro/' . $param2);
        }
    }

}
