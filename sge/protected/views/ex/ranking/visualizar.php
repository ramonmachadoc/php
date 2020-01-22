<style>
    #modal-iframe {
        width: 100%;
        height: 100%;
    }

    .modal-body {
        max-height: 400px;
    }
</style>

<h3><i class="fa fa-tachometer"></i> Ranking</h3>

<?php

    $form = $this->beginWidget(
        'booster.widgets.TbActiveForm',
        array(
            'id' => 'inlineForm',
            'type' => 'inline',
            'htmlOptions' => array('class' => 'well'),
        )
    );
    echo $form->datePickerGroup($funcionario, 'dataComparacaoRanking',
        array(
            'widgetOptions' => array(
                'options' => array(
                    'format' => 'dd/mm/yyyy',
                ),
                'htmlOptions' => array('placeholder' => 'Buscar por Data'),
            ),
            'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
        )
    );

    $this->widget(
        'booster.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Buscar')
    );

    $this->endWidget();
unset($form);

?>

<section>
    <div class="tabs tabs-style-topline">
        <nav>
            <ul>
                <li>
                    <a href="#section-topline-1" class="icon icon-date">
                        <span>Vendedores</span>
                    </a>
                </li>
                <?php if(Yii::app()->user->perfil == Funcionario::GERENTE):?>
                    <li>
                        <a href="#section-topline-2" class="icon icon-home">
                            <span>Supervisores</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="#section-topline-3" class="icon icon-display">
                        <span>Vendas</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="content-wrap">
            <section id="section-topline-1">
                <?php echo $this->renderPartial('_vendedores', array('vendedores'=>$vendedores/*, 'pages'=>$pages*/)); ?>
            </section>
            <?php if(Yii::app()->user->perfil == Funcionario::GERENTE):?>
            <section id="section-topline-2">
                <?php echo $this->renderPartial('_supervisores', array('supervisores' => $supervisores/*, 'pages'=>$pages*/)); ?>
            </section>
            <?php endif; ?>
            <section id="section-topline-3">
                <?php echo $this->renderPartial('_vendas', array('vendas' => $vendas, 'pages'=>$pages)); ?>
            </section>
        </div><!-- /content -->
    </div><!-- /tabs -->
</section>


<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'modal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4 id="modal-titulo"></h4>
</div>

<div class="modal-body">
</div>

<div class="modal-footer">
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'context' => 'danger',
            'label' => 'Fechar',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/TabStylesInspiration/js/cbpFWTabs.js"></script>

<script>
    (function () {
        $('#sub-menu-rank').addClass('active');

        [].slice.call(document.querySelectorAll('.tabs')).forEach(function (el) {
            new CBPFWTabs(el);
        });

    })();
</script>