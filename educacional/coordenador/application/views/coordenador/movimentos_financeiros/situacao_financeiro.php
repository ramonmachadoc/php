<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>"><i class="fa fa-search"></i> CONSULTAR DADOS ALUNO</a></li>
                    <li class="active"><i class="fa fa-search"></i> CONSULTAR DADOS</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <?php if ($this->session->flashdata('message') != ""): ?>

            <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <?php echo $this->session->flashdata('message'); ?>

            </div>
        <?php endif; ?>




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
                            $dadosIngresso = $this->coordenador_model->PeriodLetivo($turma['matricula_aluno_id']);
                            $dadosMatriz = $this->coordenador_model->MatrizAtual($turma['matriz_id']);

                            if ($dadosIngresso['periodo_letivo_id']) {
                                $dadosPeriodo = $this->coordenador_model->PeriodAtual($dadosIngresso['periodo_letivo_id']);
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
                                                    <i class=" fa fa fa-search text-primary"></i>
                                                    Consultar Dados
                                                </a>
                                            </li>
                                            <li >
                                                <a href="<?php echo base_url(); ?>ReceberPagamento/historicoFinanceiro/<?php echo $turma['matricula_aluno_id']; ?>">
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
                                                <a href="javascript:;">
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
                            $dadosIngresso = $this->coordenador_model->PeriodLetivo($turma['matricula_aluno_id']);
                            $dadosMatriz = $this->coordenador_model->MatrizAtual($turma['matriz_id']);

                            if ($dadosIngresso['periodo_letivo_id']) {
                                $dadosPeriodo = $this->coordenador_model->PeriodAtual($dadosIngresso['periodo_letivo_id']);
                                $ano_igresso = $dadosPeriodo['periodo_letivo'];
                            } else {
                                $ano_igresso = $dadosIngresso['ano'] . '/' . $dadosIngresso['semestre'];
                            }
                            ?>



                            <hr/>


                            <div class="row">
                                <div class="col-lg-12">
                                    <header class="panel-heading">
                                        <b>INFORMAÇÕES</b>
                                    </header>
                                </div>
                            </div>
                            <br/>
                            <?php
                            $dadosPeriodos = $this->coordenador_model->PeriodCoursed($turma['matricula_aluno_id'], 0);
                            ?>


                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <table class="table table-striped table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-calendar"></i> Período Letivo</th>
                                                    <th><i class="fa fa-users"></i> Turma</th>
                                                    <th><i class="fa fa-bookmark"></i> Período</th>
                                                    <th><i class=" fa fa-clock-o"></i> Turno</th>
                                                    <th><i class=" fa fa-user"></i> Situação</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $cont = 1;
                                                $cont2 = 1;
                                                foreach ($dadosPeriodos as $rowPeriod):


                                                    $periodo_letivo = $rowPeriod['periodo_letivo'];
                                                    if ($periodo_letivo) {
                                                        $periodo_letivo = $rowPeriod['periodo_letivo'];
                                                    } else {
                                                        $periodo_letivo = $rowPeriod['ano'] . '/' . $rowPeriod['semestre'];
                                                    }
                                                    $periodo = $rowPeriod['periodo'];
                                                    if ($periodo) {
                                                        $periodo2 = $rowPeriod['periodo'];
                                                    } else {
                                                        $periodo = $rowPeriod['periodo_mat'];
                                                    }

//                                                $dadosBolsa = $this->financeiro_model->CarregaBolsas($rowPeriod['matricula_aluno_turma_id']);
                                                    ?>
                                                    <tr>
                                                        <td class="hidden-phone"><?php echo $periodo_letivo; ?></td>
                                                        <td><?php echo $rowPeriod['tur_tx_descricao']; ?></td>
                                                        <td><?php echo $periodo; ?> </td>
                                                        <td><?php echo $rowPeriod['turno'] ?></td>
                                                        <td><?php echo $rowPeriod['situacao_aluno']; ?> </td>
                                                    </tr>


                                                    <?php
                                                endforeach;
                                                ?>


                                            </tbody>
                                        </table>
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
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>




