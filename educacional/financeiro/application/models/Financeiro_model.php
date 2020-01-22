<?php

/**
 * Description of Agape_model
 *
 * @author karol Oliveira
 */
class Financeiro_model extends CI_Model {

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
        $this->db->order_by($table . "." . $order, "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTableRow($table, $order = null, $where = null, $value = null, $join = null) {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->order_by($table . "." . $order, "ASC");

        if ($join) {
            $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");
        }
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

    public function getJoin($table, $join, $order, $where = null, $value = null) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $join . "." . $join . "_id =" . $table . "." . $join . "_id");
        $this->db->order_by($table . "." . $order, "desc");

        if ($where) {
            $this->db->where($where, $value);
        }


        $query = $this->db->get();
        return $query->result_array();
    }

    public function getUpdate($table, $id) {

        $query = $this->db->get_where($table, array($table . "_id" => $id));
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

    public function DeleteWhere($table, $where, $id) {

        $this->db->where($where, $id);
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

    public function GetWhere($table, $where, $value) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $value);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function GetWhereArray($table, $where, $value) {

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $value);
        $query = $this->db->get();
        return $query->result_array();
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

    public function GetPesquisaAlunos($curso = null, $turma = null, $nome = null, $periodo = null) {

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

        $query = $this->db->query("SELECT * FROM (SELECT distinct(registro_academico), `matricula_aluno`.`matricula_aluno_id` as `matricula`,desperiodizado, periodo_atual, `situacao_aluno_turma`, `nome`, `cpf`, `rg`, `data_nascimento`, `cur_tx_abreviatura`, `periodo_letivo`
                                 FROM `matricula_aluno_turma` JOIN `matricula_aluno` ON `matricula_aluno`.`matricula_aluno_id` = `matricula_aluno_turma`.`matricula_aluno_id`
                                 JOIN `cadastro_aluno` ON `cadastro_aluno`.`cadastro_aluno_id` = `matricula_aluno`.`cadastro_aluno_id`
                                 JOIN `turma` ON `turma`.`turma_id` = `matricula_aluno_turma`.`turma_id` JOIN `periodo_letivo`
                                 ON `periodo_letivo`.`periodo_letivo_id` = `matricula_aluno_turma`.`periodo_letivo_id` JOIN `cursos` ON `cursos`.`cursos_id` = `matricula_aluno`.`curso_id` 
                                 WHERE matricula_aluno_turma.status is null $wherecurso $whereturma $wherenome $whereperiodo order by situacao_aluno_turma ASC) AS conteudo GROUP BY registro_academico ORDER BY nome LIMIT 100");
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

    public function PeriodCoursedRow($matricula, $matricula_turma_id) {
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
        $this->db->where('matricula_aluno_turma_id', $matricula_turma_id);
        $this->db->order_by('matricula_aluno_turma_id', "desc");
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

    public function MensalidadesCarne($matricula_aluno_turma) {

        $this->db->select("*");
        $this->db->from('mensalidade');
        $this->db->where('matricula_aluno_turma_id', $matricula_aluno_turma);
        $this->db->where('men_nb_numero_parcela >=1');
        $this->db->where('produto_id >=2');
        $query = $this->db->get();
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

    public function DadosAlunoCarne($matricula_aluno, $matricula_aluno_turma) {

        $this->db->select("max(matricula_aluno_turma_id) as mat_max, cur_tx_abreviatura, periodo, desperiodizado, matricula_aluno_turma.semestre, matricula_aluno_turma.ano, nome,registro_academico, cur_tx_descricao, periodo_atual as periodo_id,periodo_letivo");
        $this->db->from('matricula_aluno');
        $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_id = matricula_aluno.matricula_aluno_id');
        $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
        $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id', 'left');
        $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $this->db->where("matricula_aluno.matricula_aluno_id", $matricula_aluno);
        $this->db->where("matricula_aluno_turma_id", $matricula_aluno_turma);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function HistoricoPagamentos($matricula_aluno) {

        $query = $this->db->query("SELECT `mat`.`matricula_aluno_turma_id` as `matricula_aluno_turma_id`, data_entrada, `mensalidade_id`, `t`.`turma_id`, `t`.`ano` as `ano`, `t`.`semestre` as `semestre`, `mat`.`periodo`
as `periodo_mat`, `mat`.`dependencia` as `dependencia`, `mat`.`situacao_aluno_turma` as `situacao_aluno_turma`, `mensalidade_id`, `men_dt_vencto`, `mf_dt_pgto`,
`men_nb_numero_parcela`, `total_parcela`, `men_nb_status` as `status_mensalidade`, `men_fl_valor`, `men_tx_mes`, `men_tx_obs`, `p`.`produto_id` as
`produto_id`, `p`.`nome` as `produto`, `referencia`, `mf_nb_forma_pagamento`, `men`.`periodo_letivo_id`, CONCAT(t.ano, '/', t.semestre)
AS periodo_letivo_turma, `obs`, `mf_db_valor`, `mf_db_desconto`, `mf_db_juros`, `multa`, `bolsa`, `valor_total`, `mf_nb_codigo`, `financiamento`
 FROM `matricula_aluno_turma` `mat` JOIN `mensalidade` `men` ON `men`.`matricula_aluno_turma_id` = `mat`.`matricula_aluno_turma_id`
 LEFT JOIN `movimento_financeiro` `mf` ON `mf`.`mensalidades_id` = `men`.`mensalidade_id` LEFT JOIN `produto` `p` ON `p`.`produto_id` = `men`.`produto_id` JOIN `turma` `t`
 ON `t`.`turma_id` = `mat`.`turma_id` WHERE `mat`.`matricula_aluno_id` = '$matricula_aluno'
 ORDER BY `periodo_letivo_id` DESC, `men_nb_numero_parcela` ASC, `total_parcela` ASC, `mensalidade_id` DESC");
        return $query->result_array();
    }

    public function ReciboPagamento($matricula_aluno_turma, $mensalidade, $movimentoFinan) {

        $this->db->select("*, MONTH(men_dt_vencto) as mes, year (men_dt_vencto) as ano");
        $this->db->from('mensalidade m');
        $this->db->join('produto p', 'p.produto_id = m.produto_id', 'left');
        $this->db->join('movimento_financeiro mf', 'mf.mensalidades_id = m.mensalidade_id');
        $this->db->where("matricula_aluno_turma_id = $matricula_aluno_turma");
        $this->db->where("mensalidade_id = $mensalidade");
        $this->db->where("mf_nb_codigo = $movimentoFinan");
        $query = $this->db->get();
        return $query->row_array();
    }

    public function GetDespesa() {

        $query = $this->db->query(" SELECT cpr.conta_pagar_receber_id as cpr_codigo,
                                    for_tx_razao_social as fornecedor,
                                    cpr_nb_numero_parcela as num_parcela, cpr_tx_num_orcamento as num_orcamento,
                                    cpr_nb_qtde_parcela as total_parcela, cpr_tx_num_documento as num_documento,
                                    cpr_tx_historico as historico,
                                    mf_db_valor_sem_imposto as  valor_sem_imposto,
                                    cat_tx_descricao as categoria, mf_tx_comprovante as comprovante,
                                    MONTH(cpr_dt_vencimento)  as mes,
                                    year (cpr_dt_vencimento) as ano,
                                    cpr_dt_vencimento as data_vencto, mf_nb_forma_pagamento as forma_pgto, cpr.cpr_db_valor as valor,
                                    cpr.for_nb_codigo as fornecedor_codigo, cpr.cpr_nb_status as cpr_status
                                    FROM conta_pagar_receber cpr
                                    inner join fornecedor f on f.fornecedor_id = cpr.for_nb_codigo
                                    inner join categoria c on c.categoria_id = cpr.cat_nb_codigo
                                    left join movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id
                                    where cpr_nb_tipo = 2   ORDER BY cpr_dt_vencimento,num_parcela  ASC");

        return $query->result_array();
    }

    public function GetContasReceber() {

        $query = $this->db->query("SELECT cpr.conta_pagar_receber_id as cpr_codigo, cpr_nb_numero_parcela as num_parcela,cpr.cliente as cliente,
                                    cpr_tx_num_orcamento as num_orcamento, cpr_nb_qtde_parcela as total_parcela, cpr_tx_num_documento as num_documento,
                                    cpr_tx_historico as historico, mf_db_valor_sem_imposto as valor_sem_imposto, cat_tx_descricao as categoria,
                                    mf_tx_comprovante as comprovante, cpr_dt_vencimento as data_vencto, MONTH(cpr_dt_vencimento) as mes, year (cpr_dt_vencimento) as ano,
                                    mf_nb_forma_pagamento as forma_pgto, cpr.cpr_db_valor as valor, cpr.for_nb_codigo as fornecedor_codigo, cpr.cpr_nb_status as cpr_status

                                    FROM conta_pagar_receber cpr

                                    inner join categoria c on c.categoria_id = cpr.cat_nb_codigo
                                    left join movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id
                                    where cpr_nb_tipo = 1
                                    ORDER BY cpr_dt_vencimento DESC");


        return $query->result_array();
    }

    public function RelatorioPagAlunos($datainicio, $datafim) {


        $query = $this->db->query("SELECT ca.nome as nome, t.tur_tx_descricao as turma, c.cur_tx_abreviatura as curso,mf_db_valor,mf_dt_pgto, data_entrada,
                                    p.produto_id as produto_id, p.nome as produto, referencia,
                                    mf_nb_forma_pagamento,
                                    men.periodo_letivo_id,  CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma, mensalidade_id
                                    FROM matricula_aluno_turma mat
                                    inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
                                    inner join cursos c on c.cursos_id = ma.curso_id
                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                                    inner join mensalidade men on men.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                                    inner join movimento_financeiro mf on mf.mensalidades_id = men.mensalidade_id
                                    left join produto p on p.produto_id = men.produto_id
                                    inner join turma t on t.turma_id = mat.turma_id
                                    where  mf_dt_pgto between '$datainicio' and '$datafim'
                                    order by mf_dt_pgto, periodo_letivo_id desc, men_nb_numero_parcela, total_parcela asc,mensalidade_id desc");

        return $query->result_array();
    }

    public function RelatorioPagAlunosTotal($datainicio, $datafim) {


        $query = $this->db->query("SELECT  SUM(mf_db_valor) as valor, ca.nome as nome, t.tur_tx_descricao as turma, c.cur_tx_abreviatura as curso,mf_db_valor,mf_dt_pgto,
                                    p.produto_id as produto_id, p.nome as produto, referencia,
                                    mf_nb_forma_pagamento,
                                    men.periodo_letivo_id,  CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma
                                    FROM matricula_aluno_turma mat
                                    inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
                                    inner join cursos c on c.cursos_id = ma.curso_id
                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                                    inner join mensalidade men on men.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                                    inner join movimento_financeiro mf on mf.mensalidades_id = men.mensalidade_id
                                    left join produto p on p.produto_id = men.produto_id
                                    inner join turma t on t.turma_id = mat.turma_id
                                    where  mf_dt_pgto between '$datainicio' and '$datafim'
                                    order by periodo_letivo_id desc, men_nb_numero_parcela, total_parcela asc,mensalidade_id desc");

        return $query->row_array();
    }

    public function RelatorioAdimplentes($mes, $ano) {
        $query = $this->db->query("SELECT * FROM mensalidade
                                    INNER JOIN movimento_financeiro ON mensalidade.mensalidade_id = movimento_financeiro.mensalidades_id
                                    INNER JOIN matricula_aluno_turma ON  matricula_aluno_turma.matricula_aluno_turma_id = mensalidade.matricula_aluno_turma_id
                                    INNER JOIN matricula_aluno ON matricula_aluno.matricula_aluno_id = mensalidade.matricula_aluno_id
                                    INNER JOIN cadastro_aluno ON cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id
                                    INNER JOIN turma ON turma.turma_id = matricula_aluno_turma.turma_id
                                    INNER JOIN cursos ON cursos.cursos_id = turma.curso_id
                                    WHERE men_dt_vencto = '$ano-$mes-07' GROUP BY mensalidades_id ORDER BY nome");
        return $query->result_array();
    }

    public function RelatorioInadimplentes($mes, $ano) {

        $query = $this->db->query("SELECT * FROM mensalidade
                                  INNER JOIN matricula_aluno_turma ON  matricula_aluno_turma.matricula_aluno_turma_id = mensalidade.matricula_aluno_turma_id
                                  INNER JOIN matricula_aluno ON matricula_aluno.matricula_aluno_id = mensalidade.matricula_aluno_id
                                  INNER JOIN cadastro_aluno ON cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id
                                  INNER JOIN turma ON turma.turma_id = matricula_aluno_turma.turma_id
                                  INNER JOIN cursos ON cursos.cursos_id = turma.curso_id

                                  WHERE NOT EXISTS (SELECT * FROM movimento_financeiro
                                  WHERE mensalidade.mensalidade_id = movimento_financeiro.mensalidades_id)
                                  AND men_dt_vencto = '$ano-$mes-07'");
        return $query->result_array();
    }

    public function RelContasPagar($datainicio, $datafim, $tipo, $join = null, $join2 = null) {

        if ($join) {

            $join = "INNER JOIN fornecedor ON conta_pagar_receber.for_nb_codigo = fornecedor.fornecedor_id";
        }

        if ($join2) {

            $join2 = "INNER JOIN categoria ON categoria.categoria_id = conta_pagar_receber.cat_nb_codigo";
        }

        $query = $this->db->query("SELECT * FROM conta_pagar_receber $join $join2
                                   WHERE cpr_dt_vencimento between '$datainicio' and '$datafim'  and cpr_nb_tipo = $tipo ORDER BY cpr_dt_vencimento");

        return $query->result_array();
    }

    public function RelContasPagarTotal($datainicio, $datafim, $tipo) {

        $query = $this->db->query("SELECT SUM(cpr_db_valor) as valor FROM conta_pagar_receber 
                                   WHERE cpr_dt_vencimento between '$datainicio' and '$datafim'  and cpr_nb_tipo = $tipo");

        return $query->row_array();
    }

    public function RelContasTotalOutros($datainicio, $datafim) {

        $query = $this->db->query("SELECT SUM(valor_pago) as total FROM outros_pagamentos WHERE data_pagamento between '$datainicio' and '$datafim'");
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

    public function RelatorioOutros($datainicio, $datafim, $tipo_pagamento = null) {

        $this->db->select("*");
        $this->db->from('outros_pagamentos');
        $this->db->join('produto', 'produto.produto_id = outros_pagamentos.produto_id');
        $this->db->where("data_pagamento BETWEEN '$datainicio' AND '$datafim'");

        if ($tipo_pagamento) {
            $this->db->where('forma_pagamento', $tipo_pagamento);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPeriodoUltimoTurma($matricula_aluno_id) {

        $this->db->select("situacao_aluno_turma");
        $this->db->from('matricula_aluno_turma');
        $this->db->where('matricula_aluno_id', $matricula_aluno_id);
        $this->db->where('status is null');
        $this->db->order_by('matricula_aluno_turma_id', "desc");
        $this->db->limit(0, 1);
        $query = $this->db->get();
        return $query->row_array();
    }

}
