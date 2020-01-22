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
                <a href="<?php echo Yii::app()->createUrl('usuario/create'); ?>">
                    <i class="fa fa-plus"></i> Novo
                </a>
            </li>
        </ul>
    </div>
</h3>
<br>


<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'usuarios-grid',
    'itemsCssClass'   => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->search(),
    'filter'          => $model,
    'columns'         => array(
        'nome',
        'login',
        array(
            'name'   => 'empresa_id',
            'filter' => CHtml::listData(Empresa::model()->findAll(), 'empresa_id', 'nome'),
            'value'  => 'Empresa::Model()->FindByPk($data->empresa_id)->nome',
        ),
        array(
            'name'   => 'setor_id',
            'filter' => CHtml::listData(Setor::model()->findAll(), 'setor_id', 'descricao'),
            'value'  => 'Setor::Model()->FindByPk($data->setor_id)->descricao',
        ),
        array(
            'name'   => 'auditado',
            'filter' => $model->auditadoOptions,
            'value'  => '$data->auditadoText',
        ),       
        array(
            'name'   => 'status',
            'filter' => $model->statusOptions,
            'value'  => '$data->statusText',
        ),     

        array(
            'class'           => 'booster.widgets.TbButtonColumn',
            'header'          => 'Ações',
            'htmlOptions'     => array('style' => 'width: 100px;text-align:center'),
            'template'        => '{view}{update}{permissao}',
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("id"=>$data->primaryKey))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
            'buttons'         => array(
                'permissao' => array(
                    'label'   => 'Conceder Permissão',
                    'icon'    => 'fa fa-lock',
                    'url'     => 'Yii::app()->createUrl("permissao/create", array("usuario" => Utils::encodeGET($data->primaryKey)))',
                    'options' => array('style'=>'margin-left:10px;'),
                    'visible' => '$data->auditado == Usuario::NAO' ,
                ),
                'update' => array('options' => array('style' => 'margin-left:10px;'),),
            ),
        ),


    ),
)); ?>
<br><br>



<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-usuario').addClass('active');
</script>

