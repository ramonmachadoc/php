<?php
/* @var $this IshikawaController */
/* @var $model Ishikawa */

$this->breadcrumbs=array(
	'Ishikawas'=>array('index'),
	$model->ishikawa_id=>array('view','id'=>$model->ishikawa_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ishikawa', 'url'=>array('index')),
	array('label'=>'Create Ishikawa', 'url'=>array('create')),
	array('label'=>'View Ishikawa', 'url'=>array('view', 'id'=>$model->ishikawa_id)),
	array('label'=>'Manage Ishikawa', 'url'=>array('admin')),
);
?>

<h1>Update Ishikawa <?php echo $model->ishikawa_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>