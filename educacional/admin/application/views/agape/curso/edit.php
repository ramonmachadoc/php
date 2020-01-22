<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVO CURSO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Cadastrar Curso
                                </header>
                                <div class="panel-body">

                                    <?php echo form_open('curso/cursos/do_update/'.$cursos['cursos_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddCurso')); ?>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nome do Curso</label>
                                                <input type="text" required="required" value="<?php echo $cursos['cur_tx_descricao']; ?>" name="curso"  class="form-control"  placeholder="Nome do Curso">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nome Abrev. do Curso</label>
                                                <input type="text" name="abreviatura" value="<?php echo $cursos['cur_tx_abreviatura']; ?>" class="form-control" placeholder="Nome Abrev. do Curso">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Habilitação do Curso</label>
                                                <input type="text" name="habilidade" value="<?php echo $cursos['cur_tx_habilitacao']; ?>" class="form-control" placeholder="Habilitação do Curso">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Horas de Estagio Obrigatorio</label>
                                                <input type="text" name="estagio" value="<?php echo $cursos['cur_nb_estagio_obrigatoria']; ?>" class="form-control" placeholder="Habilitação do Curso">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Horas de Ativ. Comp. Obrigatorio</label>
                                                <input type="text" name="atividades_complementares" value="<?php echo $cursos['cur_nb_ativ_comp_obrigatoria']; ?>" class="form-control" placeholder="Horas de Ativ. Comp. Obrigatorio">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Duração do Curso (Semestre(s))</label>
                                                <input type="text"  required="required" name="duracao" value="<?php echo $cursos['cur_tx_duracao']; ?>" class="form-control" placeholder="Duração do Curso (Semestre(s))">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Coodenador(a)</label>
                                                <input type="text" name="coordenador" required="required" value="<?php echo $cursos['cur_tx_coordenador']; ?>" class="form-control"  placeholder="Coodenador(a)">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Valor do Cuso</label>
                                                <input type="text" name="valor" required="required" value="<?php echo $cursos['cur_fl_valor']; ?>" class="form-control" placeholder="Valor do Cuso">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12"> 
                                        <br/>
                                        <button type="submit" class="btn btn-info">Cadastrar</button>
                                        </form>
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