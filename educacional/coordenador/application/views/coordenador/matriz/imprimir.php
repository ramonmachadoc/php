<style>
    .adv-table table tr td{
        padding: 5px; 
    }
</style>


<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>matriz"><i class="fa fa-list-alt"></i> LISTA MATRIZ</a></li>
                    <li class="active"><i class="fa fa-print"></i> IMPRIMIR MATRIZ</li>
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

<!--                                    <div style="width: 700px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;"> MATRIZ <br/> <?php echo $InfoMatriz['cur_tx_abreviatura'] . "-" . $InfoMatriz['mat_tx_ano'] . "/" . $InfoMatriz['mat_tx_semestre'] ?></div>-->
                                    <div style="width: 700px;   height: 27px; font-weight: bold;  font-size: 20px; padding-left: 4px; padding-top: 2px; margin-top: 10px;">MATRIZ CURRICULAR   </div>
                                    <div style="width: 700px;   height: 27px; font-weight: bold;  font-size: 20px;  padding-left: 4px; padding-top: 2px; margin-top: 10px;">CURSO: <?php echo $InfoMatriz['cur_tx_descricao']; ?>   </div>
                                    <div style="width: 700px;   height: 27px; font-weight: bold;  font-size: 20px;  padding-left: 4px; padding-top: 2px; margin-top: 10px;"><?php echo $InfoMatriz['cur_tx_abreviatura'] . "-" . $InfoMatriz['mat_tx_ano'] . "/" . $InfoMatriz['mat_tx_semestre']; ?>   </div>

                                </div>

                                <div style=" width: 190px; float: left; height: 136px;">

                                    <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                </div>


                                <div class="adv-table">
                                    <table style="font-size: 12px;"  class="display table table-bordered table-striped" id="example">


                                        <?php
                                        $cont = 1;
                                        foreach ($periodos as $rowPeriodo):
                                            ?>

                                            <tr style="font-size: 14px;" >
                                                <th colspan="4" style="text-align: center;"> <?php echo $rowPeriodo['periodo']; ?>º SEMESTRE</th>
                                            </tr>


                                            <tr style="font-size: 14px;" >
                                                <th style="text-align: center; ">Nº</th>
                                                <th>Disciplina</th>
                                                <th style="text-align: center;">CH</th>
                                                <th style="text-align: center;">Crédito</th>
                                            </tr>


                                            <?php
                                            $disciplinas = $this->coordenador_model->DisciplinasMatrizImprimir($matriz_id, $rowPeriodo['periodo']);


                                            foreach ($disciplinas as $rowDisc):
                                                ?>
                                                <tr style="text-align: justify;" class="gradeU">
                                                    <td style="text-align: center; "><?php echo $cont++; ?></td>
                                                    <td><?php echo $rowDisc['disc_tx_descricao']; ?></td>
                                                    <td style="text-align: center;"><?php echo $rowDisc['carga_horaria']; ?></td>
                                                    <td style="text-align: center;"><?php echo $rowDisc['credito']; ?></td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>


                                            <tr style="font-size: 14px;">
                                                <th colspan="2" style="text-align: right; font-size: 12px;">SUB TOTAL</th>
                                                <th  style="text-align: center; font-size: 12px;"><?php
                                                    $sum = $this->coordenador_model->DisciplinasMatrizImprimirSum($matriz_id, $rowPeriodo['periodo'], 'carga_horaria');
                                                    echo $sum['soma'];
                                                    ?>
                                                <th  style="text-align: center; font-size: 12px;">

                                                    <?php
                                                    $sum = $this->coordenador_model->DisciplinasMatrizImprimirSum($matriz_id, $rowPeriodo['periodo'], 'credito');
                                                    echo $sum['soma'];
                                                    ?>

                                                </th>
                                            </tr>

                                        <?php endforeach; ?>
                                    </table>


                                    <br/>

                                    <table style="font-size: 12px;"  class="display table table-bordered table-striped" id="example">
                                        <tr style="font-size: 14px;">
                                            <th colspan="4" style="text-align: center; font-size: 12px;">RESUMO DO CURSO</th>
                                        </tr>

                                        <tr style="font-size: 14px;">
                                            <th colspan="2" style=" font-size: 12px;">Carga Horária Total das Disciplinas </th>
                                            <th colspan="2" style="text-align: center; font-size: 12px;"><?php echo $soma['soma']; ?> Horas</th>
                                        </tr>
                                        
                                          <tr style="font-size: 14px;">
                                            <th colspan="2" style="font-size: 12px;">Atividades Complementares  </th>
                                            <th colspan="2" style="text-align: center; font-size: 12px;">100 Horas</th>
                                        </tr>
                                        
                                          <tr style="font-size: 14px;">
                                            <th colspan="2" style="font-size: 12px;">Carga Horária Total </th>
                                            <th colspan="2" style="text-align: center; font-size: 12px;"><?php echo 100 + $soma['soma']; ?> Horas</th>
                                        </tr>
                                        
                                    </table>

                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px; margin-left: 40px;" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i> IMPRIMIR MATRIZ </button>
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
                "<html><head><style> .adv-table table tr td{padding: 5px;}</style></head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>

