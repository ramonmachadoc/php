<script>
$( document ).ready(function() {
  
});
</script>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'cliente-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

	<!-- FUNCIONARIO -->
	<?php if(Yii::app()->user->perfil != Funcionario::VENDEDOR): ?>
		<?php echo $form->dropDownListGroup($model, 'id_funcionario',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'span5',
				),
				'widgetOptions' => array(
					'data' => CHtml::listData(Funcionario::model()->findAll('perfil=3 and status=1'),'id_funcionario','nome'),
					'htmlOptions' => array('empty'=>'...:: Selecione ::...'),
				),
				'prepend' => '<i class="fa fa-user"></i>'
			)
		); ?>
	<?php endif; ?>

	<!-- NOME -->
	<?php echo $form->textFieldGroup($model,'nome',array(
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>100)
			)
		)
	); ?>
	
	<!-- EMAIL -->
	<?php echo $form->textFieldGroup($model,'email',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>50
			)
		),
		'prepend' => '<i class="fa fa-at"></i>'
	)); ?>
	
	<!-- FONE -->
	<?php echo $form->textFieldGroup($model,'fone',array(
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>20)
			)
		),
		'prepend' => '<i class="fa fa-phone"></i>',
	)); ?>
	
	<!-- DATA ANIVERSARIO -->
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($model, 'aniversario', array('class' => 'col-sm-2 control-label')); ?>
		<div class="span5 col-sm-8">
			<div class="input-group">
				<div style="float: left">
					<?php echo Chtml::activeDropDownList($model, 'dia', $model->getDiaOptions(), array('class' => 'form-control col-sm-4','style'=>'border-radius:4px')); ?>
				</div>
				<div style="float: left;margin-left: 10px;">
					<?php echo Chtml::activeDropDownList($model, 'mes', $model->getMesOptions(), array('class' => 'form-control col-sm-4','style'=>'border-radius:4px')); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- COMPRA -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="display: inline;">
				<i class="fa fa-shopping-bag"></i> Dados da Compra</h3>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body" id="yw0">

			<?php echo $form->datePickerGroup($model, 'data_retorno',
				array(
					'widgetOptions' => array(
						'options' => array(
							'format' => 'dd/mm/yyyy',
							'viewformat' => 'yyyy-dd-mm',
						)
					),
					'wrapperHtmlOptions' => array(),
					'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
				)
			); ?>

			<?php echo $form->textFieldGroup($model,'modelo_moto',
				array('widgetOptions'=>array(
					'htmlOptions'=>array(
						'class'=>'span5',
						'maxlength'=>50
					)
				),
				'prepend' => '<i class="fa fa-motorcycle"></i>'
			)); ?>

			<?php echo $form->dropDownListGroup($model, 'forma_pagamento',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'span5',
					),
					'widgetOptions' => array(
						'data' => $model->getFormaPagamentoOptions(),
						'htmlOptions' => array('empty'=>'...:: Selecione ::...'),
					),
					'prepend' => '<i class="fa fa-usd"></i>'
				)
			); ?>
		</div>
	</div>	

	<!-- INDICACAO -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="display: inline;">
				<i class="fa fa-user-plus"></i> Indicação
			</h3>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<?php echo $form->textFieldGroup($model,'nome_indicacao',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>	
			<?php echo $form->textFieldGroup($model,'fone_indicacao',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>	
		</div>
	</div>	


	<!-- OBSERVAÇÃO -->
	<?php echo $form->textAreaGroup($model, 'observacao',
		array(
			'wrapperHtmlOptions' => array(
				'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'htmlOptions' => array('rows'=>4,'style'=>'width:100% !important'),
			)
		)
	); ?>


	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'    => 'primary',
			'label'      => $model->isNewRecord ? 'Cadastrar' : 'Alterar',
		)); ?>
	</div>

<?php echo CHtml::hiddenField('Cliente[origem]', $model->origem); ?>
<?php echo CHtml::hiddenField('Cliente[dataConsulta]', $model->dataConsulta); ?>

<?php $this->endWidget(); ?>

<script>
	$('#sub-menu-cadastros').addClass('active');
	$('#sub-cadastros-cli').addClass('active');
</script>