<?php
/* @var $this IshikawaController */
/* @var $model Ishikawa */

$this->breadcrumbs=array(
	'Ishikawas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ishikawa', 'url'=>array('index')),
	array('label'=>'Manage Ishikawa', 'url'=>array('admin')),
);
?>

<h1>Create Ishikawa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>