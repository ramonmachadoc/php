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
    <div class="title">ENTRADA(S) OUTROS PAGAMENTOS</div>


    <table width="100%" style="font-size: 15px" >
        <tr style="font-size: 14px;" >
            <th style="text-align: center; ">#</th>
            <th style="text-align: center;">PRODUTO</th>
            <th style="text-align: center;">VALOR</th>
            <th style="text-align: center; width: 100px;">DATA</th>
            <th style="text-align: center; width: 130px;">FORMA PAG</th>
        </tr>
        <?php
        $cont = 1;
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


    <div>
        <ul style="text-align: left; font-size: 18px;">
            <li><strong>Total de Entradas (Outros): </strong> <?php echo FormatarValor($TotalOutrosPagamentos['total']); ?></li>
        </ul>   
    </div>

</div>





