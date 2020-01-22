<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE EVENTO(S)</h1>
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
                        <a href="<?php echo base_url(); ?>agenda/add"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> EVENTO</button>
                        </a>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Evento</th>
                                        <th>Data Inicio</th>
                                        <th>Data Fim</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    $cont2 = 1;
                                    $cont3 = 1;
                                    foreach ($agenda as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $row['titulo']; ?></td>
                                            <td><?php echo FormatarData($row['data_evento']); ?></td>
                                            <td> 
                                                <?php echo FormatarData($row['data_fim']); ?>
                                            </td>
                                            <td class="center hidden-phone">

                                                <a data-toggle="modal" href="#myModal2<?php echo $cont2++; ?>"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>


                                        </tr>

                                    <div class="modal fade" id="myModal2<?php echo $cont3++; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Excluir Evento</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente exclur este registro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                    <a href="<?php echo base_url(); ?>/agenda/delete/<?php echo $row['calendario_id']; ?>"><button class="btn btn-warning" type="button"> Confirmar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

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