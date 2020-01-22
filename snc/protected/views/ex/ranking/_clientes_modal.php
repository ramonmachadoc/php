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
    .detail-view{
        font-size: 0.8em;
    }

</style>
<?php $numero = 1; ?>
<?php foreach($clientes as $cliente): ?>


    <div class="panel panel-default">
 
        <div class="panel-heading">
            <a onclick="exibeEscondePainel('cliente<?php echo $numero; ?>')" style="cursor: pointer">
                <h3 class="panel-title" style="display: inline;">
                    <i class="fa fa-user"></i> <?php echo $cliente->nome; ?>
                </h3>
            </a>
            <div style='float: right;'>
                <a href='<?php echo Yii::app()->createUrl('cliente/update',array('id'=>$cliente->id_cliente,'origem'=>'modalC','data'=>$data)); ?>' class="label label-primary" style="cursor: pointer">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="panel-body" id="cliente<?php echo $numero;?>">
            <?php $this->widget('booster.widgets.TbDetailView', array(
                'type'=>' condensed striped',
                'data' => $cliente,
                'attributes' => array(
                    array('label' => 'Carteira do Vendedor', 'value' => $cliente->vendedor->nome),
                    'email',
                    'fone',
                    'data_retorno',
                    'modelo_moto',
                    array('label' => 'Forma de Pagamento', 'value' => $cliente->getFormaPagamentoText()),
                    array('label' => 'Status', 'value' => $cliente->getStatusText()),
                ),
            )); ?>
        </div>
    </div>

    <?php $numero++; ?>
<?php endforeach; ?>

<script>
    $(function () {
        $('.panel-body').hide();
    });
</script>
