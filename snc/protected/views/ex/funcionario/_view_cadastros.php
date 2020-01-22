<style>
    #cadastros-grid {
        font-size: 0.8em;
    }
</style>
<?php $this->widget('booster.widgets.TbGridView', array(
    'id' => 'cadastros-grid',
    'itemsCssClass' => 'fundoBranco',
    'type' => 'striped condensed bordered',
    'dataProvider' => $cadastros->search(),
    'filter' => $cadastros,
//    'summaryText' => '',
    'enableSorting' => true,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns' => array(
        'nome',
        'fone',
        array(
            'name' => 'data_retorno',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $cadastros,
                'attribute' => 'data_retorno',
                'language' => 'pt-BR',
                'htmlOptions' => array(
                    'id' => 'datepicker_data_retorno_tab1',
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
        'modelo_moto',
        array('name' => 'status', 'value' => '$data->statusText', 'filter' => $carteira->statusOptions),

        array(
            'class' => 'booster.widgets.TbButtonColumn',
            'header' => 'Ações',
            'htmlOptions' => array('style' => 'width: 85px; text-align:center;'),
            'template' => '{view}',
            'viewButtonUrl' => 'Yii::app()->createUrl("cliente/view",  array("id"=>$data->primaryKey))',
        )
    ),
)); ?>