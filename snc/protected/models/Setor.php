<?php

/**
 * This is the model class for table "setor".
 *
 * The followings are the available columns in table 'setor':
 * @property integer $setor_id
 * @property string $descricao
 *
 * The followings are the available model relations:
 * @property Usuario[] $usuarios
 */
class Setor extends CActiveRecord
{
	/* Cliente*/
	const INTERNO = 'Interno';
	const EXTERNO = 'Externo';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descricao', 'required'),
			array('descricao', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('setor_id, descricao', 'safe', 'on'=>'search'),

			array('cliente','required'),
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
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'setor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'setor_id'  => 'Setor',
			'descricao' => 'Descricao',
			'cliente'   => 'Cliente Interno/Externo',
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

		$criteria->compare('setor_id',$this->setor_id);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('cliente',$this->cliente);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*public function getAll(){
		return CHtml::listData(Setor::model()->findAll(),'setor_id','descricao');
		//return CHtml::listData(self::model()->findAll(),'setor_id','descricao');
	}*/

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Setor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getCLienteOptions(){
		return array(
			self::INTERNO => 'Interno',
			self::EXTERNO => 'Externo',
		);
	}
}
