<div id="grid-view-supervisores" class="grid-view">
    <?php if (count($vendas) != 0): ?>
    <table class="items table table-striped table-condensed" style="padding: 0px;">
        <thead class="tableFloatingHeaderOriginal"
               style="position: static; margin-top: 0px; left: 425.5px; z-index: 1; top: 40px; width: 807px;">
        <tr>
            <th style="min-width: 0px; max-width: none;text-align: center">#</th>
            <th style="min-width: 0px; max-width: none;">Vendedor</th>
            <th style="min-width: 0px; max-width: none;">Cliente</th>
            <th style="min-width: 0px; max-width: none;">Moto</th>
            <th style="min-width: 0px; max-width: none;text-align: center">Data da Venda</th>
            <th class="button-column" style="text-align: center"></th>
        </tr>
        </thead>
        <tbody>
        <?php $numero = 1; ?>
        <?php foreach ($vendas as $venda): ?>

            <tr class="odd">
                <td style="width: 60px;text-align: center"><?php echo $numero; ?></td>
                <td><?php echo $venda->vendedor->nome; ?></td>
                <td><?php echo $venda->nome; ?></td>
                <td><?php echo $venda->modelo_moto; ?></td>
                <td style="text-align: center"><?php echo $venda->data_venda; ?></td>
                <td style="text-align: center" nowrap="nowrap">
                    <a class="view" title="" data-toggle="tooltip" href="<?php echo Yii::app()->createUrl('retorno/view', array('id' => $venda->id_cliente)); ?>" data-original-title="Visualizar">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
                </td>
            </tr>
            <?php $numero++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <h3>Nenhuma venda relalizada nesse mês!</h3>
    <?php endif; ?>
    <?php $this->widget('booster.widgets.TbPager', array('pages' => $pages)); ?>
    <div class="keys" style="display:none" title="/extendedGridView">
        <span>1</span><span>2</span><span>3</span><span>4</span></div>
    <div class="keys" style="display:none" title="/extendedGridView">
        <span>1</span><span>2</span><span>3</span><span>4</span></div>
</div>
