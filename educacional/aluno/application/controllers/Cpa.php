<?php

/**
 * Description of Cpa
 *
 * @author Karol Oliveira
 */
class Cpa extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $matricula = $this->aluno_model->getTableRow('matricula_aluno', 'registro_academico', 'registro_academico', $this->session->userdata('login'));
        $turmasAluno = $disciplinas = $this->aluno_model->GetTurmasCpa($matricula['matricula_aluno_id']);
        $page_data['turmasAluno'] = $disciplinas = $this->aluno_model->GetTurmasCpa($matricula['matricula_aluno_id']);
        $page_data['minhas_disciplinas'] = $this->aluno_model->disciplinasCpa($turmasAluno['matricula_aluno_turma_id'], 0);
        $page_data['perguntas'] = $this->aluno_model->GetWhere('fbnov509_cpa.pergunta', 'questionario_id', 5);
        $page_data['page_name'] = 'cpa/cpa';
        $page_data['page_title'] = 'DIMENSÕES GERAIS PARA A AVALIAÇÃO – CORPO DISCENTE';
        $this->load->view('index', $page_data);
    }

    public function saveCpa() {

        $matricula = $this->aluno_model->getTableRow('matricula_aluno', 'registro_academico', 'registro_academico', $this->session->userdata('login'));
        $turmasAluno = $disciplinas = $this->aluno_model->GetTurmasCpa($matricula['matricula_aluno_id']);
        $page_data['turmasAluno'] = $disciplinas = $this->aluno_model->GetTurmasCpa($matricula['matricula_aluno_id']);
        $page_data['minhas_disciplinas'] = $this->aluno_model->disciplinasCpa($turmasAluno['matricula_aluno_turma_id'], 0);
        $array = $this->aluno_model->disciplinasCpa($turmasAluno['matricula_aluno_turma_id'], 0);
        $perguntas = $this->aluno_model->GetWhere('fbnov509_cpa.pergunta', 'questionario_id', 5);

        foreach ($array as $row):

            $Professor = $this->aluno_model->nomeProfessor($turmasAluno['turma_id'], $row['disciplina_id']);


            foreach ($perguntas as $rowPerg):

                $junta = "pergunta_id_" . $rowPerg['pergunta_id'];
                $dados['pergunta_id'] = $rowPerg['pergunta_id'];
                $dados['resposta'] = $_POST[$junta];
                $dados['professor_id'] = $Professor['professor_id'];
                $dados['disciplina_id'] = $row['disciplina_id'];
                $insert = $this->aluno_model->save('fbnov509_cpa.resposta_questionario', $dados);

            endforeach;

        endforeach;

        if ($insert) {

            $dados = array(
                "matricula_id" => $this->session->userdata('login'),
                "data_questionario" => date('Y-m-d H:i:s'),
                "questionario_id" => 5,
            );
            $insertstatus = $this->aluno_model->save('fbnov509_cpa.status_questionario', $dados);

            if ($insertstatus) {
                redirect(base_url() . 'dashboard/', 'refresh');
            }
        }
    }
}
