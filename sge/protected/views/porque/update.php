<?php
/* @var $this PorqueController */
/* @var $model Porque */

$this->breadcrumbs=array(
	'Porques'=>array('index'),
	$model->porque_id=>array('view','id'=>$model->porque_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Porque', 'url'=>array('index')),
	array('label'=>'Create Porque', 'url'=>array('create')),
	array('label'=>'View Porque', 'url'=>array('view', 'id'=>$model->porque_id)),
	array('label'=>'Manage Porque', 'url'=>array('admin')),
);
?>

<h1>Update Porque <?php echo $model->porque_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>