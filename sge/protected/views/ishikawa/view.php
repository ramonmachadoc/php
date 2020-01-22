<?php
/* @var $this IshikawaController */
/* @var $model Ishikawa */

$this->breadcrumbs=array(
	'Ishikawas'=>array('index'),
	$model->ishikawa_id,
);

$this->menu=array(
	array('label'=>'List Ishikawa', 'url'=>array('index')),
	array('label'=>'Create Ishikawa', 'url'=>array('create')),
	array('label'=>'Update Ishikawa', 'url'=>array('update', 'id'=>$model->ishikawa_id)),
	array('label'=>'Delete Ishikawa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ishikawa_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ishikawa', 'url'=>array('admin')),
);
?>

<h1>View Ishikawa #<?php echo $model->ishikawa_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ishikawa_id',
		'planoacao_id',
		'metodoA',
		'metodoB',
		'metodoC',
		'maquinaA',
		'maquinaB',
		'maquinaC',
		'mensagemA',
		'mensagemB',
		'mensagemC',
		'meioA',
		'meioB',
		'meioC',
		'materialA',
		'materialB',
		'materialC',
		'maoA',
		'maoB',
		'maoC',
	),
)); ?>
