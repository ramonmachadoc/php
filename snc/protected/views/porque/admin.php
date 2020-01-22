<?php
/* @var $this PorqueController */
/* @var $model Porque */

$this->breadcrumbs=array(
	'Porques'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Porque', 'url'=>array('index')),
	array('label'=>'Create Porque', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#porque-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Porques</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'porque-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'porque_id',
		'planoacao_id',
		'cr11',
		'cr12',
		'cr13',
		'cr14',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
