
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'auditado_encerrado_grid',
    'itemsCssClass'   => 'table table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->searchAuditadoEncerrados(),
    'filter'          => $model,
	'afterAjaxUpdate' => 'function(link,success,data){ reinstallDatePicker(); }',
    'columns'         => array(
        //'setor_id', 
        /*array(
            'name'   => 'setor_id',
            'filter' => CHtml::listData(Setor::model()->findAll(), 'setor_id', 'nome'),
            'value'  => 'Setor::Model()->FindByPk($data->setor_id)->descricao',
        ),*/
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
					'id'    => 'auditado_encerrado_datepicker',
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
            'template'        => '{view}',
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("viewall", array("evento"=>Utils::encodeGET($data->primaryKey)))',
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


