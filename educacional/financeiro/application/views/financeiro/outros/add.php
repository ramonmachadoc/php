<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Novo Pagamento</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <!--                                <header class="panel-heading">
                                                                    Cadastrar Bolsas
                                                                </header>-->
                                <div class="panel-body">

                                    <?php echo form_open('OutrosPagamentos/add/' . $matricula_aluno_id, array('enctype' => 'multipart/form-data', 'id' => 'FormNotificacao')); ?>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data Pagamento</label>
                                                <input type="text" required="required" data-mask="99/99/9999" name="datapagamento" class="form-control"/>
                                            </div>
                                        </div>



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Forma de Pagamento</label>
                                                <select  class="form-control" name="forma_pagamento">
                                                    <option value="1">À Vista</option>
                                                    <option value="2">C. Crédito</option>
                                                    <option value="3">C. Débito</option>
                                                    <option value="4">Cheque</option>
                                                    <option value="5">Boleto</option>
                                                    <option value="6">Tranferência Bancária</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>




                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Produto</label>
                                                <select class="form-control" name="produto">
                                                    <option value="">Selecione a Produto</option>

                                                    <?php
                                                    foreach ($produtos as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['produto_id']; ?>"><?php echo $row['nome']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Valor a Pagar</label>
                                                <input type="text" required="required" id="valorpagar" name="valorpagar" class="form-control"/>
                                            </div>
                                        </div>



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Valor Pago</label>
                                                <input type="text" required="required" id="valorpago" name="valorpago" class="form-control"/>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Observações</label>
                                                <textarea class="form-control" name="obs" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <br/>
                                    
                                    
                                    <div class="row">
                                        <div class="col-lg-2"> 
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info">Cadastrar</button>
                                                <a href="<?php echo base_url(); ?>OutrosPagamentos/outros/<?php echo $matricula_aluno_id; ?>"><button class="btn btn-default" type="button">Cancelar</button></a>
                                            </div>
                                        </div>
                                    </div>




                                </div>

                                <?php echo form_close(); ?>
                            </section>
                        </div>

                    </div>

                </div>
            </section>
        </div>
    </section>
</section>

<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.maskMoney.js"></script>


<script type="text/javascript">
    $(function () {
        $("#valorpagar").maskMoney(
                {
                    symbol: 'R$ ',
                    showSymbol: true,
                    thousands: '.',
                    decimal: ',',
                    symbolStay: true}

        );

        $("#valorpago").maskMoney(
                {
                    symbol: 'R$ ',
                    showSymbol: true,
                    thousands: '.',
                    decimal: ',',
                    symbolStay: true}

        );
    })
</script>
