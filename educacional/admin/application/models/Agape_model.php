<?php

/**
 * Description of Agape_model
 *
 * @author karol Oliveira
 */
class Agape_model extends CI_Model {

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

    public function getJoin($table, $join, $order) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");
        $this->db->order_by($table . "." . $order, "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getJoinRow($table, $join, $where = null, $value = null) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");

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

    public function getUpdateMatriz($id) {

        $query = $this->db->query("select *, matriz_disciplina.disciplina_id as iddisc from matriz_disciplina
                                    INNER JOIN disciplina ON
                                    disciplina.disciplina_id = matriz_disciplina.disciplina_id
                                    WHERE matriz_disciplina_id = $id");
        return $query->row_array();
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

    public function GetAlbumFoto($table, $join, $order) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");
        $this->db->join('album_fotos', 'album_fotos.album_id = album.album_id');
        $this->db->where('capa_album', 1);
        $this->db->order_by($table . "." . $order, "desc");
        $this->db->group_by('album.nome');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteAlbum($table, $album_id) {

        $this->db->where("album_id", $album_id);
        $this->db->delete($table);
    }

    public function GetWhere($table, $where, $value) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $value);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function GetWhereArray($table, $where, $value, $order = null) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $value);

        if ($order) {
            $this->db->order_by($order, "DESC");
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function GetWhereRow($table, $where, $value) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $value);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function verificaAlbum($table, $value) {

        $this->db->from($table);
        $this->db->where('album_id', $value);
        return $this->db->count_all_results();
    }

    public function UpdateAlbum($dados, $table, $value) {

        $this->db->where("album_id", $value);
        $this->db->update($table, $dados);
    }

