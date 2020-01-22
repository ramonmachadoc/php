<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVO PRODUTO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
<!--                                <header class="panel-heading">
                                    Cadastrar Bolsas
                                </header>-->
                                <div class="panel-body">

                                    <?php echo form_open('produto/edit/'.$ProdutoEdit['produto_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormEditProduto')); ?>

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Produto</label>
                                                <input type="text" name="nome" value="<?php echo $ProdutoEdit['nome']; ?>" required="required" class="form-control" id="nome" required="required">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <textarea class="form-control" name="descricao"><?php echo $ProdutoEdit['descricao']; ?></textarea>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <br/>
                                            <button type="submit" class="btn btn-info">Salvar Alterações</button>
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