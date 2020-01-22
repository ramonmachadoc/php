<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> MINHAS DISCIPLINAS</h1>
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


                <section class="panel">

                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>P. Letivo</th>
                                        <th>Curso</th>
                                        <th>Turma</th>
                                        <th>Período</th>
                                        <th>Disciplina</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    $cont2 = 1;
                                    $cont = 1;
                                    ?>



                                    <?php
                                    foreach ($disciplinas as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td style="width: 3%;"><?php echo $contador++; ?></td>
                                            <td class="text-center"><?php echo $row['periodo_letivo']; ?></td>
                                            <td class="text-center"><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td class="text-center"><?php echo $row['periodo']; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?> </td>
                                            <td class="center hidden-phone">


                                                <a href="<?php echo base_url(); ?>Disciplinas/minhas_disciplinas_aula/<?php echo $row['pdt_id']; ?>">
                                                    <button type="button" class="btn btn-azul_2 btn-sm"><i class="fa fa-table"></i> AULAS</button>
                                                </a>


                                                <a href="<?php echo base_url(); ?>Disciplinas/protocolo/<?php echo $row['pdt_id']; ?>/<?php echo $row['turma_id'] ?>/<?php echo $row['disciplina_id']; ?>">
                                                    <button type="button" class="btn btn-cinza btn-sm"><i class="fa fa-print"></i> P. Prova</button>
                                                </a>

                                            </td>


                                        </tr>

                                        <?php
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