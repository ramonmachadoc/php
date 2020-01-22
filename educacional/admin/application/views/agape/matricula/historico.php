<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>"><i class="fa fa-table"></i> RECEBER PAGAMENTO ALUNO</a></li>
                    <li class="active"><i class="fa fa-share"></i> RECEBER PAGAMENTO</li>
                </ul>
                <!--breadcrumbs end -->
            </div>

        </div>


        <div class="row">



            <div class="col-lg-12">

                <div class="col-lg-4">
                    <!--widget start-->
                    <aside class="profile-nav alt blue-border">
                        <section class="panel">
                            <div class="user-heading alt blue-bg">
                                <a href="#">

                                    <?php
                                    $arquivo = "upload/aluno/" . $turma['cadastro_aluno_id'] . ".jpg";

                                    if (file_exists($arquivo)) {
                                        ?>
                                        <img src="<?php echo base_url(); ?>upload/aluno/<?php echo $turma['cadastro_aluno_id']; ?>.jpg" alt="">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo base_url(); ?>template/img/sem-imagem.png" alt="">
                                        <?php
                                    }
                                    ?>
                                </a>
                                <h6>
                                    <?php
                                    echo "<b>" . $turma['nome'] . "</b>";
                                    $temp = explode(" ", $turma['nome']);
