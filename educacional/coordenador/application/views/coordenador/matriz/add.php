<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVA MATRIZ</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('matriz/add', array('enctype' => 'multipart/form-data', 'id' => 'FormAddBolsa')); ?>

                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Ano</label>
                                                <input type="text" name="ano" required="required" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Semestre</label>


                                                <select class="form-control" required="required" name="semestre">
                                                    <option value="">Selecione o Semestre</option>
                                                    <option value="I">I SEMESTRE</option>
                                                    <option value="II">II SEMESTRE</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Curso</label>
                                                <select class="form-control" name="curso">
                                                    <option value="">Selecione o Curso</option>
                                                    <?php
                                                    foreach ($cursos as $rowCurso):
                                                        ?>
                                                        <option value="<?php echo $rowCurso['cursos_id']; ?>"><?php echo $rowCurso['cur_tx_descricao']; ?></option>
                                                        <?php
                                                    endforeach;
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