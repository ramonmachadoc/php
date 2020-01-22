<?php

class Contencao extends CActiveRecord
{
	// APLICAVEL
	const SIM = 'S';
	const NAO = 'N';

	//STATUS
	const ENVIADO  = 'E';
	const PENDENTE = 'P';

	//STATUS AVALIACAO
	const EFICAZ    = 'F';
	const INEFICAZ  = 'I';

	//public $statusavaliacao; 

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contencao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aplicavel', 'required', 'on'=>'aplicavelNAO'),
			array('aplicavel, evento_id, contencao, prazo, responsavel_id', 'required', 'on'=>'aplicavelSIM'),
			array('status', 'required', 'on'=>'avaliarContecao'),
			array('evento_id, aplicavel, responsavel_id, contencao, prazo, arquivo, status', 'safe'),
			array('contencao_id, evento_id, prazo', 'safe', 'on'=>'search'),

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
			'evento'      => array(self::HAS_ONE,    'Evento',  'evento_id'),
			'responsavel' => array(self::BELONGS_TO, 'Usuario', 'responsavel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'contencao_id'   => 'Contencao',
			'evento_id'      => 'Evento',
			'aplicavel'      => 'Contenção Necessária?',
			'contencao'      => 'Contenção',
			'responsavel_id' => 'Responsavel',
			'prazo'          => 'Prazo',
			'arquivo'        => 'Documento',
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

		$criteria->compare('contencao_id',$this->contencao_id);
		$criteria->compare('evento_id',$this->evento_id);
		$criteria->compare('responsavel_id',$this->responsavel_id,true);
		$criteria->compare('prazo',$this->prazo,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Combo Aplicavel
	 */
	public function getAplicavelOptions(){
		return array(
			self::SIM => 'Sim',
			self::NAO => 'Não',
		);
	}
	
	public function getAplicavelText(){
		$options = $this->getAplicavelOptions();
		return $options[$this->aplicavel];
	}

	/**
	 * Combo Status
	 */
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
	 * Combo todos os Status (Envio e Avaliacao)
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
		return $options[$this->status];
	}

 	/**
     *  Função chamada antes de salvar o $model
     */
    public function beforeSave() {
        if(!empty($this->prazo))
        	$this->prazo = Utils::converte($this->prazo);
        else 
        	$this->prazo = null;

        return parent::beforeSave();
    }

 	/**
     *  Função chamada depois que a consulta eh realizada e antes de alimentar o model
     */
    public function afterFind() {
    	if(!is_null($this->prazo))
			$this->prazo = Utils::converte($this->prazo, 'pt');

        return parent::afterFind();
    }  


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contencao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
