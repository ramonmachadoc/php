
<script type="application/javascript">
	$( document ).ready(function() {

		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php //if($model->hasErrors() or !$model->isNewRecord ): ?>
			//mostraEmpresa();
		<?php //endif; ?>

	});

</script>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'causaraiz-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array('class' => 'well','style'=>'background:#ffffff;')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'tipo',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				//'class'=>'span5',
				'maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-cog"></i>'
	)); ?>

	<?php echo $form->textFieldGroup($model,'categoria',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				//'class'=>'span5',
				'maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-cog"></i>'
	)); ?>

	<?php echo $form->textFieldGroup($model,'codigo',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				//'class'=>'span5',
				'maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-cog"></i>'
	)); ?>

	<?php echo $form->textFieldGroup($model,'subcategoria',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				//'class'=>'span5',
				'maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-cog"></i>'
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
    $('#admgerenc-causaraiz').addClass('active');
</script>
