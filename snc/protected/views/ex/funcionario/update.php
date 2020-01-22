<?php //$this->widget(
//	'booster.widgets.TbBreadcrumbs',
//	array(
//		'links' => array('Funcionários' => 'admin', 'Editar'),
//	)
//); ?>

	<h3 id='tituloPagina'><i class="fa fa-user"></i> Editar Funcionário: <?php echo $model->nome; ?></h3>
<?php echo $this->renderPartial('_form',array('model'=>$model, 'endereco'=>$endereco)); ?>