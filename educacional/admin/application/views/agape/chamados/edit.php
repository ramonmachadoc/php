<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
            <section class="panel">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('chamado/edit/' . $ChamadoEdit['chamados_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddChamados')); ?>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Chamado</label>
                                                <textarea name="nome" required="required" class="form-control" disabled="true"><?php echo $ChamadoEdit['chamados_obs']; ?>
                                                </textarea>
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
                                                        if ($responsavel == $row['usuarios_id']) {
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
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label>Encaminhamento</label>
                                              <textarea name="texto" required="required" class="form-control">
                                              </textarea>
                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label>Status</label>
                                              <select class="form-control" required="required" name="situacao">
                                                <option value="">Indique o Status</option>
                                                <option value="1">En Andamento</option>
                                                <option value="2">Encerrar</option>
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
