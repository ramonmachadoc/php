<?php
class Evento extends CActiveRecord
{
	//ENVIOU - ANALISE DE RISCO
	const SIM = 'S';
	const NAO = 'N';

	//SEVERIDADE
	const A = 'A';
	const B = 'B';
	const C = 'C';
	const D = 'D';
	const E = 'E';

	//PROBABILIDADE
	const PROB01 = '1';
	const PROB02 = '2';
	const PROB03 = '3';
	const PROB04 = '4';
	const PROB05 = '5';

	//NIVEL
	const AC = 'AC';
	const TO = 'TO';
	const IN = 'IN';

	//CRITICIDADES
	const CRITCD01 = 'CRITCD01';
	const CRITCD02 = 'CRITCD02';
	const CRITCD03 = 'CRITCD03';
	const CRITCD04 = 'CRITCD04';
	const CRITCD05 = 'CRITCD05';
	const CRITCD06 = 'CRITCD06';
	const CRITCD07 = 'CRITCD07';
	const CRITCD08 = 'CRITCD08';
	const CRITCD09 = 'CRITCD09';
	const CRITCD10 = 'CRITCD10';
	const CRITCD11 = 'CRITCD11';

	//STATUS
	const ENVIADO    = 'E';
	const PENDENTE   = 'P';
	const FINALIZADO = 'F';


