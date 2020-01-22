<?php

class Justificativa extends CActiveRecord
{	
	const REAGENDADO = 2;
	const VENDA      = 3;

	public function tableName()
	{
		return 'justificativa';
	}

	public function rules()
	{
		return array(
			array('texto,dtCadastro,status', 'required'),
			array('texto', 'length', 'max'=>2000),
			array('id_justificativa, id_cliente, texto', 'safe', 'on'=>'search'),
			array('id_justificativa, id_cliente, texto, dtCadastro, status', 'safe'),
		);
	}

	public function relations()
	{
		return array(
			'idCliente' => array(self::BELONGS_TO, 'Cliente', 'id_cliente'),
		);
	}

	/*public function behaviors()
	{
		return array(
			'RestModelBehavior' => array(
				'class' => 'WRestModelBehavior',
			)
		);
	}*/


	public function attributeLabels()
	{
		return array(
			'id_justificativa' => 'Id Justificativa',
			'id_cliente'       => 'Id Cliente',
			'texto'            => 'Texto',
			'dtCadastro'       => 'Data de Cadastro',
			'status'           => 'Status',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id_justificativa', $this->id_justificativa);
		$criteria->compare('id_cliente',       $this->id_cliente);
		$criteria->compare('texto',            $this->texto,true);
		$criteria->compare('dtCadastro',       $this->dtCadastro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getStatusOptions(){
		return array(
			self::REAGENDADO => 'REAGENDAMENTO',
			self::VENDA      => 'VENDA REALIZADA',
		);
	}
	
	public function getStatusText(){
		$options = $this->getStatusOptions();
		return $options[$this->status];
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
