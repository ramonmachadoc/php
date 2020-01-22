<?php
/* @var $this ContencaoController */
/* @var $model Contencao */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'contencao_id'); ?>
		<?php echo $form->textField($model,'contencao_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evento_id'); ?>
		<?php echo $form->textField($model,'evento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsavel'); ?>
		<?php echo $form->textField($model,'responsavel',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'causaraiz'); ?>
		<?php echo $form->textArea($model,'causaraiz',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acaocontencao'); ?>
		<?php echo $form->textArea($model,'acaocontencao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prazo'); ?>
		<?php echo $form->textField($model,'prazo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vencimento'); ?>
		<?php echo $form->textField($model,'vencimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusvencimento'); ?>
		<?php echo $form->textField($model,'statusvencimento',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eficacia'); ?>
		<?php echo $form->textField($model,'eficacia',array('size'=>1,'maxlength'=>1)); ?>
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