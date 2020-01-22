<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/"><i class="fa fa-book"></i> BIBLIOTECA</a></li>
                    <li class="active"><i class="fa fa-table"></i> LISTA DE LIVROS</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-heading"><strong><span class="glyphicon glyphicon-tasks"></span> NOVA CATEGORIA</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">

                                    <div class="panel-body">

                                        <?php echo form_open('biblioteca/CreateCategoria', array('enctype' => 'multipart/form-data', 'id' => 'FormAddCategoria')); ?>


                                        <div class="row">
                                            
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label>Nome Categoria</label>
                                                    <input type="text" name="nome" id="nome" minlength="5" required="required" class="form-control">
                                                </div>
                                            </div>

                                           
                                        </div>
                                        <hr/>

                                        <div class="row">
                                            <div class="col-lg-12"> 
                                                <br/>
                                                <button type="submit" class="btn btn-info">CADASTRAR CATEGORIA</button>
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
        </div>
    </section>
</section>
<script src="<?php echo base_url(); ?>template/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>