    public function isVarExists($table, $value, $NameField, $where2 = null, $value2 = null, $join = null) {
        $this->db->from($table);
        $this->db->where($NameField, $value);

        if ($join) {
            $this->db->join('matricula_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        }
        if ($where2) {
            $this->db->where($where2, $value2);
        }
        return $this->db->count_all_results();
    }

    public function PeriodoLetivo($turma) {

        $this->db->select("turma.periodo_letivo_id as IdPeriodoLetivo");
        $this->db->from('turma');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
        $this->db->where('turma_id', $turma);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ExistStudentPeriod($cpf, $periodo_letivo_id, $curso) {

        $this->db->select("count(*) as cont");
        $this->db->from('matricula_aluno');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_id = matricula_aluno.matricula_aluno_id');
        $this->db->join('dados_censo_aluno', 'dados_censo_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id', 'left');
        $this->db->where('cadastro_aluno.cpf', $cpf);
        $this->db->where('matricula_aluno_turma.periodo_letivo_id', $periodo_letivo_id);
        $this->db->where('matricula_aluno.curso_id', $curso);
        $query = $this->db->get();
        return $query->row_array();
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

    public function PeriodLetivo($matricula_id) {

        $this->db->select(" min(matricula_aluno_turma_id) as id, mat.ano as ano,mat.semestre as semestre,"
                . "mat.periodo_letivo_id as periodo_letivo_id");
        $this->db->from('matricula_aluno_turma mat');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = mat.periodo_letivo_id', 'left');
        $this->db->where('matricula_aluno_id', $matricula_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function PeriodAtual($periodo) {

        $this->db->select("*");
        $this->db->from('periodo_letivo');
        $this->db->where('periodo_letivo_id', $periodo);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function MatrizAtual($matriz) {

        $this->db->select("*");
        $this->db->from('matriz');
        $this->db->where('matriz_id', $matriz);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function PeriodCoursed($matricula, $pl) {

        $this->db->select("situacao_aluno_turma, mat.matricula_aluno_turma_id as matricula_aluno_turma_id, turma.turma_id, turma.ano as ano, turma.semestre as semestre,
                           mat.periodo as periodo_mat, turma.periodo_letivo_id,tur_tx_descricao, turno.turno_id,
                           turno.descricao as turno, periodo.periodo_id, periodo.periodo as periodo,
                           periodo_letivo.periodo_letivo as periodo_letivo,  
                           CASE WHEN mat.situacao_aluno_turma = 1 THEN 'Pré-Matriculado'
                                WHEN mat.situacao_aluno_turma = 2 THEN 'Matriculado'
                                WHEN mat.situacao_aluno_turma = 3 THEN 'Matricula Trancada'
                                WHEN mat.situacao_aluno_turma = 4 THEN 'Desvinculado do curso'
                                WHEN mat.situacao_aluno_turma = 5 THEN 'Transferido'
                                WHEN mat.situacao_aluno_turma = 6 THEN 'Formado'
                                WHEN mat.situacao_aluno_turma = 0 THEN 'Período concluído'
                                WHEN mat.situacao_aluno_turma = 7 THEN 'Falecido'
                            END situacao_aluno,
                            CASE WHEN mat.dependencia = 1  THEN '(Dependência)'
                                 ELSE ''
                            END dependencia");
        $this->db->from('matricula_aluno_turma mat');
        $this->db->join('matricula_aluno', 'matricula_aluno.matricula_aluno_id = mat.matricula_aluno_id');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('turma', 'turma.turma_id = mat.turma_id');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->join('turno', 'turno.turno_id = turma.turno_id');
        $this->db->join('periodo', 'periodo.periodo_id = turma.periodo_id', 'left');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = mat.periodo_letivo_id', 'left');
        $this->db->where('matricula_aluno.matricula_aluno_id', $matricula);
        $this->db->where("(mat.status != '11' or mat.status is null)");
        if ($pl == 1) {
            $this->db->where('periodo_letivo.atual', 1);
        }
        $this->db->order_by('matricula_aluno_turma_id', "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function CarregaBolsas($matricula_aluno_turma_id) {

        $this->db->select("bolsas.descricao as bolsa");
        $this->db->from('bolsa_aluno');
        $this->db->join('bolsa_periodo', 'bolsa_periodo.bolsa_periodo_id = bolsa_aluno.bolsa_periodo_id');
        $this->db->join('bolsas', 'bolsas.bolsas_id = bolsa_periodo.bolsas_id');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = bolsa_periodo.periodo_letivo_id');
        $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_turma_id = bolsa_aluno.matricula_aluno_turma_id');
        $this->db->join('matricula_aluno', 'matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->join('turno', 'turno.turno_id = turma.turno_id');
        $this->db->join('periodo', 'periodo.periodo_id = turma.periodo_id', 'left');
        $this->db->where('bolsa_aluno.matricula_aluno_turma_id', $matricula_aluno_turma_id);
        $this->db->order_by('bolsa_aluno_id', "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function BolsasAluno($matricula) {

        $this->db->select("*, bolsas.descricao as bolsa");
        $this->db->from('bolsa_aluno');
        $this->db->join('bolsa_periodo', 'bolsa_periodo.bolsa_periodo_id = bolsa_aluno.bolsa_periodo_id');
        $this->db->join('bolsas', 'bolsas.bolsas_id = bolsa_periodo.bolsas_id');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = bolsa_periodo.periodo_letivo_id');
        $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_turma_id = bolsa_aluno.matricula_aluno_turma_id');
        $this->db->join('matricula_aluno', 'matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->join('turno', 'turno.turno_id = turma.turno_id');
        $this->db->join('periodo', 'periodo.periodo_id = turma.periodo_id', 'left');
        $this->db->where('matricula_aluno.matricula_aluno_id', $matricula);
        $this->db->order_by('bolsa_aluno_id', "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function Bolsas() {

        $this->db->select("*");
        $this->db->from('bolsas');
        $this->db->join('bolsa_periodo', 'bolsa_periodo.bolsas_id = bolsas.bolsas_id');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = bolsa_periodo.periodo_letivo_id');
        $this->db->where('periodo_letivo.atual', 1);
        $this->db->order_by('descricao', "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function HistoricoAluno($matricula) {

        $query = $this->db->query("SELECT dan_fl_nota_pf as periodoLetivo, periodo_letivo_id, ano, semestre,carga_horaria, credito, disciplina.disciplina_id, matricula_aluno_turma.matricula_aluno_turma_id, disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao from matricula_aluno
                         INNER JOIN matricula_aluno_turma
                         ON matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id
                         INNER JOIN disciplina_aluno
                         ON disciplina_aluno.matricula_aluno_turma_id = matricula_aluno_turma.matricula_aluno_turma_id
                         INNER JOIN disciplina
                         ON disciplina.disciplina_id = disciplina_aluno.disciplina_id
                         INNER JOIN disciplina_aluno_nota
                         ON disciplina_aluno_nota.disciplina_aluno_id = disciplina_aluno.disciplina_aluno_id
                         INNER JOIN matriz_disciplina
                         ON matriz_disciplina.disciplina_id = disciplina.disciplina_id
                         WHERE matricula_aluno.matricula_aluno_id = $matricula UNION "
                . "SELECT periodo_letivo as periodoLetivo, matricula_aluno_turma.periodo_letivo_id, matricula_aluno_turma.ano, matricula_aluno_turma.semestre, carga_horaria, credito, disciplina.disciplina_id, matricula_aluno_turma.matricula_aluno_turma_id, disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao from matricula_aluno
                         INNER JOIN matricula_aluno_turma
                        ON matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id
                        INNER JOIN disciplina_aluno
                        ON disciplina_aluno.matricula_aluno_turma_id = matricula_aluno_turma.matricula_aluno_turma_id
                        INNER JOIN matriz_disciplina
                        ON matriz_disciplina.matriz_disciplina_id = disciplina_aluno.matriz_disciplina_id
                        INNER JOIN disciplina
                        ON disciplina.disciplina_id = matriz_disciplina.disciplina_id
                        INNER JOIN disciplina_aluno_nota
                        ON disciplina_aluno_nota.disciplina_aluno_id = disciplina_aluno.disciplina_aluno_id
                        INNER JOIN periodo_letivo
                        ON periodo_letivo.periodo_letivo_id = matricula_aluno_turma.periodo_letivo_id
                        WHERE matricula_aluno.matricula_aluno_id = $matricula");
        return $query->result_array();
    }

    public function GetTurmas() {

        $query = $this->db->query("SELECT * FROM turma INNER JOIN cursos ON cursos.cursos_id = turma.curso_id
                                    INNER JOIN periodo_letivo ON periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id
                                    INNER JOIN matriz ON matriz.matriz_id = turma.matriz_id
                                    INNER JOIN periodo ON turma.periodo_id = periodo.periodo_id
                                    ORDER BY tur_tx_descricao");

        return $query->result_array();
    }

    public function getTableRow($table, $order = null, $where = null, $value = null, $where2 = null, $value2 = null) {
        $this->db->select("*");
        $this->db->from($table);
        if ($order) {
            $this->db->order_by($table . "." . $order, "ASC");
        }
        if ($where) {
            $this->db->where($where, $value);
        }

        if ($where2) {
            $this->db->where($where2, $value2);
        }

        $query = $this->db->get();
        return $query->row_array();
    }

    public function DisciplinasMatriz($matriz_id) {

        $query = $this->db->query("SELECT * FROM matriz
                                  INNER JOIN matriz_disciplina
                                  ON matriz.matriz_id = matriz_disciplina.matriz_id
                                  INNER JOIN disciplina
                                  ON matriz_disciplina.disciplina_id = disciplina.disciplina_id
                                  WHERE matriz.matriz_id = $matriz_id");
        return $query->result_array();
    }

    public function DisciplinasMatrizImprimir($matriz_id, $periodo) {

        $query = $this->db->query("SELECT * FROM matriz
                                  INNER JOIN matriz_disciplina
                                  ON matriz.matriz_id = matriz_disciplina.matriz_id
                                  INNER JOIN disciplina
                                  ON matriz_disciplina.disciplina_id = disciplina.disciplina_id
                                  WHERE matriz.matriz_id = $matriz_id AND periodo = $periodo");
        return $query->result_array();
    }

    public function DisciplinasMatrizImprimirSum($matriz_id, $periodo, $sum) {

        $query = $this->db->query("SELECT SUM($sum) as soma FROM matriz
                                  INNER JOIN matriz_disciplina
                                  ON matriz.matriz_id = matriz_disciplina.matriz_id
                                  INNER JOIN disciplina
                                  ON matriz_disciplina.disciplina_id = disciplina.disciplina_id
                                  WHERE matriz.matriz_id = $matriz_id AND periodo = $periodo");
        return $query->row_array();
    }

    public function DiscSumtotal($matriz_id) {

        $query = $this->db->query("SELECT SUM(carga_horaria) as soma FROM matriz
                                  INNER JOIN matriz_disciplina
                                  ON matriz.matriz_id = matriz_disciplina.matriz_id
                                  INNER JOIN disciplina
                                  ON matriz_disciplina.disciplina_id = disciplina.disciplina_id
                                  WHERE matriz.matriz_id = $matriz_id");
        return $query->row_array();
    }

    public function DisciplinasMatrizPeriodo($matriz_id) {

        $query = $this->db->query("SELECT * FROM matriz
                                  INNER JOIN matriz_disciplina
                                  ON matriz.matriz_id = matriz_disciplina.matriz_id
                                  INNER JOIN disciplina
                                  ON matriz_disciplina.disciplina_id = disciplina.disciplina_id
                                  WHERE matriz.matriz_id = $matriz_id GROUP BY periodo");
        return $query->result_array();
    }

    public function bolsasPeriodo($periodo_letivo) {

        $query = $this->db->query("SELECT * FROM bolsa_periodo
                                   INNER JOIN bolsas ON bolsa_periodo.bolsas_id = bolsas.bolsas_id
                                   WHERE periodo_letivo_id = $periodo_letivo");
        return $query->result_array();
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

    public function MatriculaAluno($matricula_aluno_turma) {

        $this->db->select("*");
        $this->db->from('matricula_aluno_turma');
        $this->db->join('matricula_aluno', 'matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->where('matricula_aluno_turma_id', $matricula_aluno_turma);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function SelectImportacao($turma_id) {

        $query = $this->db->query("SELECT * FROM (SELECT distinct(registro_academico), `matricula_aluno`.`matricula_aluno_id` as `matricula`, matricula_aluno_turma_id,  matricula_aluno.bolsista, cursos_id, tipo_escola, forma_ingresso, situacao,semestre_ano_ingresso, `situacao_aluno_turma`, `nome`, sexo, cor, mae, turma.turno_id, nacionalidade, uf_nascimento, municipio_nascimento, aluno_deficiencia, `cpf`, `rg`, `data_nascimento`, `cur_tx_abreviatura`, `periodo_letivo`
                                   FROM `matricula_aluno_turma` JOIN `matricula_aluno` ON `matricula_aluno`.`matricula_aluno_id` = `matricula_aluno_turma`.`matricula_aluno_id`
                                   JOIN `cadastro_aluno` ON `cadastro_aluno`.`cadastro_aluno_id` = `matricula_aluno`.`cadastro_aluno_id`
                                   JOIN dados_censo_aluno ON dados_censo_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id                                   
                                   JOIN `turma` ON `turma`.`turma_id` = `matricula_aluno_turma`.`turma_id` 
                                   JOIN turno ON turma.turno_id = turno.turno_id
                                   JOIN `periodo_letivo`
                                   ON `periodo_letivo`.`periodo_letivo_id` = `matricula_aluno_turma`.`periodo_letivo_id` JOIN `cursos` ON `cursos`.`cursos_id` = `matricula_aluno`.`curso_id`
                                   WHERE matricula_aluno_turma.status is null AND turma.turma_id = $turma_id AND situacao_aluno_turma = 2 AND matricula_aluno.bolsista = 0 and forma_ingresso <> 5 order by situacao_aluno_turma ASC) AS conteudo GROUP BY registro_academico ORDER BY nome ");
        return $query->result_array();
    }

    public function AnoingressoImpo($matricula_aluno) {
        $query = $this->db->query("SELECT min(matricula_aluno_turma_id),ano, semestre from matricula_aluno_turma where matricula_aluno_id = $matricula_aluno");
        return $query->row_array();
    }

    public function SelectBolsaImportacao($turma_id) {

        $query = $this->db->query("SELECT * FROM bolsa_aluno
                                    INNER JOIN bolsa_periodo ON
                                    bolsa_aluno.bolsa_periodo_id = bolsa_periodo.bolsa_periodo_id
                                    WHERE matricula_aluno_turma_id = $turma_id");

        return $query->row_array();
    }

    public function GraficoTurma($semestreP, $semestreS) {

        $this->db->select("COUNT(*) as qtd, cur_tx_descricao");
        $this->db->from('matricula_aluno');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->where("semestre_ano_ingresso = '$semestreP' OR semestre_ano_ingresso = '$semestreS'");
        $this->db->group_by('cur_tx_descricao');
        $query = $this->db->get();
        return $query->result_array();
    }

}
