<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> PERÍODO(S) LETIVO(S)</h1>
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

                    <header class="panel-heading">
                        <a href="<?php echo base_url(); ?>periodoLetivo/add"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> PERÍODO LETIVO</button>
                        </a>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Período Letivo</th>
                                        <th class="text-center">Dias Letivos</th>
                                        <th>Data Início</th>
                                        <th class="text-center">Ano</th>
                                        <th class="text-center">Semestre</th>
                                        <th>Bolsas</th>
                                        <th>Situação</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($periodos as $row):
                                        ?>

                                        <tr class="gradeU">
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $row['periodo_letivo'] ?></td>
                                            <td class="text-center"><?php echo $row['dias_letivos'] ?></td>
                                            <td class="text-center"><?php echo FormatarData($row['data_inicio']) ?></td>
                                            <td class="text-center"><?php echo $row['ano'] ?></td>
                                            <td class="text-center"><?php echo $row['semestre'] ?></td>

                                            <td class="text-center" style="font-size: 12px;">
                                                <?php
                                                $arrayBolsas = $this->agape_model->bolsasPeriodo($row['periodo_letivo_id']);

                                                foreach ($arrayBolsas as $rowBolsas):
                                                    echo $rowBolsas['descricao'];
                                                    echo "<hr/>";
                                                endforeach;
                                                ?>
                                            </td>

                                            <td class="text-center">

                                                <?php
                                                if ($row['periodo_encerrado'] == 1) {
                                                    ?>
                                                    <button style="width: 110px;" type="button" class="btn btn-success btn-xs">Período Aberto</button>

                                                    <?php
                                                } else if ($row['periodo_encerrado'] == 0) {
                                                    ?>
                                                    <button style="width: 110px;" type="button" class="btn btn-default btn-xs">Período Fechado</button>
                                                    <?php
                                                }
                                                ?>


                                            </td>


                                            <td class="center hidden-phone">

                                                <a href="<?php echo base_url(); ?>PeriodoLetivo/bolsas/<?php echo $row['periodo_letivo_id']; ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-briefcase"></i></button></a>
                                                <a href="<?php echo base_url(); ?>PeriodoLetivo/edit/<?php echo $row['periodo_letivo_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                                <a href="<?php echo base_url(); ?>PeriodoLetivo/delete/<?php echo $row['periodo_letivo_id'] ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>

                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>

                                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Excluir Bolsa</h4>
                                            </div>
                                            <div class="modal-body">
                                                Deseja realmente excluir esta bolsa?
                                            </div>
                                            <div class="modal-footer">
                                                <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                <a href="<?php echo base_url(); ?>/bolsa/bolsas/delete/<?php echo $rowBolsas['bolsas_id']; ?>"><button class="btn btn-warning" type="button"> Confirmar</button></a>
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