//                                    echo $nomeNovo = $temp[0] . " " . $temp[count($temp) - 1];
                                    ?>
                                </h6>

                                </h1>
                                <h6>Curso: <?php echo $turma['cur_tx_descricao']; ?></h6>
                                <h6>Reg. Academico: <?php echo $turma['registro_academico']; ?></h6>
                                <h6>Periodo Atual: <?php echo $turma['periodoAtual']; ?></h6>
                                <h6> Bolsita? <?php echo $turma['SituacaoAluno']; ?></h6>


                            </div>

                            <!--                            <ul class="nav nav-pills nav-stacked">
                                                            <li class="active"><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-user"></i> Situação Financeira</a></li>
                                                            <li  ><a href="<?php echo base_url(); ?>ReceberPagamento/historicoFinanceiro/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-calendar"></i> Histórico Financeiro<span class="label label-danger pull-right r-activity"></span></a></li>
                                                            <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notificação para Aluno <span class="label label-warning pull-right r-activity">0</span></a></li>
                                                                                            <li><a href="javascript:;"> <i class="fa fa-calendar-o"></i> Outros Pagamentos <span class="label label-success pull-right r-activity">0</span></a></li>
                                                                                        </ul>-->

                        </section>
                    </aside>
                    <!--widget end-->

                </div>


                <aside class="profile-info col-lg-8">
                    <section class="panel">

                        <div class="panel-body" style="font-size: 14px;">

                            <?php
                            $dadosIngresso = $this->agape_model->PeriodLetivo($turma['matricula_aluno_id']);
                            $dadosMatriz = $this->agape_model->MatrizAtual($turma['matriz_id']);

                            if ($dadosIngresso['periodo_letivo_id']) {
                                $dadosPeriodo = $this->agape_model->PeriodAtual($dadosIngresso['periodo_letivo_id']);
                                $ano_igresso = $dadosPeriodo['periodo_letivo'];
                            } else {
                                $ano_igresso = $dadosIngresso['ano'] . '/' . $dadosIngresso['semestre'];
                            }
                            ?>

                            <div class="row" style="font-size: 15px;">




                                <div class="col-lg-12">



                                    <!--                                    <div class="panel">
                                                                            <div class="panel-body">
                                                                                <div class="bio-desk">
                                                                                    <p><b>NOME:</b> <?php echo $turma['nome']; ?></p>
                                                                                    <p><b>CURSO:</b> <?php echo $turma['cur_tx_descricao']; ?></p>
                                                                                    <p><b>REG.ACADEMICO:</b> <?php echo $turma['registro_academico']; ?></p>
                                                                                    <p><b>ANO INGRESSO:</b> <?php echo $ano_igresso; ?></p>
                                                                                    <p><b>FORMA DE INGRESSO:</b> <?php echo $turma['AlunoIngresso']; ?></p>
                                                                                    <p><b>MATRIZ ATUAL:</b> <?php echo $dadosMatriz['mat_tx_ano'] ?>/ <?php echo $dadosMatriz['mat_tx_semestre']; ?></p>
                                                                                    <p><b>PERIODO ATUAL:</b> <?php echo $turma['periodoAtual']; ?></p>
                                                                                    <p><b>DESPERIODIZADO?</b> <?php echo $turma['AlunoBolsista']; ?>  <b>BOLSITA?</b> <?php echo $turma['SituacaoAluno']; ?></p>
                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                </div>

                            </div>
                            <br/>
                            <br/>

                            <div class="col-lg-12 col-xs-12 col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <ul class="summary-list" style="font-size: 13px;">
                                            <li style="background-color: #eee;">
                                                <a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>">
                                                    <i class=" fa fa fa-share text-primary"></i>
                                                    Situação Aluno
                                                </a>
                                            </li>
                                            <li >
                                                <a href="<?php echo base_url(); ?>ReceberPagamento/historicoFinanceiro/<?php echo $turma['matricula_aluno_id']; ?>">
                                                    <i class="fa fa-user"></i>
                                                    Ficha Aluno
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>educacional/historico_aluno/<?php echo $turma['matricula_aluno_id']; ?>/">
                                                    <i class=" fa fa-money text-muted"></i>
                                                    Historico Aluno
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>Notificacao/notificacao/<?php echo $turma['matricula_aluno_id']; ?>">
                                                    <i class="fa fa-bell text-success"></i>
                                                    Situação Financeira
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>educacional/ficha_aluno_bolsa/<?php echo $turma['matricula_aluno_id']; ?>">
                                                    <i class="fa fa-print text-danger"></i>
                                                    Bolsa Financiamento
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </section>
                            </div>


                        </div>
                    </section>
                </aside>
            </div>


        </div>






        <aside class="profile-info col-lg-12">
            <section class="panel">
                <header class="panel-heading summary-head" style="height: 40px; line-height: 50px;">
                    <!-- <h4>DADOS ALUNO</h4>-->
                    <p></p>
                </header>


                <div  class="panel-body" style="font-size: 15px; margin-left: 30px;">


                    <div class="row" id="teste" >
                        <div style='width: 890px; height: auto; margin-left: 15px;'>


                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <h3>HISTÓRICO ESCOLAR - FACULDADE BOAS NOVAS</h3>
                                </div>
                            </div>
                            <br/>

                            <div class="row">
                                <table width="100%" border="0" class="table-advance">
                                    <tr>
                                        <td width="55%">

                                            <img width="100" height="100" style="margin-top: -25px; margin-left: 100px;" src="<?php echo base_url(); ?>template/img/brasao7.png"/></td>


                                        <td width="45%">
                                            <p> <b>Nome: </b><?php echo $turma['nome']; ?></p>
                                            <p> <b>Matrícula: </b>  <?php echo $turma['matricula_aluno_id']; ?></p>
                                            <b>Curso: </b>  <?php echo $turma['cur_tx_descricao']; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr/>


                            <div class="row" style="margin-left: 0px;">
                                <table class="table table-striped table-advance table-hover">
                                    <thead>
                                        <tr>
                                            <th>Período</th>
                                            <th>Código</th>
                                            <th>Disciplina</th>
                                            <th>C.H</th>
                                            <th>Crédito</th>
                                            <th>Notas</th>
                                            <th>Situação</th>

                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 11px;">

                                        <?php
                                        foreach ($historico as $rowHistorico):
                                            ?>
                                            <tr >
                                                <td>
                                                    <?php
                                                    if ($rowHistorico['periodo_letivo_id']) {

                                                        $periodo = $rowHistorico['periodoLetivo'];
                                                    } else {
                                                        $periodo = $rowHistorico['ano'] . "/" . $rowHistorico['semestre'];
                                                    }

                                                    echo $periodo;
                                                    ?>

                                                </td>
                                                <td class="hidden-phone"><?php echo $rowHistorico['matricula_aluno_turma_id']; ?></td>
                                                <td><?php echo $rowHistorico['disciplina']; ?> </td>
                                                <td><?php echo $rowHistorico['carga_horaria']; ?></td>
                                                <td><?php echo $rowHistorico['credito']; ?></td>
                                                <td>
                                                    <?php echo number_format($rowHistorico['media'], 2, ',', ' '); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($rowHistorico['situacao'] == '1') {
                                                        $situacao2 = 'AP';
                                                    } else if ($rowHistorico['situacao'] == '2') {
                                                        $situacao2 = 'RN';
                                                    } else if ($rowHistorico['situacao'] == '3') {
                                                        $situacao2 = 'RF';
                                                    } else if ($rowHistorico['situacao'] == '4') {
                                                        $situacao2 = 'RNF';
                                                    } else if ($rowHistorico['situacao'] == '0') {
                                                        $situacao2 = '--';
                                                    }
                                                    echo $situacao2;
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button onclick="printDiv('teste')"style="margin-top: -8px; margin-left: 15px;" type="button" class="btn btn-success btn-sm"><i class="fa fa-print"></i> IMPRIMIR HISTÓRICO </button>

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


