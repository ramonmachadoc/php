<style>
    .fundoBranco{background:#fff;}
    .espacoBotoes{margin-left: 5px;}
</style>

<h3>
    <i class="fa fa-sort-amount-asc"></i> Listagem  de Permissões
    <div class="btn-group" style="float:right">
        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo Yii::app()->createUrl('permissao/create'); ?>"><i class="fa fa-plus"></i> Nova</a>
            </li>
        </ul>
    </div>
</h3>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'permissao-grid',
    'itemsCssClass' => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'  => $model->search(),
    'filter'        => $model,
    'columns' => array(
		array(
            'name'   => '_filterUsuarioId',
            'filter' => CHtml::listData(Usuario::model()->findAll(array('order'=>'nome')), 'usuario_id', 'nome'),
            //'value'  => 'Empresa::Model()->FindByPk($data->empresa_id)->nome',
			'value'  => '$data->usuario->nome',
        ),
        /*array(
            'name'   => '_filterLogin',
			'value'  => '$data->usuario->login',
        ),*/
        array(
            'name'   => 'perfil',
            'filter' => $model->perfilOptions,
            'value'  => '$data->perfilText',
        ),
        array(
            'name'   => 'empresa_id',
            'filter' => CHtml::listData(Empresa::model()->findAll(), 'empresa_id', 'nome'),
			'value'  => '$data->empresa->nome',
        ),
        
		array(
            'name'   => 'area_id',
            'filter' => CHtml::listData(Area::model()->findAll(), 'area_id', 'descricao'),
            'value'  => '$data->area->descricao',
        ),

        array(
            'class'           => 'booster.widgets.TbButtonColumn',
            'header'          => 'Ações',
            'htmlOptions'     => array('style' => 'width: 85px;text-align:center'),
            'template'        => '{delete}',
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
            'buttons'         => array(
                'update' => array('options' => array('style' => 'margin-left:5px;'),),
                'delete' => array('options'=>  array('style' => 'margin-left:5px;'),),
            ),
        ),
    ),
)); ?>

<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#adm-permissao').addClass('active');
</script>