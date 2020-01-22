<?php

/**
 * Description of Professor_model
 *
 * @author karol Oliveira
 */
class Aluno_model extends CI_Model {

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

    public function CountTable($table, $where = null, $value = null) {
        $this->db->from($table);
        if ($where) {
            $this->db->where($where, $value);
        }
        return $this->db->count_all_results();
    }

    public function getTable($table, $order = null) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->order_by($table . "." . $order, "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTableRow($table, $order = null, $where = null, $value = null) {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->order_by($table . "." . $order, "ASC");

        if ($where) {
            $this->db->where($where, $value);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function Mensalidade($mensalidae_id) {

        $this->db->select("men_nb_status, nome");
        $this->db->from('mensalidade');
        $this->db->join('produto', 'produto.produto_id = mensalidade.produto_id');
        $this->db->where('mensalidade_id', $mensalidae_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getJoin($table, $join, $order) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");
        $this->db->order_by($table . "." . $order, "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getJoinLike($select, $table, $join, $order, $where = null, $value = null, $value2 = null, $group = null, $maximo, $inicio) {

        $this->db->select("$select");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");


        if ($group) {
            $this->db->group_by("$group");
        }

        $this->db->order_by($order, "asc");

        if ($where) {
            $this->db->like($where, $value);
        }

        if ($value2) {
            $this->db->or_where('livro_id', $value2);
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
            $this->db->like($where, $value);
        }

        return $this->db->count_all_results();
    }

    public function getUpdate($table, $id) {

        $query = $this->db->get_where($table, array($table . "_id" => $id));
        return $query->row_array();
    }

    public function UpdateChamada($dados, $table, $where, $id) {

        $this->db->where($where, $id);
        $this->db->update($table, $dados);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
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

    public function deleteAlbum($table, $album_id) {

        $this->db->where("album_id", $album_id);
        $this->db->delete($table);
    }

    public function GetWhere($table, $where, $value, $where2 = null, $value2 = null) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $value);

        if ($where2) {
            $this->db->where($where2, $value2);
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

    public function isVarExists($table, $value, $NameField) {
        $this->db->from($table);
        $this->db->where($NameField, $value);
        return $this->db->count_all_results();
    }

    public function getPeriodoLetivo($curso_id) {

        $this->db->select("periodo_letivo.periodo_letivo_id, periodo_letivo.periodo_letivo, turma.turma_id as turma_id, turma.ano as ano, turma.semestre as semestre");
        $this->db->from('turma');
        $this->db->join('turno', 'turno.turno_id = turma.turno_id');
        $this->db->join('periodo_letivo ', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id', 'left');
        $this->db->where('turma.curso_id', $curso_id);
        $this->db->group_by('ano, semestre');
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

    public function GetPesquisaAlunos($curso = null, $turma = null, $nome = null) {

        $this->db->select("distinct(registro_academico), matricula_aluno.matricula_aluno_id as matricula,situacao_aluno_turma, nome, cpf, rg, data_nascimento,cur_tx_abreviatura");
        $this->db->from('matricula_aluno_turma');
        $this->db->join('matricula_aluno', 'matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
//        $this->db->where('cadastro_aluno.cadastro_aluno_id', "!= ''");


        if ($curso) {
            $this->db->where('cursos.cursos_id', $curso);
        }
        if ($turma) {
            $this->db->where('turma.turma_id', $turma);
        }
        if ($nome) {
            $this->db->like('cadastro_aluno.nome', $nome);
        }

        $this->db->limit(10, 0);
        $query = $this->db->get();
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

    public function PeriodCoursed($matricula, $pl) {

        $this->db->select("mat.matricula_aluno_turma_id as matricula_aluno_turma_id, turma.turma_id, mat.situacao_aluno_turma, turma.ano as ano, turma.semestre as semestre,
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

    public function PegaPeriodoLetivo($matricula_aluno_turma) {

        $this->db->select("*");
        $this->db->from('matricula_aluno_turma mat');
        $this->db->join('periodo_letivo pl', 'pl.periodo_letivo_id = mat.periodo_letivo_id');
        $this->db->where('matricula_aluno_turma_id', $matricula_aluno_turma);
        $query = $this->db->get();
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

    public function InfoPlanoEnsino($pdtId) {

        $query = $this->db->query("SELECT pdt_nb_codigo, turma_id, professor_id, tur_tx_descricao,nome, cur_tx_descricao,disc_tx_descricao,disciplina.disciplina_id as disciplina_id,
                                  carga_horaria FROM professor_disciplina_turma
                                  INNER JOIN turma ON turma.turma_id = professor_disciplina_turma.tur_nb_codigo
                                  INNER JOIN disciplina ON disciplina.disciplina_id = professor_disciplina_turma.disc_nb_codigo
                                  INNER JOIN professor_curso ON professor_curso.pc_nb_codigo = professor_disciplina_turma.pc_nb_codigo
                                  INNER JOIN professor ON professor.professor_id = professor_curso.prof_nb_codigo
                                  INNER JOIN cursos ON cursos.cursos_id = professor_curso.cur_nb_codigo
                                  INNER JOIN matriz_disciplina ON matriz_disciplina.disciplina_id = disciplina.disciplina_id  WHERE pdt_nb_codigo = '$pdtId' ");

        return $query->row_array();
    }

    public function InfoPlanoDesc($pdtId) {

        $query = $this->db->query("SELECT *, pe.pe_nb_codigo as pe_nb_codigo FROM plano_ensino pe
                    left join avaliacao a on a.pe_nb_codigo = pe.pe_nb_codigo
                    inner join objetivos_especificos oe on oe.pe_nb_codigo = pe.pe_nb_codigo
                    inner join competencias_habilidades ch on ch.pe_nb_codigo = pe.pe_nb_codigo
                    where pe.pdt_nb_codigo  = '$pdtId' ");

        return $query->row_array();
    }

    public function InfoEmenta($disciplinaId) {

        $query = $this->db->query("SELECT * FROM ementa a "
                . "inner join referencias r on r.emet_nb_codigo = a.emet_nb_codigo"
                . " where a.disc_nb_codigo = '$disciplinaId'");

        return $query->row_array();
    }

    public function ConteudoAula($pe_nb_codigo) {

        $query = $this->db->query("  SELECT * FROM plano_ensino_conteudo pec inner join aulas a on a.aul_nb_codigo = pec.aul_nb_codigo
                                     where pe_nb_codigo = '$pe_nb_codigo'");

        return $query->result_array();
    }

    public function GetMatriculaTurma($matricula_id) {

        $query = $this->db->query("SELECT * FROM matricula_aluno_turma mat
                    inner join turma t on t.turma_id = mat.turma_id
                    inner join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
                    where matricula_aluno_id = $matricula_id  and mat.situacao_aluno_turma = 2 and (mat.status != '11' or mat.status is null)");
        return $query->result_array();
    }

    public function GetMinhasDisciplinas($mat_aluno_turma_id) {

        $query = $this->db->query("SELECT d.disc_tx_descricao as disciplina,d.disciplina_id, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da
                        left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
                        inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
                        inner join disciplina d on d.disciplina_id = md.disciplina_id
                        where matricula_aluno_turma_id = $mat_aluno_turma_id ");

        return $query->result_array();
    }

    public function nomeProfessor($turma_id, $disciplina_id) {


        $query = $this->db->query("SELECT `professor_id`, `nome`, `disc_tx_descricao`, `tur_tx_descricao`, `turma`.`ano` as ano,
                                   `turma`.`semestre` as semestre, `turno`.`descricao`, `cur_tx_abreviatura`, `periodo`, `mat_tx_ano`, `periodo_letivo`,
                                   `mat_tx_semestre`,`professor_curso`.`pc_nb_codigo` as prof_curso,`professor_disciplina_turma`.`pdt_nb_codigo` as pdt_id
                                   FROM (`professor`)
                                   JOIN `professor_curso` ON `professor_curso`.`prof_nb_codigo` = `professor`.`professor_id`
                                   JOIN `professor_disciplina_turma` ON `professor_disciplina_turma`.`pc_nb_codigo` = `professor_curso`.`pc_nb_codigo`
                                   JOIN `disciplina` ON `disciplina`.`disciplina_id` = `professor_disciplina_turma`.`disc_nb_codigo`
                                   JOIN `turma` ON `turma`.`turma_id` = `professor_disciplina_turma`.`tur_nb_codigo`
                                   JOIN `turno` ON `turno`.`turno_id` = `turma`.`turno_id`
                                   left JOIN `periodo_letivo` ON `periodo_letivo`.`periodo_letivo_id` = `turma`.`periodo_letivo_id`
                                   JOIN `cursos` ON `cursos`.`cursos_id` = `turma`.`curso_id`
                                   JOIN `matriz` ON `matriz`.`matriz_id` = `turma`.`matriz_id`
                                   JOIN `matriz_disciplina` ON `matriz_disciplina`.`disciplina_id` = `disciplina`.`disciplina_id`
                                   WHERE turma.status = 1 and periodo_letivo.atual = 1 and `turma`.turma_id = $turma_id and disciplina.disciplina_id = $disciplina_id");
        return $query->row_array();
    }

    public function NotasAluno($matricula_aluno_turma) {

        $query = $this->db->query("SELECT da.disciplina_aluno_id, d.disc_tx_descricao as disciplina,d.disciplina_id, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim
                                as 2bim, dan_fl_nota_3bim as 3bim, dan_fl_media_final as media, dan_nb_total_falta as falta, dan_nb_situacao_final as situacao, dan_nb_falta_1bim as falta1, dan_nb_falta_2bim as falta2, carga_horaria
                                FROM disciplina_aluno da left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id inner join matriz_disciplina md on
                                md.matriz_disciplina_id = da.matriz_disciplina_id
                                inner join disciplina d on d.disciplina_id = md.disciplina_id where matricula_aluno_turma_id = $matricula_aluno_turma");

        return $query->result_array();
    }

    public function QtdChamada($da_nb_codigo, $where2 = null, $value2 = null, $where3 = null, $value3 = null) {

        $this->db->select("*");
        $this->db->from('chamada');
        $this->db->where("da_nb_codigo", $da_nb_codigo);
        if ($where2) {
            $this->db->where($where2, $value2);
        }
        if ($where3) {
            $this->db->where($where3, $value3);
        }

        return $this->db->count_all_results();
    }

    public function DadosAluno($registro) {

        $query = $this->db->query("SELECT registro_academico, nome, cur_tx_descricao FROM matricula_aluno
                                   INNER JOIN cadastro_aluno ON matricula_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id
                                   INNER JOIN cursos ON cursos.cursos_id = matricula_aluno.curso_id
                                   WHERE registro_academico = $registro");
        return $query->row_array();
    }

    public function HistoricoPagamentos($matricula_aluno) {

        $this->db->select("mat.matricula_aluno_turma_id as matricula_aluno_turma_id, mensalidade_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                             mat.periodo as periodo_mat,  mat.dependencia as dependencia,
                                                             mat.situacao_aluno_turma as situacao_aluno_turma,mensalidade_id,men_dt_vencto,mf_dt_pgto,men_nb_numero_parcela,total_parcela,
                                                             men_nb_status as status_mensalidade, men_fl_valor,men_tx_mes, men_tx_obs, p.produto_id as produto_id, p.nome as produto, referencia,
                                                             mf_nb_forma_pagamento, men.periodo_letivo_id,  CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma, obs,mf_db_valor,mf_db_desconto,
                                                             mf_db_juros,multa,bolsa,valor_total,mf_nb_codigo,financiamento");
        $this->db->from('matricula_aluno_turma mat');
        $this->db->join('mensalidade men', 'men.matricula_aluno_turma_id = mat.matricula_aluno_turma_id');
        $this->db->join('movimento_financeiro mf', 'mf.mensalidades_id = men.mensalidade_id', 'left');
        $this->db->join('produto p', 'p.produto_id = men.produto_id', 'left');
        $this->db->join('turma t', 't.turma_id = mat.turma_id');
        $this->db->where("mat.matricula_aluno_id", $matricula_aluno);
        $this->db->order_by('periodo_letivo_id', "desc");
        $this->db->order_by('men_nb_numero_parcela', "asc");
        $this->db->order_by('total_parcela', "asc");
        $this->db->order_by('mensalidade_id', "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function cpa($questionario_id, $dimensao) {
        $this->db->select('*');
        $this->db->from('fbnov509_cpa.pergunta');
        $this->db->where('questionario_id', $questionario_id);
        $this->db->where("dimensao", $dimensao);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function opcoesPergunta($pergunta_id) {
        $this->db->select('*');
        $this->db->from('fbnov509_cpa.opcoes');
        $this->db->where('pergunta_id', $pergunta_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetTurmasCpa($matricula_id) {

        $query = $this->db->query("SELECT * FROM matricula_aluno_turma mat
                    inner join turma t on t.turma_id = mat.turma_id
                    inner join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
                    where matricula_aluno_id = $matricula_id  and mat.situacao_aluno_turma = 2 and (mat.status != '11' or mat.status is null) AND periodo_letivo = '2017/2'");
        return $query->row_array();
    }

    public function disciplinasCpa($mat_aluno_turma_id, $limit) {

        $query = $this->db->query("SELECT d.disc_tx_descricao as disciplina,d.disciplina_id, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da

                        left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id

                        inner join disciplina d on d.disciplina_id = da.disciplina_id

                        where matricula_aluno_turma_id = $mat_aluno_turma_id

                        union

                        SELECT d.disc_tx_descricao as disciplina,d.disciplina_id, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da

                        left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id

                        inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id

                        inner join disciplina d on d.disciplina_id = md.disciplina_id

                        where matricula_aluno_turma_id = $mat_aluno_turma_id");

        return $query->result_array();
    }

    public function GetCountDisciplinaCpa($matricula_id, $disciplina_id, $professor_id) {

        $query = $this->db->query("SELECT COUNT(*) as count FROM fbnov509_cpa.status_questionario WHERE matricula_id = $matricula_id AND disciplina_id = $disciplina_id AND professor_disciplina_id = $professor_id");
        return $query->row_array();
    }

}
