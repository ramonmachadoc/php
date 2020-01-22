<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA MINHAS NOTAS</h1>

        <?php
        $matricula = $this->aluno_model->getTableRow('matricula_aluno', 'registro_academico', 'registro_academico', $this->session->userdata('login'));
        $disciplinas = $this->aluno_model->GetMatriculaTurma($matricula['matricula_aluno_id']);
        ?>


        <hr style="border: 1px solid #333;">
        <div class="divider"></div>
        <div class="divider"></div>

<!--        <section class="panel">

            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Selecione o Perído Letivo</label>

                            <select class="form-control" required="required" name="categoria">
                                <option value="">Selecione a Categoria</option>

                                <?php
                                foreach ($disciplinas as $rowPeriodos):
                                    ?>
                                    <option value="<?php echo $rowPeriodos['periodo_letivo_id']; ?>"><?php echo $rowPeriodos['periodo_letivo']; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 7px;">
                            <br/>
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </div>
                    </div>


                </div>
            </div>

        </section>


        <hr style="border: 1px solid #333;">
        <div class="divider"></div>
        <div class="divider"></div>-->


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

                <section class="panel">


                    <div class="panel-body">




                        <div class="adv-table" style="overflow-x: auto">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="text-align: center;">Disciplina</th>
                                        <th style="text-align: center;">N1</th>
                                        <th style="text-align: center;">N2</th>
                                        <th style="text-align: center;">N3</th>
                                        <th style="text-align: center;">Faltas</th>
                                        <th style="text-align: center;">Média</th>
                                        <th style="text-align: center; width: 10%;">Situação</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;

                                    foreach ($disciplinas as $disRow):


                                        $notas = $this->aluno_model->NotasAluno($disRow['matricula_aluno_turma_id']);

                                        foreach ($notas as $row):
                                            ?>
                                            <tr class="gradeU">
                                                <td style="text-align: center;"><?php echo $cont++; ?></td>
                                                <td style=""><?php echo $row['disciplina']; ?></td>
                                                <td style="text-align: center;"><?php echo $row['1bim']; ?></td>
                                                <td style="text-align: center;"><?php echo $row['2bim']; ?></td>
                                                <td style="text-align: center;"><?php echo $row['3bim']; ?></td>
                                                <td style="width: 7%; text-align: center;">

                                                    <?php
                                                    echo $faltasAtual = $this->aluno_model->QtdChamada($row['disciplina_aluno_id'], 'cham_nb_status', 0, 'updateStatus', 1) * 2;
                                                    ?>

                                                </td>
                                                <td style="text-align: center;"><?php echo $mediaFinal = round(($row['1bim'] + $row['2bim'] + $row['3bim']) / 3, 2) ?></td>
                                                <td style="text-align: center;">

                                                    <?php
                                                    if ($faltasAtual > $row['carga_horaria'] / 100 * 25) {
                                                        ?>
                                                        <button style="width: 100px;" type="button" class="btn btn-warning btn-xs">REP POR FALTA</button>
                                                        <?php
                                                    } else if ($mediaFinal >= 7) {
                                                        ?>
                                                        <button style="width: 100px;" type="button" class="btn btn-success btn-xs">APROVADO </button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button style="width: 100px;" type="button" class="btn btn-danger btn-xs">REPROVADO </button>
                                                        <?php
                                                    }
                                                    ?>

                                                </td>


                                            </tr>

                                            <?php
                                        endforeach;
                                    endforeach;
                                    ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
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