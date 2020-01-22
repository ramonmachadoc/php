<style>
    .fundoBranco{background:#fff;}
    .espacoBotoes{margin-left: 5px;}
</style>

<h3>
    <i class="fa fa-list-alt"></i> Gerenciar Causas Raiz
    <div class="btn-group" style="float:right">
        <a class="btn btn-info" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Ações</a>
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo Yii::app()->createUrl('causaraiz/create'); ?>">
                    <i class="fa fa-plus"></i> Novo
                </a>
            </li>
        </ul>
    </div>
</h3>
<br>


<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'causaraiz-grid',
    'itemsCssClass'   => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->search(),
    'filter'          => $model,
    'columns'         => array(
        'tipo',
        'categoria',
        'codigo',
        'subcategoria',
        array(
            'class'           => 'booster.widgets.TbButtonColumn',
            'header'          => 'Ações',
            'htmlOptions'     => array('style' => 'width: 100px;text-align:center'),
            'template'        => '{view}{update}',
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("id"=>$data->primaryKey))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
            
        ),


    ),
)); ?>
<br><br>



<script>
    $('#sub-menu-adm-gerenc').addClass('active');
    $('#admgerenc-causaraiz').addClass('active');
</script>
