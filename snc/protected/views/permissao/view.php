<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#fff !important">

		<h3>
		    <i class="glyphicon glyphicon-user"></i> Visualizar Permissão: <?php echo $model->usuario->nome; ?>
		    
		    <div class="btn-group" style="float:right">
		        <button type="button" class="btn btn-info">Acões</button>
		        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		            <span class="caret"></span>
		        </button>
		        <ul class="dropdown-menu" role="menu">
		            <li><a href="<?php echo Yii::app()->createUrl('permissao/update',array('id'=>$model->permissao_id)); ?>">Alterar</a></li>
					<li class="divider"></li>
		            <li><a href="<?php echo Yii::app()->createUrl('permissao/create'); ?>">Novo</a></li>
		            <li><a href="<?php echo Yii::app()->createUrl('permissao/admin'); ?>">Listar</a></li>
		        </ul>
		    </div>
		</h3>


		<div class="panel-body" id="yw0">
			<?php $this->widget('booster.widgets.TbDetailView',array(
				'data' => $model,
				'attributes' => array(
					array(
						'name'   => '_filterUsuarioId',
						'value'  => $model->usuario->nome,
					),
					array(
						'name'   => '_filterLogin',
						'value'  => $model->usuario->login,
					),
					array(
						'name'   => 'perfil',
						'value'  => $model->perfilText,
					),
					array(
						'name'    => 'empresa_id',
						'value'   => $model->empresa->nome,
						'visible' => $model->empresa != null,
					),      
					array(
						'name'    => 'area_id',
						'value'   => $model->area->descricao,
						'visible' => $model->area_id != null,
					),
				),
			));?>
		</div>

	</div>
</div>

<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-setor').addClass('active');
</script>