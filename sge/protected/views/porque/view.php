<?php
/* @var $this PorqueController */
/* @var $model Porque */

$this->breadcrumbs=array(
	'Porques'=>array('index'),
	$model->porque_id,
);

$this->menu=array(
	array('label'=>'List Porque', 'url'=>array('index')),
	array('label'=>'Create Porque', 'url'=>array('create')),
	array('label'=>'Update Porque', 'url'=>array('update', 'id'=>$model->porque_id)),
	array('label'=>'Delete Porque', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->porque_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Porque', 'url'=>array('admin')),
);
?>

<h1>View Porque #<?php echo $model->porque_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'porque_id',
		'planoacao_id',
		'cr11',
		'cr12',
		'cr13',
		'cr14',
		'cr15',
		'cr21',
		'cr22',
		'cr23',
		'cr24',
		'cr25',
		'cr31',
		'cr32',
		'cr33',
		'cr34',
		'cr35',
		'cr41',
		'cr42',
		'cr43',
		'cr44',
		'cr45',
		'cr51',
		'cr52',
		'cr53',
		'cr54',
		'cr55',
	),
)); ?>
