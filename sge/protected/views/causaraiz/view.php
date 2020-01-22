<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#fff !important">

		<h3>
		    <i class="glyphicon glyphicon-eye-open"></i> Visualizar Causa Raiz: <?php echo $model->subcategoria; ?>
		    <div class="btn-group" style="float:right">
		        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
		        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
		        </a>
		        <ul class="dropdown-menu">
		            <!--
		            <li>
		                <a href="<?php echo Yii::app()->createUrl('causaraiz/create'); ?>"><i class="fa fa-plus"></i> Novo</a>
		            </li>
		            -->
		            <li>
		                <a href="<?php echo Yii::app()->createUrl('causaraiz/update', array('id'=> $model->causaraiz_id)); ?>">
							<i class="fa fa-pencil fa-fw"></i> Editar
						</a>
		            </li>
		            <li>
						<a href="<?php echo Yii::app()->createUrl('causaraiz/admin'); ?>">
							<i class="fa fa-list"></i> Listar
						</a>
					</li>
					<li class="divider"></li>
		    </div>
		</h3>


		<div class="panel-body" id="yw0">
			<?php $this->widget('booster.widgets.TbDetailView',array(
				//'type'=>'bordered condensed striped',
				'data'=>$model,
				'attributes'=>array(
					'tipo',
					'codigo',
					'categoria',
					'subcategoria'
				),
			));?>
		</div>

	</div>
</div>

<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-casaraiz').addClass('active');
</script>
