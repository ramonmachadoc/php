<?php
/* @var $this IshikawaController */
/* @var $data Ishikawa */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ishikawa_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ishikawa_id), array('view', 'id'=>$data->ishikawa_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('planoacao_id')); ?>:</b>
	<?php echo CHtml::encode($data->planoacao_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metodoA')); ?>:</b>
	<?php echo CHtml::encode($data->metodoA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metodoB')); ?>:</b>
	<?php echo CHtml::encode($data->metodoB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metodoC')); ?>:</b>
	<?php echo CHtml::encode($data->metodoC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maquinaA')); ?>:</b>
	<?php echo CHtml::encode($data->maquinaA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maquinaB')); ?>:</b>
	<?php echo CHtml::encode($data->maquinaB); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('maquinaC')); ?>:</b>
	<?php echo CHtml::encode($data->maquinaC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mensagemA')); ?>:</b>
	<?php echo CHtml::encode($data->mensagemA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mensagemB')); ?>:</b>
	<?php echo CHtml::encode($data->mensagemB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mensagemC')); ?>:</b>
	<?php echo CHtml::encode($data->mensagemC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meioA')); ?>:</b>
	<?php echo CHtml::encode($data->meioA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meioB')); ?>:</b>
	<?php echo CHtml::encode($data->meioB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meioC')); ?>:</b>
	<?php echo CHtml::encode($data->meioC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materialA')); ?>:</b>
	<?php echo CHtml::encode($data->materialA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materialB')); ?>:</b>
	<?php echo CHtml::encode($data->materialB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materialC')); ?>:</b>
	<?php echo CHtml::encode($data->materialC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maoA')); ?>:</b>
	<?php echo CHtml::encode($data->maoA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maoB')); ?>:</b>
	<?php echo CHtml::encode($data->maoB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maoC')); ?>:</b>
	<?php echo CHtml::encode($data->maoC); ?>
	<br />

	*/ ?>

</div>