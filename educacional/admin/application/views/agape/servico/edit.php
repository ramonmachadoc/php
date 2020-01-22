<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
            <section class="panel">
                <div class="panel-heading"><strong><span class="fa fa-users"></span> NOVO SERVIÇO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('servico/edit/' . $ServicoEdit['servicos_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddServicos')); ?>

                                    <div class="row">

                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label>Descrição</label>
                                              <textarea name="descricao" required="required" class="form-control">
                                                 <?php echo trim($ServicoEdit['servicos_descricao']); ?>
                                              </textarea>
                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label>SLA</label>
                                              <input type="number" min="0" name="sla" required="required" class="form-control" value="<?php echo $ServicoEdit['servicos_sla']; ?>" >
                                            </input>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Departamento</label>
                                            <select class="form-control" required="required" name="departamento">
                                                <option value="">Selecione o Departamento</option>

                                                <?php
                                                foreach ($departamentos as $row):
                                                    ?>
                                                    <option <?php
                                                    if ($ServicoEdit['departamento_id'] == $row['departamento_id']) {
                                                        echo "selected='true'";
                                                    }
                                                    ?> value="<?php echo $row['departamento_id']; ?>"><?php echo $row['departamento_nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Valor R$</label>
                                            <input type="text" name="valor" required="required" class="form-control" onKeyPress="return(MascaraMoeda(this,'.',',',event))"
                                             value="<?php echo $ServicoEdit['servicos_valor']; ?>">
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

</script>
