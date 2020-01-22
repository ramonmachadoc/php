<head>
    <style>

        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }
        tr:nth-child(odd) {
            background-color: #fff;
        }      

        .title{
            width: 100%; 
            font-weight: bold;
            height: 10px;
            background-color: #cccccc;
            border: 1px solid black; 
            padding: 10px;
            text-align: center;
            font-size: 13px;
        }


        .centerTd {
            text-align: center;
        }



    </style>
</head>



<div style='width: 890px; height: auto;'>
    <table  style=" border: none !important;" style="font-size: 15px;">
        <tr>
            <td style="border:none">
                <img width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
            </td>

            <td style="border:none; text-align: center;">
                <div style="width: 500px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 25px; margin-top: -30px; margin-left: 50px;">RELATÓRIO DE FLUXO DE CAIXA</div>
                <div style="height: 27px; font-size: 14px;">PERÍODO : <b><?php echo FormatarData($dataInicio) ?></b> ATÉ <b><?php echo FormatarData($dataFim); ?></b> </div>
            </td>
        </tr>
    </table>

    <hr style="float: left; width: 890px;"/>
    <div class="title">ENTRADA(S) PAGAMENTOS ALUNOS</div> 
    <table width="100%">
        <tr style="font-size: 14px;" >
            <th  style="text-align: center; ">#</th>
            <th  style="text-align: center;">DATA</th>
            <th  style="text-align: center;">CURSO</th>
            <th  style="text-align: center; width: 250px;">NOME</th>
            <th  style="text-align: center; width: 150px;">TURMA</th>
            <th  style="text-align: center; width: 80px;">VALOR B</th>
            <th  style="text-align: center; width: 80px">VALOR L</th>
            <th  style="text-align: center;">TIPO PAG</th>
            <th  style="text-align: center;">PRODUTO</th>
        </tr>
        <?php
        $cont = 1;
        foreach ($ListPagamentos as $row):

            $qtdParcelas = $this->financeiro_model->isVarExists('movimento_financeiro', $row['mensalidade_id'], 'mensalidades_id');
            if ($qtdParcelas == 1 && $row['mf_nb_forma_pagamento'] == 2) {
                $taxa = $row['data_entrada'] >= '2018-05-05' ? 2.70  : 3;
            } else if ($qtdParcelas == 1 && $row['mf_nb_forma_pagamento'] == 3) {
                $taxa = $row['data_entrada'] >= '2018-05-05' ? 2.10 : 2.5;
            } else if ($qtdParcelas > 1 && $qtdParcelas < 7 && $row['mf_nb_forma_pagamento'] == 2) {
                $taxa = $row['data_entrada'] >= '2018-05-05' ? 3.77  :  4;
            } else if ($qtdParcelas > 6 && $qtdParcelas <= 12 && $row['mf_nb_forma_pagamento'] == 2) {
                $taxa = 4.5;
            } else {
                $taxa = 0;
            }


            $totalDescontos = $totalDescontos + ($row['mf_db_valor'] / 100) * $taxa;
            $totalLiquido = $totalLiquido + $row['mf_db_valor'] - ($row['mf_db_valor'] / 100) * $taxa
            ?>
            <tr style="font-size: 10px;">
                <td><?php echo $cont++; ?></td>
                <td class="centerTd"> <?php echo FormatarData($row['mf_dt_pgto']); ?></td>
                <td class="centerTd"><?php echo $row['curso']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td class="centerTd"><?php echo $row['turma']; ?></td>
                <td class="centerTd"><?php echo FormatarValor($row['mf_db_valor']); ?></td>
                <td class="centerTd"><?php echo FormatarValor($row['mf_db_valor'] - ($row['mf_db_valor'] / 100) * $taxa) ?></td>
                <td class="centerTd"><?php
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
 
    </table>
    <hr/>


    <div class="title">CONTAS A RECEBER</div>
    <table width="100%">
        <tr  style="font-size: 14px;" >
            <th style="text-align: center; ">#</th>
            <th style="text-align: center;">NOME</th>
            <th style="text-align: center;">VALOR</th>
            <th style="text-align: center;">DATA</th>
            <th style="text-align: center;">PRODUTO</th>
        </tr>
