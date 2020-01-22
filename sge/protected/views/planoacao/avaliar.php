<script>
    $(document).ready(function(){
		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php if($model->hasErrors() ): ?>
			mostraMotivo();
		<?php endif; ?>
    });
</script>

<h3 id='tituloPagina'>
	<i class="fa fa-retweet"></i> Avaliar Plano de Ação <?php echo $evento->codigo;  ?>
	<div class="form-actions" style="float:right">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'link',
			'context'    => 'success',
			'label'      => 'Voltar',
			'url'        => Yii::app()->createUrl('evento/indexadministrador'),
		)); ?>
	</div>
</h3>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'administrador-planoacao-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'class' => 'well',
		'style' => 'background:#ffffff;'
	),
)); ?>

	<!-- Acordeon EVENTO -->
	<?php echo $this->renderPartial('../evento/_acordeonEvento', array('evento'=>$evento));  ?>

	<!-- Acordeon CONTENCAO -->
	<?php
	if(!is_null($evento->contencao))
		echo $this->renderPartial('../contencao/_acordeonContencao', array('contencao'=>@$evento->contencao));
	?>

    <!-- ABAS -->
	<?php $this->widget('booster.widgets.TbTabs', array(
	    'type'      => 'pills', //'tabs', 'pills', or 'list' border: 1px solid
	    'justified' => true,
	    'tabs'      => array(
	        /*array(
	            'label'   => '5 Porquês',
	            'active'  => true,
				'content' => $this->renderPartial("viewPorqueAba", array(
								'porque' => $model->porque,
								'form'   => $form,
							 ),true),
	        ),
	        array(
	        	'label'   => 'Ishikawa',
	        	'content' => $this->renderPartial("viewIshikawaAba", array(
	        					'ishikawa' => $model->ishikawa,
	        					'form'     => $form,
	        				  ),true),
	        ),*/
	        array(
	        	'label'   => 'Plano de Ação',
	        	'content' => $this->renderPartial("viewPlanoacaoAba", array(
	        					'model' => $model,
	        					'form'   => $form,
	        				  ),true),
	        ),
	    ),
	)); ?>

	<br>
	<h4 id='tituloPagina'><i class="fa fa-retweet"></i> Enviar Avaliação deste Plano de Ação</h4>
	<hr>
	<?php echo $form->errorSummary($model); ?>

	<!-- EVENTO ID -->
	<?php echo $form->hiddenField($model,'evento_id',array('value' => $evento->evento_id)); ?>

	<!-- PLANOACAO ID -->
	<?php echo $form->hiddenField($model,'planoacao_id',array('value' => $model->planoacao_id)); ?>

	<!-- APLICAVEL -->
	<?php echo $form->dropDownListGroup($model, 'statusavaliacao',
		array(
			'wrapperHtmlOptions' => array(
				//'class' => 'col-sm-5',
			),
			'widgetOptions' => array(
				'data' => $model->getStatusAvaliacaoOptions(),
				'htmlOptions' => array(
					'empty'    => '...:: Selecione ::...',
					'style'    => 'width: 400px',
					'onChange' => 'mostraMotivo()',
				),
			)
		)
	); ?>

	<!-- MOTIVO -->
	<div id="divmotivo" style="display:none">
		<?php echo $form->textAreaGroup($model, 'motivo',
			array(
				'wrapperHtmlOptions' => array(
					//'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'htmlOptions' => array('rows'=>4,'style'=>'width:100% !important'),
				)
			)
		); ?>
	</div>


	<!-- BOTAO -->
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType' => 'submit',
				'context'    => 'primary',
				'label'      => $model->isNewRecord ? 'Enviar' : 'Avaliar',
			)); ?>
	</div>


<?php $this->endWidget(); ?>


<!--***   script    ***-->
<script type="application/javascript">
	$('#sub-menu-administrador').addClass('active');
	$('#administrador-contencao').addClass('active');

	function mostraMotivo(){
		var status = $('#Planoacao_statusavaliacao').val();

		if(status == 'I')
			$('#divmotivo').show(400);
		else {
			$('#divmotivo').hide(400);
			$('#Planoacao_motivo').val('');
		}
	}
</script>
