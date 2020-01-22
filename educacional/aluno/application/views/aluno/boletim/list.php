<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">

                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li class="active"><i class="fa fa-table"></i> DEMONSTRATIVO DE NOTAS</li>
                </ul>

            </div>
        </div>


        <section>

            <div class="panel panel-primary">


                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body" style="overflow-x: auto">



                    <div class="row" id="teste" >




                        <div style='width: 890px; height: auto; margin-left: 15px;'>


                            <table style="overflow-x: auto" style="font-size: 12px; "  class="" id="example">
                                <tr>
                                    <td>
                                        <div class="col-lg-6 col-sm-6" >
                                            <div style="width: 500px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">DEMONSTRATIVO DE NOTAS</div>
                                            <div style="width: 500px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 15px;">NOME : <?php echo $dados_aluno['nome']; ?> </div>
                                            <div style="width: 500px;  height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">CURSO: <?php echo $dados_aluno['cur_tx_descricao']; ?></div>
                                            <div style="width: 500px;  height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">MATRÍCULA: <?php echo $dados_aluno['registro_academico']; ?></div>
                                        </div>
                                    </td>

                                    <td>

                                        <div class="col-lg-6 col-sm-6">
                                            <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                        </div>

                                    </td>


                                </tr>

                            </table>



                            <!--                                <div class="col-lg-12 col-sm-12">
                                                                
                                                                <div class="col-lg-6 col-sm-6" style="background-color: green; height: 125px;">
                                                                     <div style="width: 500px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">DEMONSTRATIVO DE NOTAS</div>
                                                                <div style="width: 500px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 15px;">NOME : <?php echo $dados_aluno['nome']; ?> </div>
                                                                <div style="width: 500px;  height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">CURSO: <?php echo $dados_aluno['cur_tx_descricao']; ?></div>
                                                             
                                                                </div>
                                                                
                                                                
                                                                <div class="col-lg-6 col-sm-6" style="background-color: red;">
                                                                   <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                                                </div>
                                                               
                                                                
                                                                
                                                               
                                                            </div>-->

                            <!--                                <div class="col-lg-3 col-sm-3" >
                            dadasd
                                                            </div>-->



                            <hr style="float: left; width: 890px;"/>

                            <section class="panel">

                                <div class="panel-body" >
                                    <div class="adv-table" >
                                        <table  style="font-size: 12px;"  class="display table table-bordered table-striped table-hover" id="example">



                                            <?php
                                            $matricula = $this->aluno_model->getTableRow('matricula_aluno', 'registro_academico', 'registro_academico', $this->session->userdata('login'));
                                            $disciplinas = $this->aluno_model->GetMatriculaTurma($matricula['matricula_aluno_id']);

                                            $cont = 1;

                                            foreach ($disciplinas as $disRow):

                                                $notas = $this->aluno_model->NotasAluno($disRow['matricula_aluno_turma_id']);
                                                ?>

                                                <thead>
                                                    <tr style="font-size: 14px;" >
                                                        <th colspan="9" style="text-align: center;"> <?php echo $disRow['periodo_id']; ?>º PERÍODO</th>
                                                    </tr>
                                                </thead>


                                                <thead>
                                                    <tr style="font-size: 14px;" >
                                                        <th style="text-align: center; ">#</th>
                                                        <th style="text-align: center;">DISCIPLINA</th>
                                                        <th style="text-align: center;">N1</th>
                                                        <th style="text-align: center;">N2</th>
                                                        <th style="text-align: center;">N3</th>
                                                        <th style="text-align: center;">MÉDIA</th>
                                                        <th style="text-align: center;">FALTAS</th>
                                                        <th style="text-align: center;">SITUAÇÃO</th>

                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <?php
                                                    foreach ($notas as $row):
                                                        ?>
                                                        <tr style="text-align: justify;" class="gradeU">
                                                            <td style="text-align: center;"><?php echo $cont++; ?></td>
                                                            <td><?php echo $row['disciplina']; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['1bim']; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['2bim']; ?></td>
                                                            <td style="text-align: center;"><?php echo $row['3bim']; ?></td>
                                                            <td style="text-align: center;"><?php echo $mediaFinal = round(($row['1bim'] + $row['2bim'] + $row['3bim']) / 3, 2) ?></td>
                                                            <td style="text-align: center;">
                                                                <?php
                                                                echo $faltasAtual = $this->aluno_model->QtdChamada($row['disciplina_aluno_id'], 'cham_nb_status', 0, 'updateStatus', 1) * 2;
                                                                ?>
                                                            </td>
                                                            <td style="width: 8%; text-align: center;">

                                                                <?php
                                                                if ($faltasAtual > $row['carga_horaria'] / 100 * 25) {
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
                                                endforeach;
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>

                            <div style="width: 890px;page-break-after: always; float: left; height: 20px;  border:1px solid #ddd; font-size: 12px; margin-top: 20px;">
                                <b>LEGENDA:</b> <b>AP</b> = APROVADO - <b>RN</b> = REPROVADO POR NOTA - <b>RF</b> = REPROVADO POR FALTA
                            </div>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px;" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i> IMPRIMIR BOLETIM </button>
                        </div>
                    </div>



                </div>
            </div>
        </section>
        <!-- invoice end-->
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

