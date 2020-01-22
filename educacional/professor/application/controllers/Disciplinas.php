<?php

/**
 * Description of Disciplinas
 * @author Karol Oliveira
 */
class Disciplinas extends CI_Controller {

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
        $page_data['page_name'] = 'minhas_disciplinas/list';
        $page_data['page_title'] = 'Minhas Disciplinas';
        $this->load->view('index', $page_data);
    }

    public function minhas_disciplinas_aula($param1 = '') {

        $page_data['Infoaulas'] = $this->professor_model->GetMinhasDisciplinasAula($param1);
        $page_data['aulas'] = $this->professor_model->GetWhere('aulas', 'pdt_nb_codigo', $param1);

        if (count($this->professor_model->GetWhere('aulas', 'pdt_nb_codigo', $param1)) == 0) {

            $this->session->set_flashdata('message', '<span class="label label-danger">ATENÇÃO !</span> <b>Preecha o seu Plano de Ensino</b>  ');
            $this->session->set_flashdata('type', 'warning');
        }

        $page_data['page_name'] = 'minhas_disciplinas/aulas';
        $page_data['page_title'] = 'Minhas Aulas';
        $this->load->view('index', $page_data);
    }

    public function chamada($param1 = '', $param2 = '') {

        if ($this->input->post()) {

            $arrayAulas = $this->professor_model->GetWhere('chamada', 'aul_nb_codigo', $param1);

            foreach ($arrayAulas as $row):

                $chamadaId = $row['cham_nb_codigo'];
                $junta = "rd_resposta" . $chamadaId;

                $dados = array(
                    "cham_nb_status" => $this->input->post($junta),
                    "updateStatus" => 1
                );

                $resultado = $this->professor_model->UpdateChamada($dados, 'chamada', 'cham_nb_codigo', $chamadaId);
            endforeach;

            if ($resultado) {
                $this->session->set_flashdata('message', '<strong>CHAMADA</strong> feita com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'Disciplinas/minhas_disciplinas_aula/' . $param2);
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao realizar CHAMADA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'Disciplinas/minhas_disciplinas_aula/' . $param2);
            }
        } else {


            $page_data['Infoaulas'] = $this->professor_model->GetMinhasDisciplinasAula($param1);
            $resultado = $this->professor_model->GetMinhasDisciplinasAula($param1);
            $page_data['aula_id'] = $param2;
            $page_data['alunos'] = $this->professor_model->Chamada($resultado['turma_id'], $resultado['disciplina_id']);
            $arrayAlunos = $this->professor_model->Chamada($resultado['turma_id'], $resultado['disciplina_id']);

            foreach ($arrayAlunos as $row):

                $da_codigo = $row['da_codigo'];
                $count = count($this->professor_model->GetWhere('chamada', 'aul_nb_codigo', $param2, 'da_nb_codigo', $da_codigo));

                if ($count == 0) {

                    $dados = array(
                        "aul_nb_codigo" => $param2,
                        "da_nb_codigo" => $da_codigo,
                        "cham_nb_status" => '1',
                    );
                    $this->professor_model->save('chamada', $dados);
                }
            endforeach;

            $page_data['page_name'] = 'minhas_disciplinas/chamada';
            $page_data['page_title'] = 'Minhas Disciplinas';
            $this->load->view('index', $page_data);
        }
    }

    public function Justifica($param1 = '', $param2 = '') {

        $justificativa = rawurldecode($param1);

        $dados = array(
            "justificativa" => $justificativa,
        );

        $resultado = $this->professor_model->UpdateChamada($dados, 'chamada', 'cham_nb_codigo', $param2);

        if ($resultado) {
            ?>
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>JUSTIFICATIVA</strong> cadastrada com sucesso!.
            </div> 
            <?php
        } else {
            ?>
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>ERRO</strong> ao cadastrar justificativa.
            </div> 
            <?php
        }
    }

    public function protocolo($param1 = '', $param2 = '', $param3 = '') {

        $page_data['alunos'] = $this->professor_model->AlunosNota($param2, $param3);
        $page_data['infoPlano'] = $this->professor_model->InfoPlanoEnsino($param1);
        $page_data['page_name'] = 'minhas_disciplinas/protocolo';
        $page_data['page_title'] = 'Mapa de Notas';
        $this->load->view('index', $page_data);
    }

}
?>