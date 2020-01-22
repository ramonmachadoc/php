<?php

class Chamado_model extends CI_Model{

  public function __construct()
  {
    $this->load->database();
  }
  public function getServicos(){

    $this->db->from('servicos');

    $query = $this->db->get();

    return $query->result_array();
  }
  public function getChamados($usuario = ''){

    $this->db->from('chamados');
    $this->db->join('servicos','chamados.servicos_id = servicos.servicos_id');
    $this->db->join('departamento','servicos.departamento_id = departamento.departamento_id');
    $this->db->where('chamados.chamados_status !=',2);

    if(!empty($usuario)){
      $this->db->where('departamento.responsavel_id',$usuario);
    }else{
      $this->db->where('departamento.responsavel_id',0);
    }
    $query = $this->db->get();

    return $query->result_array();
  }
  public function getInteracoesChamados($chamado){

    $this->db->from('chamados_interacao');
    $this->db->join('chamados','chamados_interacao.chamados_id = chamados.chamados_id');
    $this->db->join('servicos','chamados.servicos_id = servicos.servicos_id');
    $this->db->join('departamento','servicos.departamento_id = departamento.departamento_id');
    $this->db->join('usuarios','chamados_interacao.responsavel_id = usuarios.usuarios_id');
    $this->db->where('chamados_interacao.chamados_id',$chamado);

    $query = $this->db->get();

    return $query->result_array();
  }
  public function getInteracoesResp($responsavel){

    $query = $this->db->query("select *
                                    from chamados cha
                                    inner join chamados_interacao ite on cha.chamados_id = ite.chamados_id
                                    inner join usuarios usu on ite.solicitante_id = usu.usuarios_id
                                    where ite.responsavel_id = $responsavel
                                    and ite.chamados_interacao_id = (select iteaux.chamados_interacao_id
                                    from chamados_interacao iteaux
                                    where iteaux.chamados_id = cha.chamados_id
                                    order by iteaux.chamados_interacao_id desc limit 1)");



    return $query->result_array();
  }
}
