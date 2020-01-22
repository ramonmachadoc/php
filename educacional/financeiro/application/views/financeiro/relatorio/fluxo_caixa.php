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
            <div class="col-lg-12">

                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li class="active"><i class="fa fa-table"></i> RELATÓRIO DE FLUXO DE CAIXA</li>
                </ul>
            </div>
        </div>

        <section>
            <div class="panel panel-primary">
                <div class="panel-body" style="overflow-x: auto">
                    <div class="row" id="teste" >

                        <div style='width: 890px; height: auto; margin-left: 15px;'>

                            <div class="row">
                                <table style="overflow-x: auto" style="font-size: 12px; "  class="" id="example">
                                    <tr>
                                        <td>
                                            <div class="col-lg-6 col-sm-6" >
                                                <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="col-lg-6 col-sm-6">
                                                <div style="width: 500px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: -30px; margin-left: 50px;">RELATÓRIO DE FLUXO DE CAIXA</div>
                                                <div class="text-center" style="width: 500px;  height: 27px;   font-size: 14px; padding-left: 4px; padding-top: 2px; margin-top: 15px; margin-left: 50px;">PERÍODO : <b><?php echo FormatarData($dataInicio); ?></b> ATÉ <b><?php echo FormatarData($dataFim); ?></b> </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                            <hr style="float: left; width: 890px;"/>
                            <section class="panel">

                                <div class="panel-body" >
                                    <div class="adv-table" >

                                        <div class="row">
                                            <table width="100%"  style="border:none !important; font-size: 10px"  class="display table table-striped  table-hover " id="example">

                                                <thead style="border: 1px; border-color: #666666; border-style: solid;" >
                                                    <tr style="font-size: 14px;" >
                                                        <th style="border: 1px; border-color: #666666; border-style: solid;" class="tableRelatorio tableRelatorio2 text-center" colspan="9" style="text-align: center;"> ENTRADA DE PAGAMENTO(S) DE ALUNO(S)</th>
                                                    </tr>
                                                </thead>

                                                <thead class="tableRelatorio tableRelatorio2">
                                                    <tr class="tableRelatorio tableRelatorio2" style="font-size: 14px;" >
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center; ">#</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">DATA</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">CURSO</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">NOME</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">TURMA</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">VALOR B</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">VALOR L</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">TIPO PAG</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">PRODUTO</th>
                                                    </tr>
                                                </thead>

                                                <tbody >

                                                    <?php
                                                    $cont = 1;
                                                    $totalDescontos = 0;
                                                    $totalLiquido = 0;
                                                    foreach ($ListPagamentos as $row):

                                                        $qtdParcelas = $this->financeiro_model->isVarExists('movimento_financeiro', $row['mensalidade_id'], 'mensalidades_id');
                                                        if ($qtdParcelas == 1 && $row['mf_nb_forma_pagamento'] == 2) {
                                                            $taxa = $row['data_entrada'] >= '2018-05-05' ? 2.70 : 3;
                                                        } else if ($qtdParcelas == 1 && $row['mf_nb_forma_pagamento'] == 3) {
                                                            $taxa = $row['data_entrada'] >= '2018-05-05' ? 2.10 : 2.5;
                                                        } else if ($qtdParcelas > 1 && $qtdParcelas < 7 && $row['mf_nb_forma_pagamento'] == 2) {
                                                            $taxa = $row['data_entrada'] >= '2018-05-05' ? 3.77 : 4;
                                                        } else if ($qtdParcelas > 6 && $qtdParcelas <= 12 && $row['mf_nb_forma_pagamento'] == 2) {
                                                            $taxa = 4.5;
                                                        } else {
                                                            $taxa = 0;
                                                        }


                                                        $totalDescontos = $totalDescontos + ($row['mf_db_valor'] / 100) * $taxa;
                                                        $totalLiquido = $totalLiquido + $row['mf_db_valor'] - ($row['mf_db_valor'] / 100) * $taxa
                                                        ?>
                                                        <tr class="tableRelatorio tableRelatorio2">
                                                            <td><?php echo $cont++; ?></td>
                                                            <td class="centerTd tableRelatorio tableRelatorio2"> <?php echo FormatarData($row['mf_dt_pgto']); ?></td>
                                                            <td class="centerTd tableRelatorio tableRelatorio2"><?php echo $row['curso']; ?></td>
                                                            <td><?php echo $row['nome']; ?></td>
                                                            <td class="centerTd tableRelatorio tableRelatorio2"><?php echo $row['turma']; ?></td>
                                                            <td class="centerTd tableRelatorio tableRelatorio2"><?php echo FormatarValor($row['mf_db_valor']); ?></td>
                                                            <td class="centerTd tableRelatorio tableRelatorio2"><?php echo FormatarValor($row['mf_db_valor'] - ($row['mf_db_valor'] / 100) * $taxa) ?></td>
                                                            <td class="centerTd tableRelatorio tableRelatorio2"><?php
                                                                if ($row['mf_nb_forma_pagamento'] == 1) {
                                                                    echo "DINHEIRO";
                                                                } else if ($row['mf_nb_forma_pagamento'] == 2) {
                                                                    echo "C.CRÉDITO";
                                                                } else if ($row['mf_nb_forma_pagamento'] == 3) {
                                                                    echo "C.DÉBITO";
                                                                }
                                                                ?></td>
                                                            <td class="centerTd"><?php echo $row['produto']; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                            <br/>
                                            <br/>

                                            <?php
                                            if ($TotalPagAvulsos['valor'] <> "") {
                                                ?>
                                                <table width="100%" style="border:none !important; font-size: 10px"  class="display table table-striped  table-hover " id="example">

                                                    <thead style="border: 1px; border-color: #666666; border-style: solid;" >
                                                        <tr style="font-size: 14px;" >
                                                            <th style="border: 1px; border-color: #666666; border-style: solid;" class="tableRelatorio tableRelatorio2 text-center" colspan="7" style="text-align: center;"> ENTRADA DE PAGAMENTO(S) DE AVULSO(S)</th>
                                                        </tr>
                                                    </thead>

                                                    <thead class="tableRelatorio tableRelatorio2">
                                                        <tr class="tableRelatorio tableRelatorio2" style="font-size: 14px;" >
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center; ">#</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">NOME</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">VALOR</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">DATA</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">PRODUTO</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>

                                                        <?php foreach ($ListPagAvulsos as $rowPagAvulso): ?>
                                                            <tr class="tableRelatorio tableRelatorio2" >
                                                                <td  class="text-center tableRelatorio tableRelatorio2"><?php echo $cont++; ?></td>
                                                                <td  class="text-center tableRelatorio tableRelatorio2"><?php echo $rowPagAvulso['cliente']; ?></td>
                                                                <td class="text-center tableRelatorio tableRelatorio2"><?php echo FormatarValor($rowPagAvulso['cpr_db_valor']); ?></td>
                                                                <td class="tableRelatorio tableRelatorio2 text-center"> <?php echo FormatarData($rowPagAvulso['cpr_dt_vencimento']); ?></td>
                                                                <td class="text-center tableRelatorio tableRelatorio2"><?php echo $rowPagAvulso['cpr_tx_historico']; ?></td>

                                                            </tr>

                                                        <?php endforeach; ?>

                                                    </tbody>
                                                </table>


                                                <br/>
                                                <br/>
                                            <?php } ?>

                                            <?php if ($TotalSaidaPag['valor'] <> "") { ?>

                                                <table width="100%"  style="border:none !important; font-size: 10px"  class="display table table-striped  table-hover " id="example">

                                                    <thead style="border: 1px; border-color: #666666; border-style: solid;" >
                                                        <tr style="font-size: 14px;" >
                                                            <th style="border: 1px; border-color: #666666; border-style: solid;" class="tableRelatorio tableRelatorio2 text-center" colspan="7" style="text-align: center;"> SAÍDA(S) DE CONTAS A PAGAR</th>
                                                        </tr>
                                                    </thead>


                                                    <thead class="tableRelatorio tableRelatorio2">
                                                        <tr class="tableRelatorio tableRelatorio2" style="font-size: 14px;" >
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center; ">#</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">FORNECEDOR</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">VALOR</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">DATA</th>
                                                            <th class="tableRelatorio tableRelatorio2" style="text-align: center;">CATEGORIA</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach ($SaidaPag as $rowSaida): ?>

                                                            <tr class="tableRelatorio tableRelatorio2" >
                                                                <td  class="text-center tableRelatorio tableRelatorio2"><?php echo $cont++; ?></td>
                                                                <td  class="text-center tableRelatorio tableRelatorio2"><?php echo $rowSaida['for_tx_razao_social']; ?></td>
                                                                <td class="text-center tableRelatorio tableRelatorio2"><?php echo FormatarValor($rowSaida['cpr_db_valor']); ?></td>
                                                                <td class="tableRelatorio tableRelatorio2 text-center"> <?php echo FormatarData($rowSaida['cpr_dt_vencimento']); ?></td>
                                                                <td class="text-center tableRelatorio tableRelatorio2"><?php echo $rowSaida['cat_tx_descricao']; ?></td>

                                                            </tr>

                                                        <?php endforeach; ?>

                                                    </tbody>


                                                </table>





                                            <?php } ?>


                                            <table  width="100%" style="border:none !important; font-size: 10px"  class="display table table-striped  table-hover " id="example">

                                                <thead style="border: 1px; border-color: #666666; border-style: solid;" >
                                                    <tr style="font-size: 14px;" >
                                                        <th style="border: 1px; border-color: #666666; border-style: solid;" class="tableRelatorio tableRelatorio2 text-center" colspan="7" style="text-align: center;"> ENTRADA(S) OUTROS PAGAMENTOS</th>
                                                    </tr>
                                                </thead>


                                                <thead class="tableRelatorio tableRelatorio2">
                                                    <tr class="tableRelatorio tableRelatorio2" style="font-size: 14px;" >
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center; ">#</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">PRODUTO</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">VALOR</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">DATA</th>
                                                        <th class="tableRelatorio tableRelatorio2" style="text-align: center;">FORMA PAG</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php
                                                    foreach ($ListPagOutros as $rowOutrosPag):
                                                        ?>
                                                        <tr class="tableRelatorio tableRelatorio2" >
                                                            <td  class="text-center tableRelatorio tableRelatorio2"> <?php echo $cont++; ?></td>
                                                            <td  class="text-center tableRelatorio tableRelatorio2"><?php echo $rowOutrosPag['nome']; ?></td>
                                                            <td class="text-center tableRelatorio tableRelatorio2"><?php echo FormatarValor($rowOutrosPag['valor_pago']); ?></td>
                                                            <td class="tableRelatorio tableRelatorio2 text-center"> <?php echo FormatarData($rowOutrosPag['data_pagamento']); ?></td>
                                                            <td class="text-center tableRelatorio tableRelatorio2"> <?php
                                                                if ($rowOutrosPag['forma_pagamento'] == 1) {
                                                                    echo "DINHEIRO";
                                                                } else if ($rowOutrosPag['forma_pagamento'] == 2) {
                                                                    echo "C.CRÉDITO";
                                                                } else if ($rowOutrosPag['forma_pagamento'] == 3) {
                                                                    echo "C.DÉBITO";
                                                                }
                                                                ?></td>
                                                        </tr>

                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>


                            <hr/>
                            <div class="row">
                                <div class="col-lg-6 invoice-block pull-left">
                                    <ul style="text-align: left; font-size: 18px;" class="unstyled amounts">
                                        <li><strong>Total de Entradas (Alunos): </strong> <?php echo FormatarValor($Total['valor']) . " R$"; ?></li>
                                        <li><strong>Total de Entradas (Alunos): </strong> <?php echo " R$: " . FormatarValor($Total['valor']); ?></li>
                                        <li><strong>Total de Entradas (Outros): </strong> <?php echo " R$: " . FormatarValor($TotalOutrosPagamentos['total']); ?></li>
                                        <li><strong>Total de Contas a Receber: </strong> <?php echo " R$: " . FormatarValor($TotalPagAvulsos['valor']); ?></li>
                                        <li><strong>Total de Contas a Pagar: </strong>  <?php echo " R$: " . FormatarValor($TotalSaidaPag['valor']); ?></li>
                                        <hr/>
                                        <li><strong>Saldo Bruto: </strong> <?php echo " R$: " . FormatarValor($Total['valor'] + $TotalOutrosPagamentos['total'] + $TotalPagAvulsos['valor'] - $TotalSaidaPag['valor']); ?></li>
                                        <li><strong>Valor Descontos (Cielo):   </strong> <?php echo " R$: " . FormatarValor($totalDescontos) ?></li>
                                        <li><strong>Saldo Liquido:   </strong> <?php echo " R$: " . FormatarValor($totalLiquido + $TotalOutrosPagamentos['total'] + $TotalPagAvulsos['valor'] - $TotalSaidaPag['valor']); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px;" type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i> IMPRIMIR RELÁTORIO </button>
                        </div>
                    </div>



                </div>
            </div>
        </section>
        <!-- invoice end-->
    </section >
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
                "<html><head> <style>table{color:black;}</style> </head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>
