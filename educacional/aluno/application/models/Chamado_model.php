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
  public function getChamados($usuario){

    $query = $this->db->query("select *
                                    from chamados cha
                                    left outer join chamados_interacao ite on cha.chamados_id = ite.chamados_id
                                    inner join usuarios usu on ite.solicitante_id = usu.usuarios_id
                                    inner join servicos ser on cha.servicos_id = ser.servicos_id
                                    inner join departamento dep on ser.departamento_id = dep.departamento_id
                                    where cha.solicitante_id = $usuario
                                    and ite.chamados_interacao_id = (select iteaux.chamados_interacao_id
                                    from chamados_interacao iteaux
                                    where iteaux.chamados_id = cha.chamados_id
                                    order by iteaux.chamados_interacao_id desc limit 1)");

    return $query->result_array();
  }
  public function getChamadosInt($chamado){

    $this->db->from('chamados');
    $this->db->join('chamados_interacao','chamados.chamados_id = chamados_interacao.chamados_id');
    $this->db->join('servicos','chamados.servicos_id =  servicos.servicos_id');
    $this->db->join('departamento','servicos.departamento_id = departamento.departamento_id');
    $this->db->join('usuarios','departamento.responsavel_id = usuarios.usuarios_id');

    $this->db->where('chamados.chamados_id',$chamado);
    $this->db->order_by('chamados_interacao_id','DESC');
    $this->db->limit(1);

    $query = $this->db->get();

    return $query->row_array();
  }
}
