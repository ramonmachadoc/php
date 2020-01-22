<?php

class Usuario extends CActiveRecord
{
	/* status */
	const ATIVO   = 'A';
	const INATIVO = 'I';

	/* auditado */
	const SIM = 'S';
	const NAO = 'N';

	//public $usuarioAutitado;
	public $perfil;
	public $senhaAntiga;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('auditado, setor_id, nome, matricula, cpf, email, login, senha, status', 'required'),
			//array('empresa_id', 'required', 'on'=>'AUDITADO'),
			array('empresa_id, setor_id, nome, matricula, cpf, login, senha, email, auditado, status', 'required'),
			array('email', 'emailValidation'),
			array('login,matricula,cpf', 'unique'),
			//array('nome, login, email', 'required', 'on'=>'update'),
			//array('setor_id', 'required', 'on'=>'usuarioAUDITADO'),
			//array('setor_id', 'numerical', 'integerOnly'=>true),
			//array('nome',   'length', 'max'=>80),
			//array('login',  'length', 'max'=>30),
			//array('senha',  'length', 'max'=>10),
			array('setor_id, nome, matricula, cpf, login, status, auditado', 'safe', 'on'=>'search'),
			array('empresa_id, setor_id, nome, matricula, cpf, login, senha, email, status, auditado', 'safe'),
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
			'empresa'    => array(self::BELONGS_TO, 'Empresa',   'empresa_id'),
			'setor'      => array(self::BELONGS_TO, 'Setor',     'setor_id'),
			'permissoes' => array(self::HAS_MANY,   'Permissao', 'usuario_id', 'order' => 'perfil asc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usuario_id' => 'Código',
			'empresa_id' => 'Empresa',
			'setor_id'   => 'Setor',
			'nome'       => 'Nome',
			'matricula'  => 'Matrícula',
			'cpf'        => 'CPF',
			'login'      => 'Login',
			'senha'      => 'Senha',
			'email'      => 'E-mail',
			'status'     => 'Status',
			'auditado'   => 'Perfil Auditado',

		);
	}


	public function search()
	{
		$criteria = new CDbCriteria;
		//$criteria->with = 'permissoes';
		//$criteria->join = 'JOIN permissao P ON (t.usuario_id = P.usuario_id)';
		//$criteria->with = array("permissoes"=>array("select"=>"perfil")); 
		
		$criteria->compare('nome',       $this->nome,       true);
		$criteria->compare('login',      $this->login,      true);	
		$criteria->compare('empresa_id', $this->empresa_id, true);	
		$criteria->compare('setor_id',   $this->setor_id,   true);	
		$criteria->compare('auditado',   $this->auditado,   true);
		$criteria->compare('status',     $this->status,     true);

		$criteria->order = 'nome ASC';

		//$criteria->addCondition("t.auditado = '".Usuario::NAO."'");
		//$criteria->addCondition("P.perfil = '".Permissao::ADMINISTRADOR."'");		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/*public function searchAdministradores()
	{
		$criteria = new CDbCriteria;
		//$criteria->with = 'permissoes';
		$criteria->join = 'JOIN permissao P ON (t.usuario_id = P.usuario_id)';
		//$criteria->with = array("permissoes"=>array("select"=>"perfil")); 
		
		$criteria->compare('t.nome',   $this->nome,   true);
		$criteria->compare('t.login',  $this->login,  true);	
		$criteria->compare('t.status', $this->status, true);

		$criteria->addCondition("t.auditado = '".Usuario::NAO."'");
		$criteria->addCondition("P.perfil = '".Permissao::ADMINISTRADOR."'");		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchGerenteAuditor()
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'DISTINCT(P.usuario_id), t.nome, t.login, t.empresa_id, t.setor_id, t.status';
		$criteria->join = 'JOIN permissao P ON (t.usuario_id = P.usuario_id)';
		
		$criteria->compare('t.nome',       $this->nome,       true);
		$criteria->compare('t.login',      $this->login,      true);
		$criteria->compare('P.empresa_id', $this->empresa_id, true);
		$criteria->compare('P.setor_id',   $this->setor_id,   true);	
		$criteria->compare('t.status',     $this->status,     true);

		$criteria->addCondition("t.auditado = '".Usuario::NAO."'");
		$criteria->addCondition("P.perfil = '".Permissao::GERENTE."' or 
								 P.perfil = '".Permissao::AUDITOR."' ");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	

	public function searchAuditado()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('nome',       $this->nome,       true);
		$criteria->compare('login',      $this->login,      true);
		$criteria->compare('empresa_id', $this->empresa_id, true);
		$criteria->compare('setor_id',   $this->setor_id,   true);
		$criteria->compare('status',     $this->status,     true);

		$criteria->addCondition("auditado = '".Usuario::SIM."'");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/

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

	public function getAuditadoOptions(){
		return array(
			self::SIM => 'Sim',
			self::NAO => 'Não',
		);
	}
	
	public function getAuditadoText(){
		$options = $this->getAuditadoOptions();
		return $options[$this->auditado];
	}

	/**
	 * Retorna uma lista de emails dos usuarios de um mesmo setor
	 */
	public static function buscarEmailsBySetor($setor_id){
		
		$emails = Yii::app()->db->createCommand("
			SELECT nome, email 
			FROM usuario 
			WHERE status = 'A' AND setor_id = '".$setor_id."'
		")->queryAll();
			
		foreach($emails as $key=> $email){
			$arrayEmail[$email['email']] = $email['nome'];
		}
	
		return $arrayEmail;
	} 

	/**
	 * Retorna uma lista de emails dos usuarios de uma area
	 */
	public static function buscarEmailsByArea($area_id){
		
		$emails = Yii::app()->db->createCommand("
				SELECT DISTINCT(U.usuario_id), U.nome, U.email
				FROM permissao P 
				JOIN usuario U ON (P.usuario_id = U.usuario_id)
				WHERE P.area_id = '".$area_id."'
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
		$this->senhaAntiga = $this->senha;
		
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
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
