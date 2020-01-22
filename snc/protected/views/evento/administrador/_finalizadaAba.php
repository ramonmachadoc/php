<!--
<h3 style="margin-bottom:-13px">
    <i class="fa fa-sort-amount-asc"></i> Eventos com Contenção Pendente
</h3>
-->

<div class="alert alert-info" role="alert" style="margin-bottom: -12px">
    <i class="fa fa-thumbs-o-up">
    </i> Não Conformidades Finalizadas
</div>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'eventoSetorContencao-grid',
    'itemsCssClass'   => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->searchAuditadoFinalizada(),
    'filter'          => $model,
	'afterAjaxUpdate' => 'function(link,success,data){ reinstallDatePicker(); }',
    'columns'         => array(

        /*array(
            'name'   => 'setor_id',
            //'filter' => CHtml::listData(Setor::model()->findAll(), 'empresa_id', 'nome'),
            'value'  => 'Setor::Model()->FindByPk($data->setor_id)->descricao',
        ),*/

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

        'codigo', 

		array(
			'name' => 'dataevento',
			'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'       => $model,
				'attribute'   => 'dataevento',
				'language'    => 'pt-BR',
				'htmlOptions' => array(
					'id'    => 'datepicker_dataevento1',
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
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("viewcontencao", array("id"=>$data->primaryKey))',
        ),

    ),
)); ?>


<?php /*Yii::app()->clientScript->registerScript('re-install-date-picker', 
	"// Reset the datepicker after gridview ajax
	function reinstallDatePicker(id, data) {
		$('#datepicker_dataevento1').datepicker(jQuery.extend());
        $('#Evento_setor_id').hide();
	};

	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);"
); */?>


