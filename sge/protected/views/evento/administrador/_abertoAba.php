
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'eventoAbertos-grid',
    'itemsCssClass'   => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->searchAdministradorAberto(),
    'filter'          => $model,
	'afterAjaxUpdate' => 'function(link,success,data){ reinstallDatePicker(); }',
    'columns'         => array(
        'codigo',
        'numeroitem',
        'numerochecklist',
        'prazoresposta',
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
        /*array(
            'name'   => 'area_id',
            'filter' => CHtml::listData(Area::model()->findAll(), 'area_id', 'descricao'),
            'value'  => 'Area::Model()->FindByPk($data->area_id)->descricao',
        ),*/
        array(
            'name' => 'dataevento',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'       => $model,
                'attribute'   => 'dataevento',
                'language'    => 'pt-BR',
                'htmlOptions' => array(
                    'id'    => 'datepicker_dataevento_aberto',
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
            'class'         => 'booster.widgets.TbButtonColumn',
            'header'        => 'Ações',
            'htmlOptions'   => array('style' => 'width: 85px;text-align:center'),
            'template'      => '{view}',
            'viewButtonUrl' => 'Yii::app()->createUrl("evento/view", array(
                                    "eventoid"    => Utils::encodeGET($data->primaryKey)
                                ))',
            'buttons' => array(
                'view' => array(
                    'icon'    => 'fa fa-search',
                    'options' => array(
                        'class'=>'btn btn-success btn-xs',
                    ),
                ),
            ),

        ),

    ),
)); ?>
<br><br>
