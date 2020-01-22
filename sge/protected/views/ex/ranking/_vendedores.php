<style>
    .table {
        font-size: 0.8em;
    }

    .extended-summary {
        width: 272px;
        padding-bottom: 25px;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
    }
</style>
<div id="yw0" class="grid-view">
    <?php if (count($vendedores) != 0): ?>
        <table class="items table table-striped table-condensed" style="padding: 0px;">
            <thead class="tableFloatingHeaderOriginal"
                   style="position: static; margin-top: 0px; left: 425.5px; z-index: 1; top: 40px; width: 807px;">
            <tr>
                <th style="min-width: 0px; max-width: none;text-align: center">#</th>
                <th style="min-width: 0px; max-width: none;">Vendedor</th>
                <th style="min-width: 0px; max-width: none;">Supervisor</th>
                <th style="min-width: 0px; max-width: none;text-align: center">Cadastros</th>
                <th class="button-column" id="yw0_c5" style="text-align: center"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $numero = 1;
            $totalCadastros = 0;
            ?>
            <?php foreach ($vendedores as $vendedor): ?>

                <tr class="odd">
                    <td style="width: 60px;text-align: center"><?php echo $numero; ?></td>
                    <td><?php echo $vendedor->nome; ?></td>
                    <td><?php echo $vendedor->supervisor->nome; ?></td>
                    <td style="font-size: 1.2em;text-align: center">
                        <?php $this->widget(
                            'booster.widgets.TbButton',
                            array(
                                'context' => $vendedor->qtdAgendamentosVend < 5 ? 'danger' : 'success',
                                'label' => $vendedor->qtdAgendamentosVend . '/5',
                                'htmlOptions' => array(
                                    'onclick' => 'abrirModalClientes(' . $vendedor->id_funcionario . ', ' . $vendedor->qtdAgendamentosVend . ')',
                                    'style' => 'width: 90px; padding: 3px 5px 1px 5px;'
                                    /*'data-toggle' => "tooltip",
                                    'data-original-title' => "Clientes"*/)
                            ));
                        ?>
                    </td>
                    <td style="text-align: center" nowrap="nowrap">
                        <a class="view" title="" data-toggle="tooltip"
                           href="<?php echo Yii::app()->createUrl('funcionario/view', array('id' => $vendedor->id_funcionario)); ?>"
                           data-original-title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                    </td>
                </tr>
                <?php $numero++; ?>
                <?php $totalCadastros += $vendedor->qtdAgendamentosVend; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <div class="well pull-left extended-summary">
            <h4 style="margin-bottom: 20px">Total de Clientes no Banco de Dados</h4>
            <?php
            $this->widget(
                'booster.widgets.TbLabel',
                array(
                    'context' => 'info',
                    'label' => Cliente::getQtdTotalClientes(),
                    'htmlOptions' => array('style' => 'padding: 8px 30px 5px 30px;font-size:1.2em')
                )
            );
            ?>
        </div>
        <div class="well pull-right extended-summary">
            <h4 style="margin-bottom: 20px">Total de Cadastros Hoje</h4>
            <?php
            $this->widget(
                'booster.widgets.TbLabel',
                array(
                    'context' => $totalCadastros < (($numero - 1) * 5) ? 'danger' : 'success',
                    'label' => $totalCadastros . '/' . ($numero - 1) * 5,
                    'htmlOptions' => array('style' => 'padding: 8px 30px 5px 30px;font-size:1.2em')
                )
            );
            ?>
        </div>
    <?php else: ?>
        <h3>Nenhum vendedor cadastrado!</h3>
    <?php endif; ?>
    <br clear="all">
</div>

<script>
    function abrirModalClientes(id, qtd) {
        if (qtd > 0) {
            $('.modal-body').html("<iframe id='modal-iframe' frameborder='0'></iframe>");
        }
        else {
            $('.modal-body').html("<p id='texto'> Nenhum Cliente Cadastrado! </p>");
        }

        $('#modal-titulo').html('Clientes Cadastrados');

        var data = $('#Funcionario_dataComparacaoRanking').val();
        $('#modal').modal();
        document.getElementById('modal-iframe').contentWindow.location.replace('<?php echo Yii::app()->getBaseUrl() . "/ranking/buscaclientes"; ?>' + '?id=' + id + '&data=' + data);

    }
</script>