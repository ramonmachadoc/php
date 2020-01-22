
<section id="main-content">
    <section class="wrapper">
        <div class="row">

            <aside class="profile-info col-lg-12">
                <section class="panel">
                    <header class="panel-heading summary-head" style="height: 40px; line-height: 50px;">
                        <!-- <h4>DADOS ALUNO</h4>-->
                        <p></p>
                    </header>

                    <div  id="teste" class="panel-body" style="font-size: 15px;">

                        <?php
                        foreach ($mensalidades as $row):
                            ?>

                            <div style='/*background-color: red;*/' class="row" style="margin-left: 0px;">

                                <div style='width: 187px; height: 211px; /* background-color: blue;*/ float: left;border-style: solid; border-width:1px; margin-left: 20px; '>

                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 58px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style="float: left; width: 60px; margin-left: 10px;">
                                            <img style="margin-top: 5px;" width="50" height="50" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                        </div>

                                        <div style="font-size: 18px;   float: left; margin-top: 5px; ">
                                            <span style="margin-top: 25px;"> Vencimento: 
                                                <br/><b>

                                                    <?php
                                                    $data_real = explode('-', $row['men_dt_vencto']);
                                                    echo $data_real[2] . "/" . $data_real[1] . "/" . $data_real[0];
                                                    ?>
                                                </b>
                                            </span>
                                        </div>

                                    </div>


                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" font-size: 11px;  margin-top: 2px; width: 187px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)VALOR : <b><?php echo number_format($row['men_fl_valor'], 2, ',', ' '); ?></b>
                                            </span>
                                        </div>

                                    </div>


                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" font-size: 11px; margin-top: 2px; width: 187px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (-)DESCONTO:  <b></b>
                                            </span>
                                        </div>

                                    </div>

                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style="margin-top: 2px; width: 187px; font-size: 11px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)JUROS:  <b></b>
                                            </span>
                                        </div>

                                    </div>


                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" margin-top: 2px; width: 187px; font-size: 11px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)VALOR A PAGAR:  <b></b>
                                            </span>
                                        </div>

                                    </div>




                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" margin-top: 2px; width: 187px; font-size: 11px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)Nº PARCELA:  <b><?php echo $row['men_nb_numero_parcela']; ?>/5</b>
                                            </span>
                                        </div>

                                    </div>


                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 40px; font-size: 11px; border-style: solid; border-right-width:0px;  border-left-width: 0px; border-top-width: 0px; border-bottom-style: dashed; border-bottom-width: 1px;">

                                        <div style=" margin-top: 2px; width: 187; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                VISTO CAIXA:  
                                            </span>
                                        </div>

                                    </div>


                                </div>


                                <div style='width: 352px; height: 211px;  float: left; margin-left: 0px; border-style: solid; border-width:1px; border-right-style: dashed; border-right-width: 1px;'>


                                    <div style=" /* background-color: yellow;*/ width: 360px; height: 58px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">


                                        <div style="float: left; width: 75px; margin-left: 10px; ">
                                            <img style="margin-top: 5px;" width="50" height="50" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                        </div>


                                        <div style="font-size: 18px; float: left; margin-top: 4px; ">
                                            <span style="margin-top: 25px;"> 
                                                <b>CONTROLE DE PAGAMENTO</b> 
                                            </span>
                                        </div>


                                        <div style="font-size: 18px;  float: left; margin-top: 0px;text-align: center; ">
                                            <span style="margin-top: 25px;"> 
                                                <b>FACULDADE BOAS NOVAS</b>
                                            </span>
                                        </div>

                                    </div>

                                    <div style=" /* background-color: yellow;*/ width: 360px; height: 64px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" font-size: 12px; margin-top: 2px; width: 360px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                ALUNO: <?php echo $DadosAluno['nome']; ?>
                                            </span>
                                        </div>


                                        <div style=" font-size: 12px; margin-top: 2px; width: 360px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                CURSO: <?php echo $DadosAluno['cur_tx_descricao']; ?>
                                            </span>
                                        </div>


                                        <div style=" font-size: 12px; margin-top: 2px; width: 360px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                PERÍODO: <?php echo $DadosAluno['periodo_id'] . "º - " . $DadosAluno['periodo_letivo']; ?>
                                            </span>
                                        </div>


                                    </div>





                                    <div style=" /* background-color: yellow;*/ width: 360px; height: 84px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" margin-top: 2px; width: 360px; text-align: justify; font-size: 10px;">
                                            <span style="margin-left: 10px;"> 
                                                <b>INFORMAÇÕES DE RESPONSABILIDADE DO BENEFICIÁRIO</b>
                                            </span>
                                        </div>

                                        <div style=" margin-top: 2px; width: 360px; text-align: justify; font-size: 10px;">
                                            <span style="margin-left: 10px; "> 
                                                -Após o vencimento, o valor da mensalidade será integral
                                            </span>
                                        </div>

                                        <div style="  margin-top: 2px; width: 360px; text-align: justify; font-size: 10px;">
                                            <span style="margin-left: 10px; "> 
                                                -Após o vencimento, multa de 2% mais juros de 2% ao mês
                                            </span>
                                        </div>

                                        <div style="margin-top: 2px; width: 360px; text-align: justify; font-size: 10px;">
                                            <span style="margin-left: 10px;"> 
                                                -Desconto de 10% para todo pagamento feito até o dia 07 de cada mês 
                                            </span>
                                        </div>

                                        <div style="  margin-top: 2px; width: 360px; text-align: justify; font-size: 10px;">
                                            <span style="margin-left: 10px; "> 
                                                -Pagável Somente na Faculdade Boas Novas
                                            </span>
                                        </div>

                                    </div>

                                </div>

                                <div style='width: 188px; height: 211px; /* background-color: blue;*/ float: left;border-left-style: dashed; border-top-style: solid; border-top-width: 1px; border-right-style: solid; border-left-width: 1px; border-right-width: 1px;'>

                                    <div style=" /* background-color: yellow;*/  width: 187px; height: 50px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" font-size: 11px;  margin-top: 2px; width: 185px;">
                                            <p style='margin-left: 8px; margin-top: 8px; '> 
                                                Aluno: <?php echo $DadosAluno['registro_academico']; ?> - <?php echo $DadosAluno['nome']; ?> - <?php echo $DadosAluno['cur_tx_abreviatura']; ?> -
                                                <?php echo $DadosAluno['periodo_id'] . "º - " . $DadosAluno['periodo_letivo']; ?>

                                            </p>
                                        </div>




                                    </div>


                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" font-size: 11px;  margin-top: 2px; width: 187px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)VALOR : <b><?php echo number_format($row['men_fl_valor'], 2, ',', ' '); ?></b>
                                            </span>
                                        </div>

                                    </div>


                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style="font-size: 11px; margin-top: 2px; width: 187px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (-)DESCONTO:  <b></b>
                                            </span>
                                        </div>

                                    </div>

                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style="  margin-top: 2px; width: 187px; font-size: 11px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)JUROS:  <b></b>
                                            </span>
                                        </div>

                                    </div>


                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style="margin-top: 2px; width: 187px; font-size: 11px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)VALOR A PAGAR:  <b></b>
                                            </span>
                                        </div>

                                    </div>



                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 20px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" margin-top: 2px; width: 187px; font-size: 11px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                (+)Nº PARCELA:  <b><?php echo $row['men_nb_numero_parcela']; ?>/5</b>
                                            </span>
                                        </div>

                                    </div>




                                    <div style=" /* background-color: yellow;*/ width: 187px; height: 40px; font-size: 11px; border-style: solid; border-right-width:0px; border-left-width: 0px; border-top-width: 0px; border-bottom-width: 1px;">

                                        <div style=" margin-top: 2px; width: 187px; text-align: justify;">
                                            <span style="margin-left: 20px;"> 
                                                VISTO CAIXA - Vec: 
                                                <b>
                                                    <?php
                                                    $data_real = explode('-', $row['men_dt_vencto']);
                                                    echo $data_real[2] . "/" . $data_real[1] . "/" . $data_real[0];
                                                    ?> 
                                                </b>
                                            </span>
                                        </div>

                                    </div>


                                </div>




                            </div>
                            <?php
                        endforeach;
                        ?>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: -8px; margin-left: 20px;" type="button" class="btn btn-success btn-sm"><i class="fa fa-print"></i> IMPRIMIR MENSALIDADES </button>
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
                "<html><head><title></title></head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>
