<?php

/**
 * Description of Matriz
 *
 * @author Karol Oliveira
 */
class Matriz extends CI_Controller {

    function __construct() {
        parent::__construct();

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $page_data['matriz'] = $this->agape_model->getJoin('matriz', 'cursos', 'matriz_id');
        $page_data['page_name'] = 'matriz/list';
        $page_data['page_title'] = 'LISTA MATRIZ';
        $this->load->view('index', $page_data);
    }

    public function add() {


        if ($this->input->post()) {

            $dados = array(
                "mat_tx_ano" => $this->input->post('ano'),
                "mat_tx_semestre" => $this->input->post('semestre'),
                "cursos_id" => $this->input->post('curso'),
            );

            if ($this->agape_model->save('matriz', $dados)) {

                $this->session->set_flashdata('message', '<strong>MATRIZ</strong> cadastrada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'matriz');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar TURMA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'matriz');
            }
        } else {
            $page_data['cursos'] = $this->agape_model->getTable('cursos', 'cur_tx_descricao');
            $page_data['page_name'] = 'matriz/add';
            $page_data['page_title'] = 'INCLUIR MATRIZ';
            $this->load->view('index', $page_data);
        }
    }

    public function disciplinas($param1 = '') {

        if ($this->input->post()) {

            $dadosDisciplina = array(
                "disc_tx_descricao" => $this->input->post('disciplina'),
                "disc_tx_abrev" => $this->input->post('codigo'),
            );

            $ultimo_id = $this->agape_model->save('disciplina', $dadosDisciplina);

            if ($ultimo_id) {

                $dados = array(
                    "matriz_id" => $param1,
                    "periodo" => $this->input->post('periodo'),
                    "disciplina_id" => $ultimo_id,
                    "carga_horaria" => $this->input->post('ch'),
                    "credito" => $this->input->post('credito'),
                );

                if ($this->agape_model->save('matriz_disciplina', $dados)) {

                    $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> cadastrada com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'matriz/disciplinas/' . $param1);
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar DISCIPLINA!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'matriz/disciplinas/' . $param1);
                }
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar DISCIPLINA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'matriz/disciplinas/' . $param1);
            }
        } else {

            $page_data['disciplinas'] = $this->agape_model->DisciplinasMatriz($param1);
            $page_data['InfoMatriz'] = $this->agape_model->getJoinRow('matriz', 'cursos', 'matriz_id', $param1);
            $page_data['periodos'] = $this->agape_model->getTable('periodo');
            $page_data['page_name'] = 'matriz/disciplinas';
            $page_data['page_title'] = 'INCLUIR DISCIPLINA MATRIZ';
            $this->load->view('index', $page_data);
        }
    }

    public function addDisciplina($param1 = '') {

        if ($this->input->post()) {

            $dadosDisciplina = array(
                "disc_tx_descricao" => $this->input->post('disciplina'),
                "disc_tx_abrev" => $this->input->post('codigo'),
            );

            $ultimo_id = $this->agape_model->save('disciplina', $dadosDisciplina);

            if ($ultimo_id) {

                $dados = array(
                    "matriz_id" => $param1,
                    "periodo" => $this->input->post('periodo'),
                    "disciplina_id" => $ultimo_id,
                    "carga_horaria" => $this->input->post('ch'),
                    "credito" => $this->input->post('credito'),
                );

                if ($this->agape_model->save('matriz_disciplina', $dados)) {

                    $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> cadastrada com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'matriz/disciplinas/' . $param1);
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar DISCIPLINA!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'matriz/disciplinas/' . $param1);
                }
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar DISCIPLINA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'matriz/disciplinas/' . $param1);
            }
        } else {

            $page_data['InfoMatriz'] = $this->agape_model->getJoinRow('matriz', 'cursos', 'matriz_id', $param1);
            $page_data['periodos'] = $this->agape_model->getTable('periodo');
            $page_data['page_name'] = 'matriz/nova_disciplina';
            $page_data['page_title'] = 'INCLUIR DISCIPLINA MATRIZ';
            $this->load->view('index', $page_data);
        }
    }

    public function deleteDisciplina($param1 = '', $param2 = '') {

        if ($this->agape_model->delete('matriz_disciplina', $param1)) {

            if ($this->agape_model->delete('disciplina', $param1)) {

                $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> excluida com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'matriz/disciplinas/' . $param2);
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'matriz/disciplinas/' . $param2);
            }

            $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'matriz/disciplinas/' . $param2);
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir DISCIPLINA');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'matriz/disciplinas/' . $param2);
        }
    }

    public function editDisciplina($param1 = '', $param2 = '', $param3 = '') {

        if ($this->input->post()) {

            $dadosDisciplina = array(
                "disc_tx_descricao" => $this->input->post('disciplina'),
                "disc_tx_abrev" => $this->input->post('codigo'),
            );

            $ultimo_id = $this->agape_model->update($dadosDisciplina, 'disciplina', $param2);

            if ($ultimo_id) {

                $dados = array(
                    "periodo" => $this->input->post('periodo'),
                    "carga_horaria" => $this->input->post('ch'),
                    "credito" => $this->input->post('credito'),
                );

                if ($this->agape_model->update($dados, 'matriz_disciplina', $param3)) {

                    $this->session->set_flashdata('message', '<strong>DISCIPLINA</strong> editada com sucesso!');
                    $this->session->set_flashdata('type', 'success');
                    redirect(base_url() . 'matriz/disciplinas/' . $param1);
                } else {

                    $this->session->set_flashdata('message', '<strong>ERRO</strong> ao editar DISCIPLINA!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect(base_url() . 'matriz/disciplinas/' . $param1);
                }
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao editar DISCIPLINA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'matriz/disciplinas/' . $param1);
            }
        } else {

            $page_data['disciplinas'] = $this->agape_model->DisciplinasMatriz($param1);
            $page_data['InfoMatriz'] = $this->agape_model->getJoinRow('matriz', 'cursos', 'matriz_id', $param3);
            $page_data['periodos'] = $this->agape_model->getTable('periodo');
            $page_data['matriz_disciplina'] = $this->agape_model->getUpdateMatriz($param2);
            $page_data['page_name'] = 'matriz/edit_disciplina';
            $page_data['page_title'] = 'EDITAR DISCIPLINA';
            $this->load->view('index', $page_data);
        }
    }

    public function MatrizDisciplina($param1 = '') {

        $page_data['carrega_curso'] = $this->db->get_where('cursos')->result_array();
        $page_data['page_name'] = 'matriz/disciplinas';
        $page_data['page_title'] = 'LISTA MATRIZ';
        $this->load->view('index', $page_data);
    }

    public function imprimir($param1 = '') {


        $page_data['periodos'] = $this->agape_model->DisciplinasMatrizPeriodo($param1);
        $page_data['soma'] = $this->agape_model->DiscSumtotal($param1);
        $page_data['InfoMatriz'] = $this->agape_model->getJoinRow('matriz', 'cursos', 'matriz_id', $param1);
        $page_data['matriz_id'] = $param1;
        $page_data['page_name'] = 'matriz/imprimir';
        $page_data['page_title'] = 'LISTA MATRIZ';
        $this->load->view('index', $page_data);
    }

}
