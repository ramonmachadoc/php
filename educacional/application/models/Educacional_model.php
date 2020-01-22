<?php

/**
 * Description
 * 
 * @author Karol Oliveira
 */
class Educacional_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function save($table, $dados) {

        $this->db->insert($table, $dados);
        return $this->db->insert_id();
    }

    public function contaRegistros($categoria) {

        $this->db->from('categoria_livro');
        $this->db->like('nome', $categoria);
        return $this->db->count_all_results();
    }

    public function CountTable($table) {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function getTable($table, $order = null) {

        $this->db->select("*");
        $this->db->from($table);

        if ($order) {
            $this->db->order_by($table . "." . $order, "ASC");
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTableRow($table, $order = null, $where = null, $value = null) {
        $this->db->select("*");
        $this->db->from($table);
        if ($order) {
            $this->db->order_by($table . "." . $order, "ASC");
        }
        if ($where) {
            $this->db->where($where, $value);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getJoinLike($select, $table, $join, $order, $where = null, $value = null, $group = null, $maximo, $inicio) {

        $this->db->select("$select");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");

        if ($group) {
            $this->db->group_by("$group");
        }

        $this->db->order_by($order, "asc");

        if ($where) {
            $where == "livro_id" ? $this->db->where($where, $value) : $this->db->like($where, $value);
        }

        $this->db->limit($maximo, $inicio);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getJoinLikeCount($select, $table, $join, $order, $where = null, $value = null, $group = null) {

        $this->db->select("$select");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");

        if ($group) {
            $this->db->group_by("$group");
        }

        $this->db->order_by($order, "ASC");

        if ($where) {
            $where == "livro_id" ? $this->db->where($where, $value) : $this->db->like($where, $value);
        }

        return $this->db->count_all_results();
    }

    public function getJoin($select, $table, $join, $order, $where = null, $value = null, $join2 = null, $table2 = null, $group = null, $where2 = null, $value2 = null) {

        $this->db->select("$select");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");

        if ($join2) {
            $this->db->join($join2, $join2 . "." . $join2 . "_id =" . $table2 . "." . $join2 . "_id");
        }

        if ($group) {
            $this->db->group_by("$group");
        }

        $this->db->order_by($order, "asc");

        if ($where) {
            $this->db->where($where, $value);
        }

        if ($where2) {
            $this->db->where($where2, $value2);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function CountGetJoin($select, $table, $join, $order, $where = null, $value = null, $join2 = null, $table2 = null, $group = null) {

        $this->db->select("COUNT(*) as total");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");

        if ($join2) {
            $this->db->join($join2, $join2 . "." . $join2 . "_id =" . $table2 . "." . $join2 . "_id");
        }

        if ($group) {
            $this->db->group_by("$group");
        }

        if ($where) {
            $this->db->where($where, $value);
        }

        $query = $this->db->get();
        return $query->row_array();
    }

    public function getUpdate($table, $id) {

        $query = $this->db->get_where($table, array($table . "_id" => $id));
        return $query->row_array();
    }

    public function UpdateWhere($dados, $table, $where, $id, $where2 = null, $value2 = null) {

        $this->db->where($where, $id);

        if ($where2) {
            $this->db->where($where2, $value2);
        }

        $this->db->update($table, $dados);

        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($dados, $table, $id) {

        $this->db->where($table . "_id", $id);
        $this->db->update($table, $dados);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $id) {

        $this->db->where($table . "_id", $id);
        $this->db->delete($table);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function GetWhere($select, $table, $where, $value, $where2 = null, $value2 = null) {

        $this->db->select("$select");
        $this->db->from($table);
        $this->db->where($where, $value);

        if ($where2) {
            $this->db->where($where2, $value2);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetWhereRow($table, $where, $value, $where2 = null, $value2 = null, $order = null, $join = null) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $value);

        if ($where2) {
            $this->db->where($where2, $value2);
        }


        if ($join) {
            $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");
        }

        if ($order) {
            $this->db->order_by($order, "desc");
        }
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function retornaLista2($table, $maximo, $inicio, $categoria = null) {

        $this->db->from($table);

        if ($categoria) {
            $this->db->like('liv_tx_titulo', $categoria);
        }

        $this->db->limit($maximo, $inicio);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function CountLista($table, $categoria = null) {

        $this->db->from($table);

        if ($categoria) {
            $this->db->like('liv_tx_titulo', $categoria);
        }
        return $this->db->count_all_results();
    }

    public function isVarExists($table, $value, $NameField) {

        $this->db->from($table);
        $this->db->where($NameField, $value);
        return $this->db->count_all_results();
    }

    public function getPeriodoLetivo($curso_id) {

        $this->db->select("periodo_letivo, periodo_letivo.periodo_letivo_id, turma.turma_id as turma_id, periodo_letivo.ano as ano, periodo_letivo.semestre as semestre");
        $this->db->from('turma');
        $this->db->join('turno', 'turno.turno_id = turma.turno_id');
        $this->db->join('periodo_letivo ', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
        $this->db->where('turma.curso_id', $curso_id);
        $this->db->group_by('periodo_letivo.ano, periodo_letivo.semestre');
        $this->db->order_by('periodo_letivo', "desc");
        $this->db->order_by('ano', "desc");
        $this->db->order_by('semestre', "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTurma($curso_id, $periodo_id) {

        $query = $this->db->query("SELECT x.turma_id, x.tur_tx_descricao as turma,x.periodo_id as periodo, x.turno as turno,  x.periodo_letivo, x.periodo_letivo_turma
                                   FROM(select curso_id, turma_id,tur_tx_descricao, periodo_id, tu.descricao as turno, pl.periodo_letivo as periodo_letivo,
                                   CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma FROM turma t
                                   INNER join turno tu on tu.turno_id = t.turno_id
                                   LEFT join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id)  x
                                   WHERE x.curso_id = $curso_id and (x.periodo_letivo_turma = '$periodo_id' or x.periodo_letivo = '$periodo_id' )order by periodo asc");

        return $query->result_array();
    }

    public function GetPesquisaAlunos($curso = null, $turma = null, $nome = null, $periodo = null, $matricula = null) {

        if ($curso <> 'null') {

            $wherecurso = "AND cursos.cursos_id = $curso";
        } else {

            $wherecurso = "";
        }
        if ($turma <> 'null') {
            $whereturma = "AND turma.turma_id = $turma";
        } else {

            $whereturma = "";
        }

        if ($nome <> 'null') {
            $wherenome = "AND cadastro_aluno.nome LIKE '%$nome%'";
        } else {
            $wherenome = "";
        }


        if ($periodo <> 'null') {
            $whereperiodo = "AND turma.periodo_letivo_id = '$periodo'";
        } else {

            $whereperiodo = "";
        }


        if ($matricula != 'null') {
            $wherematricula = "AND registro_academico = $matricula";
        } else {
            $wherematricula = '';
        }



        $query = $this->db->query("SELECT * FROM (SELECT distinct(registro_academico), `matricula_aluno`.`matricula_aluno_id` as `matricula`,desperiodizado, periodo_atual, `situacao_aluno_turma`, `nome`, `cpf`, `rg`, `data_nascimento`, `cur_tx_abreviatura`, `periodo_letivo`
                                 FROM `matricula_aluno_turma` JOIN `matricula_aluno` ON `matricula_aluno`.`matricula_aluno_id` = `matricula_aluno_turma`.`matricula_aluno_id`
                                 JOIN `cadastro_aluno` ON `cadastro_aluno`.`cadastro_aluno_id` = `matricula_aluno`.`cadastro_aluno_id`
                                 JOIN `turma` ON `turma`.`turma_id` = `matricula_aluno_turma`.`turma_id` JOIN `periodo_letivo`
                                 ON `periodo_letivo`.`periodo_letivo_id` = `matricula_aluno_turma`.`periodo_letivo_id` JOIN `cursos` ON `cursos`.`cursos_id` = `matricula_aluno`.`curso_id` 
                                 WHERE matricula_aluno_turma.status is null $wherecurso $whereturma $wherenome $whereperiodo $wherematricula order by situacao_aluno_turma ASC) AS conteudo GROUP BY registro_academico ORDER BY nome LIMIT 100");
        return $query->result_array();
    }

    public function SituationStudent($student_id) {

        $this->db->select("*, CASE WHEN periodo_atual is null THEN 'NÃO INFORMADO'
                            WHEN desperiodizado = 1 THEN 'DESPERIODIZADO'
                            ELSE periodo_atual
                            END periodoAtual,
                      CASE  WHEN desperiodizado = 1 THEN 'SIM'
                            ELSE 'NÃO'
                            END  SituacaoAluno,
                      CASE  WHEN  bolsista = 1 THEN 'SIM'
                            ELSE 'NÃO'
                            END AlunoBolsista,
                      CASE WHEN forma_ingresso = 1 THEN 'VESTIBULAR'
                           WHEN desperiodizado = 2 THEN 'ENEM'
                           WHEN desperiodizado = 3 THEN 'AVALIAÇÃO SERIADA'
                           WHEN desperiodizado = 4 THEN 'SELEÇÃO SIMPLIFICADA'
                           WHEN desperiodizado = 5 THEN 'TRANSFERÊNCIA'
                           WHEN desperiodizado = 6 THEN 'DECISÃO JUDICIAL'
                           WHEN desperiodizado = 7 THEN 'VAGAS REMANESCENTE'
                           WHEN desperiodizado = 8 THEN 'PROGRAMAS ESPECIAIS'
                           ELSE 'NÃO INFORMADO'
                           END AlunoIngresso");
        $this->db->from('matricula_aluno');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->where('matricula_aluno.matricula_aluno_id', $student_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function countWhere($table, $where, $value, $where2 = null, $value2 = null) {

        $this->db->from($table);
        $this->db->where($where, $value);
        if ($where2) {
            $this->db->where($where2, $value2);
        }
        return $this->db->count_all_results();
    }

    public function alunosEmprestimos() {

        $query = $this->db->query("SELECT nome, mat_nb_codigo FROM livro_emprestimo
                                    INNER JOIN matricula_aluno
                                    ON matricula_aluno.matricula_aluno_id = livro_emprestimo.mat_nb_codigo
                                    INNER JOIN cadastro_aluno
                                    ON cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id
                                    WHERE le_nb_status = 2 GROUP BY nome");

        return $query->result_array();
    }

    public function livrosEmprestimos($mat_nb_codigo) {

        $query = $this->db->query("SELECT * FROM livro_emprestimo
                                     INNER JOIN livro
                                     ON livro.livro_id = livro_emprestimo.livro_id
                                     WHERE mat_nb_codigo = $mat_nb_codigo AND le_nb_status = 2");

        return $query->result_array();
    }

    public function livrosGeral() {
        $query = $this->db->query("SELECT *, livro_emprestimo.livro_id as livroId FROM livro_emprestimo
                                 INNER JOIN livro
                                 ON livro.livro_id = livro_emprestimo.livro_id
                                 INNER JOIN matricula_aluno
                                 ON matricula_aluno.matricula_aluno_id = livro_emprestimo.mat_nb_codigo
                                 INNER JOIN cadastro_aluno
                                 ON cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id
                                 WHERE le_nb_status = 2");
        return $query->result_array();
    }

    public function DadosAluno($matricula_aluno) {

        $this->db->select("max(matricula_aluno_turma_id) as mat_max, cur_tx_abreviatura, periodo, desperiodizado, matricula_aluno_turma.semestre, matricula_aluno_turma.ano, nome,registro_academico, cur_tx_descricao, periodo_atual as periodo_id,periodo_letivo");
        $this->db->from('matricula_aluno');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_id = matricula_aluno.matricula_aluno_id');
        $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id', 'left');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->where("matricula_aluno.matricula_aluno_id", $matricula_aluno);
        $query = $this->db->get();
        return $query->row_array();
    }

    //modulo admin
    public function disciplinasLiberacoes($periodo_atual, $curso_id = null) {

        if ($curso_id) {
            $this->db->where("curso_id", $curso_id);
        }

        $this->db->select("pdt_nb_codigo, nome, disc_tx_descricao, tur_tx_descricao, professor_disciplina_turma.periodo_letivo_id");
        $this->db->from('professor_disciplina_turma');
        $this->db->join('turma', 'turma.turma_id = professor_disciplina_turma.tur_nb_codigo');
        $this->db->join('disciplina', 'disciplina.disciplina_id = professor_disciplina_turma.disc_nb_codigo');
        $this->db->join('professor_curso', 'professor_curso.pc_nb_codigo = professor_disciplina_turma.pc_nb_codigo');
        $this->db->join('professor', 'professor.professor_id = professor_curso.prof_nb_codigo');
        $this->db->where("turma.periodo_letivo_id", $periodo_atual);

        $this->db->order_by('nome', "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function AlunosNota($turma_id, $disciplina_id) {

        $query = $this->db->query("SELECT registro_academico, nome, md.disciplina_id, da.disciplina_aluno_id as da_codigo, dan_nb_falta_1bim,
                                   dan_fl_nota_1bim, dan_nb_falta_2bim, dan_fl_nota_2bim,dan_nb_falta_3bim, dan_fl_nota_3bim,disciplina_aluno_nota_id,dan_fl_media_final
                                   FROM matricula_aluno_turma mat
                                   inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
                                   inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                                   inner join disciplina_aluno da on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                                   inner join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
                                   inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
                                   where mat.turma_id = $turma_id and md.disciplina_id = $disciplina_id AND situacao_aluno_turma = 2 AND mat.status is null order by nome asc");
        return $query->result_array();
    }

    public function CountAlunosNota($turma_id, $disciplina_id, $bim) {

        $query = $this->db->query("SELECT COUNT(*)as qtd
                                   FROM matricula_aluno_turma mat
                                   inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
                                   inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                                   inner join disciplina_aluno da on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                                   inner join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
                                   inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
                                   where mat.turma_id = $turma_id and md.disciplina_id = $disciplina_id AND situacao_aluno_turma = 2 AND mat.status is null AND $bim is null  order by nome asc");
        return $query->row_array();
    }

    public function InfoDisciplina($pdt_nb_codigo) {

        $query = $this->db->query("SELECT * FROM professor_disciplina_turma
                                    INNER JOIN turma ON turma.turma_id = professor_disciplina_turma.tur_nb_codigo
                                    WHERE pdt_nb_codigo = $pdt_nb_codigo");
        return $query->row_array();
    }

    public function matriculasPorTurma($turma_id) {

        $query = $this->db->query("SELECT * FROM cadastro_aluno
                                   INNER JOIN matricula_aluno
                                   ON matricula_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id
                                   INNER JOIN matricula_aluno_turma
                                   ON matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id
                                   WHERE turma_id = $turma_id  AND status  is null");
        return $query->result_array();
    }

    public function disciplinasMatrizAtual($cursos_id, $periodo_id) {

        $query = $this->db->query("SELECT matriz_disciplina_id FROM matriz
                                    INNER JOIN matriz_disciplina
                                    ON matriz.matriz_id = matriz_disciplina.matriz_id
                                    WHERE atual = 1 AND cursos_id = $cursos_id AND periodo = $periodo_id AND status = 1");
        return $query->result_array();
    }

}
