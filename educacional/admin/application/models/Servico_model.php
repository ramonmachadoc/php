<?php

class Servico_model extends CI_Model{

  public function __construct()
  {
    $this->load->database();
  }
  public function getServico(){

    $this->db->from('servicos');
    $this->db->join('departamento','servicos.departamento_id = departamento.departamento_id');

    $query = $this->db->get();

    return $query->result_array();
  }
}
