<?php

class Departamento_model extends CI_Model{

  public function __construct()
  {
    $this->load->database();
  }
  public function getResponsavel()
  {
    $campos = "usuarios_id,usu_tx_login,nome";
    $where = " concat('',usu_tx_login * 1) = 0 and usu_nb_status = 1";

    $this->db->select($campos);
    $this->db->from('usuarios');
    $this->db->where($where);

    $query = $this->db->get();

    return $query->result_array();
  }
  public function getDepartamentos(){

    $this->db->from('departamento');
    $this->db->join('usuarios','departamento.responsavel_id = usuarios.usuarios_id');

    $query = $this->db->get();

    return $query->result_array();
  }
}
