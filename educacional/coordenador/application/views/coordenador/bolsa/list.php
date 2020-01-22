<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE BOLSA(S)</h1>
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
                                        <th>Descrição</th>
                                        <th>Porcentagem Min</th>
                                        <th>Porcentagem Max</th>
                                        <th>Tipo</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    $cont2 = 1;
                                    $cont = 1;
                                    foreach ($bolsas as $rowBolsas):
                                        ?>
                                        <tr class="gradeU">
                                            <td><?php echo $contador++; ?></td>
                                            <td><?php echo $rowBolsas['descricao']; ?></td>
                                            <td><?php echo $rowBolsas['porcentagem_minima'] . "%"; ?></td>
                                            <td><?php echo $rowBolsas['porcentagem_maxima'] . "%"; ?></td>
                                            <td> 
                                                <?php
                                                if ($rowBolsas['tipo'] == 1) {
                                                    echo "Bolsa";
                                                } else {
                                                    echo "Financiamento";
                                                }
                                                ?>
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