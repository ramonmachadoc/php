<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
            <section class="panel">
                <div class="panel-heading"><strong><span class="fa fa-users"></span>NOVO CHAMADO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('chamado/add/', array('enctype' => 'multipart/form-data', 'id' => 'FormAddChamado')); ?>

                                    <div class="row">

                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label>Serviço</label>
                                              <select class="form-control" required="required" name="servico">
                                                  <option value="">Selecione o Serviço</option>

                                                  <?php
                                                  foreach ($servicos as $row):
                                                      ?>
                                                      <option value="<?php echo $row['servicos_id']; ?>"><?php echo $row['servicos_descricao']; ?></option>
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
                                                <label>Observação</label>
                                                <textarea name="observacao" required="required" class="form-control" >
                                                </textarea>
                                              </input>
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
