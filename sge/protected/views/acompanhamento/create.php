<?php
/* @var $this AcompanhamentoController */
/* @var $model Acompanhamento */

$this->breadcrumbs=array(
	'Acompanhamentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Acompanhamento', 'url'=>array('index')),
	array('label'=>'Manage Acompanhamento', 'url'=>array('admin')),
);
?>

<h1>Create Acompanhamento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>