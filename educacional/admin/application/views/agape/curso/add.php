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

                                    <?php echo form_open('curso/cursos/create', array('enctype' => 'multipart/form-data', 'id' => 'FormAddCurso')); ?>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nome do Curso</label>
                                                <input type="text" required="required" name="curso"  class="form-control"  placeholder="Nome do Curso">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nome Abrev. do Curso</label>
                                                <input type="text" name="abreviatura"  class="form-control" placeholder="Nome Abrev. do Curso">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Habilitação do Curso</label>
                                                <input type="text" name="habilidade" class="form-control" placeholder="Habilitação do Curso">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Horas de Estagio Obrigatorio</label>
                                                <input type="text" name="estagio" class="form-control" placeholder="Habilitação do Curso">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Horas de Ativ. Comp. Obrigatorio</label>
                                                <input type="text" name="atividades_complementares" class="form-control" placeholder="Horas de Ativ. Comp. Obrigatorio">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Duração do Curso (Semestre(s))</label>
                                                <input type="text"  required="required" name="duracao" class="form-control" placeholder="Duração do Curso (Semestre(s))">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Coodenador(a)</label>
                                                <input type="text" name="coordenador" required="required" class="form-control"  placeholder="Coodenador(a)">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Valor do Cuso</label>
                                                <input type="text" name="valor" required="required" class="form-control" placeholder="Valor do Cuso">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12"> 
                                        <br/>
                                        <button type="submit" class="btn btn-info">Cadastrar</button>
                                    </div>
                                    
                                    <?php echo form_close(); ?>
                                </div>
                            </section>
                        </div>

                    </div>

                </div>
            </section>
        </div>
    </section>
</section>
<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>