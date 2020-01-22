
<div class="panel-group" id="accordion">

	<div class="panel panel-default">
    	<div class="panel-heading">
      		<h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Informações Sobre o Setor Auditado
        		</a>
      		</h4>
    	</div>
	    <div id="collapseOne" class="panel-collapse collapse">
	    	<div class="panel-body">

				<?php $this->widget('booster.widgets.TbDetailView',array(
					'type'=>'bordered condensed striped',
					'data'=>$evento,
					'attributes'=>array(
						array(
							'label'   => 'Área',
							'value'   => $evento->area->descricao,
							//'visible' => isset(Yii::app()->user->perfil) and Yii::app()->user->perfil == Permissao::ADMINISTRADOR,
						),
						array('label' => 'Empresa', 'value' => $evento->empresa->nome),
						array('label' => 'Setor', 'value' => $evento->setor->descricao),
						array('label' => 'Origem Auditado', 'value' => $evento->origemauditado->descricao)
					),
				));?>

	      	</div>
	    </div>
  	</div>


  	<div class="panel panel-default">
    	<div class="panel-heading">
      		<h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          			<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Informações Sobre a Não Conformidade
        		</a>
      		</h4>
    	</div>
    	<div id="collapseTwo" class="panel-collapse collapse in">
      		<div class="panel-body">

				<?php $this->widget('booster.widgets.TbDetailView',array(
					'type'=>'bordered condensed striped',
					'data'=>$evento,
					'attributes'=>array(
						'codigo',
						array('label' => 'Tipo de Evento', 'value' => $evento->tipoauditoria->descricao),
						'dataevento',
						'requisito',
						'descricaorequisito',
						'descricaoevento',
						array('label' => 'Auditor / Relator', 'value' => $evento->auditorrelator->nome),
						array('label' => 'Origem Auditor', 'value' => $evento->origemauditor->descricao),
						array('label' => 'Criticidade', 'value' => $evento->getCriticidadeText()),
						'prazoresposta',
					),
				));?>

      		</div>
    	</div>
  	</div>


	<?php if( (@$model->area->descricao == 'SGSO') || ($evento->area_id == 3) ) : ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Informações Restritas ao SGSO
					</a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse">
				<div class="panel-body">

					<?php $this->widget('booster.widgets.TbDetailView',array(
						'type'=>'bordered condensed striped',
						'data'=>$evento,
						'attributes'=>array(
							array(
								'label'   => 'Equipamento / Aeronave',
								'value'   => $evento->equipamento->descricao,
								'visible' => $evento->equipamento_id != '',
							),
							array(
								'label'   => 'Data de Entrega do Reporte',
								'value'   => $evento->dataentregareporte,
								'visible' => $evento->dataentregareporte != '',
							),
							/*array(
								'name'    => 'arquivo',
								'header'  => 'Documento',
								'type'    => 'raw',
								'visible' => $evento->arquivo != null,
								'value'   => CHtml::link($evento->arquivo, array("evento/download?arquivo={$evento->arquivo}"), array('target'=>'_blank')),
							),*/
						),
					));?>

					<table class="detail-view table table-bordered table-condensed table-striped" id="yw3">
						<tbody>
							<tr class="odd">
								<th>Documento Vinculado</th>
								<td>
									<?php
										$arquivo = explode(';', $evento->arquivo);
										foreach ( array_filter($arquivo) as $key => $value) {
											echo CHtml::link($value, array("evento/download?arquivo={$value}"), array('target'=>'_blank'));
											echo "<br/>";
										}
									?>
								</td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	<?php endif; ?>



 	<div class="panel panel-default">
    	<div class="panel-heading">
      		<h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          			<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Índice de Avaliação do Risco
        		</a>
      		</h4>
    	</div>
    	<div id="collapseFour" class="panel-collapse collapse">
      		<div class="panel-body">

				<?php $this->widget('booster.widgets.TbDetailView',array(
					'type'=>'bordered condensed striped',
					'data'=>$evento,
					'attributes'=>array(
						array('label' => 'Análise de Risco', 'value' => $evento->getAnalisederiscoText()),
						array(
							'label'   => 'Probabilidade',
							'value'   => $evento->getProbabilidadeText(),
							'visible' => $evento->analisederisco == Evento::SIM,
						),
						array(
							'label'   => 'Severidade',
							'value'   => $evento->getSeveridadeText(),
							'visible' => $evento->analisederisco == Evento::SIM,
						),
						array(
							'label'   => 'Risco',
							'value'   => $evento->risco,
							'visible' => $evento->analisederisco == Evento::SIM,
						),
						array(
							'label'   => 'Nível',
							'value'   => $evento->getNivelText(),
							'visible' => $evento->analisederisco == Evento::SIM,
						),
					),
				));?>

      		</div>
    	</div>
  	</div>

</div>
