<!DOCTYPE html>

<html lang="pt-br">
<head>
    <title> Histórico Escolar</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=base_url('template/css/bootstrap.min.css')?>" >
    <link rel="stylesheet" type="text/css" href="<?=base_url('template/css/style_historico.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('template/css/botao_imprimir.css')?>" media="print">
</head>

<body>
  <?php
  if($historico['nacionalidade'] == 1 or $historico['nacionalidade'] == 0){
      $nac = "Brasileiro(a)";
  }elseif($historico['nacionalidade'] == 2){
      $nac = "Brasileiro(a) nascido no exterior";
  }else{
    $nac = "Estrangeiro(a)";
  }?>
  <div class="container bloco ">
    <div id="printHist" >
        <table class="table table-bordered table-condensed">
        <tbody>
            <tr bgcolor="#c6d9f1">
                <td colspan="10" class="text-center"><label for=""><strong>HISTÓRICO ESCOLAR</strong></label></td>
            </tr>

            <!-- Bloco Identificação -->
            <tr class="" >
              <td colspan="10" class="text-center"><label for=""><strong>IDENTIFICAÇÃO</strong></label></td>
            </tr>
            <tr >
                <td width="10%"><label for="nome">Nome:</label></td>
                <td colspan="10" ><?php echo $historico['nomealuno']; ?></td>
            </tr>
            <!-- Fim Bloco Identificação -->

            <!-- Bloco Nascimento -->
            <tr  >
                <td colspan="10" class="text-center"><label for=""><strong>NASCIMENTO</strong></label></td>
            </tr>
            <tr >
                <td ><label for="nome">Data: </label></td>
                <td colspan="1" align="left"><?php echo $historico['dtnasc']; ?></td>

                <td colspan="0"><label for="nome">Nacionalidade: </label></td>
                <td align="left" class="text-left" colspan="8" ><?php echo $nac ; ?></td>

            </tr>
            <tr >
                <td ><label for="nome">Cidade: </label></td>
                <td  align="left"><?php echo $historico['municipio']; ?></td>

                <td><label for="nome">UF: </label></td>
                <td align="left" class="text-left" colspan="8" ><?php echo $historico['nomeuf']; ?></td>
            </tr>
            <!-- Fim Bloco Nascimento -->

            <!-- Bloco Documentação -->
            <tr bgcolor="#c6d9f1">
                <td colspan="10" class="text-center"><label for=""><strong>DOCUMENTAÇÃO</strong></label></td>
            </tr>

            <tr class="" >
                <td colspan="3" class="text-center"><label for=""><strong>CÉDULA DE IDENTIDADE</strong></label></td>
                <td colspan="4" class="text-center"><label for=""><strong>CERTIFICADO MILITAR</strong></label></td>
                <td colspan="3" class="text-center"><label for=""><strong>TÍTULO DE ELEITOR</strong></label></td>
            </tr>

            <tr class="" >
                <td colspan="" class="text-center">DATA</td>
                <td colspan="" class="text-center">ÓRGÃO</td>
                <td colspan="" class="text-center">UF</td>
                <td colspan="" class="text-center">DATA</td>
                <td colspan="" class="text-center">CAT.</td>
                <td colspan="" class="text-center">CSM</td>
                <td colspan="" class="text-center">REG</td>
                <td colspan="" class="text-center">DATA</td>
                <td colspan="" class="text-center">ZONA</td>
                <td colspan="" class="text-center">MUN.</td>

            </tr>

            <tr class="" ><!-- Local de Inserção -->
                  <td colspan="" class="text-center">N/A</td>
                <td colspan="" class="text-center"><?php echo $historico['rgexped']; ?></td>
                <td colspan="" class="text-center"><?php echo $historico['rguf']; ?></td>
                <td colspan="" class="text-center">N/A</td>
                <td colspan="" class="text-center">N/A</td>
                <td colspan="" class="text-center">N/A</td>
                <td colspan="" class="text-center">N/A</td>
                <td colspan="" class="text-center">N/A</td>
                <td colspan="" class="text-center">N/A</td>
                <td colspan="" class="text-center">N/A</td>
            </tr>
            <tr >
                <td ><label for="nome">Nº: </label></td>
                <td colspan="2" align="left"><?php echo $historico['rgaluno']; ?></td>
                <td colspan="0"><label for="nome">Nº: </label></td>
                <td align="left" class="text-left" colspan="3" ><?php echo $historico['certres'] ; ?></td>
                <td colspan="0"><label for="nome">Nº: </label></td>
                <td align="left" class="text-left" colspan="3" >N/A</td>
                <!--<td align="left" class="text-left" colspan="3" ><?php echo $historico['titulo']; ?></td>-->
            </tr>
            <!-- Fim Bloco Documentação -->

            <!-- Bloco Ensino Médio -->
            <tr bgcolor="#c6d9f1" >
                <td colspan="10" class="text-center"><label for=""><strong>ENSINO MÉDIO</strong></label></td>
            </tr>
            <tr >
            <td colspan="1"><label for="nome">Instituição: </label></td>
                <td colspan="3" align="left">N/A</td>

                <td colspan="1"><label for="nome">Cidade/UF: </label></td>
                <td colspan="3" align="left" class="text-left">N/A</td>
                <td colspan="1"><label for="nome">Ano: </label></td>
                <td align="left" class="text-left" colspan="2" >N/A</td>
            </tr>
            <!-- Fim Bloco Ensino Médio -->

            <!-- Bloco Processo Seletivo -->
            <tr bgcolor="#c6d9f1" >
                <td colspan="10" class="text-center"><label for=""><strong>PROCESSO SELETIVO</strong></label></td>
            </tr>

            <tr >
                <td colspan="1"><label for="nome">Instituição: </label></td>
                <td colspan="2" align="left">N/A</td>

                <td colspan="1"><label for="nome">Cidade/UF: </label></td>
                <td colspan="6" align="left" class="text-left">N/A</td>

            </tr>

            <tr >
                <td colspan="1"><label for="nome">Pontos: </label></td>
                <td colspan="2" align="left">N/A</td>

                <td colspan="1"><label for="nome">Classificação: </label></td>
                <td colspan="2" align="left" class="text-left">N/A</td>
                <td colspan="1"><label for="nome">Mês/Ano: </label></td>
                <td colspan="4" align="left" class="text-left">N/A</td>
            </tr>
            <!-- Fim Bloco Ensino Médio -->

            <!-- Bloco Curso -->
            <tr bgcolor="#c6d9f1">
                <td colspan="10" class="text-center"><label for=""><strong>CURSO</strong></label></td>
            </tr>

            <tr >
                <td colspan="10">
                    <p><strong>Graduação em <u><?php echo $historico['curdesc']; ?></u>
                        <p>Renovação de Reconhecimento pela Portaria MEC Nº 267 de 03/04/2017, publicada no DOU de 04/04/2017</p></strong>
                    </p>
                </td>
            </tr>
            <!-- Fim Bloco Curso -->
        </tbody>
    </table>
    <hr>

    <!-- Tabela Componentes Curriculares-->
    <table class="table  table-bordered table-condensed ">
        <thead class="" >
            <tr class="">
                <th width="1%" class="text-center">ANO</th>
                <th width="1%" class="text-center">SEM.</th>
                <th width="5%" class="text-center">COMPONENTES CURRICULARES CURSADOS</th>
                <th width="1%" class="text-center">C. HORÁRIA</th>
                <th width="1%" class="text-center">MÉDIA FINAL</th>
                <th width="1%" class="text-center">RESULTADO</th>

            </tr>
        </thead>
        <tbody>

            <!-- td's que serão preenchidos dinamicamentes -->
            <?php
              $total = 0;
              $contador = 0;
              $coe = 0;
            ?>
            <?php foreach ($cursos as $cursos_item): ?>
            <tr>

              <?php
                $situacao;
                if(number_format($cursos_item['mediafinal'],2) > 0){
                $total += $cursos_item['chor'];
                $contador++;
                $coe += $cursos_item['mediafinal'];
                  if(number_format($cursos_item['mediafinal'],2) >= 7){
                    $situacao = 'Aprovado';
                  }else{
                    $situacao = 'Reprovado';
                  }
                }
                if(number_format($cursos_item['mediafinal'],2) == 0){
                  $situacao = 'Cursando';
                }
               ?>

                <td><?php echo substr($cursos_item['discano'],0,4); ?></td>
                <td><?php echo $cursos_item['discsem']; ?></td>
                <td><?php echo $cursos_item['disctex']; ?></td>
                <td><?php echo $cursos_item['chor']; ?></td>
                <td><?php echo number_format($cursos_item['mediafinal'],2); ?></td>
                <td><?php echo $situacao; ?></td>

            </tr>
          <?php endforeach; ?>
            <tr>
                <td colspan="3" class="text-center"><label>TOTAL</label></td>
                <td colspan="1" class="text-center"><strong><?php echo $total; ?></strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"><label>COEFICIENTE  DE  RENDIMENTO  ESCOLAR</label></td>
                <td colspan="3" class="text-center"><strong><?php echo number_format($coe / $contador,2); ?></strong></td>
            </tr>


        </tbody>
    </table>
    <!-- Fim Tabela -->

    <table class="table table-bordered table-condensed">
        <tbody>

            <!-- Bloco Enade -->
            <tr bgcolor="#c6d9f1">
                <td colspan="10" class="text-center"><label for=""><strong>ENADE</strong></label></td>
            </tr>
            <tr >
                <td colspan="10">
                    <p>
                        <strong>Estudante dispensado de acordo com a Portaria Normativa 40, de 12 de dezembro de 2007, Art. 33 - G §2º</strong>

                    </p>
                </td>
            </tr>
            <!--  Fim Bloco Enade -->


            <!-- Bloco Datas-->
            <tr bgcolor="#c6d9f1" >
                <td colspan="10" class="text-center"><label for=""><strong>DATAS</strong></label></td>
            </tr>

            <tr class="" >
                <td colspan="2" class="text-center">CONCLUSÃO DO CURSO</td>
                <td colspan="2" class="text-center">PREVISÃO DA COLAÇÃO DE GRAU</td>
                <td colspan="2" class="text-center">EXPEDIÇÃO DO DIPLOMA</td>
                <td colspan="4" class="text-center">EXPEDIÇÃO DO HISTÓRICO</td>


            </tr>
            <?php
                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                $qntdPer = $historico['curdur'] - $historico['peratu'];
                $nconclusao = $qntdPer * 6;
                $ngrau = $qntdPer * 6;
                $periodo1 = (new DateTime($periodo['data_prev_termino']));
                $conclusao = $periodo1->add(new DateInterval('P'.$nconclusao.'M'))->format('d/m/Y');
                $periodo1 = (new DateTime($periodo['data_prev_termino']));
                $grau = $periodo1->add(new DateInterval('P'.$ngrau.'M'))->format('d/m/Y');
                $grau = $periodo1->add(new DateInterval('P2M'))->format('d/m/Y');
             ?>
            <tr class="" >
                <td colspan="2" class="text-center"><?php echo $conclusao; ?></td>
                <td colspan="2" class="text-center"><?php echo $grau; ?></td>
                <td colspan="2" class="text-center">.......</td>
                <td colspan="4" class="text-center">.......</td>

            </tr>
            <!-- Fim Bloco Datas -->


            <!-- Bloco Autenticação -->
            <tr bgcolor="#c6d9f1" >
                <td colspan="10" class="text-center"><label for=""><strong>AUTENTICAÇÃO</strong></label></td>
            </tr>

            <tr class="" >
                <td colspan="2" class="text-center">SECRETÁRIA</td>
                <td colspan="2" class="text-center">COODERNADOR(A)</td>
                <td colspan="6" class="text-center">DIRETOR GERAL</td>
            </tr>
            <tr >

                <td colspan="2" class="text-center">
                    <p><br>_____________________________ </p>
                    <p class="fonte-assinatura">Elda Maria de Lima Reis</p>
                </td>

                <td colspan="2" class="text-center">
                    <p><br>_____________________________ </p>
                    <p class="fonte-assinatura"><?php echo $historico['coord']; ?><p>
                </td>

                <td colspan="6" class="text-center">
                    <p><br>_____________________________ </p>
                    <p class="fonte-assinatura">Maria José Costa Lima</p>
                </td>
            </tr>
            <!-- Fim Bloco Autenticação -->
        </tbody>
    </table>

</div>
    <div class="row imprimir">
        <hr>
            <input type="button" class="btn btn-default btn-lg imprimir text-center" value="Imprimir" onclick="printDiv('printHist')"/>
        <hr>
    </div>
    <script type="text/javascript">
    function printDiv(divName)
    {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
   window.print();
    document.body.innerHTML = originalContents;
   }
    </script>
</div>

</body>

<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
