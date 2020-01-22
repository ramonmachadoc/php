<?php
/* @var $this OrigemauditorController */
/* @var $data Origemauditor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('origemauditor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->origemauditor_id), array('view', 'id'=>$data->origemauditor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />


</div>