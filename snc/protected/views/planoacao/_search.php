<?php
/* @var $this PlanoacaoController */
/* @var $model Planoacao */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'planoacao_id'); ?>
		<?php echo $form->textField($model,'planoacao_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'causaraiz_id'); ?>
		<?php echo $form->textField($model,'causaraiz_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evento_id'); ?>
		<?php echo $form->textField($model,'evento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsavel_id'); ?>
		<?php echo $form->textField($model,'responsavel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acaocorrecao'); ?>
		<?php echo $form->textField($model,'acaocorrecao',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prazo'); ?>
		<?php echo $form->textField($model,'prazo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
