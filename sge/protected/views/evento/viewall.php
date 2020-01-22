
<script>
    $(document).ready(function(){
        $('#yw0.back').click(function(){
            parent.history.back();
            return false;
        });
    });
</script>

<style>
	legend { font-size: 15px !important; }
</style>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'                   => 'evento-viewall-form',
	'type'                 => 'horizontal',
	'enableAjaxValidation' => false,
	'htmlOptions'          => array(
		//'class'   => 'well',
		'style'   => 'background:#ffffff;'
	),
)); ?>



<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#fff !important">

		<h3>
		    <i class="glyphicon glyphicon-eye-open"></i> Visualizar Informações Gerais do Evento
            <div class="form-actions" style="float:right">
                <?php $this->widget('booster.widgets.TbButton', array(
					'buttonType' => 'link',
					'context'    => 'success',
					'label'      => 'Voltar',
					'url'        => Yii::app()->user->auditado == Usuario::SIM ? Yii::app()->createUrl('evento/indexauditado') : Yii::app()->createUrl('evento/indexadministrador'),
                )); ?>
            </div>
		</h3>


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
					array('label' => 'Origem Auditor',    'value' => $model->origemauditor->descricao),
					array('label' => 'Criticidade',       'value' => $model->getCriticidadeText()),
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
			<h4><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Índice de Avaliação do Risco</h4>
		  	<?php $this->widget('booster.widgets.TbDetailView',array(
				'type'=>'bordered condensed striped',
				'data'=>$model,
				'attributes'=>array(
					array(
						'label'   => 'Análise de Risco?',
						'value'   => $model->getAnalisederiscoText(),
					),
					array(
						'label'   => 'Probabilidade',
						'value'   => $model->getProbabilidadeText(),
						'visible' => $model->getAnalisederiscoText() == Evento::SIM,
					),
					array(
						'label'   => 'Severidade',
						'value'   => $model->getSeveridadeText(),
						'visible' => $model->getAnalisederiscoText() == Evento::SIM,
					),
					array(
						'label'   => 'Risco',
						'value'   => $model->risco,
						'visible' => $model->getAnalisederiscoText() == Evento::SIM,
					),
					array(
						'label'   => 'Nível',
						'value'   => $model->getNivelText(),
						'visible' => $model->getAnalisederiscoText() == Evento::SIM,
					),
				),
			));?>
		</div>


        <!-- CONTENCAO -->
        <?php if(!is_null(@$evento->contencao)) : ?>
		<div class="panel-body" id="yw0">
			<h4><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Contenção</h4>
		  	<?php $this->widget('booster.widgets.TbDetailView',array(
				'type'=>'bordered condensed striped',
				'data'=>$model->contencao,
				'attributes'=>array(
	                array(
						'label'   => 'Contenção Necessária?',
						'value'   => @$model->contencao->getAplicavelText(),
					),
                	array(
						'label'   => 'Responsável',
						'value'   => @$model->contencao->responsavel->nome,
						'visible' => $model->contencao->aplicavel == Contencao::SIM,
					),
					array(
						'label'   => 'Contenção',
						'value'   => @$model->contencao->contencao,
						'visible' => $model->contencao->aplicavel == Contencao::SIM,
					),
					array(
						'label'   => 'Prazo',
						'value'   => @$model->contencao->prazo,
						'visible' => $model->contencao->aplicavel == Contencao::SIM,
					),
		            array(
		            	'name'   => 'Documento',
		            	'header' => 'Documento',
		            	'type'   => 'raw',
		            	'value'  => CHtml::link(@$model->contencao->arquivo, array("upload/{$model->contencao->arquivo}"), array('target'=>'_blank')),
						'visible'=> $model->contencao->arquivo != null,
		        	),
					array(
						'label'   => 'Status',
						'value'   => @$model->contencao->getAllStatusText(),
					),
				),
			));?>
		</div>
		<?php endif; ?>


		<!-- PLANOS DE ACAO -->
		<div class="panel-group" id="accordion">
			<?php foreach($model->planosacao as $key=>$plano) : ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key; ?>">
								<?php if($plano->status == Planoacao::ENVIADO) $class ='warning'; else if($plano->status == Planoacao::EFICAZ) $class = 'success'; else if($plano->status == Planoacao::INEFICAZ) $class = 'danger';  ?>
								<?php echo $key+1; ?>º PAC - <span class="label label-<?php echo $class ?>"><?php echo $plano->getAllStatusText() ?></span>
							</a>
						</h4>
					</div>
					<div id="collapse<?php echo $key; ?>" class="panel-collapse collapse">
						<div class="panel-body">


							<!--<fieldset><legend><i class="fa fa-dot-circle-o" aria-hidden="true"></i> 5 Porques</legend></fieldset>-->
							<?php /*$this->widget('booster.widgets.TbDetailView',array(
								'type'=>'bordered condensed striped',
								'data'=>$plano,
								'attributes'=>array(
									array('label' => '1º Porque', 'value' => $plano->porque->cr1),
									array('label' => '2º Porque', 'value' => $plano->porque->cr2),
									array('label' => '3º Porque', 'value' => $plano->porque->cr3),
									array('label' => '4º Porque', 'value' => $plano->porque->cr4),
									array('label' => '5º Porque', 'value' => $plano->porque->cr5),
								),
							));*/?>


							<!--<br><br>
							<fieldset>
								<legend><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Ishikawa</legend>
							</fieldset>-->
							<?php /*echo $this->renderPartial('../planoacao/viewIshikawaAba', array('ishikawa'=>$plano->ishikawa,'form'=>$form));*/  ?>
							<!--<br><br>-->


							<!--<h5>Ishikawa</h5>-->
							<?php /*$this->widget('booster.widgets.TbDetailView',array(
								'type'=>'bordered condensed striped',
								'data'=>$plano,
								'attributes'=>array(
									array('label' => 'Problema', 'value' => $plano->ishikawa->problema),

									array('label' => 'Método', 'value' => $plano->ishikawa->metodoA, 'visible' => $plano->ishikawa->metodoA != ""),
									array('label' => 'Método', 'value' => $plano->ishikawa->metodoB, 'visible' => $plano->ishikawa->metodoB != ""),
									array('label' => 'Método', 'value' => $plano->ishikawa->metodoC, 'visible' => $plano->ishikawa->metodoC != ""),

									array('label' => 'Máquina', 'value' => $plano->ishikawa->maquinaA, 'visible' => $plano->ishikawa->maquinaA != ""),
									array('label' => 'Máquina', 'value' => $plano->ishikawa->maquinaB, 'visible' => $plano->ishikawa->maquinaB != ""),
									array('label' => 'Máquina', 'value' => $plano->ishikawa->maquinaC, 'visible' => $plano->ishikawa->maquinaC != ""),

									array('label' => 'Mensagem', 'value' => $plano->ishikawa->mensagemA, 'visible' => $plano->ishikawa->mensagemA != ""),
									array('label' => 'Mensagem', 'value' => $plano->ishikawa->mensagemB, 'visible' => $plano->ishikawa->mensagemB != ""),
									array('label' => 'Mensagem', 'value' => $plano->ishikawa->mensagemC, 'visible' => $plano->ishikawa->mensagemC != ""),

									array('label' => 'Meio Físico', 'value' => $plano->ishikawa->meioA, 'visible' => $plano->ishikawa->meioA != ""),
									array('label' => 'Meio Físico', 'value' => $plano->ishikawa->meioB, 'visible' => $plano->ishikawa->meioB != ""),
									array('label' => 'Meio Físico', 'value' => $plano->ishikawa->meioC, 'visible' => $plano->ishikawa->meioC != ""),

									array('label' => 'Materiais', 'value' => $plano->ishikawa->materialA, 'visible' => $plano->ishikawa->materialA != ""),
									array('label' => 'Materiais', 'value' => $plano->ishikawa->materialB, 'visible' => $plano->ishikawa->materialB != ""),
									array('label' => 'Materiais', 'value' => $plano->ishikawa->materialC, 'visible' => $plano->ishikawa->materialC != ""),

									array('label' => 'Mão de Obra', 'value' => $plano->ishikawa->maoA, 'visible' => $plano->ishikawa->maoA != ""),
									array('label' => 'Mão de Obra', 'value' => $plano->ishikawa->maoB, 'visible' => $plano->ishikawa->maoB != ""),
									array('label' => 'Mão de Obra', 'value' => $plano->ishikawa->maoC, 'visible' => $plano->ishikawa->maoC != ""),
								),
							)); */?>

              <?php
                if($plano->causaraiz){
                  $texto = $plano->causaraiz->fullName;
                }else{
                  $texto = "N/A";
                }
               ?>
							<fieldset><legend><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Plano de Ação</legend></fieldset>
							<?php $this->widget('booster.widgets.TbDetailView',array(
								'type'=>'bordered condensed striped',
								'data'=>$plano,
								'attributes'=>array(
                  array('label' => 'Causa Raiz', 'value' => $texto),
									array('label' => 'Responsavel', 'value' => $plano->responsavel->nome),
									array('label' => 'Ação Corretiva', 'value' => $plano->acaocorrecao),
									array('label' => 'Prazo', 'value' => $plano->prazo),
									/*array(
		            					'name'   => 'Documento',
		            					'header' => 'Documento',
		            					'type'   => 'raw',
		            					'value'  => CHtml::link($plano->arquivo, array("upload/{$plano->arquivo}"), array('target'=>'_blank')),
										//'visible'=> $plano->arquivo != null,
		        					),*/
									array('label' => 'Status', 'value' => $plano->getAllStatusText()),
								),
							));?>

							<table class="detail-view table table-bordered table-condensed table-striped" id="yw5">
								<tbody>
									<tr class="even">
										<th>Documento</th>
										<td>
											<?php //echo CHtml::link($model->arquivo, array("upload/{$model->arquivo}"), array('target'=>'_blank'));

			                                    $arquivos = explode(";", $plano->arquivo);
			                                    $arquivos = array_filter($arquivos);

			                                    foreach ($arquivos as $f) {
			                                        echo CHtml::link($f, array("upload/{$f}"), array('target'=>'_blank'));
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
			<?php endforeach; ?>
		</div>



		<!-- ACOMPANHAMENTO -->
		<?php if( $model->acompanhado == Evento::SIM ) : ?>
			<div class="panel-body" id="yw0">
				<?php

					$arquivos = explode(";", $model->arquivo_acompanhamento);
					$arquivos = array_filter($arquivos);
					$teste="";

				?>
				<h4><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Acompanhamento</h3>
				<?php $this->widget('booster.widgets.TbDetailView',array(
					'type'=>'bordered condensed striped',
					'data'=>$model,
					'attributes'=>array(
						array(
							'label'   => 'Ação de Monitoramento',
							'value'   => $model->monitoramento,
						),
						array(
							'label'   => 'Observações',
							'value'   => $model->observacao,
						),
					),
				));?>

				<table class="detail-view table table-bordered table-condensed table-striped" id="yw8">
					<tbody>
						<tr class="odd">
							<th>Documentos</th>
							<td>
								<?php
									foreach ($arquivos as $f) {
										echo CHtml::link($f, array("upload/{$f}"), array('target'=>'_blank'))."<br/>";
									}
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

	</div>
</div>
<?php $this->endWidget(); ?>

<script>
	$('#sub-menu-adm-evento').addClass('active');
	$('#admevento-cadastrar').addClass('active');
</script>
