<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVA DESPESA</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <div class="panel-body">

                                    <?php echo form_open('despesas/edit', array('enctype' => 'multipart/form-data', 'id' => 'FormAddFornecedor')); ?>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Fornecedor</label>
                                                <select class="form-control" name="for_nb_codigo">
                                                    <option value="">Selecione o Fornecedor</option>

                                                    <?php
                                                    foreach ($fornecedores as $rowFornecedores) {
                                                        ?>
                                                        <option value="<?php echo $rowFornecedores['fornecedor_id']; ?>"><?php echo $rowFornecedores['for_tx_razao_social']; ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Vencimento</label>
                                                <input type="text" value="<?php echo FormatarData($ContaEdit['cpr_dt_vencimento']); ?>" data-mask="99/99/9999" name="cpr_dt_vencimento" required="required" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Valor</label>
                                                <input type="text" value="<?php echo $ContaEdit['cpr_db_valor'] ?>" name="cpr_db_valor" required="required" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Número Nota Fiscal</label>
                                                <input type="text" value="<?php echo $ContaEdit['cpr_tx_num_documento']; ?>" name="cpr_tx_num_documento" required="required" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Categoria</label>
                                                <select class="form-control" name="cat_nb_codigo">
                                                    <option value="">Selecione o Fornecedor</option>

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


                                        <div class="col-lg-3" >
                                            <div class="form-group">
                                                <label>Ocorrência</label>
                                                <select onchange="MudaTipo();" id="cpr_nb_ocorrencia" class="form-control" name="cpr_nb_ocorrencia">
                                                    <option value="1">ÚNICA</option>
                                                    <option value="3">PARCELADA</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-3" id="situacao">
                                            <div class="form-group">
                                                <label>Já foi pago?</label>
                                                <select class="form-control" name="pago">
                                                    <option value="1">NÃO</option>
                                                    <option value="2">SIM</option>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-lg-3" id="parcela" style="display: none;">
                                            <div class="form-group">
                                                <label>Parcelas</label>
                                                <input type="text" maxlength="2" name="parcelas" required="required" class="form-control" id="razaosocial" required="required">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Observações</label>
                                                <textarea class="form-control" rows="7" name="cpr_tx_historico"></textarea>
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


