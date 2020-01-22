<?php

class Causaraiz extends CActiveRecord
{
	//so serve pra mostrar um erro na tela
	public $pelomenosumcampo;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'causaraiz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo,categoria,codigo,subcategoria', 'required'),
			//array('pelomenosumcampo', 'peloMenosUmCampoPreenchido'),
			//array('planoacao_id', 'numerical', 'integerOnly'=>true),
			array('tipo,categoria,codigo,subcategoria', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('ishikawa_id, planoacao_id, metodoA, metodoB, metodoC, maquinaA, maquinaB, maquinaC, mensagemA, mensagemB, mensagemC, meioA, meioB, meioC, materialA, materialB, materialC, maoA, maoB, maoC', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'planoacao'      => array(self::HAS_ONE,    'Planoacao',      'causaraiz_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'causaraiz_id'  => 'Causa Raiz',
			'tipo'     => 'Tipo',
      'categoria' => 'Categoria',
      'codigo' => 'Código',
      'subcategoria' => 'SubCategoria',
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

		$criteria->compare('causaraiz_id',$this->causaraiz_id);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('codigo',$this->codigo);
		$criteria->compare('subcategoria',$this->subcategoria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CausaRaiz the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getFullName(){
		return $this->tipo.' - '.$this->categoria.' - '.$this->codigo.' - '.$this->subcategoria;
	}
}
