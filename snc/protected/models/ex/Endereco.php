<?php

/**
 * This is the model class for table "endereco".
 *
 * The followings are the available columns in table 'endereco':
 * @property integer $id_endereco
 * @property string $endereco
 * @property string $bairro
 * @property string $cidade
 * @property string $complemento
 * @property string $referencia
 *
 * The followings are the available model relations:
 * @property Cliente[] $clientes
 * @property Funcionario[] $funcionarios
 */
class Endereco extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'endereco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('endereco, bairro, cidade, complemento, referencia', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_endereco, endereco, bairro, cidade, complemento, referencia', 'safe', 'on'=>'search'),
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
			'clientes' => array(self::HAS_MANY, 'Cliente', 'endereco_id'),
			'funcionarios' => array(self::HAS_MANY, 'Funcionario', 'endereco_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_endereco' => 'Id Endereco',
			'endereco'    => 'Endereço',
			'bairro'      => 'Bairro',
			'cidade'      => 'Cidade',
			'complemento' => 'Complemento',
			'referencia'  => 'Referência',
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

		$criteria->compare('id_endereco',$this->id_endereco);
		$criteria->compare('endereco',$this->endereco,true);
		$criteria->compare('bairro',$this->bairro,true);
		$criteria->compare('cidade',$this->cidade,true);
		$criteria->compare('complemento',$this->complemento,true);
		$criteria->compare('referencia',$this->referencia,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Endereco the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
