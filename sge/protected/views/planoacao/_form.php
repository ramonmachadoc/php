<script type="application/javascript">
	$( document ).ready(function() {

		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php //if($model->hasErrors() or !$model->isNewRecord ): ?>
			//mostraCamposContencao($('#Contencao_aplicavel').val());
		<?php //endif; ?>

	});

</script>


<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'planoacao-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'enctype' => 'multipart/form-data',
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>

	<!-- Acordeon EVENTO -->
	<?php echo $this->renderPartial('../evento/_acordeonEvento', array('evento'=>$evento));  ?>

	<!-- Acordeon CONTENCAO -->
	<?php
		if(!is_null($evento->contencao))
			echo $this->renderPartial('../contencao/_acordeonContencao', array('contencao'=>$evento->contencao));
	?>


	<br><br><h4 id='tituloPagina'><i class="fa fa-retweet"></i> Enviar PAC</h4><hr>

	<?php /*echo $form->errorSummary($porque);*/ ?>
	<?php /*echo $form->errorSummary($ishikawa);*/ ?>
	<?php echo $form->errorSummary($model); ?>


	<!-- ABAS -->
	<?php $this->widget('booster.widgets.TbTabs', array(
	    'type'      => 'pills', //'tabs', 'pills', or 'list' border: 1px solid
	    'justified' => true,
	    'tabs'      => array(
	        /*array(
	            'label'   => '5 Porquês',
	            'active'  => true,
				'content' => $this->renderPartial("_formPorqueAba", array(
								'porque' => $porque,
								'form'   => $form,
							 ),true),
	        ),
	        array(
	        	'label'   => 'Ishikawa',
	        	'content' => $this->renderPartial("_formIshikawaAba", array(
	        					'ishikawa' => $ishikawa,
	        					'form'     => $form,
	        				  ),true),
	        ),*/
	        array(
	        	'label'   => 'Plano de Ação',
	        	'content' => $this->renderPartial("_formPlanoacaoAba", array(
	        					'model' => $model,
	        					'form'   => $form,
	        				  ),true),
	        ),
					array(
						'label' => 'Tabela de Causa raiz',
						'content' => $this->renderPartial("viewCausaraiz", array(
							'causaraiz' => $causaraiz,
						),true),
					),
	    ),
	)); ?>

	<br><br><br>


	<!-- BOTAO
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType' => 'submit',
				'context'    => 'primary',
				'label'      => $model->isNewRecord ? 'Enviar' : 'Enviar',
			)); ?>
	</div>-->


<?php $this->endWidget(); ?>

<script type="application/javascript">
	$('#sub-menu-auditado').addClass('active');
	$('#auditado-contencao-aberto').addClass('active');
</script>
