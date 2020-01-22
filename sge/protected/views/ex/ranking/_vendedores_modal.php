<style>
    body {
        background: #FFFFFF;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        background: #F2F2F2;
    }

    .table {
        font-size: 0.8em !important;
    }

</style>
<?php $id_funcionario = 1; ?>
<?php foreach($vendedores as $vendedor): ?>

    <div class="panel panel-default">
        <a onclick="exibeEscondePainel('cliente<?php echo $id_funcionario; ?>')" style="cursor: pointer">
            <div class="panel-heading">

                    <h3 class="panel-title" style="display: inline;">
                        <i class="fa fa-user"></i> <?php echo $vendedor->nome; ?>
                    </h3>
                <div class="clearfix"></div>
            </div>
        </a>
        <div class="panel-body" id="cliente<?php echo $id_funcionario;?>">
            <?php if (count($vendedor->getQtdeAgendamentosVend($vendedor->id_funcionario, $data2, false)) != 0): ?>
            <div id="grid-view-supervisores" class="grid-view">
                <table class="items table table-striped table-condensed" style="padding: 0px;">
                    <thead class="tableFloatingHeaderOriginal"
                           style="position: static; margin-top: 0px; left: 425.5px; z-index: 1; top: 40px; width: 807px;">
                    <tr>
                        <th id="yw0_c0" style="min-width: 0px; max-width: none;">#</th>
                        <th id="yw0_c1" style="min-width: 0px; max-width: none;">Nome</th>
                        <th id="yw0_c2" style="min-width: 0px; max-width: none;">Modelo da Moto</th>
                        <th id="yw0_c5" style="min-width: 0px; max-width: none;">Data de Retorno</th>
                        <th id="yw0_c6" style="min-width: 0px; max-width: none;">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $id_cliente = 1; ?>
                    <?php foreach ($vendedor->getQtdeAgendamentosVend($vendedor->id_funcionario,$data2,false) as $cliente): ?>
                        <tr class="odd">
                            <td style="width: 60px"><?php echo $id_cliente; ?></td>
                            <td><?php echo $cliente->nome; ?></td>
                            <td><?php echo $cliente->modelo_moto; ?></td>
                            <td><?php echo $cliente->data_retorno; ?></td>
                            <td>
                                <a href='<?php echo Yii::app()->createUrl('cliente/update',array('id'=>$cliente->id_cliente,'origem'=>'modalV', 'data' => $data)); ?>' class="label label-primary" style="cursor: pointer">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $id_cliente++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div>Nenhum cliente cadastrado hoje!</div>
            <?php endif; ?>
        </div>
    </div>
    <?php $id_funcionario++; ?>
<?php endforeach; ?>

<script>
    $(function () {

        $('.panel-body').hide();

    });
</script>
