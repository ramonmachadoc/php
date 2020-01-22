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

                                    <div style="width: 700px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">PROTOCOLO DE PROVA</div>
                                    <div style="width: 700px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 15px;"><b>CURSO:</b> <?php echo $infoPlano['cur_tx_descricao']; ?></div>
                                    <div style="width: 700px;  height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;"><b>DISCIPLINA:</b> <?php echo $infoPlano['disc_tx_descricao']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;"><b>PROFESSOR:</b> <?php echo $infoPlano['nome']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;"><b>TURMA:</b> <?php echo $infoPlano['tur_tx_descricao']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;"> <b>PROTOCO DE PRESENÇA NA:</b> _____ ARE - DATA:  ____/____/2017 </div>

                                </div>

                                <div style=" width: 190px; float: left; height: 136px;">

                                    <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                </div>


                                <hr style="float: left; width: 890px;"/>


                                <div class="adv-table">
                                    <table style="font-size: 12px;"  class="display table table-bordered table-striped" id="example">
                                        <thead>
                                            <tr style="font-size: 14px;" >
                                                <th style="text-align: center; ">Nº</th>
                                                <th style="text-align: center; width: 12%;">MATRÍCULA</th>
                                                <th style="text-align: center; width: 42%;">NOME</th>
                                                <th style="text-align: center;">ASSINATURA DO ALUNO</th>
                                                

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
                                                    <td style="text-align: center;"></td>
                                            
                                                  
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>
                                                
                                                 <tr style="text-align: justify; height: 35px;" class="gradeU">
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td></td>
                                                    <td style="text-align: center;"></td>
                                                </tr>
                                                
                                                 <tr style="text-align: justify; height: 35px;" class="gradeU">
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td></td>
                                                    <td style="text-align: center;"></td>
                                                </tr>
                                                
                                                
                                                
                                        </tbody>
                                    </table>
                                </div>

                            
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px; margin-left: 40px;" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i> IMPRIMIR P. PROVA </button>
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

