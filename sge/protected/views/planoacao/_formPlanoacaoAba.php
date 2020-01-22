<br>

<!-- Causa Raiz -->
<?php echo $form->dropDownListGroup($model, 'causaraiz_id',
	array(
		'wrapperHtmlOptions' => array(
			//'class' => 'col-sm-5',
		),

		'widgetOptions' => array(
			//'data' => CHtml::listData(Usuario::model()->findAllByAttributes(Array('setor_id'=>Yii::app()->user->getState('setor_id'),'auditado'=>'S','status'=>'A')),'usuario_id','nome'),
			'data'        => CHtml::listData(Causaraiz::model()->findAll(),'causaraiz_id','fullName'),
			'htmlOptions' => array(
				'empty' => '...:: Selecione uma Causa raiz ::...',
			),
		)
	)
); ?>

<!-- RESPONSAVEL -->
<?php echo $form->dropDownListGroup($model, 'responsavel_id',
	array(
		'wrapperHtmlOptions' => array(
			//'class' => 'col-sm-5',
		),

		'widgetOptions' => array(
			//'data' => CHtml::listData(Usuario::model()->findAllByAttributes(Array('setor_id'=>Yii::app()->user->getState('setor_id'),'auditado'=>'S','status'=>'A')),'usuario_id','nome'),
			'data' => CHtml::listData(Usuario::model()->findAllByAttributes(Array('setor_id'=>Yii::app()->user->getState('setor_id'),'status'=>'A')),'usuario_id','nome'),
			'htmlOptions' => array(
				'empty' => '...:: Selecione um Responsável ::...',
			),
		)
	)
); ?>


<!-- CONTENCAO -->
<?php echo $form->textAreaGroup($model, 'acaocorrecao',

	array(
		'wrapperHtmlOptions' => array(
			//'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'htmlOptions' => array('rows'=>4,'style'=>'width:100% !important'),
		)
	)
); ?>



<!-- PRAZO -->
<?php echo $form->datePickerGroup($model, 'prazo',
	array(
		'widgetOptions' => array(
			'options' => array(
				'format'     => 'dd/mm/yyyy',
				'viewformat' => 'yyyy-mm-dd',
				'autoclose'  => true,
			)
		),
		'wrapperHtmlOptions' => array(
			//'onchange'=>'preenchecodigoevento(this.value);',
		),
		'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
	)
); ?>

<!-- ARQUIVO -->
<?php //echo $form->fileFieldGroup($model, 'arquivo', array('wrapperHtmlOptions' => array('class' => 'col-sm-5'))); ?>

<div class="form-group">
	<label class="col-sm-2 control-label" for="Planoacao_arquivo">Documento</label>
	<div class="col-sm-5 col-sm-9">
		<input id="ytPlanoacao_arquivo" type="hidden" value="" name="Planoacao[arquivo]">
		<input class="form-control" placeholder="Documento" name="Planoacao[arquivo][]" id="Planoacao_arquivo" type="file" multiple="">
	</div>
</div>

<!-- BOTAO -->
<div class="form-actions">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'    => 'primary',
			//'htmlOptions' => 'margin-left: 50px',
			'label'      => $model->isNewRecord ? 'Enviar' : 'Enviar',
		)); ?>
</div>

<br>
