<?php
/* @var $this IshikawaController */
/* @var $model Ishikawa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ishikawa_id'); ?>
		<?php echo $form->textField($model,'ishikawa_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'planoacao_id'); ?>
		<?php echo $form->textField($model,'planoacao_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metodoA'); ?>
		<?php echo $form->textField($model,'metodoA',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metodoB'); ?>
		<?php echo $form->textField($model,'metodoB',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metodoC'); ?>
		<?php echo $form->textField($model,'metodoC',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maquinaA'); ?>
		<?php echo $form->textField($model,'maquinaA',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maquinaB'); ?>
		<?php echo $form->textField($model,'maquinaB',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maquinaC'); ?>
		<?php echo $form->textField($model,'maquinaC',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mensagemA'); ?>
		<?php echo $form->textField($model,'mensagemA',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mensagemB'); ?>
		<?php echo $form->textField($model,'mensagemB',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mensagemC'); ?>
		<?php echo $form->textField($model,'mensagemC',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meioA'); ?>
		<?php echo $form->textField($model,'meioA',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meioB'); ?>
		<?php echo $form->textField($model,'meioB',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meioC'); ?>
		<?php echo $form->textField($model,'meioC',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'materialA'); ?>
		<?php echo $form->textField($model,'materialA',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'materialB'); ?>
		<?php echo $form->textField($model,'materialB',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'materialC'); ?>
		<?php echo $form->textField($model,'materialC',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maoA'); ?>
		<?php echo $form->textField($model,'maoA',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maoB'); ?>
		<?php echo $form->textField($model,'maoB',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maoC'); ?>
		<?php echo $form->textField($model,'maoC',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->