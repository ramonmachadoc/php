<style>
    #vendedores-iframe {
        width: 100%;
        height: 100%;
    }

    .modal-body {
        height: 400px;
    }
</style>

<div id="grid-view-supervisores" class="grid-view">
    <?php if (count($supervisores) != 0): ?>
    <table class="items table table-striped table-condensed" style="padding: 0px;">
        <thead class="tableFloatingHeaderOriginal"
               style="position: static; margin-top: 0px; left: 425.5px; z-index: 1; top: 40px; width: 807px;">
        <tr>
            <th style="min-width: 0px; max-width: none;text-align: center">#</th>
            <th style="min-width: 0px; max-width: none;">Supervisor</th>
            <th style="min-width: 0px; max-width: none;text-align: center">Cadastros da Equipe</th>
            <th style="min-width: 0px; max-width: none;text-align: center"> Retornos Hoje/Atrasados</th>
            <th class="button-column" id="yw0_c5"></th>
        </tr>
        </thead>
        <tbody>
        <?php $numero = 1; ?>
        <?php foreach ($supervisores as $supervisor): ?>

            <tr class="odd">
                <td style="width: 60px;text-align: center"><?php echo $numero; ?></td>
                <td><?php echo $supervisor->nome; ?></td>
                <td style="font-size: 1.2em; text-align: center">
                    <?php $this->widget(
                        'booster.widgets.TbButton',
                        array(
                            'context' => $supervisor->qtdAgendamentosSup < (count($supervisor->vendedores) * 5) || $supervisor->qtdAgendamentosSup == 0 ? 'danger' : 'success',
                            'label' => $supervisor->qtdAgendamentosSup . '/' . (count($supervisor->vendedores) * 5),
                            'htmlOptions' => array(
                                'onclick' => 'abrirModalVend(' . $supervisor->id_funcionario . ')',
                                'style' => 'width: 90px; padding: 3px 5px 1px 5px;'
                                /*'data-toggle' => "tooltip",
                                'data-original-title' => "Vendedores"*/)
                        ));
                    ?>
                </td>
                <td style="font-size: 1.2em; text-align: center">
                    <?php
                        $qtdRetornosHoje = Funcionario::getRetornosHoje($supervisor->id_funcionario);
                        $qtdRetornosAtrasados = Funcionario::getRetornosAtrasados($supervisor->id_funcionario);
                        $this->widget(
                            'booster.widgets.TbButton',
                            array(
                                'context' => $qtdRetornosHoje > 0 || $qtdRetornosAtrasados > 0 ? 'danger' : 'success',
                                'label' => $qtdRetornosHoje.'/'. $qtdRetornosAtrasados,
                                'htmlOptions' => array(
                                    'style' => 'width: 90px; padding: 3px 5px 1px 5px;'
                                )
                            )
                        );
                    ?>
                </td>
                <td style="text-align: center" nowrap="nowrap">
                    <a class="view" title="" data-toggle="tooltip" href="<?php echo Yii::app()->createUrl('funcionario/view', array('id' => $supervisor->id_funcionario)); ?>" data-original-title="Visualizar">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
                </td>
            </tr>
            <?php $numero++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <h3>Nenhum supervisor cadastrado!</h3>
    <?php endif; ?>
    <!--    --><?php //$this->widget('booster.widgets.TbPager', array('pages' => $pages)); ?>
    <div class="keys" style="display:none" title="/extendedGridView">
        <span>1</span><span>2</span><span>3</span><span>4</span></div>
    <div class="keys" style="display:none" title="/extendedGridView">
        <span>1</span><span>2</span><span>3</span><span>4</span></div>
</div>

<script>
    function abrirModalVend(id) {

        $('.modal-body').html("<iframe id='modal-iframe' frameborder='0'></iframe>");

        $('#modal-titulo').html('Vendedores');

        var data = $('#Funcionario_dataComparacaoRanking').val();
        $('#modal').modal();
        document.getElementById('modal-iframe').contentWindow.location.replace('<?php echo Yii::app()->getBaseUrl() . "/ranking/buscavendedores"; ?>' + '?id=' + id + '&data=' + data);
    }
</script>