<?php
/* @var $this PlanoacaoController */
/* @var $data Planoacao */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('planoacao_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->planoacao_id), array('view', 'id'=>$data->planoacao_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evento_id')); ?>:</b>
	<?php echo CHtml::encode($data->evento_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('causaraiz_id')); ?>:</b>
	<?php echo CHtml::encode($data->causaraiz); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsavel_id')); ?>:</b>
	<?php echo CHtml::encode($data->responsavel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acaocorrecao')); ?>:</b>
	<?php echo CHtml::encode($data->acaocorrecao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prazo')); ?>:</b>
	<?php echo CHtml::encode($data->prazo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>
