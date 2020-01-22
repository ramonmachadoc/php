<?php
class Matriz_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  public function get_Matriz($matricula,$disciplinas,$descricao){

    $campos = "cursos.cur_tx_descricao as curdesc,matriz_disciplina.periodo as disper, disciplina.disc_tx_descricao as disdesc, matriz_disciplina.carga_horaria as discarhor";

    $campos = $campos.', matriz.mat_nb_total_hora as cargahr';


    $this->db->select($campos);
    $this->db->from('matricula_aluno');
    $this->db->join('matriz','matricula_aluno.matriz_id = matriz.matriz_id');
    $this->db->join('cursos','matriz.cursos_id = cursos.cursos_id');
    $this->db->join('matriz_disciplina','matriz.matriz_id = matriz_disciplina.matriz_id');
    $this->db->join('disciplina','matriz_disciplina.disciplina_id = disciplina.disciplina_id');
    $this->db->where('matricula_aluno.registro_academico',$matricula);

    if(sizeof($disciplinas) > 0 && sizeof($descricao) > 0){
      for($n = 0; $n < sizeof($disciplinas);$n++){
        $this->db->where('disciplina.disciplina_id <>',$disciplinas[$n]);
      }
      for($n = 0; $n < sizeof($descricao);$n++){
        $this->db->where('disciplina.disc_tx_descricao <>',$descricao[$n]);
      }
    }

    $this->db->order_by('matriz_disciplina.periodo');

    $query = $this->db->get();

    return $query->result_array();
  }
  public function get_Matriz_Cur($matricula){

    $this->db->select('cursos.cur_tx_descricao');
    $this->db->from('matricula_aluno');
    $this->db->join('matriz','matricula_aluno.matriz_id = matriz.matriz_id');
    $this->db->join('cursos','matricula_aluno.curso_id = cursos.cursos_id');
    $this->db->where('matricula_aluno.registro_academico',$matricula);

    $query = $this->db->get();

    return $query->row_array();
  }
}
