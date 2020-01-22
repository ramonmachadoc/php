<h3 id='tituloPagina'><i class="fa fa-lock"></i> Alterar Senha: <?php echo $model->nome; ?></h3>
<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'trocar-senha-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well', 'style' => 'background:#ffffff;')
)); ?>

<?php echo $form->errorSummary($model); ?>

<!-- Nova Senha -->
<?php echo $form->passwordFieldGroup($model, 'senha',
    array('widgetOptions' => array(
        'htmlOptions' => array(
            'class' => 'span5',
            'maxlength' => 50
        )
    ),
        'prepend' => '<i class="fa fa-key"></i>'
    ));
?>

<!-- Repetir Senha -->
<?php echo $form->passwordFieldGroup($model, 'senha_verify',
    array('widgetOptions' => array(
        'htmlOptions' => array(
            'class' => 'span5',
            'maxlength' => 50
        )
    ),
        'prepend' => '<i class="fa fa-key"></i>'
    ));
?>


<!-- BOTAO -->
<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => 'Alterar',
    )); ?>
</div>

<?php $this->endWidget(); ?>

<script>
    $('#sub-menu-gerenciar').addClass('active');
    $('#sub-gerenciar-func').addClass('active');
</script>