<?php
class Declaracao_model extends CI_Model {

    public function __construct()
    {
      $this->load->database();
    }

    public function get_Declaracao($matricula){

      $campos = 'cadastro_aluno.nome as nomealuno, cadastro_aluno.cpf, cadastro_aluno.rg as rg,cursos.cur_tx_descricao as curso_descricao, matricula_aluno.turno,
      matricula_aluno.registro_academico, matricula_aluno.periodo_atual as per_atual,periodo.periodo as periodo,turno.descricao as turno';

      $this->db->select($campos);
      $this->db->from('cadastro_aluno');
      $this->db->join('matricula_aluno','cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
      $this->db->join('cursos','matricula_aluno.curso_id = cursos.cursos_id');
      $this->db->join('matricula_aluno_turma','matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
      $this->db->join('turma','matricula_aluno_turma.turma_id = turma.turma_id');
      $this->db->join('periodo','turma.periodo_id = periodo.periodo_id');
      $this->db->join('turno','turma.turno_id = turno.turno_id');
      $this->db->where('matricula_aluno.registro_academico', $matricula);
      $this->db->where('matricula_aluno.situacao', 2);
      $query = $this->db->get();

      return $query->row_array();
    }
    public function get_Periodo(){

      $this->db->from('periodo_letivo');
      $this->db->where('atual',1);
      $query = $this->db->get();

      return $query->row_array();
    }
    public function get_Inst(){

      $this->db->from('instituicao');
      $query = $this->db->get();

      return $query->row_array();
    }
}
