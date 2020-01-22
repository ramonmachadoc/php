<?php
/* @var $this AcompanhamentoController */
/* @var $model Acompanhamento */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'acompanhamento_id'); ?>
		<?php echo $form->textField($model,'acompanhamento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correcao_id'); ?>
		<?php echo $form->textField($model,'correcao_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'encerramento'); ?>
		<?php echo $form->textField($model,'encerramento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'encerrada'); ?>
		<?php echo $form->textField($model,'encerrada',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monitoramento'); ?>
		<?php echo $form->textArea($model,'monitoramento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observacao'); ?>
		<?php echo $form->textArea($model,'observacao',array('rows'=>6, 'cols'=>50)); ?>
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