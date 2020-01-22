<script type="application/javascript">
	$( document ).ready(function() {
		//refaz as regras de tela javascript quando acontece erro de campo obrigatorio
		<?php //if($model->hasErrors() or !$model->isNewRecord ): ?>
			//mostraCamposContencao($('#Contencao_aplicavel').val());
		<?php //endif; ?>
	});
</script>

<h3 id='tituloPagina'>
	<i class="fa fa-retweet"></i> Visualizar Plano de Ação - <?php echo $model->evento->codigo; ?>
</h3>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'planoacao-form-view',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>

	<!-- Acordeon EVENTO -->
	<?php echo $this->renderPartial('../evento/_acordeonEvento', array('evento'=>$model->evento));  ?>

	<!-- Acordeon CONTENCAO -->
	<?php
		if(!is_null(@$evento->contencao))
			echo $this->renderPartial('../contencao/_acordeonContencao', array('contencao'=>$model->evento->contencao));
	?>

	<!-- EVENTO ID -->
	<?php echo $form->hiddenField($model,'evento_id',array('value' => @$evento->evento_id)); ?>


  	<div class="panel panel-default" style="margin-top: -15px">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#">
                    <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Plano de Ação
                </a>
            </h4>
        </div>

        <div class="panel-collapse collapse in">
            <div class="panel-body">

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


            </div>
        </div>
    </div>

	<br><br><br>


<?php $this->endWidget(); ?>

<!--***   script    ***-->
<script type="application/javascript">
	$('#sub-menu-auditado').addClass('active');
	$('#auditado-contencao-aberto').addClass('active');
</script>

<style type="text/css">
	/*#abaCR1, #abaCR2, #abaCR3, #abaCR4, #abaCR5 {
		border-right: 1px solid #ddd !important;
		border-left: 1px solid #ddd !important;
		border-bottom: 1px solid #ddd !important;
	}
	#yw4_tab_1, #yw4_tab_2, #yw4_tab_3 {
		border-right: 1px solid #ddd !important;
		border-left: 1px solid #ddd !important;
		border-top: 1px solid #ddd !important;
		border-bottom: 1px solid #ddd !important;
	}
	#yw5_tab_1, #yw5_tab_2, #yw5_tab_3 {
		border-right: 1px solid #ddd !important;
		border-left: 1px solid #ddd !important;
		border-bottom: 1px solid #ddd !important;
	}*/
</style>
