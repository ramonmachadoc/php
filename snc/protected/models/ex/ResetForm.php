<?php

class ResetForm extends CFormModel
{
	public $identity;
	public $nome;
	public $login;
	public $senha;
	public $senha_verify;
	
	public function rules()
	{
		return array(
			array('senha,senha_verify','required'),
			array('senha','length', 'min' => 3),
			array('senha_verify', 'compare', 'compareAttribute' => 'senha', 'message' => 'Senhas devem ser iguais'),
		);
	}
	
	public function attributeLabels(){
		return array(
			'login'       =>'Usuário',
			'senha'       =>'Senha',
			'senha_verify'=>'Repetir Senha',
		);
	}
}