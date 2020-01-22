<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE MATRIZ</h1>
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
                        <a href="<?php echo base_url(); ?>matriz/add"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> MATRIZ</button>
                        </a>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Curso</th>
                                        <th class="text-center">Ano</th>
                                        <th>Semestre</th>
                                        <th class="text-center">OBS</th>
                                        <th class="text-center">OPÇÕES</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($matriz as $row):
                                        ?>

                                        <tr class="gradeU">
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $row['cur_tx_descricao']; ?></td>
                                            <td class="text-center"><?php echo $row['mat_tx_ano']; ?></td>
                                            <td class="text-center"><?php echo $row['mat_tx_semestre']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($row['atual'] == 1) {
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-xs">ATUAL</button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button type="button" class="btn btn-warning btn-xs">OFICIAL</button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td  style="text-align: center; width: 10%"> 

                                                <a href='<?php echo base_url(); ?>matriz/disciplinas/<?php echo $row['matriz_id']; ?>'><button type="button" class="btn btn-info btn-xs">
                                                        <i class="fa fa-table"></i> 
                                                        DISCIPLINAS
                                                    </button>
                                                </a>
                                            </td>
                                            <td class="center hidden-phone">

                                                <a href="matriz/imprimir/<?php echo $row['matriz_id']; ?>"><button class="btn btn-success btn-xs"><i class="fa fa-print"></i></button></a>
                                                <a href="<?php echo base_url(); ?>bolsa/update/">  <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                                <a data-toggle="modal" href="#myModal2"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>



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
                                                <a href="<?php echo base_url(); ?>/bolsa/bolsas/delete/"><button class="btn btn-warning" type="button"> Confirmar</button></a>
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