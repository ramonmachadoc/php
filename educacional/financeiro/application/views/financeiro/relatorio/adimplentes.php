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
                <div style="width: 500px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 28px; margin-top: -30px; margin-left: 50px;">Relatório de Fluxo de Caixa</div>
              
            </td>
        </tr>
    </table>

    <hr style="float: left; width: 890px;"/>
    <div class="title">Alunos Adimplentes Mês: <?php echo $mes; ?></div>
    <table width="100%">
        <tr  style="font-size: 14px;" >
            <th style="text-align: center; ">#</th>
            <th style="text-align: center;">NOME</th>
            <th style="text-align: center;">TURMA</th>
            <th style="text-align: center;">CURSO</th>
            <th style="text-align: center;">VALOR</th>
        </tr>
        <?php foreach ($ListPagamentos as $row): 
            $total = $total + $row['mf_db_valor'];
            ?>
            <tr>
                <td class="centerTd"><?php echo $cont++; ?></td>
                <td class="centerTd"><?php echo $row['nome'] ?></td>
                <td class="centerTd"><?php echo $row['tur_tx_descricao'] ?></td>
                <td class="centerTd"><?php echo $row['cur_tx_descricao'] ?></td>
                <td class="centerTd"><?php echo FormatarValor($row['mf_db_valor']); ?></td>

            </tr>
        <?php endforeach;
        ?>
    </table>
    <hr/>

    <div>
        <ul style="text-align: left; font-size: 18px;">
            <li><strong>Total de Pagamentos Adimplentes: </strong> <?php echo " R$: ".FormatarValor($total) ?> </li>
        </ul>   
    </div>

</div>





