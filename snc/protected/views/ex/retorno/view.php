<?php
//	$this->widget(
//		'booster.widgets.TbBreadcrumbs',
//		array(
//			'links' => array('Clientes' => 'admin', 'Visualizar'),
//		)
//	);
//?>

<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#fff !important">
		<h3 class="panel-title" style="display: inline;font-size: 20px">
			<i class="glyphicon glyphicon-time"></i> Visualizar Retorno: <?php echo $model->nome; ?>
		</h3>
	

		<a class="btn btn-success" href="<?php echo Yii::app()->createUrl("retorno/reagendar", array("id"=>$model->id_cliente)); ?>" role="button" style='float:right;margin-right:15px;'>Novo Retorno</a>




		<?php /*$this->widget('booster.widgets.TbButton', array(
		    'label'   => 'Novo Retorno',
		    'context' => 'success',
		    'htmlOptions'=>array('style'=>'float:right;margin-right:15px;'),
		    'url'=>'http://www.google.com',
		));*/?>

		<div class="panel-body" id="yw0">
			<?php $this->widget('booster.widgets.TbDetailView',array(
				'type'=>'bordered condensed striped',
				'data'=>$model,
				'attributes'=>array(
					'nome',
					'email',
					'fone',
					array('label' => 'Data de Cadastro', 'value' => date('d/m/Y h:i', strtotime($model->data_cadastro))),
					'data_retorno',
					'data_venda',
					array('label' => 'Status', 'value' => $model->getStatusText()),
				),
			));?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<a onclick="exibeEscondePainel('painelJustificativa')"><h3 class="panel-title" style="display: inline;">
						<i class="fa fa-comment-o"></i> Justificativas
					</h3></a>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body" id="painelJustificativa">
			    	<?php foreach ($model->justificativas as $key => $jus) {
			    		echo '**********[ '.$jus->getStatusText() . ' - ' . date('d/m/Y H:i', strtotime($jus->dtCadastro)) . ' ]********************<br>';
			    		echo $jus->texto . '<br><hr>';
			    	} ?>
			    </div>
			</div>
		</div>

	</div>
</div>


<script>
	$('#sub-menu-gerenciar').addClass('active');
	$('#sub-gerenciar-cli').addClass('active');
</script>

