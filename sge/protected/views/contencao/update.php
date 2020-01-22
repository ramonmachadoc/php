<?php
/* @var $this ContencaoController */
/* @var $model Contencao */

$this->breadcrumbs=array(
	'Contencaos'=>array('index'),
	$model->contencao_id=>array('view','id'=>$model->contencao_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contencao', 'url'=>array('index')),
	array('label'=>'Create Contencao', 'url'=>array('create')),
	array('label'=>'View Contencao', 'url'=>array('view', 'id'=>$model->contencao_id)),
	array('label'=>'Manage Contencao', 'url'=>array('admin')),
);
?>

<h1>Update Contencao <?php echo $model->contencao_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>