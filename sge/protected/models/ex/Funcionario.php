<?php

/**
 * This is the model class for table "funcionario".
 *
 * The followings are the available columns in table 'funcionario':
 * @property integer $id_funcionario
 * @property string $nome
 * @property string $fone
 * @property string $login
 * @property string $senha
 * @property string $data_nascimento
 * @property integer $perfil
 * @property string $cpf
 * @property string $data_admissao
 * @property string $email
 * @property integer $status
 * @property integer $endereco_id
 *
 * The followings are the available model relations:
 * @property Cliente[] $clientes
 * @property Endereco $endereco
 */
class Funcionario extends CActiveRecord
{
	const GERENTE    = 1;
	const SUPERVISOR = 2;
	const VENDEDOR   = 3;

	const ATIVO   = 1;
	const INATIVO = 2;

	public $qtdAgendamentosVend;
	public $qtdAgendamentosSup;

	public $dataComparacaoRanking;
	public $vendedor_id;
	public $clientes_id;
	public $filter_aniversario;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'funcionario';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Funcionario the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome,fone,login,senha,data_nascimento,perfil,cpf,data_admissao,email,status', 'required', 'on'=>'cadastro'),
			array('nome,fone,login,senha,data_nascimento,perfil,cpf,data_admissao,email,status,supervisor_id', 'required', 'on'=>'cadastroVendedor'),
			array('id_funcionario,supervisor_id,clientes_id', 'required', 'on'=>'trocaCarteira'),
			array('perfil, status, endereco_id', 'numerical', 'integerOnly'=>true),
			array('nome, email', 'length', 'max'=>100),
			array('fone', 'length', 'max'=>20),
			array('login, senha', 'length', 'max'=>50),
			array('cpf', 'length', 'max'=>15),
			array('data_nascimento, data_admissao, dataComparacaoRanking, qtdAgendamentosVend, qtdAgendamentosSup', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_funcionario, nome, fone, login, senha, data_nascimento, perfil, cpf, data_admissao, email, status, endereco_id', 'safe', 'on'=>'search'),
			array('supervisor_id, id_funcionario, vendedor_id, clientes_id', 'safe'),
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
			'supervisor' => array(self::BELONGS_TO, 'Funcionario', 'supervisor_id'),
			'vendedores' => array(self::HAS_MANY,   'Funcionario', 'supervisor_id'),
			'clientes'   => array(self::HAS_MANY,   'Cliente',     'id_funcionario'),
			'agendamentosHoje' => array(self::HAS_MANY, 'Cliente', 'id_funcionario',
				'condition' => "data_cadastro BETWEEN '" . date('Y-m-d') . " 00:00:00' and '" . date('Y-m-d') . " 23:59:59'"),
			'retornosHoje' => array(self::HAS_MANY, 'Cliente', 'id_funcionario',
				'condition' => "data_retorno = CURRENT_DATE() AND status < 3"),
			'retornosAtrasados' => array(self::HAS_MANY, 'Cliente', 'id_funcionario',
				'condition' => "status < 3 and data_retorno < CURRENT_DATE()-1"),
			'endereco'   => array(self::BELONGS_TO, 'Endereco',    'endereco_id'),
		);
	}

	/*public function behaviors()
	{
		return array(
			'RestModelBehavior' => array(
				'class' => 'WRestModelBehavior',
			)
		);
	}*/


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_funcionario'      => 'Vendedor',
			'nome'                => 'Nome',
			'fone'                => 'Fone',
			'login'               => 'Login',
			'senha'               => 'Senha',
			'data_nascimento'     => 'Data de Nascimento',
			'perfil'              => 'Perfil',
			'cpf'                 => 'CPF',
			'data_admissao'       => 'Data Admissão',
			'email'               => 'Email',
			'status'              => 'Status',
			'endereco_id'         => 'Endereço',
			'supervisor_id'       => 'Supervisor',
			'qtdAgendamentosVend' => 'Agendamentos',
			'qtdAgendamentosSup'  => 'Agendamentos'
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

		$criteria->compare('id_funcionario',$this->id_funcionario);
		$criteria->compare('supervisor_id',$this->supervisor_id);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('fone',$this->fone,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('senha',$this->senha,true);
		//$criteria->compare('data_nascimento',$this->data_nascimento,true);
		$criteria->compare('perfil',$this->perfil);
		$criteria->compare('cpf',$this->cpf,true);
		$criteria->compare('data_admissao',$this->data_admissao,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('endereco_id',$this->endereco_id);
		$criteria->compare("DATE_FORMAT(data_nascimento, '%d/%m')",$this->filter_aniversario);

		if($this->data_nascimento!=''){		
			$criteria->compare('data_nascimento', date('Y-m-d', strtotime(str_replace('/','-',$this->data_nascimento))));
		}


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getQtdeAgendamentosVend($vendedor_id,$data, $tipo = 'qtd'){

		$qtd = Cliente::model()->findAll("(data_cadastro BETWEEN '" . $data . " 00:00:00' and '" . $data . " 23:59:59') and id_funcionario = " . $vendedor_id);

		if($tipo == 'qtd')
			$this->qtdAgendamentosVend = count($qtd);

		return $qtd;

	}

	public function getQtdeAgendamentosSup($supervisor_id,$data){

		$qtd = 0;
		$vendedores = Funcionario::model()->findAllByAttributes(array('supervisor_id'=>$supervisor_id));

		foreach($vendedores as $vendedor){
			$qtd += count(Cliente::model()->findAll("(data_cadastro BETWEEN '" . $data . " 00:00:00' and '" . $data . " 23:59:59') and id_funcionario = " . $vendedor->id_funcionario));
		}

		$this->qtdAgendamentosSup = $qtd;

	}

	public static function getRetornosAtrasados($id_supervisor = false)
	{
		$data = date('Y-m-d');
		if ($id_supervisor) {
			$qtdRetornos = Yii::app()
				->db
				->createCommand("
					SELECT count(*) as c
					  FROM cliente cli
					  INNER JOIN funcionario f on (f.id_funcionario = cli.id_funcionario)
					where cli.status < 3
						and cli.data_retorno < '$data'
						and f.supervisor_id = $id_supervisor")
				->queryAll();
			return $qtdRetornos[0]['c'];
		} else {
			$model = new Cliente('search');
			$model->filter_retorno_anterior = true;
			$model->filter_supervisor = Yii::app()->user->id;
			return $model->search()->getData();
		}
	}

	public static function getRetornosHoje($id_supervisor = false)
	{
		$data = date('Y-m-d');
		if($id_supervisor){
			$qtdRetornos = Yii::app()
				->db
				->createCommand("
					SELECT count(*) as c
					  FROM cliente cli
					  INNER JOIN funcionario f on (f.id_funcionario = cli.id_funcionario)
					where cli.status < 3
						and cli.data_retorno = '$data'
						and f.supervisor_id = $id_supervisor")
				->queryAll();
			return $qtdRetornos[0]['c'];
		}else{
			$model = new Cliente('search');
			$model->filter_data_retorno_hoje = date('Y-m-d');
			$model->filter_supervisor = Yii::app()->user->id;
			return $model->search()->getData();
		}
	}

	public static function getAllRetornos($tipo)
	{
		$data = date('Y-m-d');
		if($tipo == 'hoje'){
			$qtdRetornos = Yii::app()
				->db
				->createCommand("
					SELECT count(*) as c
					  FROM cliente
					where cli.status < 3
					  and cli.data_retorno = '$data'")
				->queryAll();
			return $qtdRetornos[0]['c'];
		} else {
			$qtdRetornos = Yii::app()
				->db
				->createCommand("
					SELECT count(*) as c
					  FROM cliente
					where cli.status < 3
					  and cli.data_retorno < '$data'")
				->queryAll();
			return $qtdRetornos[0]['c'];
		}
	}

	public function getPerfilOptions(){
		return array(
			self::GERENTE    => 'Gerente',
			self::SUPERVISOR => 'Supervisor',
			self::VENDEDOR   => 'Vendedor',
		);
	}
	
	public function getPerfilText(){
		$options = $this->getPerfilOptions();
		return $options[$this->perfil];
	}


	public function getStatusOptions()
	{
		return array(
			self::ATIVO   => 'Ativo',
			self::INATIVO => 'Inativo'
		);
	}

	public function getStatusText()
	{
		$options = $this->getStatusOptions();
		return $options[$this->status];
	}

	public static function getAniversarios(){
		$aniversarios = Yii::app()
			->db->createCommand("
				SELECT count(*) as f
				  FROM funcionario
				where DATE_FORMAT(data_nascimento, '%d/%m') = '" . date('d/m'). "'")->queryAll();
		return $aniversarios[0]['f'];
	}

	public function afterFind(){
		$this->data_admissao = date('d/m/Y', strtotime($this->data_admissao));
		$this->data_nascimento = date('d/m/Y', strtotime($this->data_nascimento));

		return parent::afterFind();
	}
}