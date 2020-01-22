<?php

class Permissao extends CActiveRecord
{
	/* Perfis */
	const ADMINISTRADOR    = 1;
	const GERENTE          = 2;
	const AUDITOR          = 3;
	const GERENTE_AUDITADO = 4;

	//FILTERS
	public $_filterUsuarioId;
	public $_filterLogin;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'permissao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_id, perfil', 'required', 'on'=>'administrador'),
			array('usuario_id, empresa_id, perfil', 'required', 'on'=>'gerente_auditor'),
			array('perfil', 'naoRepetePermissao'),
			//array('usuario_id', 'upgradeDowngradePermissao'),
			//array('usuario_id, empresa_id, area_id', 'numerical', 'integerOnly'=>true),
			//array('perfil', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_filterUsuarioId, _filterLogin, permissao_id, empresa_id, setor_id, area_id, perfil', 'safe', 'on'=>'search'),
			array('_filterUsuarioId, _filterLogin, usuario_id, permissao_id, empresa_id, setor_id,  area_id, perfil', 'safe'),
		);
	}

	/**
	*	Rule of the validation - not repeat register
	*/
	public function naoRepetePermissao(){
		if($this->perfil == Permissao::ADMINISTRADOR){
			$permissao = Permissao::model()->findByAttributes(array(
				'usuario_id' => $this->usuario_id,
				'perfil'     => $this->perfil,
			));
		} elseif ($this->perfil == Permissao::GERENTE_AUDITADO) {
			$permissao = Permissao::model()->findByAttributes(array(
				'usuario_id' => $this->usuario_id,
				'perfil'     => $this->perfil,
				'empresa_id' => $this->empresa_id,
				'setor_id' 	 => $this->setor_id,
			));
		}
		else {
			$permissao = Permissao::model()->findByAttributes(array(
				'usuario_id' => $this->usuario_id,
				'perfil'     => $this->perfil,
				'empresa_id' => $this->empresa_id,
				'area_id'    => $this->area_id,
			));
		}

		if($permissao != null)
			$this->addError('perfil', 'Esta Permissão já existe para esse usuário');
	}

	/*public function upgradeDowngradePermissao(){
		$error = 'xxxxxxxxxx';
		//dbg($this->attributes,false);


		if($this->perfil == Permissao::ADMINISTRADOR){

			//pesquisar se ha um registro desse usuario como gerente ou auditor
			//se houver - erro
			$permissao = Permissao::model()->findAllByAttributes(
				Array('perfil' => Array(Permissao::GERENTE,Permissao::AUDITOR))
			);

			if($permissao->usuario_id != '')
				$error = 'Este usuário já é um ADMINISTRADOR, não necessita de outro perfil!';

		}
		else {

			$permissao = Permissao::model()->findAllByAttributes(
				Array('perfil' => Array(Permissao::ADMINISTRADOR))
			);

			//dbg($permissao->usuario_id);
			if($permissao->usuario_id != '')
				$error = 'Este usuário é um GERENTE ou AUDITOR, não pode ser ter um perfil de ADMINISTRADOR!';
		}


		if($permissao != null)
			$this->addError('usuario_id', $error);
	}*/

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'empresa_id'),
			'setor' => array(self::BELONGS_TO, 'Setor', 'setor_id'),
			'area'    => array(self::BELONGS_TO, 'Area',    'area_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'permissao_id' => 'Permissão',
			'usuario_id'   => 'Usuário',
			'empresa_id'   => 'Empresa',
			'setor_id' 	   => 'Setor',
			'area_id'      => 'Área',
			'perfil'       => 'Perfil',

			//Filters
			'_filterUsuarioId' => 'Nome',
			'_filterLogin'     => 'Login',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array( 'usuario' );

		$criteria->compare('usuario.usuario_id', $this->_filterUsuarioId);
		$criteria->compare('usuario.login',      $this->_filterLogin, true);

		$criteria->compare('t.permissao_id',     $this->permissao_id);
		$criteria->compare('t.empresa_id',       $this->empresa_id);
		$criteria->compare('t.setor_id',		 $this->setor_id);
		$criteria->compare('t.area_id',          $this->area_id);
		$criteria->compare('t.perfil',           $this->perfil,true);

		//$criteria->addCondition("perfil != '' or perfil = '".$this->perfil."' ");

		$criteria->order = 'usuario.nome ASC';


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function searchUsuario($usuario_id)
	{
		$criteria = new CDbCriteria;
		$criteria->with = array( 'usuario' );

		$criteria->compare('usuario.usuario_id', $usuario_id);
		$criteria->compare('usuario.login',      $this->_filterLogin, true);

		$criteria->compare('t.permissao_id',       $this->permissao_id);
		$criteria->compare('t.empresa_id',         $this->empresa_id);
		$criteria->compare('t.area_id',            $this->area_id);
		$criteria->compare('t.perfil',             $this->perfil,true);

		//$criteria->addCondition("perfil != '' or perfil = '".$this->perfil."' ");

		$criteria->order = 'usuario.nome ASC';


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getPerfilOptions(){
		return array(
			self::ADMINISTRADOR    => 'Administrador',
			self::GERENTE          => 'Gerente',
			self::AUDITOR          => 'Auditor',
			self::GERENTE_AUDITADO => 'Gerente Auditado'
		);
	}

	public function getPerfilText(){
		$options = $this->getPerfilOptions();
		return $options[$this->perfil];
	}

	/*
	*	Retorna um array com os IDs das areas em que o usuario tem permissao
	*/
	public static function retornaArrayComAsAreas() {

		foreach( Yii::app()->user->permissoes as $key => $permissao ) {
			$arrayAreas[] = $permissao->area_id;
		}

		return array_unique($arrayAreas);
	}

	/*
	*	Retorna um array com os IDs das areas em que o usuario tem permissao
	*/
	public static function findAllEmpresasSessao() {

		foreach( Yii::app()->user->permissoes as $key => $permissao ) {
			$arrayEmpresas[ $permissao->empresa->empresa_id ] = $permissao->empresa->sigla .' - ' . $permissao->empresa->nome;
		}

		return array_unique($arrayEmpresas);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Permissao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
