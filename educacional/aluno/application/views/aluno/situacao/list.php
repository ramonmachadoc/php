<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa fa-money"></span> HISTÓRICO FINANCEIRO</h1>
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
                        <div class="adv-table" style="overflow-x: auto">

                           <table  class="display table table-bordered table-striped" id="example" style="font-size: 13px;">
                                                <thead >
                                                    <tr >
                                                        <th>ID</th>
                                                        <th class="text-center">P. Letv </th>
                                                        <th class="text-center">Parc</th>
                                                        <th class="text-center">Dt Vcto</th>
                                                        <th class="text-center">Dt Pgto</th>
                                                        <th class="text-center">Referente</th>

                                                        <th class="text-center">Vl Pagar</th>
                                                        <th class="text-center">(-)Bolsa</th>
                                                        <th class="text-center">(-)Desc</th>
                                                        <th class="text-center">(+)Multa</th>
                                                        <th class="text-center">(+)Juros</th>
                                                        <th class="text-center">Vl Pago</th>
                                                        <th class="text-center">Vl Pend</th>
                                                        <th class="text-center">Situação</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $contador = 1;
                                                    $cont2 = 1;
                                                    $cont4 = 1;
                                                    $cont3 = 1;
                                                    $cont = 1;
                                                    ?>

                                                    <?php
                                                    foreach ($historicoPagamentos as $rowPagamentos):
                                                        ?>
                                                        <tr class="gradeU">
                                                            <td style="width: 4%; text-align: center;"><?php echo $contador++; ?></td>
                                                            <td class="text-center"> 
                                                                <?php
                                                                if ($rowPagamentos['periodo_letivo_id']) {
                                                                    $periodo_letivo_m = $rowPagamentos['periodo_letivo_id'];
                                                                } else {
                                                                    $periodo_letivo_m = $rowPagamentos['periodo_letivo_turma'];
                                                                }

                                                                echo $periodo_letivo_m;
                                                                ?>


                                                            </td>
                                                            <td class="text-center"> <?php echo $rowPagamentos['men_nb_numero_parcela']; ?><?php if ($rowPagamentos['total_parcela']) { ?>/<?php } echo $rowPagamentos['total_parcela']; ?></td>
                                                            <td class="text-center"> 
                                                                <?php
                                                                if (isset($rowPagamentos['men_dt_vencto'])) {

                                                                    echo FormatarData($rowPagamentos['men_dt_vencto']);
                                                                }
                                                                ?>
                                                            </td>

                                                            <td class="text-center" style="width: 8%;"> 
                                                                <?php
                                                                if (isset($rowPagamentos['mf_dt_pgto'])) {

                                                                    echo FormatarData($rowPagamentos['mf_dt_pgto']);
                                                                }
                                                                ?>
                                                            </td>

                                                            <td class="text-center"><?php echo $rowPagamentos['produto']; ?></td>

                                                            <td class="text-center"><?php echo number_format($rowPagamentos['men_fl_valor'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['bolsa'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['mf_db_desconto'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['multa'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['mf_db_juros'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['mf_db_valor'], 2, ',', ' '); ?></td>
                                                            <td class="text-center">



                                                                <?php
                                                                echo number_format($rowPagamentos['men_fl_valor'] + $rowPagamentos['multa'] - $rowPagamentos['bolsa'] - $rowPagamentos['mf_db_desconto'] - $rowPagamentos['mf_db_valor'], 2, ',', ' ');
                                                                ?>

                                                            </td>
                                                            <td class="text-center" style="width: 8%" > 

                                                                <?php
                                                                if ($rowPagamentos['status_mensalidade'] == 1) {
                                                                    ?>
                                                                    <button style="width: 60px;" type="button" class="btn btn-success btn-xs">Pago</button>

                                                                    <?php
                                                                } else if ($rowPagamentos['status_mensalidade'] == 0) {
                                                                    ?> <button style="width: 60px;" type="button" class="btn btn-danger btn-xs">Aberto</button>
                                                                    <?php
                                                                } else if ($rowPagamentos['status_mensalidade'] == 3) {

                                                                    $pendente = $rowPagamentos['men_fl_valor'] - $rowPagamentos['bolsa'] - $rowPagamentos['mf_db_desconto'] - $rowPagamentos['mf_db_valor'];

                                                                    if ($pendente == '0') {
                                                                        ?>

                                                                        <button style="width: 60px;" type="button" class="btn btn-success btn-xs">Pago</button>
                                                                        <?php
                                                                    } else {
                                                                        ?>

                                                                        <button style="width: 60px;" type="button" class="btn btn-info btn-xs"> Parcial</button>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                    <?php
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