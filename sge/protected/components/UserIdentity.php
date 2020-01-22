<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	const ERROR_SEM_PERMISSAO = 3;
	const ERROR_INATIVO       = 4;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */////$this->getState('perfil'); $this->setState('perfil', '1');
	public function authenticate()
	{
		$user = Usuario::model()->findByAttributes(array('login'=> $this->username));

		if(!isset($user))
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($user->senha !== md5($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else if($user->status == 'I')
			$this->errorCode = self::ERROR_INATIVO;
		else {
			$this->setState('usuario_id',  $user->usuario_id);
			$this->setState('setor_id',    $user->setor_id);
			$this->setState('setor',       $user->setor->descricao);
			$this->setState('auditado',    $user->auditado);
			$this->setState('nome',        $user->nome);
			$this->setState('matricula',   $user->matricula);
			$this->setState('cpf',         $user->cpf);
			$this->setState('login',       $user->login);
			$this->setState('email',       $user->email);

			//AUDITADO
			if( $this->getState('auditado') == Usuario::SIM ) {
				$this->setState('empresa_id',   $user->empresa_id);
				$this->setState('empresa',      $user->empresa->nome);
				$this->setState('empresasigla', $user->empresa->sigla);

				$this->errorCode = self::ERROR_NONE;
			}

			//ADM/GER/AUDITOR sem permissao
			else if( $this->getState('auditado') == Usuario::NAO and is_null($user->permissoes[0]) ) 
				$this->errorCode = self::ERROR_SEM_PERMISSAO;
			
			//ADM/GER/AUDITOR com permissao
			else {//com permissao
				$this->setState('permissoes',  $user->permissoes);
				$this->guardaMaiorPermissao();
				$this->errorCode = self::ERROR_NONE;
			}

		}
		//dbg($this->errorCode);
		//dbg($this);

		return !$this->errorCode;
	}

	/**
	*	funcao que pega a maior permissao de todas as q o usuario possui
	*/
	//$this->getState("permissoes"); $this->setState("key","value"); 
	//Yii::app()->user->permissoes Yii::app()->user->permissoes = "sdfsfasfg";
	//Yii::app()->user->getState('permissoes') Yii::app()->user->setState('permissoes', 'sdfsfasfg');
	////$this->getState('perfil'); $this->setState('perfil', '1');
	//$this->clearState('perfil'); apagar conteudo da variavel
	private function guardaMaiorPermissao(){
		//so pra contrariar kkkk
		$maiorPerfil = 100;

		foreach ( $this->getState("permissoes") as $key => $permissao ) {
			
			if( $permissao->perfil < $maiorPerfil ) {
 				$maiorPerfil = $permissao->perfil;
				 $this->setState("empresa_id",  $permissao->empresa_id);
				 $this->setState("empresa",     $permissao->empresa->sigla);
				 $this->setState("area_id",     @$permissao->area_id);
				 $this->setState("area",        @$permissao->area->descricao);
				 $this->setState("perfil",      @$permissao->perfil);
				 $this->setState("perfiltexto", $permissao->getPerfilText($permissao->perfil));
			}
			
		}
		//dbg($this);
	}

}