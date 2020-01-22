<?php

/**
 * This is the model class for table "cliente_migrado".
 *
 * The followings are the available columns in table 'cliente_migrado':
 * @property integer $id_cliente_migrado
 * @property integer $id_cliente
 * @property integer $id_funcionario_novo
 * @property integer $id_funcionario_antigo
 * @property string $data_migracao
 *
 * The followings are the available model relations:
 * @property Cliente $idCliente
 * @property Funcionario $idFuncionarioAntigo
 * @property Funcionario $idFuncionarioNovo
 */
class ClienteMigrado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cliente_migrado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cliente, id_funcionario_novo, id_funcionario_antigo, data_migracao', 'required'),
			array('id_cliente, id_funcionario_novo, id_funcionario_antigo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cliente_migrado, id_cliente, id_funcionario_novo, id_funcionario_antigo, data_migracao', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idCliente' => array(self::BELONGS_TO, 'Cliente', 'id_cliente'),
			'idFuncionarioAntigo' => array(self::BELONGS_TO, 'Funcionario', 'id_funcionario_antigo'),
			'idFuncionarioNovo' => array(self::BELONGS_TO, 'Funcionario', 'id_funcionario_novo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cliente_migrado' => 'Id Cliente Migrado',
			'id_cliente' => 'Id Cliente',
			'id_funcionario_novo' => 'Id Funcionario Novo',
			'id_funcionario_antigo' => 'Id Funcionario Antigo',
			'data_migracao' => 'Data Migracao',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_cliente_migrado',$this->id_cliente_migrado);
		$criteria->compare('id_cliente',$this->id_cliente);
		$criteria->compare('id_funcionario_novo',$this->id_funcionario_novo);
		$criteria->compare('id_funcionario_antigo',$this->id_funcionario_antigo);
		$criteria->compare('data_migracao',$this->data_migracao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClienteMigrado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
