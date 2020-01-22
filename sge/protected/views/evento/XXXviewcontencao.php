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
		        	<li><a href="<?php echo Yii::app()->createUrl('evento/indexauditado'); ?>"><i class="fa fa-reply"></i> Voltar</a></li>
		            <li><a href="<?php echo Yii::app()->createUrl('evento/update', array('id'=> $model->evento_id)); ?>"><i class="fa fa-pencil fa-fw"></i> Editar</a></li>
		            <li><a href="<?php echo Yii::app()->createUrl('evento/admin'); ?>"><i class="fa fa-list"></i> Listar</a></li>
		            <li class="divider"></li>
		            <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Deletar</a></li>
		        </ul>
		    </div>
		</h3>


		<!-- Acordeon -->
		<?php echo $this->renderPartial('../evento/_acordeonEvento', array('evento'=>$model));  ?>
		
		<?php if(count($model->contencoes) > 0) : ?>
			
			<h3><i class="glyphicon glyphicon-eye-open"></i> Contenções</h3>

			<!-- Listagem das contencoes -->
			<?php foreach ($model->contencoes as $key => $contencao) : ?>
				<div class="panel-body" id="yw0">
					<h4><?php echo $key+1 . "º"; ?> Contenção</h3>
				  	<?php $this->widget('booster.widgets.TbDetailView',array(
						'type'=>'bordered condensed striped',
						'data'=>$contencao,
						'attributes'=>array(
							array('label' => 'Não Aplicável', 'value' => $contencao->getAplicavelText()),
							array('label' => 'Responsável',   'value' => $contencao->responsavel->nome),
							'contencao',
							'prazo',
							array(
								'label'   => 'Documento Vinculado', 
								'value'   => $contencao->arquivo, 
								'visible' => $contencao->arquivo != "",
							),
						),
					));?>	
				</div>
			<?php endforeach; ?>
			
		<?php endif; ?>

	</div>
</div>

<script>
    $('#sub-menu-auditado').addClass('active');
    $('#auditado-contencao').addClass('active');
</script>
