<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE CURSO(S)</h1>
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
                                        <th>Curso</th>
                                        <th>Duração(Sem)</th>
                                        <th>Coordenador(a)</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    $cont2 = 1;
                                    $cont3 = 1;
                                    foreach ($cursos as $row):
                                        ?>

                                        <tr class="gradeU">
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $row['cur_tx_descricao']; ?></td>
                                            <td><?php echo $row['cur_tx_duracao']; ?></td>
                                            <td><?php echo $row['cur_tx_coordenador']; ?></td>
                                            <td><?php echo number_format($row['cur_fl_valor'], 2, ',', ''); ?>  </td>
                                         
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