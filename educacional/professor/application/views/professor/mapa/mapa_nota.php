<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>Mapa"><i class="fa fa-list-alt"></i> LISTA MAPA DE NOTAS</a></li>
                    <li class="active"><i class="fa fa-map-marker"></i> MAPA DE NOTAS</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="row">
            <aside class="profile-info col-lg-12">
                <section class="panel">
                    <header class="panel-heading summary-head" style="height: 40px; line-height: 50px;">
                        <!-- <h4>DADOS ALUNO</h4>-->
                        <p></p>
                    </header>

                    <div  class="panel-body" style="font-size: 15px; margin-left: 30px;">


                        <div class="row" id="teste" >
                            <div style='width: 890px; height: auto; margin-left: 15px;'>


                                <div style=" width: 700px; float: left;">

                                    <div style="width: 700px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">MAPA DE NOTAS</div>
                                    <div style="width: 700px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 15px;">CURSO : <?php echo $infoPlano['cur_tx_descricao']; ?></div>
                                    <div style="width: 700px;  height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">DISCIPLINA : <?php echo $infoPlano['disc_tx_descricao']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">PROFESSOR : <?php echo $infoPlano['nome']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">TURMA : <?php echo $infoPlano['tur_tx_descricao']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">CH : <?php echo $infoPlano['carga_horaria'] . " Horas"; ?> </div>

                                </div>

                                <div style=" width: 190px; float: left; height: 136px;">

                                    <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                </div>


                                <hr style="float: left; width: 890px;"/>


                                <div class="adv-table">
                                    <table style="font-size: 12px;"  class="display table table-bordered table-striped" id="example">
                                        <thead>
                                            <tr style="font-size: 14px;" >
                                                <th style="text-align: center; ">#</th>
                                                <th style="text-align: center;">MATRÍCULA</th>
                                                <th style="text-align: center;">NOME</th>
                                                <th style="text-align: center;">1BIM</th>
                                                <th style="text-align: center;">2BIM</th>
                                                <th style="text-align: center;">3BIM</th>
                                                <th style="text-align: center;">MÉDIA</th>
                                                <th style="text-align: center;">FALTAS</th>
                                                <th style="text-align: center;">SITUAÇÃO</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = 1;
                                            foreach ($alunos as $row):
                                                ?>
                                                <tr style="text-align: justify;" class="gradeU">
                                                    <td style="text-align: center;"><?php echo $cont++; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['registro_academico']; ?></td>
                                                    <td><?php echo $row['nome']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['dan_fl_nota_1bim']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['dan_fl_nota_2bim']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['dan_fl_nota_3bim']; ?></td>
                                                    <td style="text-align: center;"><?php echo $mediaFinal = round(($row['dan_fl_nota_1bim'] + $row['dan_fl_nota_2bim'] + $row['dan_fl_nota_3bim']) / 3, 2) ?></td>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        echo $faltasAtual = $this->professor_model->QtdChamada($row['da_codigo'], 'cham_nb_status', 0, 'updateStatus', 1) * 2;
                                                        ?>



                                                    </td>
                                                    <td style="width: 8%; text-align: center;">

                                                        <?php
                                                        if ($faltasAtual > $infoPlano['carga_horaria']/100 *25) {
                                                            ?>
                                                            <button type="button" class="btn btn-warning btn-xs">REPF</button>
                                                            <?php
                                                        } else if ($mediaFinal >= 7) {
                                                            ?>
                                                            <button type="button" class="btn btn-success btn-xs">AP </button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button type="button" class="btn btn-danger btn-xs">REP </button>
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

                                <div style="width: 890px;page-break-after: always; float: left; height: 20px;  border:1px solid #ddd; font-size: 12px; margin-top: 20px;">
                                    <b>AP</b> = APROVADO - <b>REP</b> = REPROVADO - <b>REPF</b> = REPROVADO POR FALTA


                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px; margin-left: 40px;" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i> IMPRIMIR MAPA DE NOTAS </button>
                        </div>
                    </div>

                    <br/>
                </section>
            </aside>
        </div>  
    </section>
</section>

<script>

    function printDiv(divID)
    {
        //pega o Html da DIV
        var divElements = document.getElementById(divID).innerHTML;
        //pega o HTML de toda tag Body
        var oldPage = document.body.innerHTML;

        //Alterna o body 
        document.body.innerHTML =
                "<html><head><style></style></head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>

