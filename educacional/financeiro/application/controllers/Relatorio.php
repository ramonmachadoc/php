<?php

/**
 * @Description: Classe Relatorio, usada para fazer os relatórios - (geral, pagamentos alunos, contas pagar e receber, outros pagamentos, alunos inadimplentes)
 * @author Karol Oliveira
 */
class Relatorio extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginf') != 1)
            redirect(base_url(), 'refresh');
    }

    /**
     * @description: Função para retornar primeiro e ultimo dia do mes atual
     * @access public 
     * @return array com datas 
     */
    public function returnDates() {

        $mes = date('m');
        $ano = date('Y');

        $dataInicial = $ano . "-" . $mes . "-01";
        $dataFinal = $ano . "-" . $mes . "-" . cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        return array('dateStart' => $dataInicial, 'dateEnd' => $dataFinal);
    }

    /**
     * @description: Função inicial do controller Relatorio, retorna pagina inicial do menu escolhido
     * @access public 
     * @return view, array
     */
    public function index() {

        $page_data['page_name'] = 'relatorio/pesquisa_FluxoCaixa';
        $page_data['cursos'] = $this->financeiro_model->getTable('cursos', 'cur_tx_descricao');
        $page_data['page_title'] = 'Relátorio Fluxo de Caixa';
        $this->load->view('index', $page_data);
    }

    /**
     * @description: Função que retorna todos os pagamentos do aluno por periodo informado
     * @access public 
     * @return view, array
     */
    public function PagamentoAluno() {

        $datainicio = explode("/", $this->input->post('data_inicio'));
        $datainicio = $datainicio[2] . "-" . $datainicio[1] . "-" . $datainicio[0];

        $datafim = explode("/", $this->input->post('data_fim'));
        $datafim = $datafim[2] . "-" . $datafim[1] . "-" . $datafim[0];

        $page_data['dataInicio'] = $this->input->post('data_inicio');
        $page_data['dataFim'] = $this->input->post('data_fim');


        $page_data['ListPagamentos'] = $this->financeiro_model->RelatorioPagAlunos($datainicio, $datafim);
        $page_data['ListPagAvulsos'] = $this->financeiro_model->RelContasPagar($datainicio, $datafim, 1);
        $page_data['ListPagOutros'] = $this->financeiro_model->RelatorioOutros($datainicio, $datafim, 1);

        $page_data['SaidaPag'] = $this->financeiro_model->RelContasPagar($datainicio, $datafim, 2, 'fornecedor', 'categoria');
        $page_data['Total'] = $this->financeiro_model->RelatorioPagAlunosTotal($datainicio, $datafim);
        $page_data['TotalPagAvulsos'] = $this->financeiro_model->RelContasPagarTotal($datainicio, $datafim, 1);
        $page_data['TotalSaidaPag'] = $this->financeiro_model->RelContasPagarTotal($datainicio, $datafim, 2);
        $page_data['TotalOutrosPagamentos'] = $this->financeiro_model->RelContasTotalOutros($datainicio, $datafim);

        $page_data['page_name'] = 'relatorio/fluxo_caixa';
        $page_data['page_title'] = 'Relátorio Fluxo de Caixa';
        $this->load->view('index', $page_data);
    }

    public function geral($param1 = '') {

        $page_data['historicoPagamentos'] = $this->financeiro_model->HistoricoPagamentos($param1);
        $page_data['page_name'] = 'relatorio/relatorio_geral';
        $page_data['page_title'] = 'Relátorio Individual do Aluno';
        $this->load->view('index', $page_data);
    }

    /**
     * @description: Função que retorna todos os outros pagamentos do aluno por periodo ou por mes
     * @access public 
     * @param int $param1 - por mes ou por periodo 0 = todos mes 1 = todos por data
     * @param date $param2 - data inicio
     * @param date $param3 - data final
     * @param int $param4 - tipo de pagamento
     * @return void
     */
    public function outrosPagamentos($param1 = '', $param2 = '', $param3 = '', $param4 = '') {

        if ($param1) {

            $dataInicio = $param2;
            $dataFinal = $param3;
        } else {

            $dataInicio = $this->returnDates()["dateStart"];
            $dataFinal = $this->returnDates()["dateEnd"];
        }

        $page_data['dataInicio'] = $dataInicio;
        $page_data['dataFim'] = $dataFinal;


        $page_data['ListPagOutros'] = $this->financeiro_model->RelatorioOutros($dataInicio, $dataFinal, $param4);
        $page_data['TotalOutrosPagamentos'] = $this->financeiro_model->RelContasTotalOutros($dataInicio, $dataFinal);
        $this->load->view('financeiro/relatorio/outrosPagamentos', $page_data);
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $html = $this->load->view('financeiro/relatorio/outrosPagamentos', $page_data, TRUE);
        $pdf->SetHeader('Relatório Outros Pagamentos');
        $pdf->SetFooter('{PAGENO}');
        $pdf->WriteHTML($html);
        $pdf->Output();
    }

    /**
     * @description: Função que retorna todas as entradas e saidas por periodo ou por mes
     * @access public 
     * @param int $param1 - por mes ou por periodo 0 = todos mes 1 = todos por data
     * @param date $param2 - data inicio
     * @param date $param3 - data final
     * @return void
     */
    public function entradas_saidas($param1 = '', $param2 = '', $param3 = '') {

        if ($param1) {

            $dataInicio = $param2;
            $dataFinal = $param3;
        } else {

            $dataInicio = $this->returnDates()["dateStart"];
            $dataFinal = $this->returnDates()["dateEnd"];
        }

        $page_data['dataInicio'] = $dataInicio;
        $page_data['dataFim'] = $dataFinal;

        $page_data['contasReceber'] = $this->financeiro_model->RelContasPagar($dataInicio, $dataFinal, 1);
        $page_data['contasPagar'] = $this->financeiro_model->RelContasPagar($dataInicio, $dataFinal, 2, 'fornecedor', 'categoria');
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->SetHeader('Relatório Entradas e Saídas do mês');
        $html = $this->load->view('financeiro/relatorio/entradas_saidas', $page_data, TRUE);
        $pdf->SetFooter('{PAGENO}');
        $pdf->WriteHTML($html);
        $pdf->Output();
    }

    /**
     * @description: Função que retorna todas as contas a pagar por periodo
     * @access public 
     * @param date $param1 - data inicio
     * @param date $param2 - data final
     * @return void
     */
    public function contas_pagar($param1 = '', $param2 = '') {

        $page_data['dataInicio'] = $param1;
        $page_data['dataFim'] = $param2;

        $page_data['contasPagar'] = $this->financeiro_model->RelContasPagar($param1, $param2, 2, 'fornecedor', 'categoria');

        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->SetHeader('Relatório Contas a Pagar');
        $html = $this->load->view('financeiro/relatorio/contas_pagar', $page_data, TRUE);
        $pdf->SetFooter('{PAGENO}');
        $pdf->WriteHTML($html);
        $pdf->Output();
    }

    /**
     * @description: Função que retorna todas a receber por periodo
     * @access public 
     * @param date $param1 - data inicio
     * @param date $param2 - data final
     * @return void
     */
    public function contas_receber($param1 = '', $param2 = '') {

        $page_data['dataInicio'] = $param1;
        $page_data['dataFim'] = $param2;
        $page_data['contasReceber'] = $this->financeiro_model->RelContasPagar($param1, $param2, 1);
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->SetHeader('Relatório Contas a Pagar');
        $html = $this->load->view('financeiro/relatorio/contas_pagar', $page_data, TRUE);
        $pdf->SetFooter('{PAGENO}');
        $pdf->WriteHTML($html);
        $pdf->Output();
    }

    /**
     * @description: Função que controla chamadas para os relatorios conforme solicitado pelo usuario
     * @access public 
     * @return function
     */
    public function pagamentos_alunos($param1, $param2) {

        $page_data['dataInicio'] = $param1;
        $page_data['dataFim'] = $param2;

        $page_data['ListPagamentos'] = $this->financeiro_model->RelatorioPagAlunos($param1, $param2);
        $page_data['Total'] = $this->financeiro_model->RelatorioPagAlunosTotal($param1, $param2);

        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->SetHeader('Relatório Pagamentos de Alunos');
        $html = $this->load->view('financeiro/relatorio/pagamento_alunos', $page_data, TRUE);
        $pdf->SetFooter('{PAGENO}');
        $pdf->WriteHTML($html);
        $pdf->Output();
    }

    /**
     * @description: Função que emite os alunos Adimplentes por mês
     * @access public 
     * @param $param1 - mes
     * @return function
     */
    public function adimplentes($param1 = '') {

        $page_data['mes'] = mesExtenso($param1);
        $page_data['ListPagamentos'] = $this->financeiro_model->RelatorioAdimplentes($param1, date('Y'));

        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->SetHeader('Relatório Pagamentos de Alunos');
        $html = $this->load->view('financeiro/relatorio/adimplentes', $page_data, TRUE);
        $pdf->SetFooter('{PAGENO}');
        $pdf->WriteHTML($html);
        $pdf->Output();
    }

    /**
     * @description: Função que emite os alunos Adimplentes por mês
     * @access public 
     * @param $param1 - mes
     * @return function
     */
    public function inadimplentes($param1 = '') {

        $page_data['mes'] = mesExtenso($param1);
        $page_data['ListPagamentos'] = $this->financeiro_model->RelatorioInadimplentes($param1, date('Y'));

        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->SetHeader('Relatório Pagamentos de Alunos');
        $html = $this->load->view('financeiro/relatorio/adimplentes', $page_data, TRUE);
        $pdf->SetFooter('{PAGENO}');
        $pdf->WriteHTML($html);
        $pdf->Output();
    }

    /**
     * @description: Função que controla chamadas para os relatorios conforme solicitado pelo usuario
     * @access public 
     * @return function
     */
    public function FluxoCaixa() {

        $dataInicio = FormataDataBanco($this->input->post('data_inicio'));
        $dataFinal = FormataDataBanco($this->input->post('data_fim'));
        $tipo_pagamento = $this->input->post('tipo_pagamento') == 0 ? null : $this->input->post('tipo_pagamento');

        switch ($this->input->post('tipo_relatorio')) {
            case 1:
                $this->fluxoCaixaGeral($dataInicio, $dataFinal);
                break;
            case 2:
                $this->pagamentos_alunos($dataInicio, $dataFinal);
                break;
            case 3:
                $this->entradas_saidas(1, $dataInicio, $dataFinal);
                break;
            case 4:
                $this->contas_receber($dataInicio, $dataFinal);
                break;
            case 5:
                $this->contas_pagar($dataInicio, $dataFinal);
                break;
            case 6:
                $this->outrosPagamentos(1, $dataInicio, $dataFinal, $tipo_pagamento);
                break;
            case 7:
                $this->adimplentes($this->input->post('mes'));
                break;
            case 8:
                $this->inadimplentes($this->input->post('mes'));
                break;
        }
    }

    /**
     * @description: Função que retorna relatorio geral de fluxo de caixa por periodo
     * @access public 
     * @param date $datainicio - data inicio
     * @param date $datafim - data final
     * @return function
     */
    public function fluxoCaixaGeral($datainicio, $datafim) {

        $page_data['dataInicio'] = $datainicio;
        $page_data['dataFim'] = $datafim;

        $page_data['ListPagamentos'] = $this->financeiro_model->RelatorioPagAlunos($datainicio, $datafim);
        $page_data['ListPagAvulsos'] = $this->financeiro_model->RelContasPagar($datainicio, $datafim, 1);
        $page_data['ListPagOutros'] = $this->financeiro_model->RelatorioOutros($datainicio, $datafim, 1);
        $page_data['SaidaPag'] = $this->financeiro_model->RelContasPagar($datainicio, $datafim, 2, 'fornecedor', 'categoria');
        $page_data['Total'] = $this->financeiro_model->RelatorioPagAlunosTotal($datainicio, $datafim);
        $page_data['TotalPagAvulsos'] = $this->financeiro_model->RelContasPagarTotal($datainicio, $datafim, 1);
        $page_data['TotalSaidaPag'] = $this->financeiro_model->RelContasPagarTotal($datainicio, $datafim, 2);
        $page_data['TotalOutrosPagamentos'] = $this->financeiro_model->RelContasTotalOutros($datainicio, $datafim);
        
        $page_data['page_name'] = 'relatorio/fluxo_caixa';
        $page_data['page_title'] = 'Relátorio Fluxo de Caixa';
        $this->load->view('index', $page_data);
        
        
//        $this->load->library('m_pdf');
//        $pdf = $this->m_pdf->load();
//        $pdf->SetHeader('Relatório Fluxo de Caixa Geral');
//        $html = $this->load->view('financeiro/relatorio/fluxo_caixa_1', $page_data, TRUE);
//        $pdf->SetFooter('{PAGENO}');
//        $pdf->WriteHTML($html);
//        $pdf->Output();
    }

}
