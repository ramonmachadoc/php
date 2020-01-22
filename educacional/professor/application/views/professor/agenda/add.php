<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-6">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVO EVENTO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">

                                    <?php echo form_open('agenda/add', array('enctype' => 'multipart/form-data', 'id' => 'FormAddCategoria')); ?>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Titulo</label>
                                                <input type="text" name="titulo" required="required" class="form-control" id="cat_tx_descricao" required="required">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Data Início</label>
                                               <input type="text" data-mask="99/99/9999" name="data_inicio" required="required" class="form-control" id="cat_tx_descricao" required="required">
                                            </div>
                                        </div>
                                        
                                           <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Data Fim</label>
                                               <input type="text" data-mask="99/99/9999" name="data_fim" required="required" class="form-control" id="cat_tx_descricao" required="required">
                                            </div>
                                        </div>
                                        
                                        

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <br/>
                                            <button type="submit" class="btn btn-info">Cadastrar</button>
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
<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>