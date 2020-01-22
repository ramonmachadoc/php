<?php
/* @var $this AcompanhamentoController */
/* @var $model Acompanhamento */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'acompanhamento-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'correcao_id'); ?>
		<?php echo $form->textField($model,'correcao_id'); ?>
		<?php echo $form->error($model,'correcao_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'encerramento'); ?>
		<?php echo $form->textField($model,'encerramento'); ?>
		<?php echo $form->error($model,'encerramento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'encerrada'); ?>
		<?php echo $form->textField($model,'encerrada',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'encerrada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monitoramento'); ?>
		<?php echo $form->textArea($model,'monitoramento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'monitoramento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'observacao'); ?>
		<?php echo $form->textArea($model,'observacao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'observacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->