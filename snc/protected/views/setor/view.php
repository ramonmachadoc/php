<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#fff !important">

		<h3>
		    <i class="glyphicon glyphicon-user"></i> Visualizar Setor: <?php echo $model->descricao; ?>

		    <div class="btn-group" style="float:right">
		        <button type="button" class="btn btn-info">Acões</button>
		        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		            <span class="caret"></span>
		        </button>
		        <ul class="dropdown-menu" role="menu">
		            <li><a href="<?php echo Yii::app()->createUrl('setor/update',array('id'=>$model->setor_id)); ?>">Alterar</a></li>
					<li class="divider"></li>
		            <li><a href="<?php echo Yii::app()->createUrl('setor/create'); ?>">Novo</a></li>
		            <li><a href="<?php echo Yii::app()->createUrl('setor/admin'); ?>">Listar</a></li>
		        </ul>
		    </div>
		</h3>

		<div class="panel-body" id="yw0">
			<?php $this->widget('booster.widgets.TbDetailView',array(
				//'type'=>'bordered condensed striped',
				'data'=>$model,
				'attributes'=>array(
					'setor_id',
					'descricao',
					'cliente',
				),
			));?>
		</div>

	</div>
</div>

<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-setor').addClass('active');
</script>
