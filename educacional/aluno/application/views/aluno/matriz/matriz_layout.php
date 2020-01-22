<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=base_url('template/css/bootstrap.min.css')?>" >
    <link rel="stylesheet" type="text/css" href="<?=base_url('template/css/style_historico.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('template/css/botao_imprimir.css')?>" media="print">
    <div class="container bloco">
<div id="printMat" >
    <div class="row">
        <div class="col-lg-12 text-center">
            <p><strong><u><span>CURSO </span><?php echo $curso['cur_tx_descricao']; ?></u>
            <p>Renovação de Reconhecimento pela Portaria MEC Nº 267 de <br> 03/04/2017, publicada no DOU de 04/04/2017
            <p><u>MATRIZ CURRICULAR</u></strong></p></p></p>
        </div>
    </div>
    <hr>

    <table class="table  table-bordered table-condensed ">
        <thead class="" >
            <tr bgcolor="#c6d9f1" >
                <th width="1%" class="text-center">SEMESTRE</th>
                <th width="5%" class="text-center">COMPONENTES CURRICULARES CURSADOS</th>
                <th width="1%" class="text-center">CARGA HORÁRIA</th>
            </tr>
        </thead>

        <tbody>
          <?php
            $contador = 0;
           ?>
          <?php foreach ($matriz as $matriz_item): ?>
            <tr>
              <?php
                  $contador += $matriz_item['discarhor'];
               ?>
                <td class="text-center"><?php echo $matriz_item['disper']; ?></td>
                <td class=""><?php echo $matriz_item['disdesc']; ?></td>
                <td class="text-center"><?php echo $matriz_item['discarhor']; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" class="text-center"><label> &emsp;CARGA HORÁRIA TOTAL</label></td>
                <td colspan="1" class="text-center"><strong><?php echo $contador; ?></strong></td>
            </tr>


        </tbody>
    </table>
    <div>
      <hr>
        <h3>Validação: <?php echo $validacao ?></h3>
      </hr>
    </div>
</div>
    <div class="row imprimir">
        <hr>
            <input type="button" class="btn btn-default btn-lg imprimir text-center" value="Imprimir" onclick="PrintElem('#printMat')"/>
        <hr>
    </div>
    <script type="text/javascript">
    function PrintElem(elem)
{
      Popup($('<div/>').append($(elem).clone()).html());
}

function Popup(data)
{
    var mywindow = window.open('', 'Histórico', 'height=400,width=600');
    mywindow.document.write('<html><head><title></title>');
     mywindow.document.write('<link rel="stylesheet" href="http://www.dynamicdrive.com/ddincludes/mainstyle.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.print();
    mywindow.close();

    return true;
}
    </script>
</div>

<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</div>
</section>
</section>
