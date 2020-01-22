<?php // $this->widget(
//	'booster.widgets.TbBreadcrumbs',
//	array(
//		'links' => array('Clientes' => 'admin', 'Novo'),
//	)
//);?>

<h3 id='tituloPagina'><i class="fa fa-users"></i> Novo Cliente</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>