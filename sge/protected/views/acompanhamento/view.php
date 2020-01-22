<?php
/* @var $this AcompanhamentoController */
/* @var $model Acompanhamento */

$this->breadcrumbs=array(
	'Acompanhamentos'=>array('index'),
	$model->acompanhamento_id,
);

$this->menu=array(
	array('label'=>'List Acompanhamento', 'url'=>array('index')),
	array('label'=>'Create Acompanhamento', 'url'=>array('create')),
	array('label'=>'Update Acompanhamento', 'url'=>array('update', 'id'=>$model->acompanhamento_id)),
	array('label'=>'Delete Acompanhamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->acompanhamento_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Acompanhamento', 'url'=>array('admin')),
);
?>

<h1>View Acompanhamento #<?php echo $model->acompanhamento_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'acompanhamento_id',
		'correcao_id',
		'encerramento',
		'encerrada',
		'monitoramento',
		'observacao',
		'status',
	),
)); ?>