<?php foreach ($ListPagAvulsos as $rowPagAvulso): ?>
            <tr>
                <td class="centerTd"><?php echo $cont++; ?></td>
                <td><?php echo $rowPagAvulso['cliente']; ?></td>
                <td class="centerTd"><?php echo FormatarValor($rowPagAvulso['cpr_db_valor']); ?></td>
                <td class="centerTd" > <?php echo FormatarData($rowPagAvulso['cpr_dt_vencimento']); ?></td>
                <td class="centerTd"><?php echo $rowPagAvulso['cpr_tx_historico']; ?></td>

            </tr>
<?php endforeach;
?>
    </table>
    <hr/>



    <div class="title">ENTRADA(S) OUTROS PAGAMENTOS</div>
    <table width="100%">
        <tr style="font-size: 14px;" >
            <th style="text-align: center; width: 40px;">#</th>
            <th style="text-align: center;">PRODUTO</th>
            <th style="text-align: center;">VALOR</th>
            <th style="text-align: center; width: 100px;">DATA</th>
            <th style="text-align: center; width: 130px;">FORMA PAG</th>
        </tr>
<?php
foreach ($ListPagOutros as $rowOutrosPag):
    ?>
            <tr >
                <td style="text-align: center;"><?php echo $cont++; ?></td>
                <td><?php echo $rowOutrosPag['nome']; ?></td>
                <td style="text-align: center;"><?php echo FormatarValor($rowOutrosPag['valor_pago']); ?></td>
                <td style="text-align: center;"> <?php echo FormatarData($rowOutrosPag['data_pagamento']); ?></td>
                <td style="text-align: center;"> <?php
        if ($rowOutrosPag['forma_pagamento'] == 1) {
            echo "DINHEIRO";
        } else if ($rowOutrosPag['forma_pagamento'] == 2) {
            echo "C.CRÉDITO";
        } else if ($rowOutrosPag['forma_pagamento'] == 3) {
            echo "C.DÉBITO";
        }
    ?>
                </td>
            </tr>

    <?php
endforeach;
?>
    </table>
    <hr/>


    <div class="title">SAÍDAS(S) CONTAS A PAGAR</div>
    <table width="100%">
        <tr  style="font-size: 14px;" >
            <th style="text-align: center; ">#</th>
            <th style="text-align: center;">FORNECEDOR</th>
            <th style="text-align: center;">VALOR</th>
            <th style="text-align: center;">DATA</th>
            <th style="text-align: center;">CATEGORIA</th>
            <th style="text-align: center;">OBS</th>
        </tr>
<?php foreach ($SaidaPag as $rowSaida): ?>
            <tr>
                <td class="centerTd"><?php echo $cont++; ?></td>
                <td class="centerTd" ><?php echo $rowSaida['for_tx_razao_social']; ?></td>
                <td class="centerTd"><?php echo FormatarValor($rowSaida['cpr_db_valor']); ?></td>
                <td class="centerTd"> <?php echo FormatarData($rowSaida['cpr_dt_vencimento']); ?></td>
                <td class="centerTd" ><?php echo $rowSaida['cat_tx_descricao']; ?></td>
                <td class="centerTd" ><?php echo $rowSaida['cpr_tx_historico']; ?></td>
            </tr>
<?php endforeach;
?>
    </table>
    <hr/>


    <div>
        <ul style="text-align: left; font-size: 18px;">
            <li><strong>Total de Entradas (Alunos): </strong> <?php echo " R$: " . FormatarValor($Total['valor']); ?></li>
            <li><strong>Total de Entradas (Outros): </strong> <?php echo " R$: " . FormatarValor($TotalOutrosPagamentos['total']); ?></li>
            <li><strong>Total de Contas a Receber: </strong> <?php echo " R$: " . FormatarValor($TotalPagAvulsos['valor']); ?></li>
            <li><strong>Total de Contas a Pagar: </strong>  <?php echo " R$: " . FormatarValor($TotalSaidaPag['valor']); ?></li>
            <hr/>
            <li><strong>Saldo Bruto: </strong> <?php echo " R$: " . FormatarValor($Total['valor'] + $TotalOutrosPagamentos['total'] + $TotalPagAvulsos['valor'] - $TotalSaidaPag['valor']); ?></li>
            <li><strong>Valor Descontos (Cielo):   </strong> <?php  echo " R$: ". FormatarValor($totalDescontos) ?></li>
            <li><strong>Saldo Liquido:   </strong> <?php echo " R$: " . FormatarValor($totalLiquido + $TotalOutrosPagamentos['total'] + $TotalPagAvulsos['valor'] - $TotalSaidaPag['valor']); ?></li>
        </ul>   
    </div>

</div>





