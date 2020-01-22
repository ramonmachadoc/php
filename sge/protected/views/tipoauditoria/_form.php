<script>
	$(document).ready(function() {
		$("#Tipoauditoria_sigla").keyup(function(){
			$(this).val($(this).val().toUpperCase());
		})
	});
</script>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'tipoauditoria-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array('class' => 'well','style'=>'background:#ffffff;')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<!-- DESCRICAO -->
	<?php echo $form->textFieldGroup($model,'descricao',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5','maxlength'=>100
			),
		),
	)); ?>

	<!-- SIGLA -->
	<?php echo $form->textFieldGroup($model,'sigla',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>2,
				'style'=>'width:300px'
			),
		),
	)); ?>

	<!-- BOTAO -->
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType' => 'submit',
				'context'    => 'primary',
				'label'      => $model->isNewRecord ? 'Cadastrar' : 'Alterar',
			)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-tipoevento').addClass('active');
</script>