
<h3 style="margin-bottom:-13px">
    <i class="fa fa-bullhorn"></i>
    Eventos do Setor:  
    <span class="label label-default">
        <?php
            $setor = Yii::app()->user->setor;
            $empresasigla = isset(Yii::app()->user->empresasigla) ? " / ".Yii::app()->user->empresasigla : "";

            echo $setor.$empresasigla;
        ?>
            
    </span>
</h3>
<br><br>

<?php $this->widget('booster.widgets.TbTabs', array(
    
    'type'      => 'pills', //'tabs', 'pills', or 'list'
    'justified' => true,
    'tabs'      => array(
        array(
            'label'   => 'Pendente Contenção',
            'active'  => true,
			'content' => $this->renderPartial("auditado/_pendenteContencaoAba", array('model' => $model),true),
        ),
        array(
        	'label'   => 'Pendente Plano de Ação', 
        	'content' => $this->renderPartial("auditado/_pendentePlanoAcaoAba", array('model' => $model),true),
        ),
        array(
        	'label'   => 'Em Análise', 
        	'content' => $this->renderPartial("auditado/_analiseAba", array('model' => $model),true),
        ),
        array(
            'label'   => 'Encerrados', 
            'content' => $this->renderPartial("auditado/_encerradosAba", array('model' => $model),true),
        ),
    ),
));?>

<?php Yii::app()->clientScript->registerScript('re-install-date-picker', 
    "// Reset the datepicker after gridview ajax
    function reinstallDatePicker(id, data) {
        $('#auditado_contencao_datepicker').datepicker(jQuery.extend());
        $('#auditado_planoacao_datepicker').datepicker(jQuery.extend());
        $('#auditado_analise_datepicker').datepicker(jQuery.extend());
        $('#auditado_encerrado_datepicker').datepicker(jQuery.extend());
    };

    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);"
); ?>

<script>
    $('#sub-menu-auditado-evento').addClass('active');
    $('#auditado-evento-listar').addClass('active');
</script>
