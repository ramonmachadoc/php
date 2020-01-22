<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVA BOLSA</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Cadastrar Bolsas
                                </header>
                                <div class="panel-body">

                                    <?php echo form_open('bolsa/update/'.$bolsas['bolsas_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddBolsa')); ?>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <input type="text" name="descricao" value="<?php echo $bolsas['descricao']; ?>" class="form-control" required="required" id="exampleInputdescricao">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Porcentagem Minima</label>
                                                <input type="text" name="porcentagem_minima" value="<?php echo $bolsas['porcentagem_minima']; ?>" required="required" maxlength="3" class="form-control" id="porcentagem_minima">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Porcentagem Máxima</label>
                                                <input type="text" name="porcentagem_maxima" value="<?php echo $bolsas['porcentagem_maxima'] ?>" required="required" maxlength="3" class="form-control" id="porcentagem_maxima">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select required="" class="form-control" name="tipo" id="tipo" >

                                                    <?php
                                                    if ($bolsas['tipo'] == 1) {
                                                        ?>
                                                        <option value="1">Bolsa</option>
                                                        <option value="2">Financiamento</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="2">Financiamento</option>
                                                        <option value="1">Bolsa</option>
                                                        <?php
                                                    }
                                                    ?>





                                                </select>
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

<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>