<?php

class Ishikawa extends CActiveRecord
{
	//so serve pra mostrar um erro na tela
	public $pelomenosumcampo;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ishikawa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('problema', 'required'),
			array('pelomenosumcampo', 'peloMenosUmCampoPreenchido'),
			//array('planoacao_id', 'numerical', 'integerOnly'=>true),
			array('metodoA, metodoB, metodoC, maquinaA, maquinaB, maquinaC, mensagemA, mensagemB, mensagemC, meioA, meioB, meioC, materialA, materialB, materialC, maoA, maoB, maoC', 'length', 'max'=>100),
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
			'planoacao' => array(self::BELONGS_TO, 'Planoacao', 'planoacao_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ishikawa_id'  => 'Ishikawa',
			'planoacao_id' => 'Planoacao',
			'problema'     => 'Problema',
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

		$criteria->compare('ishikawa_id',$this->ishikawa_id);
		$criteria->compare('planoacao_id',$this->planoacao_id);
		$criteria->compare('metodoA',$this->metodoA,true);
		$criteria->compare('metodoB',$this->metodoB,true);
		$criteria->compare('metodoC',$this->metodoC,true);
		$criteria->compare('maquinaA',$this->maquinaA,true);
		$criteria->compare('maquinaB',$this->maquinaB,true);
		$criteria->compare('maquinaC',$this->maquinaC,true);
		$criteria->compare('mensagemA',$this->mensagemA,true);
		$criteria->compare('mensagemB',$this->mensagemB,true);
		$criteria->compare('mensagemC',$this->mensagemC,true);
		$criteria->compare('meioA',$this->meioA,true);
		$criteria->compare('meioB',$this->meioB,true);
		$criteria->compare('meioC',$this->meioC,true);
		$criteria->compare('materialA',$this->materialA,true);
		$criteria->compare('materialB',$this->materialB,true);
		$criteria->compare('materialC',$this->materialC,true);
		$criteria->compare('maoA',$this->maoA,true);
		$criteria->compare('maoB',$this->maoB,true);
		$criteria->compare('maoC',$this->maoC,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
     * @regra - verifica um dos campos esta em branco e gera um erro
     */
    public function peloMenosUmCampoPreenchido() {
		if( empty($this->metodoA)   and empty($this->metodoB)   and empty($this->metodoC)   and
			empty($this->maquinaA)  and empty($this->maquinaB)  and empty($this->maquinaC)  and
			empty($this->mensagemA) and empty($this->mensagemB) and empty($this->mensagemC) and
			empty($this->meioA)     and empty($this->meioB)     and empty($this->meioC)     and
			empty($this->materialA) and empty($this->materialB) and empty($this->materialC) and
			empty($this->maoA)      and empty($this->maoB)      and empty($this->maoC) )
        
        	$this->addError('pelomenosumcampo', 'Pelo menos um campos deve ser preenchido!');
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ishikawa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
