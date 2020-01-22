<?php //$this->widget(
//    'booster.widgets.TbBreadcrumbs',
//    array(
//        'links' => array('Funcionário' => 'admin', 'Visualizar'),
//    )
//);?>

<?php
	if(Yii::app()->user->perfil == Funcionario::VENDEDOR){
		$itens = array(
			array('label' => 'Novo Cliente',
				'url' => array('cliente/create'),
				'icon' => 'glyphicon glyphicon-plus',

			),
			array('label' => 'Alterar Senha',
				'url' => array('senha', 'id' => $model->id_funcionario),
				'icon' => 'fa fa-key',
			),
		);
	}else{
		$itens = array(
			array('label' => 'Novo Funcionário',
				'url' => array('create'),
				'icon' => 'glyphicon glyphicon-plus',

			),
			array('label' => 'Alterar',
				'url' => array('update', 'id' => $model->id_funcionario),
				'icon' => 'glyphicon glyphicon-pencil',

			),
			array('label' => 'Excluir',
				'url' => '#',
				'linkOptions' => array(
					'submit' => array(
						'delete',
						'id' => $model->id_funcionario,
						'visualizar' => 'visualizar'
					),
					'confirm' => 'Você deseja realmente pagar esse item?'
				),
				'icon' => 'glyphicon glyphicon-trash',
			),
			array('label' => 'Gerenciar',
				'url' => array('admin'),
				'icon' => 'fa fa-list-alt',
			),
			array('label' => $model->id_funcionario != Yii::app()->user->id?'Reset Senha':'Alterar Senha',
				'url' => array('senha', 'id' => $model->id_funcionario),
				'icon' => 'fa fa-key',
			),
		);
	}
    if ($model->perfil == Funcionario::VENDEDOR) {
        $supervisor = array(
                            'name' => 'Supervisor',
                            'value' => $model->supervisor->nome,
                            'visible' => $model->perfil == Funcionario::VENDEDOR,
        );

    }else{
        $supervisor=null;
    }

?>

<?php
if(isset($error) and $error == 1){
	$user = Yii::app()->getComponent('user');
	$user->setFlash(
		'error',
		"<strong>Atenção!</strong> Voçê não pode excluir um vendedor com clientes. Por favor, transfira os clientes de carteira antes de executar essa ação."
	);
	$this->widget('booster.widgets.TbAlert', array(
		'fade' => true,
		'closeText' => '&times;', // false equals no close link
		'userComponentId' => 'user',
		'alerts' => array(
			'error' => array('closeText' => '&times;'),
		),
	));
}
//dbg($success);
if($success == 1){
	$user = Yii::app()->getComponent('user');
	$user->setFlash(
		'success',
		"<strong>Sucesso!</strong> Senha alterada/resetada com sucesso."
	);
	$this->widget('booster.widgets.TbAlert', array(
		'fade' => true,
		'closeText' => '&times;', // false equals no close link
		'userComponentId' => 'user',
		'alerts' => array(
			'success' => array('closeText' => '&times;'),
		),
	));
} else if ($success == 0) {
	$user = Yii::app()->getComponent('user');
	$user->setFlash(
		'error',
		"<strong>Erro!</strong> Não foi possível alterar/resetar a senha. Por favor, tente novamente."
	);
	$this->widget('booster.widgets.TbAlert', array(
		'fade' => true,
		'closeText' => '&times;', // false equals no close link
		'userComponentId' => 'user',
		'alerts' => array(
			'error' => array('closeText' => '&times;'),
		),
	));
}

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php if ($model->perfil == Funcionario::GERENTE) : ?>
            <h3 style="display: inline;font-size: 20px"><i class="fa fa-eye"></i> Visualizar Gerente: <?php echo $model->nome; ?></h3>
        <?php elseif ($model->perfil == Funcionario::SUPERVISOR) : ?>
            <h3 style="display: inline;font-size: 20px"><i class="fa fa-eye"></i> Visualizar Supervisor: <?php echo $model->nome; ?></h3>
        <?php elseif ($model->perfil == Funcionario::VENDEDOR) : ?>
            <h3 style="display: inline;font-size: 20px"><i class="fa fa-eye"></i> Visualizar Vendedor: <?php echo $model->nome; ?></h3>
        <?php endif; ?>
        <?php
		if (Yii::app()->user->perfil != Funcionario::SUPERVISOR) {
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'htmlOptions' => array('style' => 'float:right;margin-bottom: 10px;', 'class' => 'menu_operacoes'),
					'buttons' => array(
						array(
							'label' => 'Operações',
							'icon' => 'fa fa-cogs',
							'htmlOptions' => array('class' => 'btn-primary'),
							'items' => $itens
						),
					),
				)
			);
		}
        ?>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body" id="yw0">
        <?php $this->widget('booster.widgets.TbDetailView', array(
            //'type'=>'bordered condensed',
            'data' => $model,
            'attributes' => array(
                'nome',
                'cpf',
                'login',
                'fone',
                'email',
                'data_nascimento',
                $supervisor,
                'data_admissao',
                'endereco.endereco:text',
                'endereco.bairro:text',
                'endereco.cidade:text',
                'endereco.complemento:text',
                'endereco.referencia:text',
                array('name' => 'staus', 'value' => $model->statusText),
            ),
        )); ?>
    </div>

