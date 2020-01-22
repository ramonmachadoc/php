<?php

/**
 * This is the model class for table "acompanhamento".
 *
 * The followings are the available columns in table 'acompanhamento':
 * @property integer $acompanhamento_id
 * @property integer $correcao_id
 * @property string $encerramento
 * @property string $encerrada
 * @property string $monitoramento
 * @property string $observacao
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Correcao $correcao
 */
class Acompanhamento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acompanhamento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('correcao_id', 'required'),
			array('correcao_id', 'numerical', 'integerOnly'=>true),
			array('encerrada, status', 'length', 'max'=>1),
			array('encerramento, monitoramento, observacao', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('acompanhamento_id, correcao_id, encerramento, encerrada, monitoramento, observacao, status', 'safe', 'on'=>'search'),
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
			'correcao' => array(self::BELONGS_TO, 'Correcao', 'correcao_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'acompanhamento_id' => 'Acompanhamento',
			'correcao_id' => 'Correcao',
			'encerramento' => 'Encerramento',
			'encerrada' => 'Encerrada',
			'monitoramento' => 'Monitoramento',
			'observacao' => 'Observacao',
			'status' => 'Status',
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

		$criteria->compare('acompanhamento_id',$this->acompanhamento_id);
		$criteria->compare('correcao_id',$this->correcao_id);
		$criteria->compare('encerramento',$this->encerramento,true);
		$criteria->compare('encerrada',$this->encerrada,true);
		$criteria->compare('monitoramento',$this->monitoramento,true);
		$criteria->compare('observacao',$this->observacao,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Acompanhamento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
