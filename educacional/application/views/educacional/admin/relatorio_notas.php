<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">

                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li class="active"><i class="fa fa-table"></i> RELATÓRIO DE INCONSISTÊNCIA DE NOTAS</li>
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
                                        <div class="col-lg-8 col-sm-8"  >

                                            <div style="width: 540px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 25px; margin-top: 10px;">RELATÓRIO DE INCONSISTÊNCIA DE NOTAS</div>
                                            <div style="width: 300px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 15px;">PERÍODO 2018/1 </div>
                                        </div>
                                    </td>

                                    <td>

                                        <div class="col-lg-4 col-sm-4">
                                            <img style="margin-top: 5px; margin-left: 170px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                        </div>

                                    </td>

                                </tr>
                            </table>


                            <hr style="float: left; width: 890px;"/>

                            <section class="panel">

                                <div class="panel-body" >
                                    <div class="adv-table" >
                                        <table  style="font-size: 12px;"  class="display table table-bordered table-striped table-hover" id="example">

                                            <?php
                                            foreach ($disciplinas as $row):
                                                $InfoDisciplina = $this->educacional_model->InfoDisciplina($row['pdt_nb_codigo']);
                                                $AlunosDisc = $this->educacional_model->AlunosNota($InfoDisciplina['tur_nb_codigo'], $InfoDisciplina['disc_nb_codigo']);
                                                $CountAlunosDisc = $this->educacional_model->CountAlunosNota($InfoDisciplina['tur_nb_codigo'], $InfoDisciplina['disc_nb_codigo'], 'dan_fl_nota_1bim');
                                                //echo $CountAlunosDisc['qtd'];
                                                ?>
                                                <thead>
                                                    <tr style="font-size: 14px;" >
                                                        <th colspan="9" style="text-align: center;"> 
                                                            <?php echo $row['disc_tx_descricao']; ?> - <?php echo $row['tur_tx_descricao']; ?> 
                                                            - <?php echo $row['nome'] ?> <?php echo "</br><b> TOTAL DE ALUNOS: " . count($AlunosDisc) . "</b>"; ?> 


                                                            <?php
//                                                            $total =  ($CountAlunosDisc['qtd'] / count($AlunosDisc))* 100 ;
//                                                            $final = 100 - $total;
//                                                            
//                                                            if ($final == 0 || $final <= 30) {
//                                                                $progress = "danger";
//                                                            } else if ($final > 30 && $final <= 65) {
//                                                                $progress = "warning";
//                                                            } else if ($final > 65 && $final <= 100) {
//                                                                $progress = "success";
//                                                            }
                                                            ?>

                                                            <!--                                                            <div class="progress">
                                                                                                                            <div class="progress-bar progress-bar-<?php echo $progress; ?> progress-bar-striped" role="progressbar"
                                                                                                                                 aria-valuenow="<?php echo $final; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $final; ?>%">
                                                            <?php echo number_format($final); ?>% 
                                                                                                                            </div>
                                                                                                                        </div>-->

                                                        </th>
                                                    </tr>
                                                </thead>




                                                <thead>
                                                    <tr style="font-size: 14px;" >
                                                        <th style="text-align: center; ">#</th>
                                                        <th style="text-align: center;">NOME</th>
                                                        <th style="text-align: center;">MATRÍCULA</th>
                                                        <th style="text-align: center;">SITUAÇÃO</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $cont = 1;
                                                    foreach ($AlunosDisc as $rowAlunos):


                                                        if ($rowAlunos['dan_fl_nota_1bim'] == "") {
                                                            ?>

                                                            <tr style="text-align: justify;" class="gradeU danger">
                                                                <td style="text-align: center;"><?php echo $cont++; ?></td>
                                                                <td> <?php echo $rowAlunos['nome']; ?></td>
                                                                <td style="text-align: center;"><?php echo $rowAlunos['registro_academico']; ?></td>
                                                                <td style="width: 8%; text-align: center;">
                                                                    <button style="width: 90px;" type="button" class="btn btn-danger btn-xs">SEM NOTA </button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        } else if ($rowAlunos['dan_fl_nota_1bim'] == 0) {
                                                            ?>
                                                            <tr style="text-align: justify;" class="gradeU warning">
                                                                <td style="text-align: center;"><?php echo $cont++; ?></td>
                                                                <td> <?php echo $rowAlunos['nome']; ?></td>
                                                                <td style="text-align: center;"><?php echo $rowAlunos['registro_academico']; ?></td>
                                                                <td style="width: 8%; text-align: center;">
                                                                    <button style="width: 90px;" type="button" class="btn btn-warning btn-xs">COM NOTA 0</button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                                <?php
                                            endforeach;
                                            ?>

                                        </table>
                                    </div>
                                </div>
                            </section>
                           
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
                "<html><head><style>*{color:black}</style></head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>






<?php
//foreach ($disciplinas as $row):
//
//    $InfoDisciplina = $this->educacional_model->InfoDisciplina($row['pdt_nb_codigo']);
//
//    echo $row['disc_tx_descricao'] . "<br/>";
//
//    $AlunosDisc = $this->educacional_model->AlunosNota($InfoDisciplina['tur_nb_codigo'], $InfoDisciplina['disc_nb_codigo']);
//
//
//    foreach ($AlunosDisc as $rowAlunos):
//
//        // echo $rowAlunos['dan_fl_nota_1bim'];
//
//        if ($rowAlunos['dan_fl_nota_1bim'] == "") {
//            echo $rowAlunos['nome'];
//        } else if ($rowAlunos['dan_fl_nota_1bim'] == 0) {
//            echo $rowAlunos['nome'];
//        }
//
//    endforeach;
//
//endforeach;
?>