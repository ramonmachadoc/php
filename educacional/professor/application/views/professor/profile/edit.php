<section id="main-content">
    <section class="wrapper">
        
         <?php if ($this->session->flashdata('message') != ""): ?>

                    <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <?php echo $this->session->flashdata('message'); ?>

                    </div>
                <?php endif; ?>

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> ALTERAR DADOS PROFESSOR</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
<!--                                <header class="panel-heading">
                                    Cadastrar Bolsas
                                </header>-->
                                <div class="panel-body">

                                    <?php echo form_open('profile/edit/'.$DadosProfessor['professor_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddCategoria')); ?>

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" value="<?php echo $DadosProfessor['nome']; ?>" name="nome" required="required" class="form-control" id="cat_tx_descricao" required="required">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="password" value="<?php echo $DadosProfessor['senha']; ?>" name="senha" required="required" class="form-control" id="cat_tx_descricao" required="required">
                                     
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <br/>
                                            <button type="submit" class="btn btn-info">ALTERAR DADOS</button>
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