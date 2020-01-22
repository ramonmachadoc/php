<?php
//	$this->widget(
//		'booster.widgets.TbBreadcrumbs',
//		array(
//			'links' => array('Gerenciar Retornos para Hoje'),
//		)
//	);
//?>

<style>
	.fundoBranco{background:#fff;}
	.espacoBotoes{margin-left: 5px;}
	/*-webkit-flex-wrap: wrap;flex-wrap: wrap;
    -webkit-align-content: center;
    align-content: center;
    */
	#iframe-trocar-carteira {
		width: 100%;
		height: 210px;
	}

	.modal-body {
		/*max-height: 500px;*/
		min-height: 225px;

	}

	.modal-dialog {
		width: 450px;
	}
</style>

<h3><i class="glyphicon glyphicon-time"></i> Gerenciar Retornos para Hoje</h3>
<?php
	if (Yii::app()->user->perfil != Funcionario::GERENTE) {
		$this->widget('booster.widgets.TbGridView', array(
			'id' => 'clientes-retorno-grid',
			'itemsCssClass' => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
			'dataProvider' => $model->search(),
			'filter' => $model,
			'enableSorting' => true,
			'columns' => array(
				'nome',
				'fone',
				'modelo_moto',
				array('name' => 'filter_funcionario', 'value' => '$data->vendedor->nome'),
				array('name' => 'status', 'value' => '$data->statusText', 'filter' => $model->statusOptions),
				array(
					'class' => 'booster.widgets.TbButtonColumn',
					'header' => 'Ações',
					'htmlOptions' => array('style' => 'width: 85px;text-align:center;'),
					'template' => Yii::app()->user->perfil == Funcionario::SUPERVISOR ? '{view}' : '{view}{retorno}',
					'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
					//'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
					//'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
					'buttons' => array(
						'view' => array
						(
							'options' => array('style' => 'margin-right:10px;'),
						),
						'retorno' => array
						(
							'label' => 'Retorno',
							'icon' => 'time',
							'url' => 'Yii::app()->createUrl("retorno/reagendar", array("id"=>$data->id_cliente))',
							//'options' => array('style'=>''),
						),
						/*'delete' => array
						(
							'options'=>array('style'=>'margin-left:5px;'),
						),*/
					),
				),

			),
		));
	} else {
		$this->widget('booster.widgets.TbExtendedGridView', array(
			'id' => 'clientes-retorno-grid',
			'itemsCssClass' => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
			'dataProvider' => $model->search(),
			'template' => "{summary}{items}{pager}",
			'selectableRows' => 2,
			'filter' => $model,
			'enablePagination' => true,
			'enableSorting' => true,
			'bulkActions' => array(
				'actionButtons' => array(
					array(
						'buttonType' => 'button',
						'id' => 'id_button',
						'context' => 'primary',
						'icon' => 'fa fa-exchange',
						'size' => 'small',
						'label' => 'Trocar Carteira',
						'click' => 'js:function(values){abrirModal(values);}',
					)
				),
				'align' => 'left',
				// if grid doesn't have a checkbox column type, it will attach
				// one and this configuration will be part of it
				'checkBoxColumnConfig' => array(
					'name' => 'id_cliente'
				),
			),
			'columns' => array(
				'nome',
				'fone',
				'modelo_moto',
				array('name' => 'filter_funcionario', 'value' => '$data->vendedor->nome'),
				array('name' => 'status', 'value' => '$data->statusText', 'filter' => $model->statusOptions),
				array(
					'class' => 'booster.widgets.TbButtonColumn',
					'header' => 'Ações',
					'htmlOptions' => array('style' => 'width: 85px;text-align:center;'),
					'template' => Yii::app()->user->perfil == Funcionario::SUPERVISOR ? '{view}' : '{view}{retorno}',
					'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
					//'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
					//'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
					'buttons' => array(
						'view' => array
						(
							'options' => array('style' => 'margin-right:10px;'),
						),
						'retorno' => array
						(
							'label' => 'Retorno',
							'icon' => 'time',
							'url' => 'Yii::app()->createUrl("retorno/reagendar", array("id"=>$data->id_cliente))',
							//'options' => array('style'=>''),
						),
						/*'delete' => array
						(
							'options'=>array('style'=>'margin-left:5px;'),
						),*/
					),
				),

			),
		));
	}
?>

<textarea id="clientes_id" cols="30" rows="10" style="display:none"></textarea>

<?php $this->beginWidget(
	'booster.widgets.TbModal',
	array('id' => 'modal-troca-carteira')
); ?>

<div class="modal-header">
	<a class="close" data-dismiss="modal">&times;</a>
	<h4 id="modal-titulo">Trocar Carteira</h4>
</div>

<div class="modal-body">
	<span id="erros" class="alert alert-block alert-danger" style="display: none"></span>
	<iframe id="iframe-trocar-carteira" frameborder="0"></iframe>
</div>

<div class="modal-footer">
	<!--LOGIN BUTTON-->
	<?php $this->widget(
		'booster.widgets.TbButton',
		array(
			'context' => 'primary',
			'label' => 'Trocar',
			'icon' => 'fa fa-exchange',
			'url' => '#',
			'htmlOptions' => array('onclick' => "document.getElementById('iframe-trocar-carteira').contentDocument.getElementById('trocar-carteira-form').submit()"),
		)
	); ?>

	<?php $this->widget(
		'booster.widgets.TbButton',
		array(
			'context' => 'danger',
			'label' => 'Fechar',
			'icon' => 'fa fa-times',
			'url' => '#',
			'htmlOptions' => array('data-dismiss' => 'modal'),
		)
	); ?>
</div>

<?php $this->endWidget(); ?>
<script>
	$('#sub-menu-gerenciar').addClass('active');
	$('#sub-gerenciar-cli').addClass('active');

	function abrirModal(clientes) {
		$('#clientes_id').val(clientes);
		document.getElementById('iframe-trocar-carteira').contentWindow.location.replace("<?php echo Yii::app()->createUrl('/funcionario/trocarcarteira', array('origem' => 'retorno')); ?>");
		$('#modal-troca-carteira').modal();
	}
</script>

