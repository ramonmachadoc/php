<?php
$this->breadcrumbs=array(
	'Enderecos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Endereco','url'=>array('index')),
array('label'=>'Manage Endereco','url'=>array('admin')),
);
?>

<h1>Create Endereco</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>