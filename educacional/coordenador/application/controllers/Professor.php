<?php

/**
 * Description of Professor
 *
 * @author Karol Oliveira
 */
class Professor extends CI_Controller {

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

        $page_data['professor'] = $this->coordenador_model->getTable('professor', 'nome');
        $page_data['page_name'] = 'professor/list';
        $page_data['page_title'] = 'Lista Professores';
        $this->load->view('index', $page_data);
    }

    public function ValidateExists($param1 = '') {

        $uName = $this->input->post('nome');
        $isUNameCount = $this->coordenador_model->isVarExists('professor', $uName, 'nome');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function ValidateExistsLogin($param1 = '') {

        $Login = $this->input->post('login');
        $isUNameCount = $this->coordenador_model->isVarExists('professor', $Login, 'login');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function add() {

        if ($this->input->post()) {

            $data_banco = explode('/', $this->input->post('nascimento'));
            $nascimento = $data_banco[2] . "-" . $data_banco[1] . "-" . $data_banco[0];

            $dados = array(
                'nome' => $this->input->post('nome'),
                'nascimento' => $nascimento,
                'sexo' => $this->input->post('sexo'),
                'endereco' => $this->input->post('endereco'),
                'bairro' => $this->input->post('bairro'),
                'cep' => $this->input->post('cep'),
                'cidade' => $this->input->post('cidade'),
                'uf' => $this->input->post('uf'),
                'situacao' => $this->input->post('situacao'),
                'email' => $this->input->post('email'),
                'login' => $this->input->post('login'),
                'senha' => $this->input->post('senha'),
            );

            if ($this->coordenador_model->save('professor', $dados)) {

                $this->session->set_flashdata('message', '<strong>PROFESSOR</strong> cadastrado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'professor');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar PROFESSOR!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'professor');
            }
        } else {

            $page_data['page_name'] = 'professor/add';
            $page_data['page_title'] = 'Novo Professor';
            $this->load->view('index', $page_data);
        }
    }

    public function edit($param1 = '') {

        if ($this->input->post()) {

            $data_banco = explode('/', $this->input->post('nascimento'));
            $nascimento = $data_banco[2] . "-" . $data_banco[1] . "-" . $data_banco[0];

            $dados = array(
                'nome' => $this->input->post('nome'),
                'nascimento' => $nascimento,
                'sexo' => $this->input->post('sexo'),
                'endereco' => $this->input->post('endereco'),
                'bairro' => $this->input->post('bairro'),
                'cep' => $this->input->post('cep'),
                'cidade' => $this->input->post('cidade'),
                'uf' => $this->input->post('uf'),
                'situacao' => $this->input->post('situacao'),
                'email' => $this->input->post('email'),
                'login' => $this->input->post('login'),
                'senha' => $this->input->post('senha'),
            );

            if ($this->coordenador_model->update($dados, 'professor', $param1)) {
                $this->session->set_flashdata('message', '<strong>PROFESSOR</strong> editado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'professor');
            } else {


                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao editar PROFESSOR');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'professor');
            }
        } else {
            $page_data['professor'] = $this->coordenador_model->getUpdate('professor', $param1);
            $page_data['page_name'] = 'professor/edit';
            $page_data['page_title'] = 'Editar Professor';
            $this->load->view('index', $page_data);
        }
    }

    public function ban($param1 = '') {

        $dados = array(
            "situacao" => 'I'
        );

        if ($this->coordenador_model->UpdateWhere($dados, 'professor', 'professor_id', $param1)) {
            $this->session->set_flashdata('message', '<strong>PROFESSOR</strong> INATIVO com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'professor');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao INATIVAR PROFESSOR');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'professor');
        }
    }

    public function unlock($param1 = '') {

        $dados = array(
            "situacao" => 'A'
        );

        if ($this->coordenador_model->UpdateWhere($dados, 'professor', 'professor_id', $param1)) {
            $this->session->set_flashdata('message', '<strong>PROFESSOR</strong> ATIVO com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'professor');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao ATIVAR PROFESSOR');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'professor');
        }
    }

    public function disciplinas($param1 = '') {

        if ($this->input->post()) {

            $dadosProf = array(
                "prof_nb_codigo" => $param1,
                "cur_nb_codigo" => $this->input->post('cursos_id'),
            );

            $result = $this->coordenador_model->save('professor_curso', $dadosProf);

            if ($result) {

                $dadosTurmaProf = array(
                    "pdt_nb_status" => 1,
                    "tur_nb_codigo" => $this->input->post('turma'),
                    "disc_nb_codigo" => $this->input->post('disciplina'),
                    "pc_nb_codigo" => $result,
                    "periodo_letivo_id" => $this->input->post('periodo_letivo_pd'),
                );

                if ($this->coordenador_model->save('professor_disciplina_turma', $dadosTurmaProf)) {

                    $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> vinculada com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'professor/disciplinas/' . $param1);
                } else {


                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao vincular DISCIPLINA');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'professor/disciplinas/' . $param1);
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao vincular DISCIPLINA');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'professor/disciplinas/' . $param1);
            }
        } else {

            $page_data['disciplina'] = $this->coordenador_model->DisicplinasProfessor($param1);
            $page_data['InfoProfessor'] = $this->coordenador_model->GetWhereRow('professor', 'professor_id', $param1);
            $page_data['cursos'] = $this->coordenador_model->getTable('cursos', 'cur_tx_descricao');
            $page_data['page_name'] = 'professor/disciplina';
            $page_data['page_title'] = 'Vincular Disciplinas';
            $this->load->view('index', $page_data);
        }
    }

    public function carrega_periodo_letivo($param1 = '') {

        $arrayPeriodo = $this->coordenador_model->peridoLetivo($param1);

        echo "<label>Periodo Letivo</label>";
        echo "<select required='required' class='form-control' name='periodo_letivo_pd' id='periodo_letivo_pd' onchange='buscar_turma()'  >";
        echo "<option value='0'> Escolha um Periodo</option>";

        foreach ($arrayPeriodo as $row) {
            $id_turma = $row['turma_id'];
            $turma = $row['tur_tx_descricao'];
            $periodo_letivo = $row['periodo_letivo'];
            if ($periodo_letivo != null) {
                $periodo_letivo_descricao = $row['periodo_letivo'];
            } else {
                $periodo_letivo_descricao = $row['ano'] . '/' . $row['semestre'];
            }

            echo "<option value='$periodo_letivo_descricao'> $periodo_letivo_descricao</option>";
        }
        echo " </select>";
    }

    public function carrega_turma($param1 = '') {

        $arrayTurmas = $this->coordenador_model->turmasProfessor($param1);

        echo "<label>Turma</label>";
        echo "<select required='required' class='form-control' name='turma' id='turma' onchange='buscar_disciplina_pd()'>";
        echo "<option value='0'>Selecione uma Turma</option>";

        foreach ($arrayTurmas as $row) {
            $id_turma = $row['turma_id'];
            $turma = $row['tur_tx_descricao'];
            $periodo_letivo = $row['periodo_letivo'];
            if ($periodo_letivo != null) {
                $periodo_letivo_descricao = $row['periodo_letivo'];
            } else {
                $periodo_letivo_descricao = $row['ano'] . '/' . $row['semestre'];
            }
            $turno = $row['descricao'];
            $periodo2 = $row['periodo_id'];

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
            echo "<option value='$id_turma'> $turma /  $turno ($periodo_letivo_descricao)</option>";
        }
        echo " </select>";
    }

    public function carrega_disciplina($param1 = '', $param2 = '') {

        $Disciplinas = $this->coordenador_model->disciplinasProfessor($param1);
        $arrayDisciplinas = $this->coordenador_model->NomeDisciplinas($Disciplinas['periodo_id'], $param2, $Disciplinas['mat_tx_ano'], $Disciplinas['mat_tx_semestre']);


        echo "<label>Disciplina</label>";
        echo "<select required='required' class='form-control' name='disciplina' id='disciplina'>";
        echo "<option value='0'>Selecione a Disciplina</option>";

        foreach ($arrayDisciplinas as $row) {

            $id_matriz_disciplina = $row['matriz_disciplina_id'];
            $disciplina = $row['disc_tx_descricao'];
            $disciplina_id = $row['disciplina_id'];


            echo "<option value='$disciplina_id'> $disciplina</option>";
        }

        echo " </select>";
    }

    public function deleteDisciplina($param1 = '', $param2 = '', $param3 = '') {

        if ($this->coordenador_model->CountTable('aulas', 'pdt_nb_codigo', $param2) > 0) {

            $aulas = $this->coordenador_model->GetWhere('aulas', 'pdt_nb_codigo', $param2);

            foreach ($aulas as $row_aulas) {

                if ($this->coordenador_model->DeleteWhere('plano_ensino_conteudo', 'aul_nb_codigo', $row_aulas['aul_nb_codigo'])) {

                    if ($this->coordenador_model->DeleteWhere('aulas', 'aul_nb_codigo', $row_aulas['aul_nb_codigo'])) {
                        
                    } else {

                        $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                        $this->session->set_flashdata('type', 'warning');
                        redirect(base_url() . 'professor/disciplinas/' . $param3);
                    }
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'professor/disciplinas/' . $param3);
                }
            }

            $rowPlano = $this->coordenador_model->getTableRow('plano_ensino', 'pe_nb_codigo', 'pdt_nb_codigo', $param2);
            
            if ($this->coordenador_model->DeleteWhere('avaliacao', 'pe_nb_codigo', $rowPlano['pe_nb_codigo'])) {

                if ($this->coordenador_model->DeleteWhere('plano_ensino', 'pdt_nb_codigo', $param2)) {

                    if ($this->coordenador_model->DeleteWhere('professor_disciplina_turma', 'pdt_nb_codigo', $param2)) {

                        if ($this->coordenador_model->DeleteWhere('professor_curso', 'pc_nb_codigo', $param1)) {

                            $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> excluida com sucesso!');
                            $this->session->set_flashdata('type', 'success');
                            redirect(base_url() . 'professor/disciplinas/' . $param3);
                        } else {

                            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                            $this->session->set_flashdata('type', 'warning');
                            redirect(base_url() . 'professor/disciplinas/' . $param3);
                        }
                    } else {

                        $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                        $this->session->set_flashdata('type', 'warning');
                        redirect(base_url() . 'professor/disciplinas/' . $param3);
                    }
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'professor/disciplinas/' . $param3);
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'professor/disciplinas/' . $param3);
            }
        } else {
            if ($this->coordenador_model->DeleteWhere('professor_disciplina_turma', 'pdt_nb_codigo', $param2)) {

                if ($this->coordenador_model->DeleteWhere('professor_curso', 'pc_nb_codigo', $param1)) {

                    $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> excluida com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'professor/disciplinas/' . $param3);
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'professor/disciplinas/' . $param3);
                }
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'professor/disciplinas/' . $param3);
            }
        }
    }

}
