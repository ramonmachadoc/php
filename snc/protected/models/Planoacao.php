<?php

class Planoacao extends CActiveRecord
{
	//STATUS
	const ENVIADO  = 'E';
	const PENDENTE = 'P';

	//STATUS AVALIACAO
	const EFICAZ    = 'F';
	const INEFICAZ  = 'I';

	public $responsavelnome;
	public $statusavaliacao;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'planoacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('responsavel_id, acaocorrecao, prazo,causaraiz_id', 'required', 'on'=>'cadastro'),
			array('statusavaliacao', 'required', 'on'=>'avaliacaoEficaz'),
			array('statusavaliacao, motivo', 'required', 'on'=>'avaliacaoIneficaz'),
			array('acaocorrecao,motivo', 'length', 'max'=>1000),
			array('planoacao_id, evento_id, responsavel_id, acaocorrecao, prazo, datacadastro, status,causaraiz_id', 'safe', 'on'=>'search'),
			array('planoacao_id, evento_id, responsavel_id, acaocorrecao, prazo, datacadastro, motivo, status, statusavaliacao, arquivo,causaraiz_id', 'safe'),

			/*array('arquivo',   'file',
                'safe'       => true,
                //'types'      => 'pdf,docx,doc,xls,xlsx',
                //'wrongType'  => '{attribute} não permitido! Tipos permitidos: (pdf, docx, doc, xls, xlsx)!',
                'maxSize'    => 52428800, // 50Mb  -  1024 * 1024 * 50 - em bytes
                'tooLarge'   => '{attribute} muito grande! Tamanho máximo: 50Mb',
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
			'responsavel' => array(self::BELONGS_TO, 'Usuario',  'responsavel_id'),
			'evento'      => array(self::BELONGS_TO, 'Evento',   'evento_id'),
			'porque'      => array(self::HAS_ONE,    'Porque',   'planoacao_id'),
			'ishikawa'    => array(self::HAS_ONE,    'Ishikawa', 'planoacao_id'),
			'causaraiz' => array(self::BELONGS_TO, 'Causaraiz',  'causaraiz_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'planoacao_id'    => 'ID',
			'evento_id'       => 'Evento',
			'responsavel_id'  => 'Responsável',
			'acaocorrecao'    => 'Ação Corretiva',
			'prazo'           => 'Prazo',
			'status'          => 'Status',
			'motivo'          => 'Motivo da Não Eficácia',
			'statusavaliacao' => 'Avaliação',
			'arquivo'         => 'Documento',
			'causaraiz_id'	  => 'Causa Raiz',
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

		$criteria->compare('planoacao_id',$this->planoacao_id);
		$criteria->compare('evento_id',$this->evento_id);
		$criteria->compare('responsavel_id',$this->responsavel_id);
		$criteria->compare('acaocorrecao',$this->acaocorrecao,true);
		$criteria->compare('prazo',$this->prazo,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('causaraiz_id',$this->causaraiz_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//STATUS
	public function getStatusOptions(){
		return array(
			self::ENVIADO  => 'Enviado',
			self::PENDENTE => 'Pendente',
		);
	}
	public function getStatusText(){
		$options = $this->getStatusOptions();
		return $options[$this->status];
	}

	/**
	 * Combo Status Avaliacao
	 */
	public function getStatusAvaliacaoOptions(){
		return array(
			self::EFICAZ   => 'Eficaz',
			self::INEFICAZ => 'Não Eficaz',
		);
	}

	public function getStatusAvaliacaoText(){
		$options = $this->getStatusAvaliacaoOptions();
		return $options[$this->status];
	}

	/**
	 * Combo Todos os Status (Envio e Avaliacao)
	 */
	public function getAllStatusOptions(){
		return array(
			self::ENVIADO  => 'Enviado',
			self::PENDENTE => 'Pendente',
			self::EFICAZ   => 'Eficaz',
			self::INEFICAZ => 'Não Eficaz',
		);
	}

	public function getAllStatusText(){
		$options = $this->getAllStatusOptions();
		return @$options[$this->status];
	}

 	/**
     *  Função chamada antes de salvar o $model
     */
    public function beforeSave() {
        if(!empty($this->prazo))
        	$this->prazo = Utils::converte($this->prazo);

        if(!empty($this->datacadastro))
        	$this->datacadastro = Utils::converte($this->datacadastro);

        return parent::beforeSave();
    }

 	/**
     *  Função chamada depois que a consulta eh realizada e antes de alimentar o model
     */
    public function afterFind() {
		$this->prazo        = Utils::converte($this->prazo,        'pt');
		$this->datacadastro = Utils::converte($this->datacadastro, 'pt');

        return parent::afterFind();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Planoacao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
