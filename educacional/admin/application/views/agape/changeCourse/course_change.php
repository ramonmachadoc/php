<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-warning fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <b>ATENÇÃO -</b> Mudança de curso apenas para alunos ingressantes.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Troca de Curso
                    </header>
                    <div class="panel-body">
                        <h2 id="sampleTitle">
                            <b> Aluno: </b> <?php echo $dadosAluno['nome']; ?>
                        </h2>
                        <hr/>

                        <?php echo form_open('Registro/saveChangeCourse/' . $dadosAluno['matricula_aluno_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddCurso')); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Curso Origem</label>
                                    <select id="curso_origem" class="form-control" disabled="true">
                                        <option value="<?php echo $dadosAluno['cursos_id']; ?>"><?php echo $dadosAluno['cur_tx_descricao']; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Curso Destino</label>
                                    <select id="curso_destino" name="curso_destino" class="form-control">

                                        <?php
                                        foreach ($cursos as $rowCursos):
                                            ?>
                                            <option value="<?php echo $rowCursos['cursos_id']; ?>"><?php echo $rowCursos['cur_tx_descricao']; ?></option>
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
                                <button onclick="buscar_paginacao_receber_pagamento();"  class="btn btn-primary">Confirmar Mudança</button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>


                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

