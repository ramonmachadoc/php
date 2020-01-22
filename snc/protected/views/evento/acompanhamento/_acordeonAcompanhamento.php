
<!-- ACOMPANHAMENTO -->
<div class="panel-group" id="accordion" style="margin-top: -15px">
	<?php if( $model->acompanhado == Evento::SIM ) : ?>
		<div class="panel-body" id="yw0">
			<h4>Acompanhamento</h3>
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
		</div>
	<?php endif; ?>
</div>

<br>