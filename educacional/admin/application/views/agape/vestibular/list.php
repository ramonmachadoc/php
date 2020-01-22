<head>
    <style>

        .tableRelatorio{
            border: 1px solid #ddd;

        }

        .tableRelatorio2{
            padding: 10px;
        }

    </style>
</head>



<section id="main-content">
    <section class="wrapper">



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

                                    <div style="width: 700px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">VESTIBULAR  MACRO 2018/1</div>
                                    <div style="width: 700px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">LISTA DE FREQUÊNCIA</div>
                                    <div style="width: 700px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 15px;">DATA : <?php echo date('d/m/Y'); ?> </div>


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

                                                <th class="tableRelatorio tableRelatorio2" style="text-align: center; ">NOME</th>
                                                <th class="tableRelatorio tableRelatorio2" style="text-align: center;">TELEFONE</th>
                                                <th class="tableRelatorio tableRelatorio2" style="text-align: center;">OP. CURSO</th>
                                                <th class="tableRelatorio tableRelatorio2" style="text-align: center; width: 30%">ASSINATURA</th>


                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $cont = 1;
                                            foreach ($cadidatos as $rowcandidato):
                                                ?>
                                                <tr style="height: 25px;" class="tableRelatorio tableRelatorio2">
                                                    <td class="tableRelatorio tableRelatorio2"><?php echo $cont++; ?></td>
                                                    <td class="tableRelatorio tableRelatorio2"><?php echo strtoupper($rowcandidato['nome']); ?></td>
                                                    <td class="text-center tableRelatorio tableRelatorio2"><?php echo $rowcandidato['can_tx_telefone']; ?></td>
                                                    <td class="text-center tableRelatorio tableRelatorio2"><?php
                                                        $opcao1 = $rowcandidato['can_tx_op01'];
                                                        if ($opcao1 == 1) {
                                                            $txopcao1 = 'CT';
                                                        } else if ($opcao1 == 2) {
                                                            $txopcao1 = 'PED';
                                                        } else if ($opcao1 == 3) {
                                                            $txopcao1 = 'ADM';
                                                        } else if ($opcao1 == 4) {
                                                            $txopcao1 = 'JOR';
                                                        } else if ($opcao1 == 5) {
                                                            $txopcao1 = 'PP';
                                                        }

                                                        echo $txopcao1;
                                                        ?></td>
                                                    <td class="tableRelatorio tableRelatorio2"></td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>

                                        </tbody>
                                    </table>
                                </div>

                                
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px; margin-left: 40px;" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i> IMPRIMIR </button>
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
                "<html><head> <style>  .tableRelatorio{border: 1px solid black;}  .tableRelatorio2{padding: 10px;}  </style> </head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>


