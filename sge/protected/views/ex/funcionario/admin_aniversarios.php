<?php
//$this->widget(
//    'booster.widgets.TbBreadcrumbs',
//    array(
//        'links' => array('Aniversários'),
//    )
//);
//?>

<h3><i class="fa fa-birthday-cake"></i> Aniversário de Funcionários</h3>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'funcionario-grid',
    'type' => 'striped condensed bordered',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'nome',
        'fone',
        'email',
        'data_nascimento',
        array('name' => 'perfil', 'value' => '$data->perfilText', 'filter' => $model->getPerfilOptions()),
        /*array(
            'class' => 'booster.widgets.TbButtonColumn',
			'header' => 'Ações',
			'htmlOptions' => array('style' => 'width: 85px;'),
			'template' => '{view}',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",  array("id"=>$data->primaryKey))',
        ),*/
    ),
));
?>

<script>
    $('#sub-menu-gerenciar').addClass('active');
    $('#sub-gerenciar-func').addClass('active');
</script>
