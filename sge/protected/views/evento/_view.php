<?php
/* @var $this eventoController */
/* @var $data evento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('evento_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->evento_id), array('view', 'id'=>$data->evento_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setor_id')); ?>:</b>
	<?php echo CHtml::encode($data->setor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origemevento_id')); ?>:</b>
	<?php echo CHtml::encode($data->origemevento_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipoevento_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipoevento_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataevento')); ?>:</b>
	<?php echo CHtml::encode($data->dataevento); ?>
	<br />










	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('origemauditor')); ?>:</b>
	<?php echo CHtml::encode($data->origemauditor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataauditoria')); ?>:</b>
	<?php echo CHtml::encode($data->dataauditoria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataenvio')); ?>:</b>
	<?php echo CHtml::encode($data->dataenvio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prazoresposta')); ?>:</b>
	<?php echo CHtml::encode($data->prazoresposta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enviou')); ?>:</b>
	<?php echo CHtml::encode($data->enviou); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusenvio')); ?>:</b>
	<?php echo CHtml::encode($data->statusenvio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requisito')); ?>:</b>
	<?php echo CHtml::encode($data->requisito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricaorequisito')); ?>:</b>
	<?php echo CHtml::encode($data->descricaorequisito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricaoevento')); ?>:</b>
	<?php echo CHtml::encode($data->descricaoevento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipoevento')); ?>:</b>
	<?php echo CHtml::encode($data->tipoevento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('analisederisco')); ?>:</b>
	<?php echo CHtml::encode($data->analisederisco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('severidade')); ?>:</b>
	<?php echo CHtml::encode($data->severidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probabilidade')); ?>:</b>
	<?php echo CHtml::encode($data->probabilidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('risco')); ?>:</b>
	<?php echo CHtml::encode($data->risco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nivel')); ?>:</b>
	<?php echo CHtml::encode($data->nivel); ?>
	<br />

	*/ ?>

</div>