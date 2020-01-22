<?php
/* @var $this PorqueController */
/* @var $model Porque */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'porque-form',
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
		<?php echo $form->labelEx($model,'cr11'); ?>
		<?php echo $form->textField($model,'cr11',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr11'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr12'); ?>
		<?php echo $form->textField($model,'cr12',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr12'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr13'); ?>
		<?php echo $form->textField($model,'cr13',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr13'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr14'); ?>
		<?php echo $form->textField($model,'cr14',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr14'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr15'); ?>
		<?php echo $form->textField($model,'cr15',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr15'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr21'); ?>
		<?php echo $form->textField($model,'cr21',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr21'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr22'); ?>
		<?php echo $form->textField($model,'cr22',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr22'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr23'); ?>
		<?php echo $form->textField($model,'cr23',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr23'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr24'); ?>
		<?php echo $form->textField($model,'cr24',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr24'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr25'); ?>
		<?php echo $form->textField($model,'cr25',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr25'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr31'); ?>
		<?php echo $form->textField($model,'cr31',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr31'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr32'); ?>
		<?php echo $form->textField($model,'cr32',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr32'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr33'); ?>
		<?php echo $form->textField($model,'cr33',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr33'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr34'); ?>
		<?php echo $form->textField($model,'cr34',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr34'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr35'); ?>
		<?php echo $form->textField($model,'cr35',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr35'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr41'); ?>
		<?php echo $form->textField($model,'cr41',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr41'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr42'); ?>
		<?php echo $form->textField($model,'cr42',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr42'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr43'); ?>
		<?php echo $form->textField($model,'cr43',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr43'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr44'); ?>
		<?php echo $form->textField($model,'cr44',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr44'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr45'); ?>
		<?php echo $form->textField($model,'cr45',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr45'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr51'); ?>
		<?php echo $form->textField($model,'cr51',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr51'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr52'); ?>
		<?php echo $form->textField($model,'cr52',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr52'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr53'); ?>
		<?php echo $form->textField($model,'cr53',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr53'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr54'); ?>
		<?php echo $form->textField($model,'cr54',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr54'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr55'); ?>
		<?php echo $form->textField($model,'cr55',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cr55'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->