<?php
class Cliente extends CActiveRecord
{
	const AGENDADO   = 1;
	const REAGENDADO = 2;
	const VENDA      = 3;
	
	const AVISTA    = 1;
	const PARCELADO = 2;
	
	public $mes;
	public $dia;
	public $venda;

	public $filter_funcionario;
	public $filter_supervisor;
	public $filter_aniversario;
	public $filter_data_de;
	public $filter_data_ate;
	public $filter_data_retorno_hoje;
	public $filter_retorno_anterior;
	public $filter_vendas_ranking;

	public $dataComparacaoRanking;

	public $data_posterior = 0;
	public $justificativa;

	public $origem;
	public $dataConsulta;
	public $pagination = array('pageSize' => 10);

	public function tableName()
	{
		return 'cliente';
	}
	
	public function rules()
	{
		return array(
			array('id_funcionario, forma_pagamento, nome, fone, aniversario, data_retorno, modelo_moto, mes, dia', 'required'),
			array('status,data_retorno,data_venda,justificativa', 'required', 'on'=>'formRetorno'),
			array('status,data_retorno,justificativa', 'required', 'on'=>'reagendado'),
			array('status,data_venda,justificativa', 'required', 'on'=>'venda'),
			array('data_venda', 'verificaDataVenda', 'on'=>'venda'),
			array('nome, nome_indicacao', 'length', 'max'=>100),
			array('fone, fone_indicacao', 'length', 'max'=>20),
			array('observacao', 'length', 'max'=>1000),
			array('modelo_moto', 'length', 'max'=>50),
			array('id_funcionario,email, data_cadastro, data_atualizacao, aniversario, data_retorno, dia, mes, filter_funcionario, status, data_venda, filter_data_retorno_hoje', 'safe'),
			array('id_cliente, nome, fone, data_cadastro, aniversario, observacao, data_retorno, status, forma_pagamento, modelo_moto, nome_indicacao, fone_indicacao, id_funcionario,justificativa,filter_data_retorno_hoje', 'safe', 'on'=>'search'),
		);
	}

	public function verificaDataVenda()
	{
		if(Utils::comparar($this->venda) == 2){
			$this->data_venda = $this->venda;
			$this->status     = self::VENDA;
            $this->addError('data_venda', 'A data informada para a venda realizada não pode ser maior que a data de hoje');
		}
	}
	
