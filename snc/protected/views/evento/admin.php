<style>
    .fundoBranco{background:#fff;}
    .espacoBotoes{margin-left: 5px;}
</style>

<h3>
    <i class="fa fa-sort-amount-asc"></i> Listagem de Eventos
    <div class="btn-group" style="float:right">
        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo Yii::app()->createUrl('evento/create'); ?>">
                    <i class="fa fa-plus"></i> Novo
                </a>
            </li>
            <!--
            <li>
                <a href="<?php echo Yii::app()->createUrl('evento/create'); ?>"><i class="fa fa-pencil fa-fw"></i> Editar</a>
            </li>
            <li><a href="<?php echo Yii::app()->createUrl('evento/admin'); ?>"><i class="fa fa-list"></i> Listar</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Deletar</a></li>
            -->
        </ul>
    </div>
</h3>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'evento-grid',
    'itemsCssClass'=>'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'codigo',
        array(
            'name'   => 'empresa_id',
            'filter' => CHtml::listData(Empresa::model()->findAll(), 'empresa_id', 'nome'),
            'value'  => 'Empresa::Model()->FindByPk($data->empresa_id)->nome',
        ),
        array(
            'name'   => 'area_id',
            'filter' => CHtml::listData(Area::model()->findAll(), 'area_id', 'descricao'),
            'value'  => 'Area::Model()->FindByPk($data->area_id)->descricao',
        ),
        array(
            'name'   => 'setor_id',
            'filter' => CHtml::listData(Setor::model()->findAll(), 'setor_id', 'descricao'),
            'value'  => 'Setor::Model()->FindByPk($data->setor_id)->descricao',
        ),
        array(
            'name'   => 'tipoauditoria_id',
            'filter' => CHtml::listData(Tipoauditoria::model()->findAll(), 'tipoauditoria_id', 'descricao'),
            'value'  => 'Tipoauditoria::Model()->FindByPk($data->tipoauditoria_id)->descricao',
        ),
        array(
            'name'   => 'equipamento_id',
            'filter' => CHtml::listData(Equipamento::model()->findAll(), 'equipamento_id', 'descricao'),
            'value'  => 'Equipamento::Model()->FindByPk($data->equipamento_id)->descricao',
        ),

        array(
            'class'           => 'booster.widgets.TbButtonColumn',
            'header'          => 'Ações',
            'htmlOptions'     => array('style' => 'width: 85px;text-align:center'),
            'template'        => '{view}{update}',
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
            'buttons'         => array(
                'update' => array('options' => array('style' => 'margin-left:5px;'),),
            ),
        ),
    ),
)); ?>

<script>
    $('#sub-menu-evento').addClass('active');
    $('#naoconf-lista').addClass('active');
</script>