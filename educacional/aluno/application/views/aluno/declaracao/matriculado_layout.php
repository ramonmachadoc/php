<section id="main-content">
    <section class="wrapper">

    <div class="col-lg-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=base_url('template/css/bootstrap.css')?>" >
    <link rel="stylesheet" type="text/css" href="<?=base_url('template/css/style_declaracao.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('template/css/botao_imprimir.css')?>" media="print">

    <div class="container bloco-declaracao ">

<div id="printDec" >
        <div class="row">
            <h3 class="text-center" id="titulo"> <b>DECLARAÇÃO DE MATRÍCULA</b> </h3>
            <p class="paragrafo">Declaramos, para os devidos fins, que <span style="font-weight:600"><?php echo $declaracao['nomealuno']?></span>
              , CPF <?php echo $declaracao['cpf']?>, RG <?php echo $declaracao['rg']?>, está <span style="font-weight: 600">regularmente matriculado</span> no curso
              <span style="font-weight: 600"><?php echo $declaracao['curso_descricao']?></span> no <span style="font-weight: 600"><?php echo $declaracao['per_atual']?>º
              </span> Período, no turno
              <span style="font-weight: 600"><?php echo $declaracao['turno']?></span> desta Instituição de Ensino, com a matrícula
              <spam style="font-weight: 600"><?php echo $declaracao['registro_academico']?></spam>, no corrente ano e período <?php echo $periodo['periodo_letivo_descricao']; ?></p>
        </div>

        <div class="row bloco-data">
                <?php
                  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                  date_default_timezone_set('America/Sao_Paulo');
                  $hoje = strftime(' %d de %B de %Y', strtotime('today'));
                  $validade = date('d/m/Y', strtotime('+1 months'));
                 ?>
                <p class="text-right">Manaus, <?php echo $hoje; ?> </p><br><br>
                <p class="text-right">Assinatura</p>
                <p class="text-right">Secretária</p>
        </div>

        <div class="row bloco-rodape">
            <p class="text-center ">
                <span style="font-weight: 600"><br><?php echo $inst['nome_instituicao']; ?></span><br>
                <span style="font-weight: 600">Endereço:</span><br>
                <span style="font-weight: 600"><?php echo $inst['endereco']; ?></span><br>
                <span style="font-weight: 600">Manaus - AM - Brasil</span><br>
                <span style="font-weight: 600">Contato: <?php echo $inst['contato']; ?></span><br>
                <span style="font-weight: 600">Site: <?php echo $inst['site']; ?></span><br>
                <span style="font-weight: 600">Validade: <?php echo $validade; ?></span><br>
            </p>
        </div>
        <div>
          <hr>
            <h3>Validação: <?php echo $validacao ?></h3>
          </hr>
        </div>
</div>
        <div class="row imprimir">
            <hr>
                <input type="button" class="btn btn-default btn-lg imprimir text-center" value="Imprimir" onclick="printDiv('printDec')"/>
            <hr>
        </div>

    </div>
    <script type="text/javascript">
    function printDiv(divName)
    {
      var printContents = "<html><head><link rel=\"stylesheet\" href=\"<?=base_url('template/css/bootstrap.css')?>\" ><link rel=\"stylesheet\" type=\"text/css\" href=\"<?=base_url('template/css/style_declaracao.css')?>\"></head><body>"+
    document.getElementById(divName).innerHTML + "\n</body>\n</html>";

    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    }
    </script>

      <script src="js/jquery-1.8.3.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </div>
  </section>
</section>
