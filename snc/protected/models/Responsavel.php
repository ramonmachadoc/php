<?php

class Responsavel extends CActiveRecord
{
	/* status */
	const ATIVO   = 'A';
	const INATIVO = 'I';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'responsavel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome,email,setor_id', 'required'),
			array('email', 'emailValidation'),
			array('cpf,email', 'unique'),
			array('nome,cpf,email', 'safe', 'on'=>'search'),
			array('nome, email, status', 'safe'),
		);
	}

	public function emailValidation()
	{
		if($this->email != ""){
	       $emailValidator = new CEmailValidator;
	       if ( !$emailValidator->validateValue($this->email) )
	          $this->addError($this->email, 'E-mail inválido!');
		}
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'setor'      => array(self::BELONGS_TO, 'Setor',     'setor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'responsavel_id' => 'Código',
			'setor_id'   => 'Setor',
			'nome'       => 'Nome',
			'cpf'        => 'CPF',
			'email'      => 'E-mail',
			'status'     => 'Status',

		);
	}


	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('nome',       $this->nome,       true);
		$criteria->compare('setor_id',   $this->setor_id,   true);
		$criteria->compare('status',     $this->status,     true);

		$criteria->order = 'nome ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getStatusOptions(){
		return array(
			self::ATIVO   => 'Ativo',
			self::INATIVO => 'Inativo',
		);
	}

	public function getStatusText(){
		$options = $this->getStatusOptions();
		return $options[$this->status];
	}

	/**
	 * Retorna uma lista de emails dos responsaveis de um mesmo setor
	 */
	public static function buscarEmailsBySetor($setor_id){

		$emails = Yii::app()->db->createCommand("
			SELECT nome, email
			FROM responsavel
			WHERE status = 'A' AND setor_id = '".$setor_id."'
		")->queryAll();

		foreach($emails as $key=> $email){
			$arrayEmail[$email['email']] = $email['nome'];
		}

		return $arrayEmail;
	}

    /**
     *  Função chamada depois que a consulta eh realizada e antes de alimentar o model
     */
    public function afterFind() {

        return parent::afterFind();
    }

  	/**
     *  Função chamada antes de salvar o $model
     */
    public function beforeSave() {

        return parent::beforeSave();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Responsavel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
