<?php
/* @var $this PlanoacaoController */
/* @var $model Planoacao */

$this->breadcrumbs=array(
	'Planoacaos'=>array('index'),
	$model->planoacao_id=>array('view','id'=>$model->planoacao_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Planoacao', 'url'=>array('index')),
	array('label'=>'Create Planoacao', 'url'=>array('create')),
	array('label'=>'View Planoacao', 'url'=>array('view', 'id'=>$model->planoacao_id)),
	array('label'=>'Manage Planoacao', 'url'=>array('admin')),
);
?>

<h1>Update Planoacao <?php echo $model->planoacao_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>