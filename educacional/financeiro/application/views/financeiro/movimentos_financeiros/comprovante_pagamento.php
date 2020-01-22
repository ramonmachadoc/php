
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



                        <div class="row" >

                            <div style='width: 890px; height: 400px; margin-left: 15px;'>


                                <div style="width: 475px; float: left; height: 600px;">


                                    <div style="width: 120px;float: left; height: 169px;">
                                        <img style="margin-top: 5px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                    </div>

                                    <div style="width: 330px;  float: left; height: 25px; font-size: 25px;  font-weight: bold; text-align: center;">
                                        FACULDADE BOAS NOVAS
                                    </div>


                                    <div style="width: 330px; float: left; height: 25px; font-size: 14px; margin-top: 20px; text-align: center;">
                                        CNPJ: 84541689/0005-85
                                    </div>

                                    <div style="width: 330px;  float: left; height: 25px; font-size: 14px; margin-top: 8px; text-align: center;">
                                        INSC.EST.: 04.105.775-9
                                    </div>

                                    <div style="width: 330px; float: left; height: 25px; font-size: 12px; margin-top: 8px; text-align: center;">
                                        ENDERECO: AV.GENERAL RODRIGO OCTAVIO , 1655
                                    </div>

                                    <div style="width: 330px;  font-size: 14px; float: left; height: 25px; margin-top: 8px; text-align: center;">
                                        BAIRRO: JAPIIM, MANAUS - AM CEP: 69.077-000
                                    </div>

                                    <div style="width: 450px; text-align: center; margin-top: 25px; font-weight: bold; font-size: 16px; float: left;">
                                        <span style="margin-left: 100px;">COMPROVANTE DE PAGAMENTO</span>
                                    </div>


                                    <div style=" width: 450px;  margin-top: 25px;  font-size: 16px; float: left;">
                                        ALUNO :<?php echo $DadosAluno['registro_academico']; ?> - <?php echo $DadosAluno['nome']; ?>
                                    </div>

                                    <div style=" width: 450px;  margin-top: 10px;  font-size: 16px; float: left;">
                                        CURSO : <?php echo $DadosAluno['cur_tx_descricao']; ?>
                                    </div>

                                    <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                        <?php
                                        if ($DadosAluno['desperiodizado'] == 1) {
                                            echo "Desperiodizado-";
                                        } else {
                                            if ($DadosAluno['periodo_id'] == 0) {
                                                if ($DadosAluno['periodo'] == 'I') {
                                                    echo "1";
                                                } else if ($DadosAluno['periodo'] == 'II') {
                                                    echo "2";
                                                } else if ($DadosAluno['periodo'] == 'III') {
                                                    echo "3";
                                                } else if ($DadosAluno['periodo'] == 'IV') {
                                                    echo "4";
                                                } else if ($DadosAluno['periodo'] == 'V') {
                                                    echo "5";
                                                } else if ($DadosAluno['periodo'] == 'VI') {
                                                    echo "6";
                                                } else if ($DadosAluno['periodo'] == 'VII') {
                                                    echo '7';
                                                } else if ($DadosAluno['periodo'] == 'VIII') {
                                                    echo "8";
                                                }
                                            } else {
                                                echo $DadosAluno['periodo_id'];
                                            }
                                            ?>º Período - <?php
                                        }

                                        if ($DadosAluno['periodo_letivo'] == null) {
                                            echo $DadosAluno['ano'] . "/" . $DadosAluno['semestre'];
                                        } else {
                                            echo $DadosAluno['periodo_letivo'];
                                        }
                                        ?>
                                    </div>


                                    <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                        VALOR : R$ <?php echo FormatarValor($recibo['men_fl_valor']); ?>
                                    </div>


                                    <div style=" width: 450px;  margin-top: 8px; font-size: 12px; float: left;">
                                        Desconto: R$ <?php echo FormatarValor($recibo['mf_db_desconto']); ?>
                                    </div>


                                    <div style=" width: 450px;  margin-top: 8px; font-size: 12px; float: left;">
                                        Juros: R$ <?php echo FormatarValor($recibo['mf_db_juros']); ?>
                                    </div>


                                    <div style="width: 450px;  margin-top: 8px; font-size: 12px; float: left;">
                                        Multa: R$ <?php echo FormatarValor($recibo['multa']); ?>
                                    </div>


                                    <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                        VALOR RECEBIDO: R$ <?php echo FormatarValor($recibo['mf_db_valor']); ?>
                                    </div>

                                    <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                        NA DATA : <?php echo FormatarData($recibo['data_entrada']); ?>
                                    </div>

                                    <?php
                                    $dax = explode('-', $recibo['men_dt_vencto']);
                                    if ($dax[1] == '01') {
                                        $mesext = "JAN";
                                    } else if ($dax[1] == '02') {
                                        $mesext = "FEV";
                                    } else if ($dax[1] == '03') {
                                        $mesext = 'MAR';
                                    } else if ($dax[1] == '04') {
                                        $mesext = 'ABR';
                                    } else if ($dax[1] == '05') {
                                        $mesext = 'MAI';
                                    } else if ($dax[1] == '06') {
                                        $mesext = 'JUN';
                                    } else if ($dax[1] == '07') {
                                        $mesext = 'JUL';
                                    } else if ($dax[1] == '08') {
                                        $mesext = 'AGO';
                                    } else if ($dax[1] == '09') {
                                        $mesext = 'SET';
                                    } else if ($dax[1] == '10') {
                                        $mesext = 'OUT';
                                    } else if ($dax[1] == '11') {
                                        $mesext = 'NOV';
                                    } else if ($dax[1] == '12') {
                                        $mesext = 'DEZ';
                                    }
                                    ?>


                                    <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                        REFERENTE A(O) : <?php echo $recibo['nome']; ?>
                                        - Mês: <?php echo $mesext; ?> / <?php echo $dax[0]; ?>
                                    </div>

                                    <div style=" width: 450px; text-align: center;  margin-top: 35px; font-size: 16px; float: left;">
                                        _____________________________________________________
                                    </div>


                                    <div style="width: 450px; text-align: center; font-size: 14px; float: left;">
                                        Assinatura
                                    </div>


                                </div>



                                <div style="width: 410px; float: left;  border-style: dashed; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px;">

                                    <div style="width: 450px; float: left;  height: 600px; margin-left: 25px;">


                                        <div style=" width: 120px;float: left; height: 169px;">
                                            <img style="margin-top: 5px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                        </div>

                                        <div style="width: 330px;  float: left; height: 25px; font-size: 25px;  font-weight: bold; text-align: center;">
                                            FACULDADE BOAS NOVAS
                                        </div>


                                        <div style="width: 330px;float: left; height: 25px; font-size: 14px; margin-top: 20px; text-align: center;">
                                            CNPJ: 84541689/0005-85
                                        </div>

                                        <div style="width: 330px; float: left; height: 25px; font-size: 14px; margin-top: 8px; text-align: center;">
                                            INSC.EST.: 04.105.775-9
                                        </div>

                                        <div style="width: 330px; float: left; height: 25px; font-size: 12px; margin-top: 8px; text-align: center;">
                                            ENDERECO: AV.GENERAL RODRIGO OCTAVIO , 1655
                                        </div>

                                        <div style="width: 330px;  font-size: 14px; float: left; height: 25px; margin-top: 8px; text-align: center;">
                                            BAIRRO: JAPIIM, MANAUS - AM CEP: 69.077-000
                                        </div>

                                        <div style="width: 450px; text-align: center; margin-top: 25px; font-weight: bold; font-size: 16px; float: left;">
                                            <span style="margin-left: 100px;">COMPROVANTE DE PAGAMENTO</span>
                                        </div>


                                        <div style="width: 450px;  margin-top: 25px;  font-size: 16px; float: left;">
                                            ALUNO :<?php echo $DadosAluno['registro_academico']; ?>  - <?php echo $DadosAluno['nome']; ?>
                                        </div>

                                        <div style=" width: 450px;  margin-top: 10px;  font-size: 16px; float: left;">
                                            CURSO :  <?php echo $DadosAluno['cur_tx_descricao']; ?>
                                        </div>

                                        <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">

                                            <?php
                                            if ($DadosAluno['desperiodizado'] == 1) {
                                                echo "Desperiodizado-";
                                            } else {
                                                if ($DadosAluno['periodo_id'] == 0) {
                                                    if ($DadosAluno['periodo'] == 'I') {
                                                        echo "1";
                                                    } else if ($DadosAluno['periodo'] == 'II') {
                                                        echo "2";
                                                    } else if ($DadosAluno['periodo'] == 'III') {
                                                        echo "3";
                                                    } else if ($DadosAluno['periodo'] == 'IV') {
                                                        echo "4";
                                                    } else if ($DadosAluno['periodo'] == 'V') {
                                                        echo "5";
                                                    } else if ($DadosAluno['periodo'] == 'VI') {
                                                        echo "6";
                                                    } else if ($DadosAluno['periodo'] == 'VII') {
                                                        echo '7';
                                                    } else if ($DadosAluno['periodo'] == 'VIII') {
                                                        echo "8";
                                                    }
                                                } else {
                                                    echo $DadosAluno['periodo_id'];
                                                }
                                                ?>º Período - <?php
                                            }
                                            if ($DadosAluno['periodo_letivo'] == null) {
                                                echo $DadosAluno['ano'] . "/" . $DadosAluno['semestre'];
                                            } else {
                                                echo $DadosAluno['periodo_letivo'];
                                            }
                                            ?>
                                        </div>


                                        <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                            VALOR : R$  <?php echo FormatarValor($recibo['men_fl_valor']); ?>

                                        </div>


                                        <div style=" width: 450px;  margin-top: 8px; font-size: 12px; float: left;">
                                            Desconto: R$ <?php echo FormatarValor($recibo['mf_db_desconto']); ?>
                                        </div>


                                        <div style=" width: 450px;  margin-top: 8px; font-size: 12px; float: left;">
                                            Juros: R$ <?php echo FormatarValor($recibo['mf_db_juros']); ?>
                                        </div>


                                        <div style=" width: 450px;  margin-top: 8px; font-size: 12px; float: left;">
                                            Multa: R$ <?php echo FormatarValor($recibo['multa']); ?>
                                        </div>

                                        <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                            VALOR RECEBIDO: R$ <?php echo FormatarValor($recibo['mf_db_valor']); ?>
                                        </div>

                                        <div style="width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                            NA DATA :  <?php echo FormatarData($recibo['data_entrada']); ?>
                                        </div>


                                        <div style=" width: 450px;  margin-top: 10px; font-size: 16px; float: left;">
                                            REFERENTE A(O) : <?php echo $recibo['nome']; ?>


                                            - Mês: <?php echo $mesext; ?> /  <?php echo $dax[0]; ?>
                                        </div>

                                        <div style=" width: 450px; text-align: center;  margin-top: 35px; font-size: 16px; float: left;">
                                            _____________________________________________________
                                        </div>
                                        <div style=" width: 450px; text-align: center; font-size: 14px; float: left;">
                                            Assinatura
                                        </div>


                                    </div>
                                </div>




                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 30px; margin-left: 20px;" type="button" class="btn btn-success btn-sm"><i class="fa fa-print"></i> IMPRIMIR RECIBO </button>
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
