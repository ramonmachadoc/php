<?php
/* @var $this PorqueController */
/* @var $model Porque */

$this->breadcrumbs=array(
	'Porques'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Porque', 'url'=>array('index')),
	array('label'=>'Manage Porque', 'url'=>array('admin')),
);
?>

<h1>Create Porque</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>