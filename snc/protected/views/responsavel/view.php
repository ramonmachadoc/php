<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#fff !important">

		<h3>
		    <i class="glyphicon glyphicon-eye-open"></i> Visualizar responsável: <?php echo $model->nome; ?>
		    <div class="btn-group" style="float:right">
		        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
		        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
		        </a>
		        <ul class="dropdown-menu">
		            <!--
		            <li>
		                <a href="<?php echo Yii::app()->createUrl('responsavel/create'); ?>"><i class="fa fa-plus"></i> Novo</a>
		            </li>
		            -->
		            <li>
		                <a href="<?php echo Yii::app()->createUrl('responsavel/update', array('id'=> $model->responsavel_id)); ?>">
							<i class="fa fa-pencil fa-fw"></i> Editar
						</a>
		            </li>
		            <li>
						<a href="<?php echo Yii::app()->createUrl('responsavel/admin'); ?>">
							<i class="fa fa-list"></i> Listar
						</a>
					</li>

		        </ul>
		    </div>
		</h3>


		<div class="panel-body" id="yw0">
			<?php $this->widget('booster.widgets.TbDetailView',array(
				//'type'=>'bordered condensed striped',
				'data'=>$model,
				'attributes'=>array(
					array('label' => 'Setor', 'value' => $model->setor->descricao),
					'nome',
					'cpf',
					'email',
					array('label' => 'Status', 'value' => $model->getStatusText()),
				),
			));?>
		</div>

	</div>
</div>

<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-responsavel').addClass('active');
</script>
