<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE FORNECEDOR(ES)</h1>
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
                        <a href="<?php echo base_url(); ?>fornecedor/add"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> FORNECEDOR</button>
                        </a>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PRODUTO</th>
                                        <th>TIPO</th>
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
                                    foreach ($fornecedores as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td><?php echo $contador++; ?></td>
                                            <td> 
                                                <?php echo $row['for_tx_razao_social']; ?>
                                            </td>

                                            <td> 
                                                <?php
                                                if ($row['for_nb_tipo_pessoa'] == 1) {

                                                    echo "FÍSICA";
                                                } else {

                                                    echo "JURÍDICA";
                                                }
                                                ?>
                                            </td>



                                            <td class="center hidden-phone">

                                                <a href="<?php echo base_url(); ?>fornecedor/edit/<?php echo $row['fornecedor_id']; ?>">
                                                    <button type="button" class="btn btn-default btn-sm">
                                                        <i class="fa fa-pencil"></i> Editar
                                                    </button
                                                </a>

                                                <a data-toggle="modal" href="#myModal2<?php echo $cont++; ?>"><button type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash-o"></i> Excluir
                                                    </button>
                                                </a>
                                        </tr>

                                    <div class="modal fade" id="myModal2<?php echo $cont2++; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Excluir Fornecedor</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente exclui: <b><?php echo $row['for_tx_razao_social']; ?></b>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                    <a href="<?php echo base_url(); ?>/fornecedor/delete/<?php echo $row['fornecedor_id']; ?>"><button class="btn btn-warning" type="button"> Confirmar</button></a>
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