
<!-- PLANOS DE ACAO -->
<div class="panel-group" id="accordion" style="margin-top: -15px">
	<?php foreach($planosacao as $key=>$plano) : ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key; ?>">
						<?php if($plano->status == Planoacao::ENVIADO) $class ='warning'; else if($plano->status == Planoacao::EFICAZ) $class = 'success'; else if($plano->status == Planoacao::INEFICAZ) $class = 'danger';  ?>
						<i class="fa fa-dot-circle-o" aria-hidden="true"></i> 
						<?php echo $key+1; ?>º PAC - <span class="label label-<?php echo $class ?>"><?php echo $plano->getAllStatusText() ?></span>
					</a>
				</h4>
			</div>
			<div id="collapse<?php echo $key; ?>" class="panel-collapse collapse">
				<div class="panel-body">


					<fieldset><legend>5 Porques</legend></fieldset>
					<?php $this->widget('booster.widgets.TbDetailView',array(
						'type'=>'bordered condensed striped',
						'data'=>$plano,
						'attributes'=>array(
							array('label' => '1º Porque', 'value' => $plano->porque->cr1),
							array('label' => '2º Porque', 'value' => $plano->porque->cr2),
							array('label' => '3º Porque', 'value' => $plano->porque->cr3),
							array('label' => '4º Porque', 'value' => $plano->porque->cr4),
							array('label' => '5º Porque', 'value' => $plano->porque->cr5),
						),
					));?>


					<br><br>
					<fieldset><legend>Ishikawa</legend></fieldset>
					<?php echo $this->renderPartial('../planoacao/viewIshikawaAba', array('ishikawa'=>$plano->ishikawa,'form'=>$form));  ?>
					<br><br>

					
					<fieldset><legend>Plano de Ação</legend></fieldset>
					<?php $this->widget('booster.widgets.TbDetailView',array(
						'type'=>'bordered condensed striped',
						'data'=>$plano,
						'attributes'=>array(
							array('label' => 'Responsavel', 'value' => $plano->responsavel->nome),
							array('label' => 'Ação Corretiva', 'value' => $plano->acaocorrecao),
							array('label' => 'Prazo', 'value' => $plano->prazo),
							/*array(
			            		'name'    => 'arquivo',
			            		'header'  => 'Documento',
			            		'type'    => 'raw',
			            		'value'   => CHtml::link($plano->arquivo, array("upload/".@$contencao->arquivo), array('target'=>'_blank')),
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

<br>