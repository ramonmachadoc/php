<style>
    .fundoBranco{background:#fff;}
    .espacoBotoes{margin-left: 5px;}
</style>

<h3><i class="fa fa-list-alt"></i> Gerenciar Funcionários</h3>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'funcionario-grid',
    'itemsCssClass'=>'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns' => array(
        'nome',
        'fone',
        array(
            'name' => 'data_nascimento',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'data_nascimento',
                'language' => 'pt-BR',
                'htmlOptions' => array(
                    'id' => 'datepicker_data_nascimento',
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
        array('name'=>'perfil', 'value'=>'$data->perfilText', 'filter'=>$model->getPerfilOptions()),
        array('name'=>'status', 'value'=>'$data->statusText', 'filter'=>$model->getStatusOptions()),
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
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
// Reset the datepicker after gridview ajax
function reinstallDatePicker(id, data) {
    $('#datepicker_data_nascimento').datepicker(jQuery.extend());
};

$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
");

?>

<script>
    $('#sub-menu-gerenciar').addClass('active');
    $('#sub-gerenciar-func').addClass('active');
</script>
