
<!--<div class="alert alert-warning" role="alert" style="margin-bottom: -12px">
    <i class="fa fa-thumbs-o-down"></i> Eventos com Contenções Pendentes
</div>-->

<?php $this->widget('booster.widgets.TbGridView', array(
    'id'              => 'eventoContencao-grid',
    'itemsCssClass'   => 'table table-bordered table-condensed text-center table-hover table-striped fundoBranco',
    'dataProvider'    => $model->searchAdministradorContencao(),
    'filter'          => $model,
	'afterAjaxUpdate' => 'function(link,success,data){ reinstallDatePicker(); }',
    'columns'         => array(
        'codigo',
        'numeroitem',
        'numerochecklist',
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
					'id'    => 'datepicker_dataevento_contencao',
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
            'template'        => '{avaliar}',
            /*'viewButtonUrl'   => 'Yii::app()->controller->createUrl("contencao/viewcontencao", array(
                                    "evento"    => Utils::encodeGET($data->primaryKey),
                                    "contencao" => Utils::encodeGET($data->contencao->contencao_id)
                ))',*/
            //'updateButtonUrl' => 'Yii::app()->controller->createUrl("updaterespostacontencao",array("id"=>$data->primaryKey))',
            'buttons'         => array(
                //'update' => array('options' => array('style' => 'margin-left:5px;'),),
                'avaliar' => array(
                    'label'   => 'Avaliar Contenção',
                    'icon'    => 'fa fa-gavel',
                    //'url'=>'Yii::app()->createUrl("retorno/reagendar", array("id"=>$data->id_cliente))',
                    //'url'     => 'Yii::app()->createUrl("contencao/avaliarcontencao", array("evento"=>Utils::encodeGET($data->primaryKey)))',
                    'url'     => 'Yii::app()->createUrl("contencao/avaliar", array(
                        "evento"    => Utils::encodeGET($data->primaryKey),
                        "contencao" => Utils::encodeGET($data->contencao->contencao_id)
                    ))',
                    'options' => array('style'=>'margin-left:5px;', 'class'=>'btn btn-danger btn-xs'),
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
		$('#datepicker_dataevento1').datepicker(jQuery.extend());
        $('#Evento_setor_id').hide();
	};

	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);"
); */?>
