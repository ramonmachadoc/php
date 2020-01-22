<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'trocar-carteira-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well', 'style' => 'background:#ffffff;')
)); ?>

<?php echo $form->errorSummary($model); ?>

<div style="display: none">
    <input type="text" name="Funcionario[origem]" value="carteira">
    <?php echo $form->textAreaGroup($model, 'clientes_id'); ?>
</div>

<!-- Supervisor -->
<div id='divSupervisor'>
    <?php echo $form->dropDownListGroup($model, 'supervisor_id',
        array(
            'wrapperHtmlOptions' => array(
                'class' => 'span5',
            ),
            'widgetOptions' => array(
                'data' => CHtml::listData(Funcionario::model()->findAll('perfil=' . Funcionario::SUPERVISOR), 'id_funcionario', 'nome'),
                'htmlOptions' => array(
                    'empty' => '...:: Selecione um Supervisor ::...',
                    'onchange' => 'carregaVendedoresAjax()'),
            ),
            'prepend' => '<i class="fa fa-user"></i>'
        )
    ); ?>
</div>

<!-- Vendedor -->
<div id='divVendedor'>
    <?php echo $form->dropDownListGroup($model, 'id_funcionario',
        array(
            'wrapperHtmlOptions' => array(
                'class' => 'span5',
            ),
            'widgetOptions' => array(
                'htmlOptions' => array('empty' => '...:: Selecione um Vendedor ::...'),
            ),
            'prepend' => '<i class="fa fa-user"></i>'
        )
    ); ?>
</div>


<!-- BOTAO -->
<div class="form-actions" style='display:none'>
    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => 'Trocar',
    )); ?>
</div>

<?php $this->endWidget(); ?>

<script>

    $(document).ready(function () {

        erro = $('.alert');
        if (erro.length > 0) {
            divErro = parent.$('#modal-troca-carteira').find('.modal-body').find('#erros');
            divErro.html(erro.html());
            erro.remove();
            divErro.attr('style', 'display:block;');

        } else {
            divErro = parent.$('#modal-troca-carteira').find('.modal-body').find('#erros');
            divErro.html(erro.html());
            divErro.attr('style', 'display:none;');
        }

        $('#divVendedor').hide();

        var clientes = parent.$('#clientes_id').val();

        if (clientes != '') {
            $('#Funcionario_clientes_id').val(clientes);
        }

    });//fim onload

    /**
     * AJAX - Carrega os vendedores
     */
    function carregaVendedoresAjax() {
        var option = new Option('...:: Selecione um Vendedor ::...', '');
        $('#Funcionario_id_funcionario').html('');
        $('#Funcionario_id_funcionario').append(option);
        var id_supervisor = $('#Funcionario_supervisor_id').val();
        if (id_supervisor != '') {
            $.ajax({
                type: "GET",
                url: '<?php echo Yii::app()->baseUrl; ?>/funcionario/buscavendedores',
                data: 'id=' + id_supervisor,
                success: function (data) {
                    var response = $.parseJSON(data);
                    $.each(response, function (key, val) {
                        var option = new Option(val.nome, val.id);
                        $('#Funcionario_id_funcionario').append(option);
                    });

                    $('#divVendedor').show(400);

                }
            });
        }
        else {
            $('#divVendedor').hide(400);
        }
    }
</script>