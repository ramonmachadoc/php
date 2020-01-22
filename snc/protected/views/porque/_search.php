<?php
/* @var $this PorqueController */
/* @var $model Porque */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'porque_id'); ?>
		<?php echo $form->textField($model,'porque_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'planoacao_id'); ?>
		<?php echo $form->textField($model,'planoacao_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr11'); ?>
		<?php echo $form->textField($model,'cr11',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr12'); ?>
		<?php echo $form->textField($model,'cr12',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr13'); ?>
		<?php echo $form->textField($model,'cr13',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr14'); ?>
		<?php echo $form->textField($model,'cr14',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr15'); ?>
		<?php echo $form->textField($model,'cr15',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr21'); ?>
		<?php echo $form->textField($model,'cr21',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr22'); ?>
		<?php echo $form->textField($model,'cr22',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr23'); ?>
		<?php echo $form->textField($model,'cr23',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr24'); ?>
		<?php echo $form->textField($model,'cr24',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr25'); ?>
		<?php echo $form->textField($model,'cr25',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr31'); ?>
		<?php echo $form->textField($model,'cr31',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr32'); ?>
		<?php echo $form->textField($model,'cr32',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr33'); ?>
		<?php echo $form->textField($model,'cr33',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr34'); ?>
		<?php echo $form->textField($model,'cr34',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr35'); ?>
		<?php echo $form->textField($model,'cr35',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr41'); ?>
		<?php echo $form->textField($model,'cr41',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr42'); ?>
		<?php echo $form->textField($model,'cr42',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr43'); ?>
		<?php echo $form->textField($model,'cr43',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr44'); ?>
		<?php echo $form->textField($model,'cr44',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr45'); ?>
		<?php echo $form->textField($model,'cr45',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr51'); ?>
		<?php echo $form->textField($model,'cr51',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr52'); ?>
		<?php echo $form->textField($model,'cr52',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr53'); ?>
		<?php echo $form->textField($model,'cr53',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr54'); ?>
		<?php echo $form->textField($model,'cr54',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr55'); ?>
		<?php echo $form->textField($model,'cr55',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->