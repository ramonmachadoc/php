<?php

class Porque extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'porque';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('cr1,cr2,cr3,cr4,cr5', 'required'),
			array('cr1, cr2, cr3, cr4, cr5', 'length', 'max'=>500),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'planoacao' => array(self::BELONGS_TO, 'Planoacao', 'planoacao_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'porque_id'    => 'ID',
			'planoacao_id' => 'Plano de Ação',
			'cr1'          => '1º Porque',
			'cr2'          => '2º Porque',
			'cr3'		   => '3º Porque',
			'cr4'          => '4º Porque',
			'cr5'          => '5º Porque',
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Porque the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