</div>

<?php if($model->perfil == Funcionario::SUPERVISOR):?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<a onclick="exibeEscondePainel('painelEndereco')"><h3 class="panel-title" style="display: inline;">
				<i class="fa fa-users"></i> Equipe de Vendedores
			</h3></a>
			<div class="clearfix"></div>
		</div>
		<?php $this->widget('booster.widgets.TbGridView', array(
			'id' => 'funcionario-grid',
			'type' => 'striped condensed bordered',
			'dataProvider' => $vendedores->search(),
			'filter' => $vendedores,
			'columns' => array(
				'nome',
				'fone',
				'data_nascimento',
				array('name'=>'status', 'value'=>'$data->statusText', 'filter'=>$vendedores->getStatusOptions()),

				array(
					'class' => 'booster.widgets.TbButtonColumn',
					'header' => 'Ações',
					'htmlOptions' => array('style' => 'width: 85px;text-align:center;'),
					'template' => Yii::app()->user->perfil == Funcionario::SUPERVISOR ? '{view}' : '{view}{update}{delete}',
					'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
					'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
					'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
					'buttons' => array(
						'view' => array
						(
							'options' => array('style' => 'margin-right:5px;'),
						),
						'update' => array
                        (
                            'options'=>array('style'=>'margin-right:5px;'),
                        ),
					),
				),
			),
		));
		?>
	</div>
<?php elseif($model->perfil == Funcionario::VENDEDOR):?>

	<section>
		<div class="tabs tabs-style-topline">
			<nav>
				<ul>
					<li>
						<a href="#section-topline-1" class="icon icon-date">
							<span>Clientes cadastrados Hoje</span>
						</a>
					</li>
					<li>
						<a href="#section-topline-2" class="icon icon-display">
							<span>Carteira do Vendedor</span>
						</a>
					</li>
				</ul>
			</nav>
			<div class="content-wrap">
				<section id="section-topline-1">
					<?php $this->renderPartial('_view_cadastros', array('cadastros' => $cadastros)); ?>
				</section>
				<section id="section-topline-2">
					<?php $this->renderPartial('_view_carteira', array('carteira' => $carteira,'model'=> $model)); ?>
				</section>
			</div><!-- /content -->
		</div><!-- /tabs -->
	</section>
<?php
	endif;

	Yii::app()->clientScript->registerScript('re-install-date-picker', "
	// Reset the datepicker after gridview ajax
	function reinstallDatePicker(id, data) {
		$('#datepicker_data_retorno_tab1').datepicker(jQuery.extend());
		$('#datepicker_data_retorno_tab2').datepicker(jQuery.extend());
	};

	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
	");

?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/TabStylesInspiration/js/cbpFWTabs.js"></script>

<script>
    $('#sub-menu-gerenciar').addClass('active');
    $('#sub-gerenciar-func').addClass('active');

	(function () {

		[].slice.call(document.querySelectorAll('.tabs')).forEach(function (el) {
			new CBPFWTabs(el);
		});

	})();

</script>