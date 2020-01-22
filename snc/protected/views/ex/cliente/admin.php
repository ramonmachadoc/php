<style>
	.fundoBranco{background:#fff;}
	.espacoBotoes{margin-left: 5px;}
</style>

<h3><i class="fa fa-list-alt"></i> Gerenciar Clientes</h3>
<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'cliente-grid',
	'itemsCssClass'=>'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'enableSorting' => true,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		'nome',
		'fone',
		array(
			'name' => 'data_retorno',
			'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'data_retorno',
				'language' => 'pt-BR',
				'htmlOptions' => array(
					'id'=>'datepicker_data_retorno',
					'class' => 'form-control',
				),
				'defaultOptions' => array(  // (#3)
					'showOn' => 'focus',
					'dateFormat' => 'dd/mm/yyyy',
					'showOtherMonths' => true,
					'selectOtherMonths' => true,
					'changeMonth' => true,
					'changeYear' => true,
					'showButtonPanel' => true,
				)
			), true),
		),
		'modelo_moto',
		array('name' => 'filter_funcionario', 'value' => '$data->vendedor->nome'),
		array('name' => 'status', 'value' => '$data->statusText', 'filter' => $model->statusOptions),
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'header'=>'Ações',
			'htmlOptions'=>array('style'=>'width: 85px;text-align:center'),
			'template'=>'{view}{update}{retorno}',
			'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
			'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
			//'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
            'buttons'=>array(
                'update' => array
                (
                    'options'=>array('style'=>'margin-left:5px;'),
                ),
                'retorno' => array
                (
                    'label'=>'Retorno',
                    'icon'=>'time',
                    //'url'=>'Yii::app()->createUrl("retorno/reagendar", array("id"=>$data->id_cliente))',
                    'url'=>'Yii::app()->createUrl("retorno/view", array("id"=>$data->id_cliente))',
                    'options'=>array('style'=>'margin-left:5px;'),
                ),
                /*'delete' => array
                (
                    'options'=>array('style'=>'margin-left:5px;'),
                ),*/
			),
		),

	),
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
// Reset the datepicker after gridview ajax
function reinstallDatePicker(id, data) {
    $('#datepicker_data_retorno').datepicker(jQuery.extend());
};

$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
");

?>

<script>
	$('#sub-menu-gerenciar').addClass('active');
	$('#sub-gerenciar-cli').addClass('active');
</script>

