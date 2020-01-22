<?php

/**
 * Description of Turma
 *
 * @author Karol Oliveira
 */
class Turma extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $page_data['turmas'] = $this->agape_model->GetTurmas();
        $page_data['page_name'] = 'turma/list';
        $page_data['page_title'] = 'Lista Turma(s)';
        $this->load->view('index', $page_data);
    }

    public function add() {

        if ($this->input->post()) {

            $dados = array(
                "tur_tx_descricao" => $this->input->post('descricao'),
                "status" => $this->input->post('status'),
                "periodo_letivo_id" => $this->input->post('periodo_letivo'),
                "matriz_id" => $this->input->post('matriz'),
                "periodo_id" => $this->input->post('periodo'),
                "turno_id" => $this->input->post('turno'),
                "curso_id" => $this->input->post('curso'),
            );


            if ($this->agape_model->save('turma', $dados)) {

                $this->session->set_flashdata('message', '<strong>TURMA</strong> cadastrada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'turma', 'refresh');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar TURMA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'turma');
            }
        } else {

            $page_data['periodoLetivo'] = $this->agape_model->GetWhereArray('periodo_letivo', 'periodo_encerrado', 1, 'periodo_letivo_id');
            $page_data['cursos'] = $this->agape_model->getTable('cursos', 'cur_tx_descricao');
            $page_data['turnos'] = $this->agape_model->getTable('turno', 'descricao');
            $page_data['periodos'] = $this->agape_model->getTable('periodo');
            $page_data['page_name'] = 'turma/add';
            $page_data['page_title'] = 'CADASTRAR TURMA';
            $this->load->view('index', $page_data);
        }
    }

    public function carrega_matriz($param1 = '') {

        $MatrizArray = $this->agape_model->GetWhereArray('matriz', 'cursos_id', $param1, 'mat_tx_ano');

        echo "<label>Matriz</label>";
        echo '<select class="form-control" required="required" name="matriz">';
        foreach ($MatrizArray as $row) {
            $id_matriz = $row['matriz_id'];
            $matriznome = $row['mat_tx_ano'];
            $matrizsemestre = $row['mat_tx_semestre'];
            echo "<option value='$id_matriz'>$matriznome/$matrizsemestre</option>";
        }
        echo "</select>";
    }

    public function edit($param1 = '', $param2 = '') {

        if ($this->input->post()) {

            $dados = array(
                "tur_tx_descricao" => $this->input->post('descricao'),
                "status" => $this->input->post('status'),
                "periodo_letivo_id" => $this->input->post('periodo_letivo'),
                "matriz_id" => $this->input->post('matriz'),
                "periodo_id" => $this->input->post('periodo'),
                "turno_id" => $this->input->post('turno'),
                "curso_id" => $this->input->post('curso'),
            );

            if ($this->agape_model->update($dados, 'turma', $param1)) {

                $this->session->set_flashdata('message', '<strong>TURMA</strong> editada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'turma', 'refresh');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao editar TURMA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'turma');
            }
        } else {

            $page_data['TurmaEdit'] = $this->agape_model->getUpdate('turma', $param1);
            $page_data['periodoLetivo'] = $this->agape_model->GetWhereArray('periodo_letivo', 'periodo_encerrado', 1, 'periodo_letivo_id');
            $page_data['cursos'] = $this->agape_model->getTable('cursos', 'cur_tx_descricao');
            $page_data['turnos'] = $this->agape_model->getTable('turno', 'descricao');
            $page_data['matriz'] = $this->agape_model->GetWhereArray('matriz', 'cursos_id', $param2);
            $page_data['periodos'] = $this->agape_model->getTable('periodo');
            $page_data['page_name'] = 'turma/edit';
            $page_data['page_title'] = 'EDITAR TURMA';
            $this->load->view('index', $page_data);
        }
    }

    public function delete($param1 = '') {

        $return = $this->agape_model->delete('turma', $param1);

        if ($return) {
            $this->session->set_flashdata('message', '<strong>TURMA</strong> excluida com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'turma');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir TURMA');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'turma');
        }
    }

}
