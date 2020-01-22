<?php
/* @var $this SetorController */
/* @var $data Setor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('setor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->setor_id), array('view', 'id'=>$data->setor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />


</div>