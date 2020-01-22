<?php
//	$this->widget(
//		'booster.widgets.TbBreadcrumbs',
//		array(
//			'links' => array('Aniversários'),
//		)
//	);
//?>

<style>
	.fundoBranco{background:#fff;}
	.espacoBotoes{margin-left: 5px;}
</style>

<h3><i class="fa fa-birthday-cake"></i> Aniversário de Clientes</h3>
<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'cliente-grid',
	'itemsCssClass'=>'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'enableSorting' => true,
	'columns'=>array(
		'nome',
		'fone',
		'email',
		array('name' => 'filter_funcionario', 'value' => '$data->vendedor->nome'),
		array('name' => 'status', 'value' => '$data->statusText', 'filter' => $model->statusOptions),
		/*array(
			'class'=>'booster.widgets.TbButtonColumn',
			'header'=>'Ações',
			'htmlOptions'=>array('style'=>'width: 85px;'),
			'template'=>'{view}',
			'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
		),*/

	),
)); ?>

<script>
	$('#sub-menu-gerenciar').addClass('active');
	$('#sub-gerenciar-cli').addClass('active');
</script>

