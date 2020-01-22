<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE TURMA(S)</h1>
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
                                        <th>Curso</th>
                                        <th>Turma</th>
                                        <th>Período Letivo</th>
                                        <th>Matriz</th>
                                        <th>Período</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    $cont2 = 1;
                                    $cont3 = 1;



                                    foreach ($turmas as $row):
                                        ?>

                                        <tr class="gradeU">
                                            <td style="text-align: center;"><?php echo $cont++; ?></td>
                                            <td><?php echo $row['cur_tx_descricao']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td><?php echo $row['periodo_letivo']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['mat_tx_ano']; ?> - <?php echo $row['mat_tx_semestre']; ?> </td>

                                            <td style="text-align: center;"><?php echo $row['periodo']; ?></td>
                                           
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