<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cliente')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_cliente),array('view','id'=>$data->id_cliente)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fone')); ?>:</b>
	<?php echo CHtml::encode($data->fone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_cadastro')); ?>:</b>
	<?php echo CHtml::encode($data->data_cadastro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aniversario')); ?>:</b>
	<?php echo CHtml::encode($data->aniversario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observacao')); ?>:</b>
	<?php echo CHtml::encode($data->observacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('justificativa')); ?>:</b>
	<?php echo CHtml::encode($data->justificativa); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('data_retorno')); ?>:</b>
	<?php echo CHtml::encode($data->data_retorno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pagamento')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pagamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modelo_moto')); ?>:</b>
	<?php echo CHtml::encode($data->modelo_moto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_indicacao')); ?>:</b>
	<?php echo CHtml::encode($data->nome_indicacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fone_indicacao')); ?>:</b>
	<?php echo CHtml::encode($data->fone_indicacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_funcionario')); ?>:</b>
	<?php echo CHtml::encode($data->id_funcionario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endereco_id')); ?>:</b>
	<?php echo CHtml::encode($data->endereco_id); ?>
	<br />

	*/ ?>

</div>