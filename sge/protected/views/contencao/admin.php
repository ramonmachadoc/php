<style>
    .fundoBranco{background:#fff;}
    .espacoBotoes{margin-left: 5px;}
</style>

<h3>
    <i class="fa fa-list-alt"></i> Gerenciar Usuários
    <div class="btn-group" style="float:right">
        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo Yii::app()->createUrl('usuario/create'); ?>"><i class="fa fa-plus"></i> Novo</a>
            </li>
            <!--
            <li>
                <a href="<?php echo Yii::app()->createUrl('usuario/create'); ?>"><i class="fa fa-pencil fa-fw"></i> Editar</a>
            </li>
            <li><a href="<?php echo Yii::app()->createUrl('usuario/admin'); ?>"><i class="fa fa-list"></i> Listar</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Deletar</a></li>
            -->
        </ul>
    </div>
</h3>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'usuario-grid',
    'itemsCssClass'=>'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array('name'=>'perfil', 'value'=>'$data->perfilText', 'filter'=>$model->getPerfilOptions()),
        array(
            'name'   => 'setor_id',
            'filter' => CHtml::listData(Setor::model()->findAll(), 'setor_id', 'descricao'),
            'value'  => 'Setor::Model()->FindByPk($data->setor_id)->descricao',
        ),
        'nome',
        'login',
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
    $('#sub-menu-cadastros').addClass('active');
    $('#basicos-usuario').addClass('active');
</script>

