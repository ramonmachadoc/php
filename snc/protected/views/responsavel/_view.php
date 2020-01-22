<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsavel_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->responsavel_id), array('view', 'id'=>$data->responsavel_id)); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

</div>
