<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span>Meus Chamados</h1>
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
                                        <th style="width: 5%">ID</th>
                                        <th>Responsável</th>
                                        <th>Texto</th>
                                        <th>Status</th>
                                        <th>Nova interação</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    $cont2 = 1;
                                    $cont3 = 1;

                                    foreach ($interacoes as $row):
                                        ?>
                                        <?php
                                        switch ($row['chamados_status']) {
                                          case 0:
                                            $status = 'Aguardando atendimento';
                                            break;

                                            case 1:
                                              $status = 'Em andamento';
                                              break;

                                            case 2:
                                                $status = 'Encerrado';
                                              break;

                                          default:
                                            $status = 'Aguardando atendimento';
                                            break;
                                        }
                                         ?>

                                        <tr class="gradeU">
                                            <td style="text-align: center;"><?php echo $row['chamados_interacao_id']; ?></td>
                                            <td><?php echo $row['usu_tx_login']; ?></td>
                                            <td><?php echo $row['chamados_interacao_texto']; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td class="center hidden-phone">
                                                <a href="<?php echo base_url(); ?>chamado/edit/<?php echo $row['chamados_id']; ?>"<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                            </td>
                                        </tr>

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
