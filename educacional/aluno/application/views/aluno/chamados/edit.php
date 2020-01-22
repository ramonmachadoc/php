<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
            <section class="panel">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('chamado/edit/'.$ChamadoEdit['chamados_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddChamados')); ?>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Solicitação</label>
                                                <textarea name="nome" required="required" class="form-control" disabled="true"><?php echo $ChamadoEdit['chamados_obs']; ?>
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Departamento</label>
                                                <input type="text" name="nome" required="required" class="form-control" disabled="true"value="<?php echo $ChamadoEdit['departamento_nome']; ?>"/>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Responsável</label>
                                            <input type="text" name="nome" required="required" class="form-control" disabled="true"value="<?php echo $ChamadoEdit['nome']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Solicitação</label>
                                            <input type="text" name="nome" required="required" class="form-control" disabled="true"value="<?php echo trim($ChamadoEdit['servicos_descricao']); ?>"/>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Resposta</label>
                                            <input type="text" name="nome" required="required" class="form-control" disabled="true"value="<?php echo trim($ChamadoEdit['chamados_interacao_texto']); ?>"/>
                                        </div>
                                    </div>
                                    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                                    <style type="text/css">
                                            .estrelas input[type=radio] {
                                              display: none;
                                            }
                                            .estrelas label i.fa:before {
                                              content:'\f005';
                                              color: #FC0;
                                            }
                                            .estrelas input[type=radio]:checked ~ label i.fa:before {
                                              color: #CCC;
                                            }
                                    </style>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label>Satisfação</label>
                                    <div class="estrelas">

                                          <input type="radio" id="cm_star-empty" name="fb" value="" checked/>
                                          <label for="cm_star-1"><i class="fa"></i></label>
                                          <input type="radio" id="cm_star-1" name="fb" value="1"/>
                                          <label for="cm_star-2"><i class="fa"></i></label>
                                          <input type="radio" id="cm_star-2" name="fb" value="2"/>
                                          <label for="cm_star-3"><i class="fa"></i></label>
                                          <input type="radio" id="cm_star-3" name="fb" value="3"/>
                                          <label for="cm_star-4"><i class="fa"></i></label>
                                          <input type="radio" id="cm_star-4" name="fb" value="4"/>
                                          <label for="cm_star-5"><i class="fa"></i></label>
                                          <input type="radio" id="cm_star-5" name="fb" value="5"/>
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
