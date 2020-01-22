<?php
class Historico_model extends CI_Model {

    public function __construct()
    {
      $this->load->database();
    }

    public function get_Historico($matricula){

      $campos = 'cadastro_aluno.nome as nomealuno,cadastro_aluno.data_nascimento as dtnasc,municipio.nome as municipio,nacionalidade as nacionalidade, uf.nome as nomeuf';

      $campos = $campos.', cadastro_aluno.rg as rgaluno,cadastro_aluno.rg_orgao_expeditor as rgexped, municipio.nome as rguf, cadastro_aluno.cert_reservista as certres';
      $campos = $campos.',cur_tx_descricao as curdesc';
        $campos = $campos.', cursos.cur_tx_coordenador as coord,turma.periodo_id as peratu,cursos.cur_tx_duracao as curdur';
//, candidato.can_tx_orgaoRg as orgao,candidato.can_tx_titulo as titulo, candidato.can_tx_uf_titulo as tituf
      $this->db->select($campos);
      $this->db->from('matricula_aluno');
      $this->db->join('cadastro_aluno','matricula_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id');
      $this->db->join('municipio','cadastro_aluno.municipio_nascimento = municipio.codigo');
      $this->db->join('uf','municipio.codigo_uf = uf.codigo');
      $this->db->join('matricula_aluno_turma','matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
      $this->db->join('turma','matricula_aluno_turma.turma_id = turma.turma_id');
      $this->db->join('cursos','matricula_aluno.curso_id = cursos.cursos_id');
      //$this->db->join('candidato','cadastro_aluno.candidato_id = candidato.candidato_id','left');
      $this->db->where('matricula_aluno.matricula_aluno_id',$matricula);
      $query = $this->db->get();

      return $query->row_array();
    }
    public function get_Historico_Disc($matricula){

      $campos = '(disciplina_aluno_nota.dan_fl_nota_3bim + disciplina_aluno_nota.dan_fl_nota_2bim + disciplina_aluno_nota.dan_fl_nota_1bim)/3 as mediafinal';
      $campos = $campos.(',disciplina.disc_tx_descricao as disctex, disciplina_aluno_nota.dan_nb_situacao_final as situacao');
      $campos = $campos.(',matricula_aluno_turma.data_turma as discano, matriz_disciplina.periodo as discsem, matriz_disciplina.carga_horaria as chor');
      $campos = $campos.(',matricula_aluno.situacao as situa');

      $this->db->select($campos);
      $this->db->from('disciplina_aluno_nota');
      $this->db->from('disciplina_aluno_nota');
      $this->db->join('disciplina_aluno','disciplina_aluno_nota.disciplina_aluno_id = disciplina_aluno.disciplina_aluno_id');
      $this->db->join('matricula_aluno_turma','disciplina_aluno.matricula_aluno_turma_id = matricula_aluno_turma.matricula_aluno_turma_id');
      $this->db->join('matricula_aluno','matricula_aluno_turma.matricula_aluno_id = matricula_aluno.matricula_aluno_id');
      $this->db->join('matriz','matricula_aluno.matriz_id = matriz.matriz_id');
      $this->db->join('matriz_disciplina','disciplina_aluno.matriz_disciplina_id = matriz_disciplina.matriz_disciplina_id');
      $this->db->join('turma','matricula_aluno_turma.turma_id = turma.turma_id');
      $this->db->join('disciplina',' matriz_disciplina.disciplina_id = disciplina.disciplina_id');
      $this->db->where('matricula_aluno.matricula_aluno_id',$matricula);
      $this->db->order_by('matricula_aluno_turma.data_turma');
      $query = $this->db->get();
/*
SELECT dan_fl_nota_3bim as b3,dan_fl_nota_2bim as b2,dan_fl_nota_1bim as b1,dn.disciplina_aluno_nota_id,da.disciplina_aluno_id,mat.matricula_aluno_turma_id,
ma.matricula_aluno_id,m.matriz_id,md.matriz_disciplina_id
FROM disciplina_aluno_nota as dn
inner join
disciplina_aluno as da
on dn.disciplina_aluno_id = da.disciplina_aluno_id
inner join
matricula_aluno_turma as mat
on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
inner join
matricula_aluno as ma
on mat.matricula_aluno_id = ma.matricula_aluno_id
inner join
matriz m
on ma.matriz_id=m.matriz_id
inner join
matriz_disciplina md
on m.matriz_id = md.matriz_id
where
ma.matricula_aluno_id=5423
*/
      return $query->result_array();
    }
    public function get_Periodo(){

      $this->db->from('periodo_letivo');
      $this->db->where('atual',1);
      $query = $this->db->get();

      return $query->row_array();
    }
}
