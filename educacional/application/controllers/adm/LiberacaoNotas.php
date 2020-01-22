<?php

/**
 * @Description of LiberacaoNotas
 * @author Karol Oliveira
 */
class LiberacaoNotas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $periodo = $this->educacional_model->getTableRow('periodo_letivo', null, 'atual', 1);
        $page_data['disciplinas'] = $this->educacional_model->disciplinasLiberacoes($periodo['periodo_letivo_id']);
        $peridoAtual = $this->educacional_model->GetWhereRow('periodo_letivo', 'atual', 1);
        $page_data['datePrazo'] = $this->educacional_model->GetWhereRow('prazo_lancamento', 'periodo_letivo_id', $peridoAtual['periodo_letivo_id']);


        $page_data['page_name'] = 'admin/liberacao_notas';
        $page_data['page_title'] = 'Liberação Notas';
        $this->load->view('index', $page_data);
    }

    public function liberacao($param1 = '', $param2 = '') {

        if ($param1 == 1 || $param1 == 2 || $param1 == 3) {

            $dados = array(
                "professor_disciplina_turma_id" => $param2,
                "data_prazo" => date('Y-m-d', strtotime('+2 days')),
                "tipo_liberacao" => $param1
            );
            if ($this->educacional_model->save('liberacao_prazo', $dados)) {

                $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> liberada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'adm/LiberacaoNotas', 'refresh');
            } else {

                echo "erro";
            }
        } else if ($param1 === 4) {
            
        } else {
            echo "erro";
        }
    }

}
