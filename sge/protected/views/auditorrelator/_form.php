<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'auditorrelator-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array('class' => 'well','style'=>'background:#ffffff;')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<!-- NOME -->
	<?php echo $form->textFieldGroup($model,'nome',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5','maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-user"></i>'
	)); ?>

	<!-- SETOR -->
	<?php echo $form->textFieldGroup($model,'setor',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5','maxlength'=>100
			),
		),
		//'prepend' => '<i class="fa fa-user"></i>'
	)); ?>

	<!-- EMAIL -->
	<?php echo $form->textFieldGroup($model,'email',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5','maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-at"></i>'
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
    $('#admgerenc-auditor').addClass('active');
</script>