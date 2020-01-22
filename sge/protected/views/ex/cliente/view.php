<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title" style="display: inline;font-size: 20px">
			<i class="fa fa-eye"></i> Visualizar Cliente: <?php echo $model->nome; ?>
		</h3>
		<?php
		if(Yii::app()->user->perfil != Funcionario::SUPERVISOR) {
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'htmlOptions' => array('style' => 'float:right;margin-bottom: 10px;', 'class' => 'menu_operacoes'),
					'buttons' => array(
						array(
							'label' => 'Operações',
							'icon' => 'fa fa-cogs',
							'htmlOptions' => array('class' => 'btn-primary'),
							'items' => array(
								array('label' => 'Novo Cliente',
									'url' => array('create'),
									'icon' => 'glyphicon glyphicon-plus',
									//'visible' => ($model->status != Cliente::VENDA),

								),
								array('label' => 'Alterar',
									'url' => array('update', 'id' => $model->id_cliente),
									'icon' => 'glyphicon glyphicon-pencil',
									'visible' => (Yii::app()->user->perfil == Funcionario::GERENTE),

								),
								array('label' => 'Retorno',
									'url' => array('retorno/view', 'id' => $model->id_cliente),
									'icon' => 'glyphicon glyphicon-time',
									//'visible' => ($model->status != Cliente::VENDA),
								),
								array('label' => 'Excluir',
									'url' => '#',
									'linkOptions' => array(
										'submit' => array(
											'delete',
											'id' => $model->id_cliente,
											'visualizar' => 'visualizar'
										),
										'confirm' => 'Você deseja realmente pagar esse item?'
									),
									'icon' => 'glyphicon glyphicon-trash',
									'visible' => (Yii::app()->user->perfil == Funcionario::GERENTE),
								),
								array('label' => 'Gerenciar',
									'url' => array('admin'),
									'icon' => 'fa fa-list-alt',
									'visible' => (Yii::app()->user->perfil == Funcionario::GERENTE),
								),
							)
						),
					),
				)
			);
		}
		?>
		<div class="clearfix"></div>
	</div>

	<div class="panel-body" id="yw0">
		<?php $this->widget('booster.widgets.TbDetailView',array(
			//'type'=>'bordered condensed',
			'data'=>$model,
			'attributes'=>array(
				array('label' => 'Carteira do Vendedor', 'value' => $model->vendedor->nome),
				'nome',
				'email',
				'fone',
				'aniversario',
				'modelo_moto',
				array('label' => 'Forma de Pagamento', 'value' => $model->getFormaPagamentoText()),
				'data_retorno',
				'data_venda',
				'nome_indicacao',
				'fone_indicacao',
				'observacao',
				'data_cadastro',
				//'justificativa',
				array('label' => 'Status', 'value' => $model->getStatusText()),
			),
		));?>
	</div>

</div>

<script>
	$('#sub-menu-gerenciar').addClass('active');
	$('#sub-gerenciar-cli').addClass('active');
</script>