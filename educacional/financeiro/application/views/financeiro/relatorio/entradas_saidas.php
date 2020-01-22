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
                <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
            </td>

            <td style="border:none; text-align: center;">
                <div style="width: 500px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 25px; margin-top: -30px; margin-left: 50px;">RELATÓRIO DE FLUXO DE CAIXA</div>
                <div style="height: 27px; font-size: 14px;">PERÍODO : <b><?php echo FormatarData($dataInicio) ?></b> ATÉ <b><?php echo FormatarData($dataFim); ?></b> </div>
            </td>
        </tr>
    </table>

    <hr style="float: left; width: 890px;"/>
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
        <?php foreach ($contasPagar as $rowSaida): ?>
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



    <div class="title">CONTAS A RECEBER</div>
    <table width="100%">
        <tr  style="font-size: 14px;" >
            <th style="text-align: center; ">#</th>
            <th style="text-align: center;">NOME</th>
            <th style="text-align: center;">VALOR</th>
            <th style="text-align: center;">DATA</th>
            <th style="text-align: center;">PRODUTO</th>
        </tr>
        <?php foreach ($contasReceber as $rowPagAvulso): ?>
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


    <div>
        <ul style="text-align: left; font-size: 18px;">
            <li><strong>Total de Entradas (Outros): </strong> <?php echo FormatarValor($TotalOutrosPagamentos['total']); ?></li>
        </ul>   
    </div>

</div>