	//utilizado na alteracao para nao peder o nome do aqruivo
	public $nomeArquivo;
	public $_diasAtrasados;
	public $_dtInicialFilter;
	public $_dtFinalFilter;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'evento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('empresa_id, setor_id, origemauditado_id, codigo, tipoauditoria_id, dataevento,  requisito,
				   descricaorequisito, descricaoevento, auditorrelator_id, origemauditor_id, criticidade, prazoresposta,
				   analisederisco,numeroitem,numerochecklist,qntditens',
				   'required', 'on'=>'GERENTE_AUDITADO'),

			array('area_id, empresa_id, setor_id, origemauditado_id, codigo, tipoauditoria_id, dataevento,  requisito,
				   descricaorequisito, descricaoevento, auditorrelator_id, origemauditor_id, criticidade, prazoresposta,
				   numeroitem,numerochecklist,qntditens',
				   'required', 'on'=>'OUTRAS_AREAS_ANALISERISCO_NAO'),

			array('area_id, empresa_id, setor_id, origemauditado_id, codigo, tipoauditoria_id, dataevento,  requisito,
				   descricaorequisito, descricaoevento, auditorrelator_id, origemauditor_id, criticidade, prazoresposta,
				    probabilidade, severidade, risco, nivel,numeroitem,numerochecklist,qntditens',
				   'required', 'on'=>'OUTRAS_AREAS_ANALISERISCO_SIM'),

			array('area_id, empresa_id, setor_id, origemauditado_id, codigo, tipoauditoria_id, dataevento,  requisito,
				   descricaorequisito, descricaoevento, auditorrelator_id, origemauditor_id,  criticidade, prazoresposta,
				   equipamento_id, dataentregareporte, analisederisco,numeroitem,numerochecklist,qntditens',
				   'required', 'on'=>'SGSO_ANALISERISCO_NAO'),

			array('area_id, empresa_id, setor_id, origemauditado_id, codigo, tipoauditoria_id, dataevento,  requisito,
				   descricaorequisito, descricaoevento, auditorrelator_id, origemauditor_id, criticidade, prazoresposta,
				   equipamento_id, dataentregareporte, analisederisco, probabilidade, severidade, risco, nivel,numeroitem
					 ,numerochecklist,qntditens',
				   'required', 'on'=>'SGSO_ANALISERISCO_SIM'),

			array('acompanhado, monitoramento, observacao',
				   'required', 'on'=>'ACOMPANHAMENTO'),

			array('_dtInicialFilter, _dtFinalFilter',
				   'required', 'on'=>'INDICADORES-PIZZA'),


			array('codigo',           'length', 'max'=>20),
			array('origemauditor_id', 'length', 'max'=>50),
			array('risco, nivel',     'length', 'max'=>2),
			array('analisederisco, severidade, probabilidade', 'length', 'max'=>1),

			array('area_id, empresa_id, evento_id, auditorrelator_id, setor_id, origemauditado_id, tipoauditoria_id,
				   codigo, dataevento, origemauditor_id, requisito, descricaorequisito,numerochecklist,qntditens,
				   descricaoevento, criticidade, analisederisco, severidade, probabilidade, risco, nivel, arquivo_acompanhamento,numeroitem',
				  'safe', 'on'=>'search'),

			//array('dataevento,statuscontencao,statusplanoacao', 'safe', 'on'=>'searchAuditadoContencao'),

			array('auditorrelator_id, area_id, dataentregareporte, empresa_id, evento_id, auditorrelator_id, equipamento_id, usuario_id, setor_id, origemauditado_id,
				   tipoauditoria_id, codigo, dataevento, origemauditor_id, datacadastro,
				   prazoresposta, requisito,numeroitem,numerochecklist,qntditens,
				   descricaorequisito, descricaoevento, criticidade, analisederisco, severidade,
				   probabilidade, risco, nivel, arquivo, status, acompanhado, monitoramento, observacao, arquivo_acompanhamento,
				   _dtInicialFilter, _dtFinalFilter', 'safe'),

			//array('arquivo', 'validaArquivo'),
            /*array('arquivo',   'file',
                  'safe'       => true,
                  //'types'      => 'pdf,docx,doc,xls,xlsx',
                  //'wrongType'  => '{attribute} não permitido! Tipos permitidos: (pdf, docx, doc, xls, xlsx).',
                  'maxSize'    => 52428800, // 50Mb  -  1024 * 1024 * 50 - em bytes
                  'tooLarge'   => '{attribute} muito grande! Tamanho máximo: 10Mb',
                  'allowEmpty' => true  //se mudarmos pra false ou comentarmos, aparece duas mensagens de erro do arquivo no from
            ),*/

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
			'contencao'      => array(self::HAS_ONE,    'Contencao',      'evento_id'),
			'planosacao'     => array(self::HAS_MANY,   'Planoacao',      'evento_id'),
			'area'           => array(self::BELONGS_TO, 'Area',           'area_id'),
			'origemauditado' => array(self::BELONGS_TO, 'Origemauditado', 'origemauditado_id'),
			'origemauditor'  => array(self::BELONGS_TO, 'Origemauditor',  'origemauditor_id'),
			'empresa'        => array(self::BELONGS_TO, 'Empresa',        'empresa_id'),
			'setor'          => array(self::BELONGS_TO, 'Setor',          'setor_id'),
			'tipoauditoria'  => array(self::BELONGS_TO, 'Tipoauditoria',  'tipoauditoria_id'),
			'usuario'        => array(self::BELONGS_TO, 'Usuario',        'usuario_id'),
			'auditorrelator' => array(self::BELONGS_TO, 'Auditorrelator', 'auditorrelator_id'),
			'equipamento'    => array(self::BELONGS_TO, 'Equipamento',    'equipamento_id'),
			'Criticidade' 	 => array(self::BELONGS_TO, 'Criticidade', 'criticidade_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'evento_id'          => 'ID',
			'area_id'            => 'Área',
			'usuario_id'         => 'Usuário',
			'auditorrelator_id'  => 'Auditor/Relator',
			'setor_id'           => 'Setor Envolvido',
			'empresa_id'         => 'Empresa',
			'origemauditado_id'  => 'Origem do Auditado',
			'tipoauditoria_id'   => 'Tipo de Evento',
			'equipamento_id'     => 'Equipamento/Aeronave',

			'codigo'             => 'Código',
			'dataevento'         => 'Data do Evento/Auditoria',
			'origemauditor_id'   => 'Origem do Auditor',
			'dataentregareporte' => 'Data da Entrega do Reporte',

			'datacadastro'       => 'Data do Cadastro',
			'dataauditoria'      => 'Data da Auditoria',
			'prazoresposta'      => 'Prazo de Resposta',

			'requisito'          => 'Item do Check-List',
			'descricaorequisito' => 'Descricao do Item do Check-List',
			'descricaoevento'    => 'Descricao do Evento',
			'criticidade'        => 'Nível de Criticidade',
			'analisederisco'     => 'Análise de Risco',
			'severidade'         => 'Severidade',
			'probabilidade'      => 'Probabilidade',
			'risco'              => 'Risco',
			'nivel'              => 'Nivel',

			'arquivo'            => 'Documento Vinculado',

			'acompanhado'        => 'Acompanhado',
			'monitoramento'      => 'Ação de Monitoramento',
			'observacao'         => 'Observações',

			'arquivo_acompanhamento' => 'Arquivo Acompanhamento',

			'_dtInicialFilter'   => 'Data Inicial',
			'_dtFinalFilter'     => 'Data Final',

			'numeroitem'				=> 'Código Item',
			'numerochecklist'   => 'Check-List',
			'qntditens'					=> 'Quantidade de itens aplicáveis',
		);
	}


	public function searchIndicadores($evento)
	{
		//ADM
		if( Yii::app()->user->perfil == Permissao::ADMINISTRADOR  ){
			$areaIdSessao = $evento->area_id;
		}//GERENTE/AUDITOR
		else if( Yii::app()->user->perfil == Permissao::GERENTE or Yii::app()->user->perfil == Permissao::AUDITOR ) {
			$areaIdSessao    = Yii::app()->user->area_id;
			$empresaIdSessao = Yii::app()->user->empresa_id;
		}

		$evento->empresa_id       = $evento->empresa_id==""       ? '%' : $evento->empresa_id;
		$evento->setor_id         = $evento->setor_id==""         ? '%' : $evento->setor_id;
		$evento->tipoauditoria_id = $evento->tipoauditoria_id=="" ? '%' : $evento->tipoauditoria_id;

		$evento->numeroitem				= $evento->numeroitem=="" ? '%' : $evento->numeroitem;
		$evento->numerochecklist  = $evento->numerochecklist=="" ? '%' : $evento->numerochecklist;

		$result = Yii::app()->db->createCommand("
			select criticidade as label , count(criticidade) as value
			from evento
			where area_id          like    '".$areaIdSessao."'               and
				  empresa_id       like    '".$evento->empresa_id."'         and
				  setor_id         like    '".$evento->setor_id."'           and
				  tipoauditoria_id like    '".$evento->tipoauditoria_id."'   and
					numeroitem				like	 '".$evento->numeroitem."'				 and
					numerochecklist   like   '".$evento->numerochecklist."'		and
				  dataevento       between '".Utils::converte($evento->_dtInicialFilter)."'   and '".Utils::converte($evento->_dtFinalFilter)."'
			group by criticidade
		")->queryAll();


		return $result;
	}


	/**
	 *
	 */
	public function searchAcompanharPendente()
	{
		$criteria = new CDbCriteria;

		$criteria->addCondition('status = "'.Evento::FINALIZADO.'"');
		$criteria->addCondition('acompanhado IS NULL');

		$criteria->order = 'dataencerramento ASC';


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 *
	 */
	public function searchAcompanharConcluido()
	{
		$criteria = new CDbCriteria;

		$criteria->addCondition('status = "'.Evento::FINALIZADO.'"');
		$criteria->addCondition('acompanhado = "'.Evento::SIM.'"');

		$criteria->order = 'dataencerramento ASC';



		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 *
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('empresa_id',         $this->empresa_id);
		$criteria->compare('area_id',            $this->area_id);
		$criteria->compare('setor_id',           $this->setor_id);
		$criteria->compare('tipoauditoria_id',   $this->tipoauditoria_id);
		$criteria->compare('codigo',             $this->codigo,             true);
		$criteria->compare('equipamento_id',     $this->equipamento_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		$criteria->order = 'evento_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 */
	public function searchAuditadoContencao()
	{
		$criteria = new CDbCriteria;
		//$criteria->with = array( 'setor' );
		//$criteria->with = array('tweTicketPriceLevels' => array('alias'=>'pl'));

		$criteria->compare('codigo',           $this->codigo, true);
		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		//$criteria->addCondition('setor_id = '.Yii::app()->user->setor_id );

		///////////////////////
		if(isset(Yii::app()->user->perfil)){
			if( Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO )
			{
				$sql = "select GROUP_CONCAT(DISTINCT setor_id SEPARATOR ',') as setor
						from permissao
						where usuario_id = ".Yii::app()->user->usuario_id." and empresa_id = ".Yii::app()->user->empresa_id;
				$r = Yii::app()->db->createCommand($sql)->queryAll();
				$criteria->addCondition("setor_id IN(".$r[0]['setor'].")");
				//$criteria->addCondition("setor_id IN(".Yii::app()->user->setor_id.")");

			}
			else{
				$criteria->addCondition("setor_id IN(".Yii::app()->user->setor_id.")");
			}
		}
		///////////////////////

		$criteria->addCondition('statuscontencao IS NULL');
		//$criteria->addCondition('statusplanoacao IS NULL');

		//$criteria->addCondition('status = "'.Evento::ENVIADO.'"');

		$criteria->order = 'evento_id DESC';



		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 *
	 */
	public function searchAuditadoPlanoacao()
	{
		$criteria = new CDbCriteria;
		//$criteria->with = array( 'setor' );
		//$criteria->with = array('tweTicketPriceLevels' => array('alias'=>'pl'));

		$criteria->compare('codigo',           $this->codigo, true);
		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );

		//$criteria->addCondition('setor_id = '.Yii::app()->user->setor_id );

		if(isset(Yii::app()->user->perfil)){
			if( Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO )
			{
				$sql = "select GROUP_CONCAT(DISTINCT setor_id SEPARATOR ',') as setor
						from permissao
						where usuario_id = ".Yii::app()->user->usuario_id." and empresa_id = ".Yii::app()->user->empresa_id;
				$r = Yii::app()->db->createCommand($sql)->queryAll();
				$criteria->addCondition("setor_id IN(".$r[0]['setor'].")");


			}
			else{
				$criteria->addCondition("setor_id IN(".Yii::app()->user->setor_id.")");
			}
		}

		/*$criteria->addCondition('(statuscontencao = "'.Contencao::EFICAZ.'"  or
								  statuscontencao = "'.Contencao::INEFICAZ.'" ) ');

		$criteria->addCondition('(statusplanoacao is NULL or
								  statusplanoacao = "'.Planoacao::INEFICAZ.'" )');

		$criteria->addCondition('status = "'.Evento::ENVIADO.'"');*/

		$criteria->addCondition('(statuscontencao IS NULL or
								  statuscontencao = "'.Contencao::ENVIADO.'" or
								  statuscontencao = "'.Contencao::EFICAZ.'"  or
								  statuscontencao = "'.Contencao::INEFICAZ.'" ) ');

		$criteria->addCondition('(statusplanoacao is NULL or
								  statusplanoacao = "'.Planoacao::INEFICAZ.'" )');

		$criteria->addCondition('status = "'.Evento::ENVIADO.'" or status = "'.Evento::PENDENTE.'"');

		$criteria->order = 'evento_id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 */
	public function searchAuditadoAnalise()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('codigo',           $this->codigo, true);
		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		//$criteria->addCondition('setor_id = '.Yii::app()->user->setor_id );

		///////////////////////
		if(isset(Yii::app()->user->perfil)){
			if( Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO )
			{
				$sql = "select GROUP_CONCAT(DISTINCT setor_id SEPARATOR ',') as setor
						from permissao
						where usuario_id = ".Yii::app()->user->usuario_id." and empresa_id = ".Yii::app()->user->empresa_id;
				$r = Yii::app()->db->createCommand($sql)->queryAll();
				$criteria->addCondition("setor_id IN(".$r[0]['setor'].")");
				//$criteria->addCondition("setor_id IN(".Yii::app()->user->setor_id.")");

			}
			else{
				$criteria->addCondition("setor_id IN(".Yii::app()->user->setor_id.")");
			}
		}
		///////////////////////


		$criteria->addCondition('(statuscontencao IS NULL or
								  statuscontencao = "'.Contencao::ENVIADO.'" or
								  statuscontencao = "'.Contencao::EFICAZ.'"  or
								  statuscontencao = "'.Contencao::INEFICAZ.'" ) ');

		$criteria->addCondition('(statusplanoacao is NULL or
								  statusplanoacao = "'.Planoacao::ENVIADO.'" )');

		$criteria->addCondition('status = "'.Evento::PENDENTE.'"');

		$criteria->order = 'evento_id DESC';



		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 */
	public function searchAuditadoEncerrados()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('codigo',           $this->codigo, true);
		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		//$criteria->addCondition('setor_id = '.Yii::app()->user->setor_id );

		///////////////////////
		if(isset(Yii::app()->user->perfil)){
			if( Yii::app()->user->perfil == Permissao::GERENTE_AUDITADO )
			{
				$sql = "select GROUP_CONCAT(DISTINCT setor_id SEPARATOR ',') as setor
						from permissao
						where usuario_id = ".Yii::app()->user->usuario_id." and empresa_id = ".Yii::app()->user->empresa_id;
				$r = Yii::app()->db->createCommand($sql)->queryAll();
				$criteria->addCondition("setor_id IN(".$r[0]['setor'].")");
				//$criteria->addCondition("setor_id IN(".Yii::app()->user->setor_id.")");

			}
			else{
				$criteria->addCondition("setor_id IN(".Yii::app()->user->setor_id.")");
			}
		}
		///////////////////////


		$criteria->addCondition('status = "'.Evento::FINALIZADO.'"');

		$criteria->order = 'evento_id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 */
	public function searchAdministradorAberto()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('codigo',           $this->codigo, true);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('setor_id',         $this->setor_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		$criteria->addCondition('statuscontencao is null');
		$criteria->addCondition('statusplanoacao is null');
		$criteria->addCondition('status = "'.Evento::ENVIADO.'"');


		//ADM
		if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR  ){
			$criteria->addCondition("area_id != ''");
			$criteria->addCondition("empresa_id != ''" );
		}//GERENTE/AUDITOR
		else if( isset(Yii::app()->user->perfil) and (Yii::app()->user->perfil == Permissao::GERENTE or Yii::app()->user->perfil == Permissao::AUDITOR) ) {
			$criteria->addCondition('area_id = '.Yii::app()->user->area_id );
			$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		}

		$criteria->order = 'evento_id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 */
	public function searchAdministradorContencao()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('codigo',           $this->codigo, true);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('setor_id',         $this->setor_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));


		//ADM
		if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR  ){
			$criteria->addCondition("area_id != ''");
			$criteria->addCondition("empresa_id != ''" );
		}//GERENTE/AUDITOR
		else if( isset(Yii::app()->user->perfil) and (Yii::app()->user->perfil == Permissao::GERENTE or Yii::app()->user->perfil == Permissao::AUDITOR) ) {
			$criteria->addCondition('area_id = '.Yii::app()->user->area_id );
			$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		}


		$criteria->addCondition('statuscontencao = "'.Contencao::ENVIADO.'"');
		$criteria->addCondition('status = "'.Evento::PENDENTE.'"');

		$criteria->order = 'evento_id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 */
	public function searchAdministradorPlanoacao()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('codigo',           $this->codigo, true);
		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('setor_id',         $this->setor_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		/*$criteria->addCondition('(statuscontencao = "'.Contencao::EFICAZ.'"  or
								  statuscontencao = "'.Contencao::INEFICAZ.'" ) ');
		*/
		$criteria->addCondition('statusplanoacao = "'.Planoacao::ENVIADO.'"');
		$criteria->addCondition('status = "'.Evento::PENDENTE.'"');


		//ADM
		if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR  ){
			$criteria->addCondition("area_id != ''");
			$criteria->addCondition("empresa_id != ''" );
		}//GERENTE/AUDITOR
		else if( isset(Yii::app()->user->perfil) and (Yii::app()->user->perfil == Permissao::GERENTE or Yii::app()->user->perfil == Permissao::AUDITOR) ) {
			$criteria->addCondition('area_id = '.Yii::app()->user->area_id );
			$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		}

		$criteria->order = 'evento_id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 */
	public function searchAdministradorProcesso()
	{
		$criteria = new CDbCriteria;
		//$criteria->with = 'planosacao';
		//$criteria->with = array("planosacao"=>array("select"=>"prazo"));
		//$criteria->with = array('planosacao'=>array('select'=>'planoacao.prazoresposta','together'=>true));

		$criteria->compare('codigo',           $this->codigo, true);
		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('setor_id',         $this->setor_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		$criteria->addCondition('(statuscontencao = "'.Contencao::EFICAZ.'"  or
								  statuscontencao = "'.Contencao::INEFICAZ.'" ) ');
		$criteria->addCondition('(statusplanoacao is NULL or
								  statusplanoacao = "'.Planoacao::ENVIADO.'" )');
		$criteria->addCondition('status = "'.Evento::ENVIADO.'"');

		//ADM
		if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR  ){
			$criteria->addCondition("area_id != ''");
			$criteria->addCondition("empresa_id != ''" );
		}//GERENTE/AUDITOR
		else if( isset(Yii::app()->user->perfil) and (Yii::app()->user->perfil == Permissao::GERENTE or Yii::app()->user->perfil == Permissao::AUDITOR) ) {
			$criteria->addCondition('area_id = '.Yii::app()->user->area_id );
			$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		}

		$criteria->order = 'evento_id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 *
	 */
	public function searchAdministradorEncerrado()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('codigo',           $this->codigo, true);
		$criteria->compare('empresa_id',       $this->empresa_id);
		$criteria->compare('setor_id',         $this->setor_id);
		$criteria->compare('area_id',          $this->area_id);
		$criteria->compare('tipoauditoria_id', $this->tipoauditoria_id);

		$criteria->compare('numeroitem',				 $this->numeroitem,					true);
		$criteria->compare('numerochecklist',		 $this->numerochecklist);

		if($this->dataevento != "")
			$criteria->compare('dataevento',   Utils::converte($this->dataevento));

		$criteria->addCondition('status = "'.Evento::FINALIZADO.'"');


		//ADM
		if( isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR  ){
			$criteria->addCondition("area_id != ''");
			$criteria->addCondition("empresa_id != ''" );
		}//GERENTE/AUDITOR
		else if( isset(Yii::app()->user->perfil) and (Yii::app()->user->perfil == Permissao::GERENTE or Yii::app()->user->perfil == Permissao::AUDITOR) ) {
			$criteria->addCondition('area_id = '.Yii::app()->user->area_id );
			$criteria->addCondition('empresa_id = '.Yii::app()->user->empresa_id );
		}

		$criteria->order = 'evento_id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return evento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//ANALISE DE RISCO
	public function getAnalisederiscoOptions(){
		return array(
			self::SIM => 'Sim',
			self::NAO => 'Não',
		);
	}
	public function getAnalisederiscoText(){
		$options = $this->getAnalisederiscoOptions();
		return $options[$this->analisederisco];
	}

	//STATUS
	public function getStatusOptions(){
		return array(
			self::ENVIADO    => 'Enviado',
			self::PENDENTE   => 'Pendente Avaliação',
			self::FINALIZADO => 'Finalizado',
		);
	}
	public function getStatusText(){
		$options = $this->getStatusOptions();
		return $options[$this->status];
	}

	//STATUS CONTENCAO
	public function getStatusContencaoOptions(){
		return array(
			self::ENVIADO    => 'Enviado',
			self::FINALIZADO => 'Finalizado',
		);
	}
	public function getStatusContencaoText(){
		$options = $this->getStatusContencaoOptions();
		return $options[$this->statuscontencao];
	}

	//STATUS PLANOACAO
	public function getStatusPlanoacaoOptions(){
		return array(
			self::ENVIADO    => 'Enviado',
			self::FINALIZADO => 'Finalizado',
		);
	}
	public function getStatusPlanoacaoText(){
		$options = $this->getStatusPlanoacaoOptions();
		return $options[$this->statusplanoacao];
	}

	//SEVERIDADE
	public function getSeveridadeOptions(){
		return array(
			self::A => 'A - Catastrófica',
			self::B => 'B - Crítico',
			self::C => 'C - Significativo',
			self::D => 'D - Pequeno',
			self::E => 'E - Insignificante',
		);
	}
	public function getSeveridadeText(){
		$options = $this->getSeveridadeOptions();
		return @$options[$this->severidade];
	}

	//PROBABILIDADE
	public function getProbabilidadeOptions(){
		return array(
			self::PROB01 => '01 - Muito Improvável',
			self::PROB02 => '02 - Improvável',
			self::PROB03 => '03 - Remoto',
			self::PROB04 => '04 - Ocasional',
			self::PROB05 => '05 - Frequente',
		);
	}
	public function getProbabilidadeText(){
		$options = $this->getProbabilidadeOptions();
		return @$options[$this->probabilidade];
	}

	//NIVEL
	public function getNivelOptions(){
		return array(
			self::AC => 'Aceitável',
			self::TO => 'Tolerável',
			self::IN => 'Intolerável',
		);
	}
	public function getNivelText(){
		$options = $this->getNivelOptions();
		return @$options[$this->nivel];
	}

	//CRITICIDADES
	public function getCriticidadeOptions(){
		return array(
			self::CRITCD01 => 'Crítica',
			self::CRITCD02 => 'Documentado e Implementado',
			self::CRITCD03 => 'Documentado e Implementado - Observação',
			self::CRITCD04 => 'Documentado e Implementado - Recomendação',
			self::CRITCD05 => 'Documentado e Não Implementado',
			self::CRITCD06 => 'Implementado e Não Documentado',
			self::CRITCD07 => 'Maior',
			self::CRITCD08 => 'Menor',
			self::CRITCD09 => 'Não Documentado e Não Implementado',
			self::CRITCD10 => 'N/A',
			self::CRITCD11 => 'Observação',
		);
	}
	public function getCriticidadeText(){
		$options = $this->getCriticidadeOptions();
		return $options[$this->criticidade];
	}

  	/**
     *  Função Statica que muda o status de um EVENTO
     */
	public static function mudaStatus($id, $status){
		$model = Evento::model()->findByPk($id);
		$model->status = $status;
		$model->save(false);

		return true;
	}

  	/**
     *  Função chamada antes de salvar o $model
     */
    public function beforeSave() {
        if(!empty($this->dataentregareporte))
        	$this->dataentregareporte = Utils::converte($this->dataentregareporte);

        if(!empty($this->dataevento))
        	$this->dataevento = Utils::converte($this->dataevento);

        if(!empty($this->prazoresposta))
        	$this->prazoresposta = Utils::converte($this->prazoresposta);

        if(!empty($this->datacadastro))
        	$this->datacadastro = Utils::converte($this->datacadastro);

        return parent::beforeSave();
    }

 	/**
     *  Função chamada depois que a consulta eh realizada e antes de alimentar o model
     */
    public function afterFind() {

		if(!empty($this->dataentregareporte))
			$this->dataentregareporte = Utils::converte($this->dataentregareporte, 'pt');

		if(!empty($this->dataevento))
			$this->dataevento = Utils::converte($this->dataevento, 'pt');

		if(!empty($this->prazoresposta))
			$this->prazoresposta = Utils::converte($this->prazoresposta, 'pt');

		if(!empty($this->datacadastro))
    		$this->datacadastro = Utils::converte($this->datacadastro, 'pt');

		$this->nomeArquivo = $this->arquivo;

        //$this->_diasAtrasados = Utils::calcularQuantidadeDiasEntreDuasDatas($this->prazoresposta,$this->datacadastro);


        return parent::afterFind();
    }

  	/**
     *  Função chamada antes de validar o model
     */
    /*public function beforeValidate() {
        return parent::beforeValidate();
    }*/

}
