<?php

class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	private $_identity;

	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe' => 'Lembrar da próxima vez',
			'username'   => 'Usuário',
			'password'   => 'Senha',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity = new UserIdentity($this->username,$this->password);

			if(!$this->_identity->authenticate()) {

				//usuario cadastrado mas sem permissao cadastrada
				if( $this->_identity->errorCode == UserIdentity::ERROR_SEM_PERMISSAO ){
					Yii::app()->user->logout();
					$this->addError('password','Usuário sem permissão.');
				} else if( $this->_identity->errorCode == UserIdentity::ERROR_INATIVO ) {
						Yii::app()->user->logout();
						$this->addError('password','Usuário Inativo.');
				} else 
					$this->addError('password','Usuário ou senha inválidos.');
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			//$duration=$this->rememberMe ? 3600*24*30 : 0; // expira em 30 dias 
			//Yii::app()->user->login($this->_identity,$duration);
			//Yii::app()->user->login($this->_identity,432000);//expira em 5 dias
			Yii::app()->user->login($this->_identity,86400);//expira em 1 dia
			
			return true;
		}
		else
			return false;
	}
	
}
