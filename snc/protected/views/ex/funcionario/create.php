<?php //$this->widget(
//	'booster.widgets.TbBreadcrumbs',
//	array(
//		'links' => array('Funcionário' => 'admin', 'Novo'),
//	)
//);?>

<h3 id='tituloPagina'><i class="fa fa-user"></i> Novo Funcionário</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'endereco'=>$endereco)); ?>