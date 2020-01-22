<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'setor-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array('class' => 'well','style'=>'background:#ffffff;')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<!-- NOME -->
	<?php echo $form->textFieldGroup($model,'descricao',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5','maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-user"></i>'
	)); ?>

	<?php echo $form->dropDownListGroup($model, 'cliente', array(
			'widgetOptions' => array(
				'data' => $model->getClienteOptions(),
				'htmlOptions' => array(
					'empty'    => '...:: Tipo de cliente ::...',
				),
			)
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
    $('#admgerenc-setor').addClass('active');
</script>
