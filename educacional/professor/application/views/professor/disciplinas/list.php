<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA DISCIPLINAS</h1>
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
                                        <th style="text-align: center;">P. Letivo</th>
                                        <th style="text-align: center;">Curso</th>
                                        <th style="text-align: center;">Turma</th>
                                        <th style="text-align: center;">Período</th>
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
                                            <td style="text-align: center;"><?php echo $contador++; ?></td>
                                            <td style="text-align: center; width: 8%;"><?php echo $row['periodoNovo']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td style="text-align: center; width: 10%;"><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td style="width: 7%;text-align: center"><?php echo $row['periodo'] . "º"; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td class="center hidden-phone">

                                                <a target="_blank" href="<?php echo base_url(); ?>DisciplinasProfessor/PlanoEnsino/<?php echo $row['pdt_id']; ?>">
                                                    <button type="button" style="background-color: #4682B4;" class="btn btn-default btn-sm "><i class="fa fa-bookmark"></i> P. ENSINO</button>
                                                </a>

                                                <a href="<?php echo base_url(); ?>Mapa/Mapa/<?php echo $row['pdt_id']; ?>/<?php echo $row['turma_id']; ?>/<?php echo $row['disciplina_id']; ?>">
                                                    <button   type="button" class="btn btn-primary btn-sm "><i class="fa fa-map-marker"></i> MAPA NOTA</button>
                                                </a>
                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>

                                <div class="modal fade" id="myModal2<?php echo $cont2++; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Excluir Categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                Deseja realmente exclui: <b></b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                <a href="<?php echo base_url(); ?>/categoria/delete/"><button class="btn btn-warning" type="button"> Confirmar</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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