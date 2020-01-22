
<script type="application/javascript">
	$( document ).ready(function() {

		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php //if($model->hasErrors() or !$model->isNewRecord ): ?>
			//mostraEmpresa();
		<?php //endif; ?>

	});

</script>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'responsavel-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array('class' => 'well','style'=>'background:#ffffff;')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<!-- SETOR -->
	<?php echo $form->dropDownListGroup($model, 'setor_id', array(
		'widgetOptions' => array(
			'data'        => CHtml::listData(Setor::model()->findAll(),'setor_id','descricao'),
			'htmlOptions' => array('empty' => '...:: Selecione um Setor ::...'),
		)
	)); ?>

	<!-- NOME -->
	<?php echo $form->textFieldGroup($model,'nome',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				//'class'=>'span5',
				'maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-user"></i>'
	)); ?>

	<!-- CPF -->
	<?php echo $form->textFieldGroup($model,'cpf',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				//'class'=>'span5',
				'maxlength'=>14
			),
		),
		//'prepend' => '<i class="fa fa-user"></i>'
	)); ?>

	<!-- EMAIL -->
	<?php echo $form->textFieldGroup($model,'email', array(
		'widgetOptions'=>array(
			'htmlOptions'=>array('maxlength'=>100),
		),
		'prepend' => '<i class="fa fa-at"></i>'
	)); ?>

	<!-- STATUS -->
	<?php echo $form->dropDownListGroup($model, 'status', array(
		'widgetOptions' => array(
			'data' => $model->getStatusOptions(),
			'htmlOptions' => array(
				'empty'    => '...:: Selecione um Status ::...',
				//'style'    => 'width: 300px',
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
    $('#admgerenc-responsavel').addClass('active');
</script>
