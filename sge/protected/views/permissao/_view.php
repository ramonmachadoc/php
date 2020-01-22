<?php
/* @var $this PermissaoController */
/* @var $data Permissao */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('permissao_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->permissao_id), array('view', 'id'=>$data->permissao_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('empresa_id')); ?>:</b>
	<?php echo CHtml::encode($data->empresa_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_id')); ?>:</b>
	<?php echo CHtml::encode($data->area_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('perfil')); ?>:</b>
	<?php echo CHtml::encode($data->perfil); ?>
	<br />


</div>