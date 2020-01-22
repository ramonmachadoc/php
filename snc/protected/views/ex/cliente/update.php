<?php //$this->widget(
//	'booster.widgets.TbBreadcrumbs',
//	array(
//		'links' => array('Clientes' => 'admin', 'Editar'),
//	)
//);?>

<h3 id='tituloPagina'><i class="fa fa-users"></i> Editar Cliente: <?php echo $model->nome; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>