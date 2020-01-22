<?php

/**
 * Description of Mapa
 *
 * @author Karol Oliveira
 */
class Mapa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_loginp') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {

        $page_data['disciplinas'] = $this->professor_model->GetMinhasDisciplinas($this->session->userdata('login'));
        $page_data['page_name'] = 'mapa/list';
        $page_data['page_title'] = 'Mapa de Notas';
        $this->load->view('index', $page_data);
    }

    public function nota1($param1 = '', $param2 = '', $param3 = '') {

        if ($this->input->post()) {


            $arrayNotas = $this->professor_model->AlunosNota($param1, $param2);

            foreach ($arrayNotas as $row):

                $disiciplinaNotaId = $row['disciplina_aluno_nota_id'];
                $junta = "nota" . $disiciplinaNotaId;

                $dados = array(
                    "dan_fl_nota_1bim" => $_POST[$junta]
                );

                $resultado = $this->professor_model->UpdateChamada($dados, 'disciplina_aluno_nota', 'disciplina_aluno_nota_id', $disiciplinaNotaId);

            endforeach;

            if ($resultado) {
                $this->session->set_flashdata('message', '<strong>NOTAS</strong> preenchidas com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'Mapa/');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher NOTAS!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'Mapa/');
            }
        } else {

            $page_data['InfoDisciplina'] = $this->professor_model->GetMinhasDisciplinasAula($param1);
            $page_data['alunos'] = $this->professor_model->AlunosNota($param2, $param3);

            /* Parte da liberacao de notas */
            $peridoAtual = $this->professor_model->GetWhereRow('periodo_letivo', 'atual', 1);
            $page_data['datePrazo'] = $this->professor_model->GetWhereRow('prazo_lancamento', 'periodo_letivo_id', $peridoAtual['periodo_letivo_id']);
            $page_data['liberacao'] = $this->professor_model->GetWhereRow('liberacao_prazo', 'professor_disciplina_turma_id', $param1, 'tipo_liberacao', 1, 'liberacao_prazo_id');


            $arrayIds = array(
                "turma_id" => $param2,
                "disciplina_id" => $param3
            );

            $page_data['ArrayIds'] = $arrayIds;
            $page_data['page_name'] = 'mapa/nota1';
            $page_data['page_title'] = 'Mapa de Notas';
            $this->load->view('index', $page_data);
        }
    }

    public function nota2($param1 = '', $param2 = '', $param3 = '') {

        if ($this->input->post()) {

            $arrayNotas = $this->professor_model->AlunosNota($param1, $param2);

            foreach ($arrayNotas as $row):

                $disiciplinaNotaId = $row['disciplina_aluno_nota_id'];
                $junta = "nota" . $disiciplinaNotaId;

                $dados = array(
                    "dan_fl_nota_2bim" => $_POST[$junta]
                );

                $resultado = $this->professor_model->UpdateChamada($dados, 'disciplina_aluno_nota', 'disciplina_aluno_nota_id', $disiciplinaNotaId);

            endforeach;

            if ($resultado) {
                $this->session->set_flashdata('message', '<strong>NOTAS</strong> preenchidas com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'Mapa/');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher NOTAS!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'Mapa/');
            }
        } else {

            $page_data['InfoDisciplina'] = $this->professor_model->GetMinhasDisciplinasAula($param1);
            $page_data['alunos'] = $this->professor_model->AlunosNota($param2, $param3);


            /* Parte da liberacao de notas */
            $peridoAtual = $this->professor_model->GetWhereRow('periodo_letivo', 'atual', 1);
            $page_data['datePrazo'] = $this->professor_model->GetWhereRow('prazo_lancamento', 'periodo_letivo_id', $peridoAtual['periodo_letivo_id']);
            $page_data['liberacao'] = $this->professor_model->GetWhereRow('liberacao_prazo', 'professor_disciplina_turma_id', $param1, 'tipo_liberacao', 2, 'liberacao_prazo_id');



            $arrayIds = array(
                "turma_id" => $param2,
                "disciplina_id" => $param3
            );

            $page_data['ArrayIds'] = $arrayIds;
            $page_data['page_name'] = 'mapa/nota2';
            $page_data['page_title'] = 'Mapa de Notas';
            $this->load->view('index', $page_data);
        }
    }

    public function nota3($param1 = '', $param2 = '', $param3 = '') {

        if ($this->input->post()) {

            $arrayNotas = $this->professor_model->AlunosNota($param1, $param2);

            foreach ($arrayNotas as $row):

                $disiciplinaNotaId = $row['disciplina_aluno_nota_id'];
                $junta = "nota" . $disiciplinaNotaId;

                $dados = array(
                    "dan_fl_nota_3bim" => $_POST[$junta]
                );

                $resultado = $this->professor_model->UpdateChamada($dados, 'disciplina_aluno_nota', 'disciplina_aluno_nota_id', $disiciplinaNotaId);

            endforeach;

            if ($resultado) {
                $this->session->set_flashdata('message', '<strong>NOTAS</strong> preenchidas com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'Mapa/');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao preencher NOTAS!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'Mapa/');
            }
        } else {



            $page_data['InfoDisciplina'] = $this->professor_model->GetMinhasDisciplinasAula($param1);
            $page_data['alunos'] = $this->professor_model->AlunosNota($param2, $param3);

            /* Parte da liberacao de notas */
            $peridoAtual = $this->professor_model->GetWhereRow('periodo_letivo', 'atual', 1);
            $page_data['datePrazo'] = $this->professor_model->GetWhereRow('prazo_lancamento', 'periodo_letivo_id', $peridoAtual['periodo_letivo_id']);
            $page_data['liberacao'] = $this->professor_model->GetWhereRow('liberacao_prazo', 'professor_disciplina_turma_id', $param1, 'tipo_liberacao', 3, 'liberacao_prazo_id');


            $arrayIds = array(
                "turma_id" => $param2,
                "disciplina_id" => $param3
            );

            $page_data['ArrayIds'] = $arrayIds;
            $page_data['page_name'] = 'mapa/nota3';
            $page_data['page_title'] = 'Mapa de Notas';
            $this->load->view('index', $page_data);
        }
    }

    public function Mapa($param1 = '', $param2 = '', $param3 = '') {


        $page_data['alunos'] = $this->professor_model->AlunosNota($param2, $param3);
        $page_data['infoPlano'] = $this->professor_model->InfoPlanoEnsino($param1);
        $page_data['page_name'] = 'mapa/mapa_nota';
        $page_data['page_title'] = 'Mapa de Notas';
        $this->load->view('index', $page_data);
    }

}
