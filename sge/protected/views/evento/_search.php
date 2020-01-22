<?php
/* @var $this eventoController */
/* @var $model evento */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'evento_id'); ?>
		<?php echo $form->textField($model,'evento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_id'); ?>
		<?php echo $form->textField($model,'usuario_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'setor_id'); ?>
		<?php echo $form->textField($model,'setor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipoevento_id'); ?>
		<?php echo $form->textField($model,'tipoevento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipoevento_id'); ?>
		<?php echo $form->textField($model,'tipoevento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero'); ?>
		<?php echo $form->textField($model,'numero',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dataevento'); ?>
		<?php echo $form->textField($model,'dataevento'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'origemauditor'); ?>
		<?php //echo $form->textField($model,'origemauditor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dataauditoria'); ?>
		<?php echo $form->textField($model,'dataauditoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dataenvio'); ?>
		<?php echo $form->textField($model,'dataenvio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prazoresposta'); ?>
		<?php echo $form->textField($model,'prazoresposta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enviou'); ?>
		<?php echo $form->textField($model,'enviou',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusenvio'); ?>
		<?php echo $form->textField($model,'statusenvio',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'requisito'); ?>
		<?php echo $form->textArea($model,'requisito',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descricaorequisito'); ?>
		<?php echo $form->textArea($model,'descricaorequisito',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descricaoevento'); ?>
		<?php echo $form->textArea($model,'descricaoevento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipoevento'); ?>
		<?php echo $form->textField($model,'tipoevento',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'analisederisco'); ?>
		<?php echo $form->textField($model,'analisederisco',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'severidade'); ?>
		<?php echo $form->textField($model,'severidade',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probabilidade'); ?>
		<?php echo $form->textField($model,'probabilidade',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'risco'); ?>
		<?php echo $form->textField($model,'risco',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nivel'); ?>
		<?php echo $form->textField($model,'nivel',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->