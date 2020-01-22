<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>Disciplinas"><i class="fa fa-list-alt"></i> MINHAS DISCIPLINAS</a></li>
                    <li class="active"><i class="fa fa-table"></i> AULAS</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <h2 style="font-weight: 300;"></span> Turma: <?php echo $Infoaulas['turma']; ?></h2>
        <h2 style="font-weight: 300;"></span> Professor: <?php echo $Infoaulas['professor']; ?></h2>
        <h2 style="font-weight: 300;"></span> Disciplina: <?php echo $Infoaulas['disciplina']; ?></h2>
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
                                        <th>Aula</th>
                                        <th>Data</th>
                                        <th>Tempo</th>

                                        <th class="text-center">AÇÕES</th>
                                        <th class="text-center">SITUAÇÃO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    $cont2 = 1;
                                    $cont = 1;
                                    ?>



                                    <?php
                                    foreach ($aulas as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td><?php echo $contador++; ?></td>
                                            <td>
                                                <?php
                                                if ($row['aul_dt_aula'] == '0000-00-00' || $row['aul_dt_aula'] == '1970-01-01' || $row['aul_dt_aula'] == '') {
                                                    echo "";
                                                } else {
                                                    echo FormatarData($row['aul_dt_aula']);
                                                }
                                                ?>
                                            <td><?php echo $row['aul_tx_tempo']; ?></td>
                                            <td style="width: 10%" class="center hidden-phone">

                                                <?php
                                                if ($row['aul_dt_aula'] == '0000-00-00' || $row['aul_dt_aula'] == '1970-01-01' || $row['aul_dt_aula'] == '') {
                                                    ?>
                                                    <a href="#">
                                                        <button  type="button" class="btn btn-warning btn-sm"><i class="fa fa-exclamation-triangle "></i> AULA SEM DATA</button>
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>

                                                    <a href="<?php echo base_url(); ?>Disciplinas/chamada/<?php echo $row['pdt_nb_codigo']; ?>/<?php echo $row['aul_nb_codigo']; ?>">
                                                        <button style="background-color: #4682B4;" type="button" class="btn btn-info btn-sm"><i class="fa fa-check "></i> CHAMADA</button>
                                                    </a>
                                                    <?php
                                                }
                                                ?>





                                            </td>

                                            <td style="width: 10%" class="center hidden-phone">

                                                <?php
                                                $count = count($this->professor_model->GetWhere('chamada', 'aul_nb_codigo', $row['aul_nb_codigo'], 'updateStatus', '1'));
                                                if ($count == 0) {
                                                    ?>
                                                    <a href="#">
                                                        <button style="width: 90px;" type="button" class="btn btn-default btn-sm">PENDENTE</button>
                                                    </a>

                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="#">
                                                        <button style="width: 90px;" type="button" class="btn btn-success btn-sm">CONCLUÍDO</button>
                                                    </a>
                                                    <?php
                                                }
                                                ?>






                                            </td>

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
                                                Deseja realmente exclui: <b><?php echo $row['cat_tx_descricao']; ?></b>?
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