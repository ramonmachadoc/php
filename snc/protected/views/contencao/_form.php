<script type="application/javascript">
	$( document ).ready(function() {
		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php if($model->hasErrors() or !$model->isNewRecord ): ?>
			mostraCamposContencao($('#Contencao_aplicavel').val());
		<?php endif; ?>
	});
</script>


<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'contencao-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'enctype' => 'multipart/form-data',
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>


	<!-- Acordeon -->
	<?php echo $this->renderPartial('../evento/_acordeonEvento', array('evento'=>$evento));  ?>

	<br><br><h4 id='tituloPagina'><i class="fa fa-retweet"></i> Enviar Contenção</h4><hr>

	<?php echo $form->errorSummary($model); ?>

	<!-- EVENTO ID -->
	<?php echo $form->hiddenField($model,'evento_id',array('value' => $evento->evento_id)); ?>


	<!-- APLICAVEL -->
	<?php echo $form->dropDownListGroup($model, 'aplicavel',
		array(
			'wrapperHtmlOptions' => array(
				//'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'data' => $model->getAplicavelOptions(),
				'htmlOptions' => array(
					'empty'    => '...:: Selecione ::...',
					'style'    => 'width: 400px;',
					'onchange' => 'mostraCamposContencao(this.value);',
				),
			)
		)
	); ?>

	<div id="divAplicavel" style="display:none">

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
						//'empty' => '...:: Selecione um Responsável ::...',
					),
				)
			)
		); ?>

		<!-- CONTENCAO -->
		<?php echo $form->textAreaGroup($model, 'contencao',
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
			<label class="col-sm-2 control-label" for="Contencao_arquivo">Documento</label>
			<div class="col-sm-5 col-sm-9">
				<input id="ytContencao_arquivo" type="hidden" value="" name="Contencao[arquivo][]">
				<input class="form-control" placeholder="Documento" name="Contencao[arquivo][]" id="Contencao_arquivo" type="file" multiple="">
			</div>
		</div>

	</div>

	<!-- BOTAO -->
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType' => 'submit',
				'context'    => 'primary',
				'label'      => $model->isNewRecord ? 'Enviar' : 'Alterar',
			)); ?>
	</div>

<?php $this->endWidget(); ?>


<!--***   script    ***-->
<script type="application/javascript">
	$('#sub-menu-auditado').addClass('active');
	$('#auditado-contencao-aberto').addClass('active');

	function mostraCamposContencao(aplicavel) {
		if(aplicavel == 'S'){
			$('#divAplicavel').show(400);
		} else if(aplicavel == 'N' || aplicavel == ''){
			$('#divAplicavel').hide(400);
			$('#Contencao_responsavel_id').val('');
			$('#Contencao_contencao').val('');
			$('#Contencao_prazo').val('');
			$('#Contencao_arquivo').val('');
		}		
	}
</script>