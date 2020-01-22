<?php

/**
 * Description of Registro
 *
 * @author Karol Oliveira
 */
class Registro extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $page_data['cursos'] = $this->agape_model->getTable('cursos', 'cur_tx_descricao');
        $page_data['page_name'] = 'registro/aluno';
        $page_data['page_title'] = 'Consultar Aluno';
        $this->load->view('index', $page_data);
    }

    public function carregaPeriodoLetivo($param1 = '') {

        $ArrayPeridoLetivo = $this->agape_model->getPeriodoLetivo($param1);


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

    public function carregaTurma($param1 = '', $param2 = '', $param3 = '') {

        $DadosPeriodo = $this->agape_model->getTableRow('periodo_letivo', 'periodo_letivo', 'periodo_letivo_id', $param2);
        $periodo = $DadosPeriodo['periodo_letivo'];
        $ArrayTurma = $this->agape_model->getTurma($param1, $periodo = $periodo . "" . $param3);

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

    public function PesquisaAlunos($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {

        if ($param2 == 'undefined') {
            $param2 = 'null';
        }


        $param3 = explode("%20", $param3); // separando pelo espaço
        $nome = $param3 = implode(" ", $param3); // unindo os valores pelo |

        $arrayAlunos = $this->agape_model->GetPesquisaAlunos($param1, $param2, $nome, $param4, $param5);


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
            echo '<td><a href="../Registro/situacao_aluno/' . $rowAlunos['matricula'] . '"><span class="label label-primary label-mini">Situação Aluno</span></a></td>';
            echo '</tr>';

        endforeach;
        echo '</tbody>';
        echo '</table>';
        echo '</section>';
    }

    public function situacao_aluno($param1 = '') {

        $page_data['turma'] = $this->agape_model->SituationStudent($param1);
        $page_data['page_name'] = 'registro/situacao_aluno';
        $page_data['page_title'] = 'Pagamentos';
        $this->load->view('index', $page_data);
    }

    public function ficha_aluno($param1 = '') {

        $page_data['turma'] = $this->agape_model->SituationStudent($param1);
        $page_data['page_name'] = 'registro/ficha_aluno';
        $page_data['page_title'] = 'Pagamentos';
        $this->load->view('index', $page_data);
    }

    public function changeCourse() {

        $page_data['cursos'] = $this->agape_model->getTable('cursos', 'cur_tx_descricao');
        $page_data['page_name'] = 'changeCourse/search';
        $page_data['page_title'] = 'PESQUISAR ALUNO';
        $this->load->view('index', $page_data);
    }

    public function searchChange($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {

        if ($param2 == 'undefined') {
            $param2 = 'null';
        }


        $param3 = explode("%20", $param3); // separando pelo espaço
        $nome = $param3 = implode(" ", $param3); // unindo os valores pelo |

        $arrayAlunos = $this->agape_model->GetPesquisaAlunos($param1, $param2, $nome, $param4, $param5);


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
            echo '<td><a href="../Registro/courseChange/' . $rowAlunos['matricula'] . '"><span class="label label-primary label-mini">Trocar Curso</span></a></td>';
            echo '</tr>';

        endforeach;
        echo '</tbody>';
        echo '</table>';
        echo '</section>';
    }

    public function courseChange($param1 = '') {

        $page_data['dadosAluno'] = $this->agape_model->SituationStudent($param1);
        $page_data['cursos'] = $this->agape_model->getTable('cursos', 'cur_tx_descricao');
        $page_data['page_name'] = 'changeCourse/course_change';
        $page_data['page_title'] = 'PESQUISAR ALUNO';
        $this->load->view('index', $page_data);
    }

    public function saveChangeCourse($param1 = '') {

        $DadosMatriz = $this->agape_model->getTableRow('matriz', 'matriz_id', 'cursos_id', $this->input->post('curso_destino'), 'atual', 1);
        $DadosMatriz['matriz_id'];

        $dados_update = array(
            'curso_id' => $this->input->post('curso_destino'),
            'matriz_id' => $DadosMatriz['matriz_id'],
        );

        if ($this->agape_model->update($dados_update, 'matricula_aluno', $param1)) {
            redirect(base_url() . 'Registro/situacao_aluno/' . $param1);
        }
    }

}
