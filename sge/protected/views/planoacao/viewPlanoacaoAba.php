<br>

<!-- CAUSA RAIZ -->
<?php echo $form->textFieldGroup($model,'causaraiz_id',
	array('widgetOptions'=>array(
		'htmlOptions'=>array(
			'readonly'  => true,
			'value'  => @$model->causaraiz->fullName,
		),
	),
)); ?>

<!-- RESPONSAVEL -->
<?php echo $form->textFieldGroup($model,'responsavelNome',
	array('widgetOptions'=>array(
		'htmlOptions'=>array(
			'readonly'  => true,
			'value'  => @$model->responsavel->nome,
		),
	),
)); ?>

<!--
<div class="form-group">
	<label class="col-sm-2 control-label required" for="Evento_codigo">Responsável</label>
	<div class="col-sm-9">
		<div class="input-group">
			<input readonly="readonly" class="form-control" type="text" value="<?php //echo $planoacao->responsavel->nome; ?>" />
		</div>
	</div>
</div>
-->


<!-- CONTENCAO -->
<?php echo $form->textAreaGroup($model, 'acaocorrecao',
	array(
		'wrapperHtmlOptions' => array(
			//'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'htmlOptions' => array('rows'=>4,'style'=>'width:100% !important','readonly'  => true,),
		)
	)
); ?>

<!-- PRAZO -->
<?php echo $form->textFieldGroup(@$model,'prazo',
	array('widgetOptions'=>array(
		'htmlOptions'=>array('readonly'  => true),
	),
	'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
)); ?>

<!-- DOCUMENTO -->
<div class="form-group">
	<label class="col-sm-2 control-label">Documento</label>
	<div class="col-sm-9">

		<?php
			$arquivos = explode(";", $model->arquivo);
            $arquivos = array_filter($arquivos);

            foreach ($arquivos as $f) {
				echo CHtml::link($f, array("upload/{$f}"), array('target'=>'_blank'));
                echo "<br/>";
            }

		?>

	</div>
</div>

<!-- STATUS -->
<?php echo $form->textFieldGroup($model,'status',
	array('widgetOptions'=>array(
		'htmlOptions'=>array(
			'readonly'  => true,
			'value'  => $model->getAllStatusText(),
		),
	),
)); ?>
