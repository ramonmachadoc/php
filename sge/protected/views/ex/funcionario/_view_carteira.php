<style>
	#carteira-grid{
		font-size: 0.8em;
	}

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

<?php
	if (Yii::app()->user->perfil != Funcionario::GERENTE) {
		$this->widget('booster.widgets.TbGridView', array(
			'id' => 'carteira-grid',
			'itemsCssClass' => 'fundoBranco',
			'type' => 'striped condensed bordered',
			'dataProvider' => $carteira->search(),
			'filter' => $carteira,
	//	'summaryText' => '',
			'enableSorting' => true,
			'afterAjaxUpdate' => 'reinstallDatePicker',
			'columns' => array(
				'nome',
				'fone',
				array(
					'name' => 'data_retorno',
					'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model' => $carteira,
						'attribute' => 'data_retorno',
						'language' => 'pt-BR',
						'htmlOptions' => array(
							'id' => 'datepicker_data_retorno_tab2',
							'class' => 'form-control',
						),
						'defaultOptions' => array(  // (#3)
							'showOn' => 'focus',
							'dateFormat' => 'dd/mm/yyyy',
							'showOtherMonths' => true,
							'selectOtherMonths' => true,
							'changeMonth' => true,
							'changeYear' => true,
							'showButtonPanel' => true,
						)
					), true),
				),
				'modelo_moto',
				array('name' => 'status', 'value' => '$data->statusText', 'filter' => $carteira->statusOptions),

				array(
					'class' => 'booster.widgets.TbButtonColumn',
					'header' => 'Ações',
					'htmlOptions' => array('style' => 'width: 85px; text-align:center;'),
					'template' => '{view}',
					'viewButtonUrl' => 'Yii::app()->createUrl("cliente/view",  array("id"=>$data->primaryKey))',
				)
			),
		));
	}else {
		$this->widget('booster.widgets.TbExtendedGridView', array(
			'id' => 'carteira-grid',
			'itemsCssClass' => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
			'dataProvider' => $carteira->search(),
			'template' => "{summary}{items}{pager}",
			'selectableRows' => 2,
			'filter' => $carteira,
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
			'afterAjaxUpdate' => 'reinstallDatePicker',
			'columns' => array(
				'nome',
				'fone',
				array(
					'name' => 'data_retorno',
					'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model' => $carteira,
						'attribute' => 'data_retorno',
						'language' => 'pt-BR',
						'htmlOptions' => array(
							'id' => 'datepicker_data_retorno_tab2',
							'class' => 'form-control',
						),
						'defaultOptions' => array(  // (#3)
							'showOn' => 'focus',
							'dateFormat' => 'dd/mm/yyyy',
							'showOtherMonths' => true,
							'selectOtherMonths' => true,
							'changeMonth' => true,
							'changeYear' => true,
							'showButtonPanel' => true,
						)
					), true),
				),
				'modelo_moto',
				array('name' => 'status', 'value' => '$data->statusText', 'filter' => $carteira->statusOptions),

				array(
					'class' => 'booster.widgets.TbButtonColumn',
					'header' => 'Ações',
					'htmlOptions' => array('style' => 'width: 85px; text-align:center;'),
					'template' => '{view}',
					'viewButtonUrl' => 'Yii::app()->createUrl("cliente/view",  array("id"=>$data->primaryKey))',
				)
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
	function abrirModal(clientes) {
		$('#clientes_id').val(clientes);
		document.getElementById('iframe-trocar-carteira').contentWindow.location.replace("<?php echo Yii::app()->createUrl('/funcionario/trocarcarteira', array('origem' => 'carteira')); ?>");
		$('#modal-troca-carteira').modal();
	}
</script>
