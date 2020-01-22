<section id="main-content">
    <section class="wrapper">



        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>"><i class="fa fa-table"></i> RECEBER PAGAMENTO ALUNO</a></li>
                    <li class="active"><i class="fa fa-calendar"></i> HISTÓRICO FINANCEIRO</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <?php if ($this->session->flashdata('message') != ""): ?>

                    <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <?php echo $this->session->flashdata('message'); ?>

                    </div>
                <?php endif; ?>




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
                            $dadosIngresso = $this->financeiro_model->PeriodLetivo($turma['matricula_aluno_id']);
                            $dadosMatriz = $this->financeiro_model->MatrizAtual($turma['matriz_id']);

                            if ($dadosIngresso['periodo_letivo_id']) {
                                $dadosPeriodo = $this->financeiro_model->PeriodAtual($dadosIngresso['periodo_letivo_id']);
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
                                            <li>
                                                <a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>">
                                                    <i class=" fa fa fa-share text-primary"></i>
                                                    Receber Pagamento
                                                </a>
                                            </li>
                                            <li style="background-color: #eee;">
                                                <a href="javascript:;">
                                                    <i class="fa fa-calendar text-info"></i>
                                                    Histórico Financeiro
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>OutrosPagamentos/outros/<?php echo $turma['matricula_aluno_id']; ?>/">
                                                    <i class=" fa fa-money text-muted"></i>
                                                    Outros Pagamentos
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>Notificacao/notificacao/<?php echo $turma['matricula_aluno_id']; ?>">
                                                    <i class="fa fa-bell text-success"></i>
                                                    Notificação
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="<?php echo base_url(); ?>Relatorio/geral/<?php echo $turma['matricula_aluno_id']; ?>">
                                                    <i class="fa fa-print text-danger"></i>
                                                    Relátorio Individual
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






            <div class="col-lg-12">
                <aside class="profile-info col-lg-12">
                    <section class="panel">

                        <div class="panel-body" style="font-size: 15px;">

                            <?php
                            $dadosIngresso = $this->financeiro_model->PeriodLetivo($turma['matricula_aluno_id']);
                            $dadosMatriz = $this->financeiro_model->MatrizAtual($turma['matriz_id']);

                            if ($dadosIngresso['periodo_letivo_id']) {
                                $dadosPeriodo = $this->financeiro_model->PeriodAtual($dadosIngresso['periodo_letivo_id']);
                                $ano_igresso = $dadosPeriodo['periodo_letivo'];
                            } else {
                                $ano_igresso = $dadosIngresso['ano'] . '/' . $dadosIngresso['semestre'];
                            }
                            ?>

                            <div class="row">
                                <div class="col-lg-12">
                                    <header class="panel-heading">
                                        <b>HISTÓRICO DE PAGAMENTOS DO ALUNO</b>
                                    </header>
                                </div>
                            </div>
                            <br/>
                            <?php
                            $dadosPeriodos = $this->financeiro_model->PeriodCoursed($turma['matricula_aluno_id'], 0);
                            ?>


                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <div class="adv-table" style="overflow-x: auto">
                                            <table  class="display table table-bordered table-striped" id="example" style="font-size: 13px;">
                                                <thead >
                                                    <tr >
                                                        <th>ID</th>
                                                        <th class="text-center">P. Letv </th>
                                                        <th class="text-center">Parc</th>
                                                        <th class="text-center">Dt Vcto</th>
                                                        <th class="text-center">Dt Pgto</th>
                                                        <th class="text-center">Referente</th>

                                                        <th class="text-center">Vl Pagar</th>
                                                        <th class="text-center">(-)Bolsa</th>
                                                        <th class="text-center">(-)Desc</th>
                                                        <th class="text-center">(+)Multa</th>
                                                        <th class="text-center">(+)Juros</th>
                                                        <th class="text-center">Vl Pago</th>
                                                        <th class="text-center">Vl Pend</th>
                                                        <th class="text-center">Situação</th>
                                                        <th class="text-center">AÇÕES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $contador = 1;
                                                    $cont2 = 1;
                                                    $cont4 = 1;
                                                    $cont3 = 1;
                                                    $cont = 1;
                                                    ?>

                                                    <?php
                                                    foreach ($historicoPagamentos as $rowPagamentos):
                                                        ?>
                                                        <tr class="gradeU">
                                                            <td style="width: 4%; text-align: center;"><?php echo $contador++; ?></td>
                                                            <td class="text-center"> 
                                                                <?php
                                                                if ($rowPagamentos['periodo_letivo_id']) {
                                                                    $periodo_letivo_m = $rowPagamentos['periodo_letivo_id'];
                                                                } else {
                                                                    $periodo_letivo_m = $rowPagamentos['periodo_letivo_turma'];
                                                                }

                                                                echo $periodo_letivo_m;
                                                                ?>


                                                            </td>
                                                            <td class="text-center"> <?php echo $rowPagamentos['men_nb_numero_parcela']; ?><?php if ($rowPagamentos['total_parcela']) { ?>/<?php } echo $rowPagamentos['total_parcela']; ?></td>
                                                            <td class="text-center"> 
                                                                <?php
                                                                if (isset($rowPagamentos['men_dt_vencto'])) {

                                                                    echo FormatarData($rowPagamentos['men_dt_vencto']);
                                                                }
                                                                ?>
                                                            </td>

                                                            <td class="text-center" style="width: 8%;"> 

                                                                <?php
                                                                if ($rowPagamentos['data_entrada'] == "0000-00-00") {

                                                                    if (isset($rowPagamentos['mf_dt_pgto'])) {
                                                                        echo FormatarData($rowPagamentos['mf_dt_pgto']);
                                                                    }
                                                                } else {

                                                                    if (isset($rowPagamentos['data_entrada'])) {
                                                                        echo FormatarData($rowPagamentos['data_entrada']);
                                                                    }
                                                                }
                                                                ?>
                                                            </td>

                                                            <td class="text-center"><?php echo $rowPagamentos['produto']; ?></td>

                                                            <td class="text-center"><?php echo number_format($rowPagamentos['men_fl_valor'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['bolsa'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['mf_db_desconto'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['multa'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['mf_db_juros'], 2, ',', ' '); ?></td>
                                                            <td class="text-center"><?php echo number_format($rowPagamentos['mf_db_valor'], 2, ',', ' '); ?></td>
                                                            <td class="text-center">



                                                                <?php
                                                                echo number_format($rowPagamentos['men_fl_valor'] + $rowPagamentos['multa'] - $rowPagamentos['bolsa'] - $rowPagamentos['mf_db_desconto'] - $rowPagamentos['mf_db_valor'], 2, ',', ' ');
                                                                ?>

                                                            </td>
                                                            <td class="text-center" style="width: 8%" > 

                                                                <?php
                                                                if ($rowPagamentos['status_mensalidade'] == 1) {
                                                                    ?>
                                                                    <button style="width: 60px;" type="button" class="btn btn-success btn-xs">Pago</button>

                                                                    <?php
                                                                } else if ($rowPagamentos['status_mensalidade'] == 0) {
                                                                    ?> <button style="width: 60px;" type="button" class="btn btn-danger btn-xs">Aberto</button>
                                                                    <?php
                                                                } else if ($rowPagamentos['status_mensalidade'] == 3) {

                                                                    $pendente = $rowPagamentos['men_fl_valor'] - $rowPagamentos['bolsa'] - $rowPagamentos['mf_db_desconto'] - $rowPagamentos['mf_db_valor'];

                                                                    if ($pendente == '0') {
                                                                        ?>

                                                                        <button style="width: 60px;" type="button" class="btn btn-success btn-xs">Pago</button>
                                                                        <?php
                                                                    } else {
                                                                        ?>

                                                                        <button style="width: 60px;" type="button" class="btn btn-info btn-xs"> Parcial</button>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center hidden-phone" style="width: 13%;">

                                                                <?php
                                                                if ($rowPagamentos['status_mensalidade'] == 1) {
                                                                    ?>
                                                                    <a style="color: #797979;" title="Cancelar Pagamento" href="<?php echo base_url(); ?>ReceberPagamento/cancelar/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>">
                                                                        <button class="btn btn-white">
                                                                            <i class="fa fa-ban text-danger"></i>
                                                                        </button>
                                                                    </a>

                                                                    <?php if ($rowPagamentos['mf_nb_codigo']) {
                                                                        ?>
                                                                        <a title="Imprimir Pagamento" target="_blank" style="color: #797979;" href="<?php echo base_url(); ?>ReceberPagamento/reciboImpressao/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['matricula_aluno_turma_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>/<?php echo $rowPagamentos['mf_nb_codigo']; ?>">
                                                                            <button class="btn btn-white">
                                                                                <i class="fa fa-print text-success"></i>
                                                                            </button>
                                                                        </a>
                                                                    <?php }
                                                                    ?>



                                                                    <?php
                                                                } else if ($rowPagamentos['status_mensalidade'] == 0) {
                                                                    ?>
                                                                    <a title="Efeturar Pagamento" target="_blank" style="color: #797979;" href="<?php echo base_url(); ?>ReceberPagamento/efetuarPagamento/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['matricula_aluno_turma_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>/<?php echo $rowPagamentos['mf_nb_codigo']; ?>">
                                                                        <button class="btn btn-white">
                                                                            <i class="fa fa-money text-primary"></i>
                                                                        </button>
                                                                    </a>



                                                                    <a title="Excluir Pagamento" style="color: #797979;"  href="<?php echo base_url(); ?>ReceberPagamento/delete/<?php echo $rowPagamentos['mensalidade_id']; ?>/<?php echo $turma['matricula_aluno_id']; ?>">
                                                                        <button class="btn btn-white">
                                                                            <i class="fa fa-trash-o text-danger"></i>
                                                                        </button>
                                                                    </a>

                                                                    <?php
                                                                } else
                                                                if ($rowPagamentos['status_mensalidade'] == 3) {

                                                                    $pendente = $rowPagamentos['men_fl_valor'] - $rowPagamentos['bolsa'] - $rowPagamentos['mf_db_desconto'] - $rowPagamentos['mf_db_valor'];


                                                                    if ($pendente == '0') {
                                                                        ?>

                                                                        <a style="color: #797979;" title="Cancelar Pagamento" href="<?php echo base_url(); ?>ReceberPagamento/cancelar/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>">
                                                                            <button class="btn btn-white">
                                                                                <i class="fa fa-ban text-danger"></i>
                                                                            </button>
                                                                        </a>

                                                                        <a title="Imprimir Pagamento" target="_blank" style="color: #797979;" href="<?php echo base_url(); ?>ReceberPagamento/reciboImpressao/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['matricula_aluno_turma_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>/<?php echo $rowPagamentos['mf_nb_codigo']; ?>">
                                                                            <button class="btn btn-white">
                                                                                <i class="fa fa-print text-success"></i>
                                                                            </button>
                                                                        </a>




                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a title="Efeturar Pagamento" target="_blank" style="color: #797979;" href="<?php echo base_url(); ?>ReceberPagamento/efetuarPagamento/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['matricula_aluno_turma_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>/<?php echo $rowPagamentos['mf_nb_codigo']; ?>">
                                                                            <button class="btn btn-white">
                                                                                <i class="fa fa-money text-primary"></i>
                                                                            </button>
                                                                        </a>


                                                                        <a title="Imprimir Pagamento" target="_blank" style="color: #797979;" href="<?php echo base_url(); ?>ReceberPagamento/reciboImpressao/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['matricula_aluno_turma_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>/<?php echo $rowPagamentos['mf_nb_codigo']; ?>">
                                                                            <button class="btn btn-white">
                                                                                <i class="fa fa-print text-success"></i>
                                                                            </button>
                                                                        </a>


                                                                        <a style="color: #797979;" title="Cancelar Pagamento" href="<?php echo base_url(); ?>ReceberPagamento/cancelar/<?php echo $turma['matricula_aluno_id']; ?>/<?php echo $rowPagamentos['mensalidade_id']; ?>">
                                                                            <button class="btn btn-white">
                                                                                <i class="fa fa-ban text-danger"></i>
                                                                            </button>
                                                                        </a>

                                                                        <?php
                                                                    }
                                                                    ?>


                                                                    <?php
                                                                }
                                                                ?>
                                                        </tr>

                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>

                                        </div>

                                    </section>
                                </div>
                            </div>
                            <br/>
                        </div>

                    </section>
                </aside>
            </div>
        </div>
    </section>
</section>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
//            "aaSorting": [[4, "desc"]]
        });
    });
</script>


