<?php
/* @var $this ContencaoController */
/* @var $data Contencao */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('contencao_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->contencao_id), array('view', 'id'=>$data->contencao_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evento_id')); ?>:</b>
	<?php echo CHtml::encode($data->evento_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsavel')); ?>:</b>
	<?php echo CHtml::encode($data->responsavel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('causaraiz')); ?>:</b>
	<?php echo CHtml::encode($data->causaraiz); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acaocontencao')); ?>:</b>
	<?php echo CHtml::encode($data->acaocontencao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prazo')); ?>:</b>
	<?php echo CHtml::encode($data->prazo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vencimento')); ?>:</b>
	<?php echo CHtml::encode($data->vencimento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('statusvencimento')); ?>:</b>
	<?php echo CHtml::encode($data->statusvencimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eficacia')); ?>:</b>
	<?php echo CHtml::encode($data->eficacia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>