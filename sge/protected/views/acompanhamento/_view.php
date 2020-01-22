<?php
/* @var $this AcompanhamentoController */
/* @var $data Acompanhamento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('acompanhamento_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->acompanhamento_id), array('view', 'id'=>$data->acompanhamento_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correcao_id')); ?>:</b>
	<?php echo CHtml::encode($data->correcao_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('encerramento')); ?>:</b>
	<?php echo CHtml::encode($data->encerramento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('encerrada')); ?>:</b>
	<?php echo CHtml::encode($data->encerrada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monitoramento')); ?>:</b>
	<?php echo CHtml::encode($data->monitoramento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observacao')); ?>:</b>
	<?php echo CHtml::encode($data->observacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>