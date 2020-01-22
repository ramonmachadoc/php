
<div class="panel-group" id="accordion2" style="margin-top: -15px">
  
	<div class="panel panel-default">
    	<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne2">
					<?php if($contencao->status == Contencao::ENVIADO) $class ='warning'; else if($contencao->status == Contencao::EFICAZ) $class = 'success'; else if($contencao->status == Contencao::INEFICAZ) $class = 'danger';  ?>
					<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Contenção - <span class="label label-<?php echo $class ?>"><?php echo $contencao->getAllStatusText() ?></span>
				</a>
			</h4>
    	</div>
	    <div id="collapseOne2" class="panel-collapse collapse">
	    	<div class="panel-body">
				<?php $this->widget('booster.widgets.TbDetailView',array(
					'type'=>'bordered condensed striped',
					'data'=>$contencao,
					'attributes'=>array(
						array('label' => 'Necessário Contenção', 'value' => $contencao->getAplicavelText()),
						array(
							'label'   => 'Responsável',   
							'value'   => @$contencao->responsavel->nome, 
							'visible' => $contencao->aplicavel == Contencao::SIM,
						),
						array(
							'label'   => 'Contenção',   
							'value'   => @$contencao->contencao, 
							'visible' => $contencao->aplicavel == Contencao::SIM,
						),
						array(
							'label'   => 'Prazo',   
							'value'   => @$contencao->prazo, 
							'visible' => $contencao->aplicavel == Contencao::SIM,
						),
			            /*array(
			            	'name'    => 'arquivo',
			            	'header'  => 'Documento',
			            	'type'    => 'raw',
							'visible' => @$contencao->aplicavel == Contencao::SIM,
			            	'value'   => CHtml::link($contencao->arquivo, array("upload/{$contencao->arquivo}"), array('target'=>'_blank')),
			        	),*/						
					),
				));?>

				<table class="detail-view table table-bordered table-condensed table-striped" id="yw5">
					<tbody>
						<tr class="even">
							<th>Documento</th>
							<td>
								<?php //echo CHtml::link($model->arquivo, array("upload/{$model->arquivo}"), array('target'=>'_blank')); 

                                    $arquivos = explode(";", $contencao->arquivo);
                                    $arquivos = array_filter($arquivos);

                                    if(!empty($arquivos)){
	                                    foreach ($arquivos as $f) {
	                                        echo CHtml::link($f, array("upload/{$f}"), array('target'=>'_blank'));
	                                        echo "<br/>";
	                                    }
                                    }
                                    else
                                    	echo "-";
						       ?>
							</td>
						</tr>
					</tbody>
				</table>

	      	</div>
	    </div>
  	</div>


</div>
