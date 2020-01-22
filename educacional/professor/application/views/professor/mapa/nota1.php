<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>Mapa"><i class="fa fa-list-alt"></i> LISTA MAPA DE NOTAS</a></li>
                    <li class="active"><i class="fa fa-calendar"></i> 1BIM</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h2 style="font-weight: 300;"></span> Turma: <?php echo $InfoDisciplina['turma']; ?></h2>
        <h2 style="font-weight: 300;"></span> Professor: <?php echo $InfoDisciplina['professor']; ?></h2>
        <h2 style="font-weight: 300;"></span> Disciplina: <?php echo $InfoDisciplina['disciplina']; ?></h2>
        <h2 style="font-weight: 300;"></span> 1º BIMESTRE</h2>
        <hr style="border: 1px solid #333;">
        <div class="divider"></div>
        <div class="divider"></div>

        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('message') != ""): ?>

                    <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <?php echo $this->session->flashdata('message'); ?>

                    </div>
                <?php endif; ?>

                <?php echo form_open('Mapa/nota1/' . $ArrayIds['turma_id'] . "/" . $ArrayIds['disciplina_id'], array('class' => '', 'enctype' => 'multipart/form-data')); ?>
                <section class="panel">
                    <div class="panel-body">


                        <span class="label label-warning">ATENÇÃO!</span>
                        <!--<span>Preecha as notas, e para salvar clique no botão <b>"REGISTRAR NOTA"</b></span>-->
                        <span>O prazo para preenchimento da nota do <b>1º BIMESTRE</b> se esgotou. </span>
                        <hr/>

                        <section id="flip-scroll">
                            <table class="table table-bordered table-striped table-condensed cf">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Matrícula</th>
                                        <th>Nome</th>
                                        <th class="text-center">NOTA</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cont = 1;
                                    foreach ($alunos as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $row['registro_academico']; ?></td>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td style="width: 7%; text-align: center;" >
                                                <input style="width: 70px;" 

                                                       <?php
                                                       if ($datePrazo['1bim'] < date('Y-m-d')) {
                                                           if ($liberacao['data_prazo'] < date('Y-m-d')) {
                                                               echo 'disabled="true"';
                                                           }
                                                       }
                                                       ?>

                                                       class="form-control" value="<?php echo $row['dan_fl_nota_1bim']; ?>" type="text" name="nota<?php echo $row['disciplina_aluno_nota_id']; ?>"/>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Registrar Nota</button>
                            </div>
                        </section>
                    </div>
                </section>

                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
//            "aaSorting": [[4, "desc"]]
        });
    });
</script>