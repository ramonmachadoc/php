<?php

/**
 * This is the model class for table "auditorrelator".
 *
 * The followings are the available columns in table 'auditorrelator':
 * @property integer $auditorrelator_id
 * @property string $nome
 * @property string $setor
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Evento[] $eventos
 */
class Auditorrelator extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auditorrelator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, setor, email', 'required'),
			array('nome, setor, email', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('auditorrelator_id, nome, setor, email', 'safe', 'on'=>'search'),
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
			'eventos' => array(self::HAS_MANY, 'Evento', 'auditorrelator_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'auditorrelator_id' => 'Auditorrelator',
			'nome' => 'Nome',
			'setor' => 'Setor',
			'email' => 'Email',
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

		$criteria->compare('auditorrelator_id',$this->auditorrelator_id);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('setor',$this->setor,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Auditorrelator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
