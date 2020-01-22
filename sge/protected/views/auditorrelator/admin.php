<style>
    .fundoBranco{background:#fff;}
    .espacoBotoes{margin-left: 5px;}
</style>

<h3>
    <i class="fa fa-list-alt"></i> Gerenciar Auditor/Relator

    <div class="btn-group" style="float:right">
        <button type="button" class="btn btn-info">Acões</button>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="<?php echo Yii::app()->createUrl('auditorrelator/create'); ?>">
                    <i class="fa fa-plus"></i> Novo
                </a>
            </li>
        </ul>
    </div>
</h3>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'auditorrelator-grid',
    'itemsCssClass'=>'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'setor_id',
        'nome',
        'setor',
        'email',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
            'header' => 'Ações',
            'htmlOptions' => array('style' => 'width: 85px;text-align:center'),
            'template' => '{view}{update}',
            'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
            'buttons' => array(
                'update' => array
                (
                    'options' => array('style' => 'margin-left:5px;'),
                ),
            ),
        ),
    ),
)); ?>

<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-auditor').addClass('active');
</script>

