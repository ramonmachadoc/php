<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Nova Notificação</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <!--                                <header class="panel-heading">
                                                                    Cadastrar Bolsas
                                                                </header>-->
                                <div class="panel-body">

                                    <?php echo form_open('notificacao/add/'.$matricula_aluno_id, array('enctype' => 'multipart/form-data', 'id' => 'FormNotificacao')); ?>

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <textarea class="form-control" id="descricao" rows="6" name="descricao"></textarea>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data Início</label>
                                                <input type="text" required="required" data-mask="99/99/9999" name="DataInicio" class="form-control"/>
                                            </div>
                                        </div>



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data Fim</label>
                                                <input type="text" required="required" name="DataFim" data-mask="99/99/9999" class="form-control"/>
                                            </div>
                                        </div>

                                    </div>

<!--
                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <br/>
                                            <button type="submit" class="btn btn-info">Cadastrar</button>
                                        </div>
                                    </div>
                                    -->
                                    
                                        
                                    <div class="row">
                                        <div class="col-lg-2"> 
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info">Cadastrar</button>
                                                <a href="<?php echo base_url(); ?>Notificacao/notificacao/<?php echo $matricula_aluno_id; ?>"><button class="btn btn-default" type="button">Cancelar</button></a>
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

<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>
