<?php

/**
 * Description of Biblioteca
 *
 * @author Karol Oliveira
 */
class Biblioteca extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['calendario'] = $this->educacional_model->GetWhere('*', 'calendario', 'tipo', 1);
        $page_data['page_name'] = 'dashboard/dashboard';
        $page_data['page_title'] = 'Dashboard Biblioteca';
        $this->load->view('index', $page_data);
    }

    public function livro($param1 = '') {


        $this->load->library('pagination');
        $offset = $this->uri->segment(3, 0);
        $limit = 10;


        $config['base_url'] = base_url() . "biblioteca/livro/";
        $config['total_rows'] = $this->educacional_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', null, null, 'liv_tx_titulo');
        $config['per_page'] = 10;


        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();


        $page_data['data_list'] = $this->educacional_model->getJoinLike('COUNT(liv_tx_titulo) as quantidade, livro_id, liv_tx_titulo, liv_tx_autor, nome, palavra_chave', 'livro', 'categoria_livro', 'liv_tx_titulo', null, null, 'liv_tx_titulo, liv_tx_autor', $limit, $offset);
        $page_data['pagination'] = $pagination;


        $page_data['total'] = $this->educacional_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', null, null, 'liv_tx_titulo, liv_tx_autor');
        $page_data['page_name'] = 'biblioteca/livro/list';
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

    public function search($param1 = '', $param2 = '') {

        if ($param1 == '' && $this->input->post('nome') == '') {
            redirect(base_url() . 'biblioteca/livro');
        }
        $this->load->library('pagination');
        if ($this->input->post('nome') == '') {
            $nome = $param1;
        } else {
            $nome = $this->input->post('nome');
        }

        if ($this->input->post('tipo') == '') {
            $searchInput = $param2;
        } else {
            $searchInput = $this->input->post('tipo');
        }

        if ($searchInput == 1) {
            $search = 'liv_tx_autor';
        } else if ($searchInput == 2) {
            $search = 'liv_tx_titulo';
        } else if ($searchInput == 3) {
            $search = 'livro_id';
        } else if ($searchInput == 4) {
            $search = 'palavra_chave';
        }

        $offset = $this->uri->segment(4, 0);
        $limit = 10;

        $lista = $this->educacional_model->getJoinLike('COUNT(liv_tx_titulo) as quantidade, livro_id, liv_tx_titulo, liv_tx_autor, nome, palavra_chave', 'livro', 'categoria_livro', 'liv_tx_titulo', $search, $nome, 'liv_tx_titulo, liv_tx_autor', $limit, $offset);


        $page_data['nome'] = $nome;
        $config['base_url'] = base_url() . "biblioteca/search/$nome/" . $this->input->post('tipo');
        $config['total_rows'] = $this->educacional_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', $search, $nome, 'liv_tx_titulo, liv_tx_autor');
        $config['per_page'] = 10;


        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        $page_data['data_list'] = $lista;
        $page_data['pagination'] = $pagination;


        $page_data['total'] = $this->educacional_model->getJoinLikeCount('liv_tx_titulo', 'livro', 'categoria_livro', 'liv_tx_titulo', $search, $nome, 'liv_tx_titulo, liv_tx_autor');
        $page_data['page_name'] = 'biblioteca/livro/list';
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

    public function CreateLivro() {

        if ($this->input->post()) {


            $data_hoje = date('Y-m-d');

            for ($i = 1; $i <= $this->input->post('numero_exemplar'); $i++) {

                $dados = array(
                    "liv_nb_data" => $data_hoje,
                    "liv_tx_titulo" => $this->input->post('titulo'),
                    "liv_tx_subtitulo" => $this->input->post('subtitulo'),
                    "liv_tx_autor" => $this->input->post('autores'),
                    "liv_tx_tradutor" => $this->input->post('tradutor'),
                    "liv_tx_editora" => $this->input->post('editora'),
                    "liv_tx_idioma" => $this->input->post('idioma'),
                    "liv_tx_isbn" => $this->input->post('isbn'),
                    "liv_tx_pais" => $this->input->post('pais'),
                    "liv_tx_ano" => $this->input->post('ano'),
                    "liv_tx_npag" => $this->input->post('numero_pagina'),
                    "liv_tx_serie" => $this->input->post('serie'),
                    "liv_tx_chamada" => $this->input->post('numero_chamada'),
                    "liv_tx_exemplar" => $this->input->post('numero_exemplar'),
                    "liv_tx_edicao" => $this->input->post('edicao'),
                    "liv_tx_local" => $this->input->post('local_edicao'),
                    "liv_tx_bloco" => $this->input->post('bloco'),
                    "liv_tx_cdd" => $this->input->post('cdd'),
                    "categoria_livro_id" => $this->input->post('categoria'),
                    "sl_nb_codigo" => 1,
                    "to_nb_codigo" => $this->input->post('tipo_obra'),
                    "palavra_chave" => $this->input->post('palavra_chave'),
                    "cutter" => $this->input->post('cutter'),
                    "forma_aquisicao" => $this->input->post('forma_aquisicao'),
                    "prateleira" => $this->input->post('prateleira'),
                );


                $resultado = $this->educacional_model->save('livro', $dados);
                move_uploaded_file($_FILES['img']['tmp_name'], 'upload/livro/' . $resultado . '.jpg');
            }



            if ($resultado) {

                $this->session->set_flashdata('message', '<strong>LIVRO</strong> cadastrada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'biblioteca/livro', 'refresh');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar LIVRO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'biblioteca/livro', 'refresh');
            }
        } else {
            $page_data['categoria'] = $this->educacional_model->getTable('categoria_livro', 'nome');
            $page_data['tipoObra'] = $this->educacional_model->getTable('tipo_obra', 'to_tx_descricao');
            $page_data['page_name'] = 'biblioteca/livro/add';
            $page_data['page_title'] = 'Cadastrar Livro';
            $this->load->view('index', $page_data);
        }
    }

    public function updateLivro($param1 = '') {


        if ($this->input->post()) {

            $dados = array(
                "liv_tx_titulo" => $this->input->post('titulo'),
                "liv_tx_subtitulo" => $this->input->post('subtitulo'),
                "liv_tx_autor" => $this->input->post('autores'),
                "liv_tx_tradutor" => $this->input->post('tradutor'),
                "liv_tx_editora" => $this->input->post('editora'),
                "liv_tx_idioma" => $this->input->post('idioma'),
                "liv_tx_isbn" => $this->input->post('isbn'),
                "liv_tx_pais" => $this->input->post('pais'),
                "liv_tx_ano" => $this->input->post('ano'),
                "liv_tx_npag" => $this->input->post('numero_pagina'),
                "liv_tx_serie" => $this->input->post('serie'),
                "liv_tx_chamada" => $this->input->post('numero_chamada'),
                "liv_tx_exemplar" => $this->input->post('numero_exemplar'),
                "liv_tx_edicao" => $this->input->post('edicao'),
                "liv_tx_local" => $this->input->post('local_edicao'),
                "liv_tx_bloco" => $this->input->post('bloco'),
                "liv_tx_cdd" => $this->input->post('cdd'),
                "categoria_livro_id" => $this->input->post('categoria'),
                "sl_nb_codigo" => 1,
                "to_nb_codigo" => $this->input->post('tipo_obra'),
                "palavra_chave" => $this->input->post('palavra_chave'),
                "cutter" => $this->input->post('cutter'),
                "biblioteca" => $this->input->post('biblioteca'),
                "forma_aquisicao" => $this->input->post('forma_aquisicao'),
                "prateleira" => $this->input->post('prateleira'),
            );

            $resultado = $this->educacional_model->update($dados, 'livro', $param1);
            move_uploaded_file($_FILES['img']['tmp_name'], 'upload/livro/' . $param1 . '.jpg');


            if ($resultado) {

                $this->session->set_flashdata('message', '<strong>LIVRO</strong> atualizado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'biblioteca/livro');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao atualizar LIVRO!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'biblioteca/livro');
            }
        } else {

            $page_data['categoria'] = $this->educacional_model->getTable('categoria_livro', 'nome');
            $page_data['tipoObra'] = $this->educacional_model->getTable('tipo_obra', 'to_tx_descricao');
            $page_data['livro'] = $this->educacional_model->getUpdate('livro', $param1);


            $page_data['page_name'] = 'biblioteca/livro/edit';
            $page_data['page_title'] = 'Editar Livro';
            $this->load->view('index', $page_data);
        }
    }

    public function ValidateExists($param1 = '') {

        $uName = $this->input->post('titulo');
        $isUNameCount = $this->educacional_model->isVarExists('livro', $uName, 'liv_tx_titulo');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function ExcluirLivro($param1 = '') {

        if ($this->educacional_model->delete('livro', $param1)) {

            $this->session->set_flashdata('message', '<strong>LIVRO</strong> excluido com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'biblioteca/livro', 'refresh');
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir LIVRO');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'biblioteca/livro', 'refresh');
        }
    }

    public function Categoria($param1 = '') {


        $page_data['categorias'] = $this->educacional_model->getTable('categoria_livro');
        $page_data['page_name'] = 'biblioteca/categoria/list';
        $page_data['page_title'] = 'Lista Categoria(s)';
        $this->load->view('index', $page_data);
    }

    public function ValidateExistsCategoria($param1 = '') {

        $uName = $this->input->post('nome');
        $isUNameCount = $this->educacional_model->isVarExists('categoria_livro', $uName, 'nome');

        if ($isUNameCount > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function CreateCategoria() {

        if ($this->input->post()) {


            $dados = array(
                "nome" => $this->input->post('nome'),
            );


            if ($this->educacional_model->save('categoria_livro', $dados)) {

                $this->session->set_flashdata('message', '<strong>CATEGORIA</strong> cadastrada com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'biblioteca/categoria', 'refresh');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao cadastrar CATEGORIA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'biblioteca/categoria', 'refresh');
            }
        } else {

            $page_data['page_name'] = 'biblioteca/categoria/add';
            $page_data['page_title'] = 'Cadastrar Livro';
            $this->load->view('index', $page_data);
        }
    }

    public function updateCategoria($param1 = '') {

        if ($this->input->post()) {

            $dados = array(
                "nome" => $this->input->post('nome'),
            );

            if ($this->educacional_model->update($dados, 'categoria_livro', $param1)) {
                $this->session->set_flashdata('message', '<strong>CATEGORIA</strong> atualizado com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'biblioteca/categoria');
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao atualizar CATEGORIA!');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'biblioteca/categoria');
            }
        } else {


            $page_data['categoria'] = $this->educacional_model->getUpdate('categoria_livro', $param1);
            $page_data['page_name'] = 'biblioteca/categoria/edit';
            $page_data['page_title'] = 'Cadastrar Livro';
            $this->load->view('index', $page_data);
        }
    }

    public function emprestimo() {

        $page_data['emprestimos'] = $this->educacional_model->livrosGeral();
        $page_data['page_name'] = 'biblioteca/emprestimo/list';
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

    public function CreateEmprestimo() {

        $page_data['cursos'] = $this->educacional_model->getTable('cursos', 'cur_tx_descricao');
        $page_data['page_name'] = 'biblioteca/emprestimo/add';
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

    public function carregaPeriodoLetivo($param1 = '') {

        $ArrayPeridoLetivo = $this->educacional_model->getPeriodoLetivo($param1);


        echo " <label>Período Letivo</label>";
        echo "<select  class='form-control'  name='periodo_letivo' id='periodo_letivo' onchange='buscar_turma()'  >";
        echo "<option value=''> Escolha o Período Letivo</option>";

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

        $DadosPeriodo = $this->educacional_model->getTableRow('periodo_letivo', 'periodo_letivo', 'periodo_letivo_id', $param2);
        $periodo = $DadosPeriodo['periodo_letivo'];
        $ArrayTurma = $this->educacional_model->getTurma($param1, $periodo = $periodo . "" . $param3);

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

        $arrayAlunos = $this->educacional_model->GetPesquisaAlunos($param1, $param2, $nome, $param4, $param5);


        echo '<section class="panel">';
        echo '<table class="table table-striped table-advance table-hover">';
        echo '<thead>';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th> Nome</th>';
        echo '<th> CPF</th>';
        echo '<th> P. Atual</th>';
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
            echo '<td class="hidden-phone">' . $rowAlunos['cpf'] . '</td>';

            if ($rowAlunos['desperiodizado'] == 1) {
                echo '<td>   <button style="width: 55px;" type="button" class="btn btn-amarelo  btn-sm"> DESP</button></td>';
            } else {

                echo '<td> <button style="width: 55px;" type="button" class="btn btn-defaul btn-sm">' . $rowAlunos['periodo_atual'] . 'º</button></td>';
            }

            echo '<td>' . $rowAlunos['registro_academico'] . '</td>';

            echo '<td>' . $rowAlunos['cur_tx_abreviatura'] . ' </td>';
            echo '<td>' . $situacao2 . '</td>';

            if ($situacao == 2) {
                echo '<td><a href="addLivro/' . $rowAlunos['matricula'] . '"><span class="label label-primary label-mini"><i class="fa fa-thumbs-up"></i> Emprestar</span></a></td>';
            } else {
                echo '<td><a href="#"><span class="label label-danger label-mini"><i class="fa fa-thumbs-down"></i> Emprestar</span></a></td>';
            }

            echo '</tr>';

        endforeach;
        echo '</tbody>';
        echo '</table>';
        echo '</section>';
    }

    public function addLivro($param1 = '') {

        $page_data['turma'] = $this->educacional_model->SituationStudent($param1);
        $page_data['emprestimos'] = $this->educacional_model->getJoin('*', 'livro_emprestimo', 'livro', 'livro_emprestimo_id', 'mat_nb_codigo', $param1);
        $page_data['matricula_id'] = $param1;
        $page_data['page_name'] = 'biblioteca/emprestimo/add_livro';
        $page_data['page_title'] = 'Lista de Livros';
        $page_data['student_id'] = $param1;
        $this->load->view('index', $page_data);
    }

    public function emprestarLivro() {

        //Verifica se livro já esta emprestado.
        if ($this->educacional_model->countWhere('livro_emprestimo', 'livro_id', $this->input->post('livro_id'), 'le_nb_status', 2)) {
            $this->session->set_flashdata('message', '<strong>ERRO</strong> LIVRO já está emprestado!');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'biblioteca/addLivro/' . $this->input->post('matricula_id'));
        } else {

            $dt_emp = explode("/", $this->input->post('dt_emprestimo'));
            $dt_emp = $dt_emp[2] . "-" . $dt_emp[1] . "-" . $dt_emp[0];

            $dt_dev = explode("/", $this->input->post('dt_devolucao'));
            $dt_dev = $dt_dev[2] . "-" . $dt_dev[1] . "-" . $dt_dev[0];


            $dados = array(
                "le_dt_emprestimo" => $dt_emp,
                "le_dt_prev_dev" => $dt_dev,
                "le_nb_status" => 0,
                "le_nb_tipo" => 1,
                "mat_nb_codigo" => $this->input->post('matricula_id'),
                "livro_id" => $this->input->post('livro_id')
            );

            if ($this->educacional_model->save('livro_emprestimo', $dados)) {

                $this->session->set_flashdata('message', '<strong>LIVRO </strong> inserido com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'biblioteca/addLivro/' . $this->input->post('matricula_id'));
            } else {

                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao inserir LIVRO !');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'biblioteca/addLivro/' . $this->input->post('matricula_id'));
            }
        }
    }

    public function deleteEmprestimo($param1 = '', $param2 = '', $param3 = '') {

        if ($this->educacional_model->delete('livro_emprestimo', $param1)) {

            $dadosLend['sl_nb_codigo'] = 1;
            if ($this->educacional_model->UpdateWhere($dadosLend, 'livro', 'livro_id', $param3)) {
                $this->session->set_flashdata('message', '<strong>EMPRESTIMO LIVRO</strong> excluido com sucesso!');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url() . 'biblioteca/addLivro/' . $param2);
            } else {
                $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir EMPRESTIMO LIVRO');
                $this->session->set_flashdata('type', 'warning');
                redirect(base_url() . 'biblioteca/livro/' . $param2);
            }
        } else {
            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao excluir EMPRESTIMO LIVRO');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'biblioteca/livro/' . $param2);
        }
    }

    public function exemplares($param1 = '') {

        $livro = $this->educacional_model->getTableRow('livro', 'livro_id', 'livro_id', $param1);
        $page_data['exemplares'] = $this->educacional_model->GetWhere('*', 'livro', 'liv_tx_titulo', $livro['liv_tx_titulo'], 'liv_tx_autor', $livro['liv_tx_autor']);
        $page_data['page_name'] = 'biblioteca/livro/exemplar';
        $page_data['page_title'] = 'Lista de Exemplares';
        $page_data['idExemplar'] = $param1;
        $this->load->view('index', $page_data);
    }

    public function createExemplar($param1 = '') {

        $livro = $this->educacional_model->getTableRow('livro', 'livro_id', 'livro_id', $param1);
        $countLivro = $this->educacional_model->countWhere('livro', 'liv_tx_titulo', $livro['liv_tx_titulo']);

        $dados = array(
            "liv_tx_titulo" => $livro['liv_tx_titulo'],
            "liv_tx_subtitulo" => $livro['liv_tx_subtitulo'],
            "liv_tx_autor" => $livro['liv_tx_autor'],
            "liv_tx_tradutor" => $livro['liv_tx_tradutor'],
            "liv_tx_editora" => $livro['liv_tx_editora'],
            "liv_tx_idioma" => $livro['liv_tx_idioma'],
            "liv_tx_isbn" => $livro['liv_tx_isbn'],
            "liv_tx_pais" => $livro['liv_tx_pais'],
            "liv_tx_ano" => $livro['liv_tx_ano'],
            "liv_tx_npag" => $livro['liv_tx_npag'],
            "liv_tx_serie" => $livro['liv_tx_serie'],
            "liv_tx_chamada" => $livro['liv_tx_chamada'],
            "liv_tx_exemplar" => $countLivro + 1,
            "liv_tx_edicao" => $livro['liv_tx_edicao'],
            "liv_tx_local" => $livro['liv_tx_local'],
            "liv_tx_bloco" => $livro['liv_tx_bloco'],
            "liv_tx_cdd" => $livro['liv_tx_cdd'],
            "categoria_livro_id" => $livro['categoria_livro_id'],
            "sl_nb_codigo" => 1,
            "to_nb_codigo" => $livro['to_nb_codigo'],
            "palavra_chave" => $livro['palavra_chave'],
            "cutter" => $livro['cutter'],
            "biblioteca" => $livro['biblioteca'],
            "forma_aquisicao" => $livro['forma_aquisicao'],
            "prateleira" => $livro['prateleira'],
        );

        if ($this->educacional_model->save('livro', $dados)) {

            $this->session->set_flashdata('message', '<strong>EXEMPLAR</strong> inserido com sucesso!');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url() . 'biblioteca/exemplares/' . $param1);
        } else {

            $this->session->set_flashdata('message', '<strong>ERRO</strong> ao inserir EXEMPLAR !');
            $this->session->set_flashdata('type', 'warning');
            redirect(base_url() . 'biblioteca/exemplares/' . $param1);
        }
    }

    public function lendBooks($param1 = '') {

        $_checkbox = $this->input->post('loans');
        foreach ($_checkbox as $_valor) {

            $lendBooks = $this->educacional_model->getTableRow('livro_emprestimo', null, 'livro_emprestimo_id', $_valor);

            //Change borrowed status in the book table
            $dados['sl_nb_codigo'] = 2;
            if ($this->educacional_model->UpdateWhere($dados, 'livro', 'livro_id', $lendBooks['livro_id'])) {

                $dadosLend['le_nb_status'] = 2;
                if ($this->educacional_model->UpdateWhere($dadosLend, 'livro_emprestimo', 'livro_emprestimo_id', $_valor)) {
                    
                } else {
                    echo "ERRADO";
                }
            } else {
                echo "erro";
            }
        }
        redirect(base_url() . 'biblioteca/printEmprestimo/' . $param1);
    }

    public function printEmprestimo($param1 = '') {

        $page_data['loans'] = $this->educacional_model->getJoin('*', 'livro_emprestimo', 'livro', 'liv_tx_titulo', 'mat_nb_codigo', $param1, null, null, null, 'le_nb_status', 2);
        $page_data['dataStudent'] = $this->educacional_model->DadosAluno($param1);
        $page_data['page_name'] = 'biblioteca/emprestimo/printLoans';
        $page_data['page_title'] = 'Imprimir Empréstimo';
        $this->load->view('index', $page_data);
    }

    public function devolucao() {
        $page_data['emprestimos'] = $this->educacional_model->alunosEmprestimos();
        $page_data['page_name'] = 'biblioteca/devolucao/list';
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

    public function viewDevolucao($param1 = '') {
        $page_data['dataStudent'] = $this->educacional_model->DadosAluno($param1);
        $page_data['emprestimos'] = $this->educacional_model->getJoin('*', 'livro_emprestimo', 'livro', 'livro_emprestimo_id', 'mat_nb_codigo', $param1);
        $page_data['page_name'] = 'biblioteca/devolucao/devolucao';
        $page_data['student_id'] = $param1;
        $page_data['page_title'] = 'Lista de Livros';
        $this->load->view('index', $page_data);
    }

    public function devolutionBooks($param1 = '') {

        $_checkbox = $this->input->post('loans');

        foreach ($_checkbox as $_valor) {

            $lendBooks = $this->educacional_model->getTableRow('livro_emprestimo', null, 'livro_emprestimo_id', $_valor);

            //Change borrowed status in the book table
            $dados['sl_nb_codigo'] = 1;
            if ($this->educacional_model->UpdateWhere($dados, 'livro', 'livro_id', $lendBooks['livro_id'])) {

                $dadosLend['le_nb_status'] = 3; // STATUS 3 = DEVOLVEU
                if ($this->educacional_model->UpdateWhere($dadosLend, 'livro_emprestimo', 'livro_emprestimo_id', $_valor)) {
                    
                } else {
                    echo "ERRADO";
                }
            } else {
                echo "erro";
            }
        }
        redirect(base_url() . 'biblioteca/viewDevolucao/' . $param1);
    }

    public function minhaBiblioteca() {
        
        $service_url = 'https://digitallibraryv2.zbra.com.br/DigitalLibraryIntegrationService/AuthenticatedUrl';
        $curl = curl_init($service_url);

        // dados do aluno
        $firstName = 'camilla';
        $lastName = 'cruz';
        $email = 'ti@fbnovas.edu.br';
        $curl_post_data = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
                            <CreateAuthenticatedUrlRequest
                            xmlns=\"http://dli.zbra.com.br\"
                            xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"
                            xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">
                            <FirstName>$firstName</FirstName>
                            <LastName>$lastName</LastName>
                            <Email>$email</Email>
                            <CourseId xsi:nil=\"true\"/>
                            <Tag xsi:nil=\"true\"/>
                            <Isbn xsi:nil=\"true\"/>
                            </CreateAuthenticatedUrlRequest>";
        $content_size = strlen($curl_post_data);


        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/xml; charset=utf-8",
            "Host: digitallibrary-staging.zbra.com.br",
            "Content-Length: $content_size",
            "Expect: 100-continue",
            "Accept-Encoding: gzip, deflate",
            "Connection: Keep-Alive",
            "X-DigitalLibraryIntegration-API-Key: 578c068f-88ad-41d0-a5dd-00ec2fcc8f58")
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            echo curl_error($curl);
            curl_close($curl);
            die();
        }
        curl_close($curl);
        $xml = new SimpleXMLElement($curl_response);
        if ($xml->Success != 'true') {
            // echo htmlspecialchars($result);
            die();
        }
// user code below to redirect browser to the authenticated URL

        redirect($xml->AuthenticatedUrl, 'refresh');
        //echo header('Location: ' . $xml->AuthenticatedUrl);
        //echo $xml->AuthenticatedUrl;
        die();
    }

}
