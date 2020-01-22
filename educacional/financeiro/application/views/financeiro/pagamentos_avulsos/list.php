<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> Controle de Pagamentos Avulsos </h1>
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
                        <a href="<?php echo base_url(); ?>PagamentosAvulsos/add"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> PAGAMENTO</button>
                        </a>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table">
                            <table style="" class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Referente</th>
                                        <th class="text-center">Categoria</th>
                                        <th class="text-center">Dt Pagamento</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($ContasReceber as $row):
                                        ?>

                                        <tr class="gradeU" style="text-align: center;">
                                            <td><?php echo $cont++; ?></td>

                                            <td> 
                                                <?php echo $row['cliente']; ?>
                                            </td>

                                            <td> 
                                                <?php echo $row['historico']; ?>
                                            </td>

                                            <td> 
                                                <?php echo $row['categoria']; ?>
                                            </td>


                                            <td> 
                                                <?php echo FormatarData($row['data_vencto']); ?>
                                            </td>

                                            <td> 
                                                <?php echo FormatarValor($row['valor']); ?>
                                            </td>


                                            <td> 

                                                <?php
                                                if ($row['cpr_status'] == 1) {

                                                    if ($row['data_vencto'] == date('Y-m-d')) {
                                                        ?>
                                                        <button style="width: 85px;" type="button" class="btn btn-warning btn-sm">Venc Hoje</button>

                                                        <?php
                                                    } else if ($row['data_vencto'] < date('Y-m-d')) {
                                                        ?>
                                                        <button style="width: 85px;" type="button" class="btn btn-danger btn-sm">Em atraso</button>
                                                        <?php
                                                    } else {
                                                        ?>  
                                                        <button style="width: 85px;" type="button" class="btn btn-primary btn-sm">Em Aberto</button>

                                                        <?php
                                                    }
                                                    ?>

                                                    <?php
                                                } else if ($row['cpr_status'] == 2) {
                                                    ?>
                                                    <button style="width: 85px;"  type="button" class="btn btn-success btn-sm">Pago</button>

                                                    <?php
                                                }
                                                ?>



                                            </td>

                                            <td class="center hidden-phone">

                                                <a data-toggle="modal" href="#myModal<?php echo $cont++; ?>">
                                                    <button class="btn btn-warning btn-xs"><i class=" fa fa-print"></i></button>
                                                </a>

                                                <a href="<?php echo base_url(); ?>Despesas/edit/<?php echo $row['cpr_codigo']; ?>">
                                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                                </a>

                                                <a href="<?php echo base_url(); ?>Despesas/deleteConta/<?php echo $row['cpr_codigo']; ?>">
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                                </a>
                                        </tr>

                                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Excluir Fornecedor</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente exclui: <b></b>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                    <a href="<?php echo base_url(); ?>/fornecedor/delete/"><button class="btn btn-warning" type="button"> Confirmar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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