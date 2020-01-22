
<h3 id='tituloPagina'><i class="fa fa-exchange"></i> Acompanhamento de Evento</h3>


<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'realizar-acompanhamento-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'enctype' => 'multipart/form-data',
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>

	<!-- Acordeon EVENTO -->
	<?php echo $this->renderPartial('../evento/_acordeonEvento', array('evento'=>$model));  ?>

	<!-- Acordeon CONTENCAO -->
	<?php 
	if(!is_null($model->contencao))
		echo $this->renderPartial('../contencao/_acordeonContencao', array('contencao'=>$model->contencao));  
	?>

	<!-- Acordeon PAC -->
	<?php 
	if(!is_null($model->planosacao))
		echo $this->renderPartial('../planoacao/_acordeonPlanoacao', array('planosacao'=>$model->planosacao,'form'=>$form));  
	?>



	<h3 id='tituloPagina'><i class="fa fa-exchange"></i> Realizar Acompanhamento</h3>
	<hr style="margin-top: -10px">

	<?php echo $form->errorSummary($model); ?>

	<!-- MONITORAMENTO -->
	<?php echo $form->textAreaGroup($model, 'monitoramento',
		array(
			'wrapperHtmlOptions' => array(
				//'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'htmlOptions' => array('rows'=>4,'style'=>'width:100% !important'),
			)
		)
	); ?>

	<!-- OBSERVACAO -->
	<?php echo $form->textAreaGroup($model, 'observacao',
		array(
			'wrapperHtmlOptions' => array(
				//'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'htmlOptions' => array('rows'=>4,'style'=>'width:100% !important'),
			)
		)
	); ?>

	<div class="form-group">
		<label class="col-sm-2 control-label" for="Planoacao_arquivo">Documento</label>
		<div class="col-sm-5 col-sm-9">
			<!-- <input id="ytEvento_arquivo_acompanhamento" type="hidden" value="" name="Evento[arquivo_acompanhamento][]"> -->
			<input class="form-control" placeholder="Documento" name="Evento[arquivo_acompanhamento][]" id="Evento_arquivo_acompanhamento" type="file" multiple="">
		</div>
	</div>

	<!-- BOTAO -->
	<br><br>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType' => 'submit',
				'context'    => 'primary',
				'label'      => 'Salvar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>