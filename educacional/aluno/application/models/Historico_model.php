<?php
class Historico_model extends CI_Model {

    public function __construct()
    {
      $this->load->database();
    }

    public function get_Historico($matricula){

      $campos = 'cadastro_aluno.nome as nomealuno,cadastro_aluno.data_nascimento as dtnasc,municipio.nome as municipio,nacionalidade as nacionalidade, uf.nome as nomeuf';

      $campos = $campos.', cadastro_aluno.rg as rgaluno,cadastro_aluno.rg_orgao_expeditor as rgexped, cadastro_aluno.rg_uf as rguf, cadastro_aluno.cert_reservista as certres';
      $campos = $campos.',cur_tx_descricao as curdesc';
      $campos = $campos.', cursos.cur_tx_coordenador as coord,turma.periodo_id as peratu,cursos.cur_tx_duracao as curdur,matricula_aluno.matricula_aluno_id as matricula';
      $campos = $campos.',matricula_aluno_turma.periodo_letivo_id as periodoatual';

      $this->db->select($campos);
      $this->db->from('matricula_aluno');
      $this->db->join('cadastro_aluno','matricula_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id');
      $this->db->join('municipio','cadastro_aluno.municipio_nascimento = municipio.codigo');
      $this->db->join('uf','municipio.codigo_uf = uf.codigo');
      $this->db->join('matricula_aluno_turma','matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
      $this->db->join('turma','matricula_aluno_turma.turma_id = turma.turma_id');
      $this->db->join('cursos','matricula_aluno.curso_id = cursos.cursos_id');

      $this->db->where('matricula_aluno.registro_academico',$matricula);
      $query = $this->db->get();

      return $query->row_array();
    }
    public function get_Historico_Disc($matricula){

      $campos = '(disciplina_aluno_nota.dan_fl_nota_3bim + disciplina_aluno_nota.dan_fl_nota_2bim + disciplina_aluno_nota.dan_fl_nota_1bim)/3 as mediafinal';
      $campos = $campos.(', (disciplina_aluno_nota.dan_nb_falta_3bim + disciplina_aluno_nota.dan_nb_falta_2bim + disciplina_aluno_nota.dan_nb_falta_1bim)  as totalfalta');
      $campos = $campos.(',disciplina.disc_tx_descricao as disctex, disciplina_aluno_nota.dan_nb_situacao_final as situacao');
      $campos = $campos.(',matricula_aluno_turma.data_turma as discano, matriz_disciplina.periodo as discsem, matriz_disciplina.carga_horaria as chor');
      $campos = $campos.(',matricula_aluno.situacao as situa,disciplina_aluno.disciplina_aluno_id');

      $campos = $campos.(', disciplina.disciplina_id as disciplina_id');

      $this->db->select($campos);
      $this->db->from('disciplina_aluno_nota');
      $this->db->join('disciplina_aluno','disciplina_aluno_nota.disciplina_aluno_id = disciplina_aluno.disciplina_aluno_id');
      $this->db->join('matricula_aluno_turma','disciplina_aluno.matricula_aluno_turma_id = matricula_aluno_turma.matricula_aluno_turma_id');
      $this->db->join('matricula_aluno','matricula_aluno_turma.matricula_aluno_id = matricula_aluno.matricula_aluno_id');
      $this->db->join('matriz','matricula_aluno.matriz_id = matriz.matriz_id');
      $this->db->join('matriz_disciplina','disciplina_aluno.matriz_disciplina_id = matriz_disciplina.matriz_disciplina_id');
      $this->db->join('turma','matricula_aluno_turma.turma_id = turma.turma_id');
      $this->db->join('disciplina',' matriz_disciplina.disciplina_id = disciplina.disciplina_id');
      $this->db->where('matricula_aluno.matricula_aluno_id',$matricula);
      $this->db->order_by('matriz_disciplina.periodo');
      $query = $this->db->get();

      return $query->result_array();
    }
    public function get_Periodo(){

      $this->db->from('periodo_letivo');
      $this->db->where('atual',1);
      $query = $this->db->get();

      return $query->row_array();
    }
}
