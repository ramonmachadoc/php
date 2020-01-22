<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA PLANO(S) DE ENSINO</h1>
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
                                        <th>P. Letivo</th>
                                        <th>Curso</th>
                                        <th>Turma</th>
                                        <th>Período</th>
                                        <th>Disciplina</th>
                                        <th class="text-center">AÇÕES</th>
                                        <th class="text-center">Preenchimento Plano %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    $cont2 = 1;
                                    $cont = 1;
                                    ?>



                                    <?php
                                    foreach ($disciplinas as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td><?php echo $contador++; ?></td>
                                            <td><?php echo $row['periodo_letivo']; ?></td>
                                            <td><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td><?php echo $row['periodo']; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?> </td>
                                            <td class="center hidden-phone">

                                                <a href="<?php echo base_url(); ?>DisciplinasProfessor/PlanoEnsino/<?php echo $row['pdt_id']; ?>">
                                                    <button style="background-color: #4682B4;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> IMPRIMIR</button>
                                                </a>


                                                <a href="<?php echo base_url(); ?>PlanoEnsino/PlanoEnsino/<?php echo $row['pdt_id']; ?>/<?php echo $row['disciplina_id'] ?>/<?php echo $row['carga_horaria']; ?>">
                                                    <button  style="background-color: #4682B4;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> PREENCHER</button>
                                                </a>
                                            </td>

                                            <td style="width: 12%;">

                                                <?php
                                                $rowEmenta = $this->professor_model->EmentaPlano($row['disciplina_id']);
                                                $rowOutros = $this->professor_model->progressoPlano($row['pdt_id']);
                                                $rowReferencias = $this->professor_model->getTableRow('referencias', 'ref_nb_codigo', 'emet_nb_codigo', $rowEmenta['emet_nb_codigo']);


                                                if ($rowOutros['pe_nb_codigo']) {

                                                    $ArrayAulas = $this->professor_model->progressoAula($rowOutros['pe_nb_codigo']);

                                                    $valorTotal = 0;
                                                    $valorTotal2 = 0;
                                                    $valorTotal3 = 0;
                                                    $valorTotal4 = 0;
                                                    $valorTotal5 = 0;

                                                    foreach ($ArrayAulas as $row2):
                                                        $valorTotal += $row2['teste'];
                                                        $valorTotal2 += $row2['teste2'];
                                                        $valorTotal3 += $row2['teste3'];
                                                        $valorTotal4 += $row2['teste4'];
                                                        $valorTotal5 += $row2['teste5'];
                                                    endforeach;

                                                    $totalGeral = $valorTotal + $valorTotal2 + $valorTotal3 + $valorTotal4 + $valorTotal5;

                                                   
                                                    if ($row['carga_horaria'] == 40) {

                                                        $porce = $totalGeral * 0.5;
                                                    } else if ($row['carga_horaria'] == 80) {

                                                        $porce = $totalGeral * 0.25;
                                                    }else if($row['carga_horaria'] == 100){
                                                         $porce = $totalGeral * 0.20;
                                                    }

                                                    if ($rowReferencias['ref_tx_descricao'] == "") {
                                                        $total = $rowOutros['teste5'] + 1;
                                                    } else {

                                                        $total = $rowOutros['teste5'];
                                                    }

                                                    if ($rowEmenta['ement_tx_descricao'] == "") {

                                                        $total = $total + 1;
                                                    } else {
                                                        
                                                    } $total = $total;


                                                    $total = 7 - $total;

                                                    if ($total == 7) {
                                                        $resposta = 50;
                                                    } else {
                                                        $resposta = $total * 7;
                                                    }


                                                    $final = $resposta + $porce;
                                                    if ($final == 0 || $final <= 30) {
                                                        $progress = "danger";
                                                    } else if ($final > 30 && $final <= 65) {
                                                        $progress = "warning";
                                                    } else if ($final > 65 && $final <= 100) {
                                                        $progress = "success";
                                                    }
                                                    ?>

                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-<?php echo $progress; ?> progress-bar-striped" role="progressbar"
                                                             aria-valuenow="<?php echo $final; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $final; ?>%">
                                                            <?php echo $final; ?>% 
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            </td>

                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>

                                <div class="modal fade" id="myModal2<?php echo $cont2++; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Excluir Categoria</h4>
                                            </div>
                                            <div class="modal-body">
                                                Deseja realmente exclui: <b><?php echo $row['cat_tx_descricao']; ?></b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                <a href="<?php echo base_url(); ?>/categoria/delete/"><button class="btn btn-warning" type="button"> Confirmar</button></a>
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