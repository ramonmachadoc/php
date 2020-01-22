<?php
/* @var $this AuditorrelatorController */
/* @var $data Auditorrelator */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('auditorrelator_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->auditorrelator_id), array('view', 'id'=>$data->auditorrelator_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setor')); ?>:</b>
	<?php echo CHtml::encode($data->setor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />


</div>