<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#fff !important">

		<h3>
		    <i class="glyphicon glyphicon-eye-open"></i> Visualizar Evento: <?php echo $model->codigo; ?>
		    <div class="btn-group" style="float:right">
		        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
		        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
		        </a>
		        <ul class="dropdown-menu">
							<li>
								<a href="<?php echo Yii::app()->createUrl('evento/update', array('eventoid'=> $model->evento_id)); ?>">
							<i class="fa fa-pencil fa-fw"></i> Editar
							</a>
							</li>
								<li>
		                <a href="<?php echo Yii::app()->createUrl('evento/delete', array('id'=> $model->evento_id)); ?>">
							<i class="fa fa-eraser fa-fw"></i> Excluir
						</a>
		            </li>
		            <li>
						<a href="<?php echo Yii::app()->createUrl('evento/indexadministrador'); ?>">
							<i class="fa fa-bars"></i> Listar
						</a>
					</li>
		            <!--<li class="divider"></li>
		            <li>
						<a href="#">
							<i class="fa fa-trash-o fa-fw"></i> Deletar
						</a>
					</li>-->
		        </ul>
		    </div>
		</h3>


		<?php $this->widget('booster.widgets.TbAlert', array(
			    'fade'            => true,
			    'closeText'       => false,
			    'events'          => array(),
			    'htmlOptions'     => array('id'=>'flash-success'),
			    'userComponentId' => 'user',
			));
			Yii::app()->clientScript->registerScript(
		    'myHideEffect',
		    '$("#flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		    CClientScript::POS_READY
		); ?>


		<div class="panel-body" id="yw0">
			<h4><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Informações Sobre o Setor Auditado</h3>
			<?php $this->widget('booster.widgets.TbDetailView',array(
				'type'=>'bordered condensed striped',
				'data'=>$model,
				'attributes'=>array(
					array(
						'label'   => 'Área',
						'value'   => $model->area->descricao,
						//'visible' => isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR,
					),
					array('label' => 'Empresa', 'value' => $model->empresa->nome),
					array('label' => 'Setor', 'value' => $model->setor->descricao),
					array('label' => 'Origem Auditado', 'value' => $model->origemauditado->descricao),
				),
			));?>
		</div>

		<div class="panel-body" id="yw0">
			<h4><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Informações Sobre o Evento</h3>
		  	<?php $this->widget('booster.widgets.TbDetailView',array(
				'type'=>'bordered condensed striped',
				'data'=>$model,
				'attributes'=>array(
					'codigo',
					array('label' => 'Tipo de Evento', 'value' => $model->tipoauditoria->descricao),
					'dataevento',
					'requisito',
					'descricaorequisito',
					'descricaoevento',
					array('label' => 'Auditor / Relator', 'value' => $model->auditorrelator->nome),
					array('label' => 'Origem Auditor', 'value' => $model->origemauditor->descricao),
					array('label' => 'Criticidade', 'value' => $model->getCriticidadeText()),
					'prazoresposta',
				),
			));?>
		</div>


		<?php if( $model->area->descricao == 'SGSO' ) : ?>
			<div class="panel-body" id="yw0">
				<h4><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Informações Restritas ao SGSO</h3>
				<?php $this->widget('booster.widgets.TbDetailView',array(
					'type'=>'bordered condensed striped',
					'data'=>$model,
					'attributes'=>array(
						array(
							'label'   => 'Equipamento / Aeronave',
							'value'   => $model->equipamento->descricao,
							'visible' => $model->equipamento_id != '',
						),
						array(
							'label'   => 'Data de Entrega do Reporte',
							'value'   => $model->dataentregareporte,
							'visible' => $model->dataentregareporte != '',
						),
						array(
							'name'    => 'arquivo',
							'header'  => 'Documento',
							'type'    => 'raw',
							'visible' => $model->arquivo != null,
							'value'   => CHtml::link($model->arquivo, array("evento/download?arquivo={$model->arquivo}"), array('target'=>'_blank')),
						),
					),
				));?>
			</div>
		<?php endif; ?>

		<div class="panel-body" id="yw0">
			<h4><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Índice de Avaliação do Risco</h3>
		  	<?php $this->widget('booster.widgets.TbDetailView',array(
		  		'id'         => 'tabela-risco',
				'type'       => 'bordered condensed striped',
				'data'       => $model,
				'attributes' => array(
					array(
						'label'   => 'Análise de Risco?',
						'value'   => $model->getAnalisederiscoText(),
					),
					array(
						'label'   => 'Probabilidade',
						'value'   => @$model->getProbabilidadeText(),
						'visible' => $model->analisederisco == Evento::SIM,
					),
					array(
						'label'   => 'Severidade',
						'value'   => @$model->getSeveridadeText(),
						'visible' => $model->analisederisco == Evento::SIM,
					),
					array(
						'label'   => 'Risco',
						'value'   => $model->risco,
						'visible' => $model->analisederisco == Evento::SIM,
					),
					array(
						'label'   => 'Nível',
						'value'   => @$model->getNivelText(),
						'visible' => $model->analisederisco == Evento::SIM,
					),
				),
			));?>
		</div>

		<!-- BOTAO VOLTAR
		<div class="form-actions">
			<?php /*$this->widget('booster.widgets.TbButton', array(
					'buttonType' => 'link',
					'context'    => 'success',
					'label'      => 'Voltar',
	                'url'        => Yii::app()->createUrl('evento/indexauditado'),
				)); */?>
		</div>
		-->


	</div>
</div>

<script>
	$('#sub-menu-adm-evento').addClass('active');
	$('#admevento-cadastrar').addClass('active');

	/*$( document ).ready(function() {
		$('#tabela-risco tr').each(function(){
			var name = $('.odd').html();
			alert(name);
		});
	});*/
</script>
