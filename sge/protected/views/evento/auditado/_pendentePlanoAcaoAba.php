
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'auditado_planoacao_grid',
    'itemsCssClass'   => 'table table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->searchAuditadoPlanoacao(),
    'filter'          => $model,
    'afterAjaxUpdate' => 'function(link,success,data){ reinstallDatePicker(); }',
    'columns'         => array(
        //'setor_id', 
        'codigo',
        /*array(
            'name'   => 'setor_id',
            //'filter' => CHtml::listData(Setor::model()->findAll(), 'empresa_id', 'nome'),
            'value'  => 'Setor::Model()->FindByPk($data->setor_id)->descricao',
        ),*/
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
            'name'   => 'tipoauditoria_id',
            'filter' => CHtml::listData(Tipoauditoria::model()->findAll(), 'tipoauditoria_id', 'descricao'),
            'value'  => 'Tipoauditoria::Model()->FindByPk($data->tipoauditoria_id)->descricao',
        ),
        
        array(
            'name' => 'dataevento',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'       => $model,
                'attribute'   => 'dataevento',
                'language'    => 'pt-BR',
                'htmlOptions' => array(
                    'id'    => 'auditado_planoacao_datepicker',
                    'class' => 'form-control',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn'            => 'focus',
                    'dateFormat'        => 'dd/mm/yyyy',
                    'showOtherMonths'   => true,
                    'selectOtherMonths' => true,
                    'changeMonth'       => true,
                    'changeYear'        => true,
                    'showButtonPanel'   => true,
                )
            ), true),
        ),

   
        array(
            'class'           => 'booster.widgets.TbButtonColumn',
            'header'          => 'Ações',
            'htmlOptions'     => array('style' => 'width: 85px;text-align:center'),
            'template'        => '{responder}',
            //'viewButtonUrl'   => 'Yii::app()->controller->createUrl("viewplanoacao", array("id"=>$data->primaryKey))',
            //'updateButtonUrl' => 'Yii::app()->controller->createUrl("updaterespostacontencao",array("id"=>$data->primaryKey))',
            'buttons'         => array(
                //'update' => array('options' => array('style' => 'margin-left:5px;'),),
                'responder' => array(
                    'label'   => 'Enviar o Plano de Ação',
                    'icon'    => 'fa fa-share',
                    //'url'=>'Yii::app()->createUrl("retorno/reagendar", array("id"=>$data->id_cliente))',
                    'url'     => 'Yii::app()->createUrl("planoacao/create", array("eventoid"=>Utils::encodeGET($data->primaryKey)))',
                    'options' => array('style'=>'margin-left:5px;'),
                ),
                /*'delete' => array(
                    'options'=>array('style'=>'margin-left:5px;'),
                ),*/
            ),
        ),

    ),
)); ?>
<br><br>
<?php /*Yii::app()->clientScript->registerScript('re-install-date-picker', 
    "// Reset the datepicker after gridview ajax
    function reinstallDatePicker(id, data) {
        $('#datepicker_dataevento2').datepicker(jQuery.extend());
        $('#Evento_setor_id').hide();
    };

    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);"
); */?>


