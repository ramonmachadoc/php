
<h3 id='tituloPagina'>
	<i class="fa fa-retweet"></i> Plano de Ação - <?php echo $evento->codigo; ?>
</h3>

<?php $this->renderPartial('_form', array(
	'model'    => $model,
	//'ishikawa' => $ishikawa,
	//'porque'   => $porque,
	'evento'   => $evento,
	'causaraiz'=>$causaraiz,
)); ?>
