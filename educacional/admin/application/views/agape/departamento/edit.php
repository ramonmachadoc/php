<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
            <section class="panel">
                <div class="panel-heading"><strong><span class="fa fa-users"></span> NOVO DEPARTAMENTO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('departamento/edit/' . $DepartamentoEdit['departamento_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddDepartamentos')); ?>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" value="<?php echo $DepartamentoEdit['departamento_nome']; ?>" name="nome" required="required" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Responsável</label>
                                                <select class="form-control" required="required" name="responsavel">
                                                    <option value="">Selecione o Responsável</option>
                                                    <?php
                                                    foreach ($responsaveis as $row):
                                                        ?>
                                                        <option <?php
                                                        if ($DepartamentoEdit['responsavel_id'] == $row['usuarios_id']) {
                                                            echo "selected='true'";
                                                        }
                                                        ?> value="<?php echo $row['usuarios_id']; ?>"><?php echo $row['usu_tx_login']." - ".$row['nome']; ?></option>
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

</script>
