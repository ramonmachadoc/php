<?php
/* @var $this AcompanhamentoController */
/* @var $model Acompanhamento */

$this->breadcrumbs=array(
	'Acompanhamentos'=>array('index'),
	$model->acompanhamento_id=>array('view','id'=>$model->acompanhamento_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Acompanhamento', 'url'=>array('index')),
	array('label'=>'Create Acompanhamento', 'url'=>array('create')),
	array('label'=>'View Acompanhamento', 'url'=>array('view', 'id'=>$model->acompanhamento_id)),
	array('label'=>'Manage Acompanhamento', 'url'=>array('admin')),
);
?>

<h1>Update Acompanhamento <?php echo $model->acompanhamento_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>