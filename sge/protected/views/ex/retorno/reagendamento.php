<script>
	$( document ).ready(function() {
		//$('#Cliente_data_retorno').val('');
		//$('#Cliente_data_venda').val('');
		//$('#Cliente_status option[value=""]').attr('selected','selected');
		if($('#Cliente_status').val() == 3){
			$('#reagendado').hide();
		} else if($('#Cliente_status').val() == 2) {
			$('#venda').hide();
		} else {
			$('#reagendado').hide();
			$('#venda').hide();
		}
		
		$("#Cliente_status option[value='<?php echo Cliente::AGENDADO; ?>']").remove();
		//$("#Cliente_status option[value='<?php echo Cliente::AGENDADO; ?>']").remove();
	});

	function exibeDataRetorno(option){
		if(option == 2){
			$('#reagendado').show(400);
			$('#venda').hide(400);
			//$('#Cliente_data_venda').val('');
		} else if(option == 3){
			$('#venda').show(400);
			$('#reagendado').hide(400);
			//$('#Cliente_data_retorno').val('');
		} else{
			//$('#Cliente_data_retorno').val('');
			//$('#Cliente_data_venda').val('');
			$('#reagendado').hide(400);
			$('#venda').hide(400);
		}
	}
</script>

<?php // $this->widget('booster.widgets.TbBreadcrumbs', array(
//	'links' => array('Gerenciar' => 'admin', 'Reagendamento'),
//));?>

<h3 id='tituloPagina'>
	<i class="glyphicon glyphicon-time"></i> Retorno do Cliente: <?php echo $model->nome; ?>
</h3>
   
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'cliente-reagendar-form',
	'type'                 => 'horizontal',
	'htmlOptions'          => array('class'=>'well'),
	'enableAjaxValidation' => false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<!-- STATUS -->
	<div class="form-group">
		<label class="col-sm-2 control-label" for="Cliente_status">Status</label>
		<div class="col-sm-9">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				<?php echo Chtml::activeDropDownList($model, 'status', 
					$model->getStatusOptions(),
					array('class'    => 'form-control col-sm-4',
					 	  'empty'    => '...:: Selecione ::...',
					 	  'onChange' => 'exibeDataRetorno(this.value)',
					)
				); ?>
			</div>
		</div>
	</div>

	<!-- DATA RETORNO -->
	<div id='reagendado'>
		<?php echo $form->datePickerGroup($model, 'data_retorno',
			array(
				'widgetOptions' => array(
					'options' => array('format' => 'dd/mm/yyyy',),
				),
				'wrapperHtmlOptions' => array(),
				'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
			)
		); ?>
	</div>


	<!-- DATA VENDA -->
	<div id='venda'>
		<?php echo $form->datePickerGroup($model, 'data_venda',
			array(
				'widgetOptions' => array(
					'options' => array('format' => 'dd/mm/yyyy',),
				),
				'wrapperHtmlOptions' => array(),
				'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
			)
		); ?>
	</div>

	<!-- JUSTIFICATIVA -->
	<?php echo $form->textAreaGroup($model, 'justificativa',
		array(
			'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
			'widgetOptions' => array('htmlOptions' => array('rows'=>4,'style'=>'width:100% !important'),)
		)
	); ?>

	<!-- BOTAO -->
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'    => 'primary',
			'label'      => 'Salvar',
			'htmlOptions'=> array('style'=>'width:200px'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
	$('#sub-menu-gerenciar').addClass('active');
	$('#sub-gerenciar-cli').addClass('active');
</script>