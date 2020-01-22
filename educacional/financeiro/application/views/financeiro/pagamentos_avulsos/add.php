<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVO PAGAMENTO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <div class="panel-body">

                                    <?php echo form_open('PagamentosAvulsos/add', array('enctype' => 'multipart/form-data', 'id' => 'FormAddFornecedor')); ?>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Cliente</label>
                                                <input type="text" name="cliente" required="required" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data de Pagamento</label>
                                                <input type="text" data-mask="99/99/9999" name="data_pagamento" required="required" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Valor</label>
                                                <input type="text" name="valor" required="required" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Categoria</label>
                                                <select class="form-control" name="cat_nb_codigo">
                                                    <option value="">Selecione a Categoria</option>

                                                    <?php
                                                    foreach ($categorias as $rowCategoria) {
                                                        ?>
                                                        <option value="<?php echo $rowCategoria['categoria_id']; ?>"><?php echo $rowCategoria['cat_tx_descricao']; ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6" >
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


                                        <div class="col-lg-3" id="parcela" style="display: none;">
                                            <div class="form-group">
                                                <label>Parcelas</label>
                                                <input type="text" maxlength="2" name="razaosocial" required="required" class="form-control" id="razaosocial" required="required">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Referente á </label>
                                                <textarea class="form-control" rows="5" name="historico"></textarea>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <br/>
                                            <button type="submit" class="btn btn-info">CADASTRAR</button>
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

<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>
<script>
    function MudaTipo() {

        var tipo = $("#cpr_nb_ocorrencia").val();

        if (tipo == 1) {

            $("#parcela").hide();
            $("#situacao").show();

        } else if (tipo == 3) {

            $("#parcela").show();
            $("#situacao").hide();

        } else {

            $("#parcela").hide();
            $("#situacao").show();

        }
    }
</script>


