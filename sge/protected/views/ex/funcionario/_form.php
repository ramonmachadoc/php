<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'funcionario-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'well','style'=>'background:#ffffff;')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'nome',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5','maxlength'=>100
			),
		),
		'prepend' => '<i class="fa fa-user"></i>'
	)); ?>

	<?php echo $form->textFieldGroup($model,'fone',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>20
			)
		),
		'prepend' => '<i class="glyphicon glyphicon-earphone"></i>'
	)); ?>


	<?php echo $form->textFieldGroup($model, 'cpf',
		array('widgetOptions' => array(
			'htmlOptions' => array(
				'class' => 'span5',
				'maxlength' => 15
			)
		),
		'prepend' => '<i class="fa fa-credit-card-alt"></i>'
	)); ?>

	<?php echo $form->textFieldGroup($model,'email',
		array('widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>100
			)
		),
		'prepend' => '<i class="fa fa-at"></i>'
	)); ?>

	<?php echo $form->datePickerGroup($model, 'data_nascimento',
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

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="display: inline;">
				<i class="fa fa-lock"></i></input> Autenticação
			</h3>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<?php echo $form->textFieldGroup($model,'login',
				array('widgetOptions'=>array(
					'htmlOptions'=>array(
						'class'=>'span5',
						'maxlength'=>50
					)
				),
				'prepend' => '<i class="glyphicon glyphicon-user"></i>'
			)); ?>

			<!-- PERFIL -->
			<?php echo $form->dropDownListGroup($model, 'perfil',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => $model->getPerfilOptions(),
						'htmlOptions' => array(
							'empty' => '...:: Selecione um Perfil ::...',
							'onchange'=>'mostraSupervisores(this.value)',
						),
					)
				)
			); ?>	
			<!-- supervisores -->
			<div id='divSupervisor'>
			<?php echo $form->dropDownListGroup($model, 'supervisor_id',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'span5',
					),
					'widgetOptions' => array(
						'data' => CHtml::listData(Funcionario::model()->findAll('perfil='.Funcionario::SUPERVISOR),'id_funcionario','nome'),
						'htmlOptions' => array('empty'=>'...:: Selecione um Supervisor ::...'),
					),
					'prepend' => '<i class="fa fa-user"></i>'
				)
			); ?>
			</div>	
		</div>
	</div>


	<div class="panel panel-default">
		<div class="panel-heading">
			<a onclick="exibeEscondePainel('painelEndereco')"><h3 class="panel-title" style="display: inline;">
				<i class="fa fa-home"></i> Endereço
			</h3></a>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body" id="painelEndereco">
			<?php echo $form->textFieldGroup($endereco, 'endereco', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>
			<?php echo $form->textFieldGroup($endereco, 'bairro', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>
			<?php echo $form->textFieldGroup($endereco, 'cidade', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>
			<?php echo $form->textFieldGroup($endereco, 'complemento', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>
			<?php echo $form->textFieldGroup($endereco, 'referencia', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>
		</div>
	</div>


	<!-- DATA ADMISSAO -->
	<?php echo $form->datePickerGroup($model, 'data_admissao',
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

	<!-- STATUS -->
	<?php echo $form->dropDownListGroup($model, 'status',
		array(
			'wrapperHtmlOptions' => array(
				'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'data' => $model->getStatusOptions(),
				'htmlOptions' => array('empty' => '...:: Selecione ::...'),
			)
		)
	); ?>

	<!-- BOTAO -->
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'primary',
				'label'=>$model->isNewRecord ? 'Cadastrar' : 'Alterar',
			)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
	$(function () {
		$('#sub-menu-cadastros').addClass('active');
		$('#sub-cadastros-func').addClass('active');

		$('#painelEndereco').hide();
		$('#divSupervisor').hide();

		//com msg de erro
		//if( ($('.alert-block').length >= 1) )//verifica se existe erro

		//mostra o combo de supervisor se ele houver valor
		if ('<?php echo $model->perfil; ?>' == '<?php echo funcionario::VENDEDOR; ?>')
			$('#divSupervisor').show();

		//Alteracao
		<?php if(isset($model->endereco_id)) : ?>
		$('#painelEndereco').show();
		<?php endif; ?>
	});

	function mostraSupervisores(perfil) {
		if (perfil == '<?php echo Funcionario::VENDEDOR; ?>')
			$('#divSupervisor').show(400);
		else {
			$('#divSupervisor').hide(400);
			$('#Funcionario_supervisor_id').val('');
		}
	}
</script>