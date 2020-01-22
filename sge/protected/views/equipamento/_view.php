<?php
/* @var $this EquipamentoController */
/* @var $data Equipamento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('equipamento_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->equipamento_id), array('view', 'id'=>$data->equipamento_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />


</div>