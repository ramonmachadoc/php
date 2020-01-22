<h3 style="margin-bottom:-13px">
    <i class="fa fa-bullhorn"></i> Lista de Todos os Eventos 
</h3><br><br>

<!-- Alerta de SUCESSO -->
<?php $this->widget('booster.widgets.TbAlert', array(
    'fade'            => true,
    'closeText'       => false,
    'events'          => array(),
    'htmlOptions'     => array('id'=>'flash-success'),
    'userComponentId' => 'user',
));  
Yii::app()->clientScript->registerScript(
    'myHideEffect',
    '$("#flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
    CClientScript::POS_READY
); ?>

<?php $this->widget('booster.widgets.TbTabs', array(
    'type'      => 'pills', //'tabs', 'pills', or 'list'
    'justified' => true,
    'tabs'      => array(
        array(
            'label'   => 'Abertos', 
            'active'  => true,
            'content' => $this->renderPartial("administrador/_abertoAba", array('model' => $model),true),
        ),           
        array(
            'label'   => 'Análisar Contenção',
			'content' => $this->renderPartial("administrador/_pendenteContencaoAba", array('model' => $model),true),
        ),
        array(
        	'label'   => 'Análisar PAC', 
        	'content' => $this->renderPartial("administrador/_pendentePlanoAcaoAba", array('model' => $model),true),
        ),
        array(
            'label'   => 'Em Processo', 
            'content' => $this->renderPartial("administrador/_processoAba", array('model' => $model),true),
        ),        
        array(
            'label'   => 'Encerrados', 
            'content' => $this->renderPartial("administrador/_encerradosAba", array('model' => $model),true),
        ),        
    ),
));?>

<?php Yii::app()->clientScript->registerScript('re-install-date-picker', 
    "// Reset the datepicker after gridview ajax
    function reinstallDatePicker(id, data) {
        $('#datepicker_dataevento_aberto').datepicker(jQuery.extend());
        $('#datepicker_dataevento_contencao').datepicker(jQuery.extend());
        $('#datepicker_dataevento_pac').datepicker(jQuery.extend());
        $('#datepicker_dataevento_processo').datepicker(jQuery.extend());
        $('#datepicker_dataevento_encerrado').datepicker(jQuery.extend());
    };

    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);"
); ?>

<script>
    $('#sub-menu-adm-evento').addClass('active');
    $('#admevento-listar').addClass('active');
</script>
