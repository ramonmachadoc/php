
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'auditado_contencao_grid',
    'itemsCssClass'   => 'table table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->searchAuditadoContencao(),
    'filter'          => $model,
	'afterAjaxUpdate' => 'function(link,success,data){ reinstallDatePicker(); }',
    'columns'         => array(
        //'setor_id', 
        'codigo', 
        array(
            'name'   => 'empresa_id',
            'filter' => CHtml::listData(Empresa::model()->findAll(), 'empresa_id', 'nome'),
            'value'  => 'Empresa::Model()->FindByPk($data->empresa_id)->nome',
        ),
        array(
            'name'   => 'area_id',
            'filter' => CHtml::listData(Area::model()->findAll(), 'area_id', 'descricao'),
            'value'  => 'Area::Model()->FindByPk($data->area_id)->descricao',
        ),
        array(
            'name'   => 'tipoauditoria_id',
            'filter' => CHtml::listData(Tipoauditoria::model()->findAll(), 'tipoauditoria_id', 'descricao'),
            'value'  => 'Tipoauditoria::Model()->FindByPk($data->tipoauditoria_id)->descricao',
        ),
        
		array(
			'name' => 'dataevento',
			'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'       => $model,
				'attribute'   => 'dataevento',
				'language'    => 'pt-BR',
				'htmlOptions' => array(
					'id'    => 'auditado_contencao_datepicker',
					'class' => 'form-control',
				),
				'defaultOptions' => array(  // (#3)
					'showOn'            => 'focus',
					'dateFormat'        => 'dd/mm/yyyy',
					'showOtherMonths'   => true,
					'selectOtherMonths' => true,
					'changeMonth'       => true,
					'changeYear'        => true,
					'showButtonPanel'   => true,
				)
			), true),
		),

   
        array(
            'class'           => 'booster.widgets.TbButtonColumn',
            'header'          => 'Ações',
            'htmlOptions'     => array('style' => 'width: 85px;text-align:center'),
            'template'        => '{responder}',
            //'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("eventoid"=>Utils::encodeGET($data->primaryKey)))',
            //'updateButtonUrl' => 'Yii::app()->controller->createUrl("updaterespostacontencao",array("id"=>$data->primaryKey))',
            'buttons'         => array(
                //'update' => array('options' => array('style' => 'margin-left:5px;'),),
                'responder' => array(
                    'label'   => 'Enviar a Contenção',
                    'icon'    => 'fa fa-share',
                    'url'     => 'Yii::app()->createUrl("contencao/create", array("eventoid"=>Utils::encodeGET($data->primaryKey)))',
                    'options' => array('style'=>'margin-left:5px;'),
                ),
                /*'delete' => array(
                    'options'=>array('style'=>'margin-left:5px;'),
                ),*/
            ),
        ),

    ),
)); ?>
<br><br>

<?php /*Yii::app()->clientScript->registerScript('re-install-date-picker', 
	"// Reset the datepicker after gridview ajax
	function reinstallDatePicker(id, data) {
		$('#datepicker_dataevento1').datepicker(jQuery.extend());
        $('#Evento_setor_id').hide();
	};

	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);"
); */?>