	public function relations()
	{
		return array(
			'vendedor'       => array(self::BELONGS_TO, 'Funcionario',  'id_funcionario'),
			'justificativas' => array(self::HAS_MANY,   'Justificativa', 'id_cliente', 'order'=>'id_justificativa desc'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id_cliente'       => 'Id Cliente',
			'id_funcionario'   => 'Na Carteira do Vendedor',
			'nome'             => 'Nome',
			'email'            => 'Email',
			'fone'             => 'Fone',
			'data_cadastro'    => 'Data de Cadastro',
			'data_atualizacao' => 'Data de Atualização',
			'data_venda'       => 'Data da Venda',
			'aniversario'      => 'Aniversário',
			'observacao'       => 'Observação',
			'data_retorno'     => 'Data de Retorno',
			'status'           => 'Status',
			'forma_pagamento'  => 'Forma de Pagamento',
			'modelo_moto'      => 'Modelo da Moto',
			'nome_indicacao'   => 'Nome do Indicado',
			'fone_indicacao'   => 'Fone do Indicado',
			
			'filter_funcionario' => 'Vendedor',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('vendedor');

		if ($this->filter_data_de != '' and $this->filter_data_ate != '') {
			$criteria->addBetweenCondition('data_cadastro', $this->filter_data_de, $this->filter_data_ate);
		}

		if ($this->filter_data_retorno_hoje != '') {
			$criteria->condition = 't.status < 3 and data_retorno = CURRENT_DATE()';
		}

		if ($this->filter_retorno_anterior == true) {
			$criteria->condition = 't.status < 3 and data_retorno < CURRENT_DATE()';
		}

		if ($this->data_retorno != '') {
			$criteria->compare('data_retorno', date('Y-m-d', strtotime(str_replace('/', '-', $this->data_retorno))));
		}

		if ($this->filter_vendas_ranking == true) {
			$criteria->condition = "YEAR(data_venda) = '"
				. date('Y',strtotime($this->dataComparacaoRanking))
				. "' and MONTH(data_venda) = '"
				. date('m', strtotime($this->dataComparacaoRanking))."'";
		}

		$criteria->compare('UPPER(t.nome)',          mb_strtoupper($this->nome), true);
		$criteria->compare('t.fone',                 $this->fone, true);
		$criteria->compare('UPPER(t.modelo_moto)',   mb_strtoupper($this->modelo_moto), true);
		$criteria->compare('UPPER(vendedor.nome)',   mb_strtoupper($this->filter_funcionario), true);
		$criteria->compare('vendedor.supervisor_id', $this->filter_supervisor);
		$criteria->compare('t.status', $this->status);
		$criteria->compare("t.aniversario",          $this->filter_aniversario);
		$criteria->compare("t.id_funcionario",       $this->id_funcionario);

		if(!Yii::app()->user->isGuest and Yii::app()->user->perfil != Funcionario::SUPERVISOR){
			$criteria->order = 't.nome ASC';
		}else{
			$criteria->order = 't.data_venda DESC';
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => $this->pagination
		));
	}


	public function getStatusOptions(){
		return array(
			self::AGENDADO   => 'Agendado',
			self::REAGENDADO => 'Reagendado',
			self::VENDA      => 'Venda Realizada',
		);
	}
	
	public function getStatusText(){
		$options = $this->getStatusOptions();
		return $options[$this->status];
	}
	
	public function getFormaPagamentoOptions(){
		return array(
			self::AVISTA    => 'À Vista',
			self::PARCELADO => 'Parcelado',
		);
	}
	
	public function getFormaPagamentoText(){
		$options = $this->getFormaPagamentoOptions();
		return $options[$this->forma_pagamento];
	}
	
	public function getMesOptions()
	{
		return array(
			'01' => 'Janeiro',
			'02' => 'Fevereiro',
			'03' => 'Março',
			'04' => 'Abril',
			'05' => 'Maio',
			'06' => 'Junho',
			'07' => 'Julho',
			'08' => 'Agosto',
			'09' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro',
		);
	}
	
	public function getMesText(){
		$options = $this->getMesOptions();
		return $options[$this->mes];
	}

	public function getDiaOptions()
	{
		return array(
			'01' => '01',
			'02' => '02',
			'03' => '03',
			'04' => '04',
			'05' => '05',
			'06' => '06',
			'07' => '07',
			'08' => '08',
			'09' => '09',
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'21' => '21',
			'22' => '22',
			'23' => '23',
			'24' => '24',
			'25' => '25',
			'26' => '26',
			'27' => '27',
			'28' => '28',
			'29' => '29',
			'30' => '30',
			'31' => '31',
		);
	}


	public static function getAniversarios()
	{
		$model = new Cliente('search');
		$model->filter_aniversario = date('d/m');
		$model->pagination = false;

		if (!Yii::app()->user->isGuest and Yii::app()->user->perfil == Funcionario::VENDEDOR ) {
			$model->id_funcionario = Yii::app()->user->id;
		} elseif (!Yii::app()->user->isGuest and Yii::app()->user->perfil == Funcionario::SUPERVISOR) {
			$model->filter_supervisor = Yii::app()->user->id;
		}

		return $model->search()->getData();
	}

	public static function getQtdTotalClientes()
	{
		$qtdRetornos = Yii::app()
			->db
			->createCommand("
					SELECT count(*) as c
				    FROM cliente")->queryAll();
		return $qtdRetornos[0]['c'];
	}

	/*public function beforeSave(){
		if($this->data_venda == '' or $this->data_venda == '0000-00-00' or $this->data_venda == '31/12/1969')
			$this->data_venda = null;
		
		return parent::beforeSave();
	}*/

	public function afterFind(){
	
		if($this->data_retorno != '')
			$this->data_retorno =  date('d/m/Y', strtotime(str_replace('-','/',$this->data_retorno)));

		if ($this->data_venda == '' or $this->data_venda == '0000-00-00' or $this->data_venda == '1969-12-31')
			$this->data_venda = null;
		else
			$this->data_venda = date('d/m/Y', strtotime(str_replace('-', '/', $this->data_venda)));

		$data_aniversario    = explode("/", $this->aniversario);
		$this->dia = $data_aniversario[0];
		$this->mes = $data_aniversario[1];
		$this->aniversario = $this->dia .'/'. $this->getMesText();

		return parent::afterFind();
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}