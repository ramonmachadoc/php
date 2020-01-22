<?php
/* @var $this IshikawaController */
/* @var $model Ishikawa */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ishikawa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'planoacao_id'); ?>
		<?php echo $form->textField($model,'planoacao_id'); ?>
		<?php echo $form->error($model,'planoacao_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metodoA'); ?>
		<?php echo $form->textField($model,'metodoA',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'metodoA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metodoB'); ?>
		<?php echo $form->textField($model,'metodoB',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'metodoB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metodoC'); ?>
		<?php echo $form->textField($model,'metodoC',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'metodoC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maquinaA'); ?>
		<?php echo $form->textField($model,'maquinaA',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'maquinaA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maquinaB'); ?>
		<?php echo $form->textField($model,'maquinaB',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'maquinaB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maquinaC'); ?>
		<?php echo $form->textField($model,'maquinaC',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'maquinaC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mensagemA'); ?>
		<?php echo $form->textField($model,'mensagemA',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mensagemA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mensagemB'); ?>
		<?php echo $form->textField($model,'mensagemB',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mensagemB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mensagemC'); ?>
		<?php echo $form->textField($model,'mensagemC',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mensagemC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meioA'); ?>
		<?php echo $form->textField($model,'meioA',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'meioA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meioB'); ?>
		<?php echo $form->textField($model,'meioB',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'meioB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meioC'); ?>
		<?php echo $form->textField($model,'meioC',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'meioC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'materialA'); ?>
		<?php echo $form->textField($model,'materialA',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'materialA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'materialB'); ?>
		<?php echo $form->textField($model,'materialB',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'materialB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'materialC'); ?>
		<?php echo $form->textField($model,'materialC',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'materialC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maoA'); ?>
		<?php echo $form->textField($model,'maoA',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'maoA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maoB'); ?>
		<?php echo $form->textField($model,'maoB',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'maoB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maoC'); ?>
		<?php echo $form->textField($model,'maoC',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'maoC'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->