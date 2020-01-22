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
                                                <a href="<?php echo base_url(); ?>OutrosPagamentos/outros/<?php echo $turma['matricula_aluno_id']; ?>/">
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


            <div class="col-lg-12">
                <aside class="profile-info col-lg-12">
                    <section class="panel">

                        <div class="panel-body" style="font-size: 15px;">

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



                            <hr/>



                            <div class="row">
                                <div class="col-lg-12">
                                    <header class="panel-heading">
                                        <button style="margin-top: -8px;" type="button" class="btn btn-success btn-sm" data-toggle="modal" href="#myModald">ADICIONAR BOLSA </button>
                                    </header>
                                </div>
                            </div>
                            <br/>


                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <table class="table table-striped table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-users"></i> Descrição da Bolsa</th>
                                                    <th><i class="fa fa-calendar"></i> Período Letivo</th>
                                                    <th> % da Bolsa</th>
                                                    <th>AÇÕES</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                foreach ($bolsa as $row_bolsa):
                                                    $periodo = $row_bolsa['periodo'];
                                                    if ($periodo) {
                                                        $periodo2 = $row_bolsa['periodo'];
                                                    } else {
                                                        $periodo = $row_bolsa['periodo_mat'];
                                                    }
                                                    if ($periodo2 == 1) {
                                                        $periodo = 'I';
                                                    } else if ($periodo2 == 2) {
                                                        $periodo = 'II';
                                                    } else if ($periodo2 == 3) {
                                                        $periodo = 'III';
                                                    } else if ($periodo2 == 4) {
                                                        $periodo = 'IV';
                                                    } else if ($periodo2 == 5) {
                                                        $periodo = 'V';
                                                    } else if ($periodo2 == 6) {
                                                        $periodo = 'VI';
                                                    } else if ($periodo2 == 7) {
                                                        $periodo = 'VII';
                                                    } else if ($periodo2 == 8) {
                                                        $periodo = 'VIII';
                                                    } else if ($periodo2 == 9) {
                                                        $periodo = 'IX';
                                                    } else if ($periodo2 == 10) {
                                                        $periodo = 'X';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row_bolsa['bolsa']; ?></td>
                                                        <td class="hidden-phone"><?php
                                                            echo "Turma: " . $row_bolsa['tur_tx_descricao'] . " (" . $row_bolsa['periodo_letivo'] . ") ";
                                                            echo $periodo . " " . $row_bolsa['descricao'];
                                                            ?></td>
                                                        <td> <?php echo $row_bolsa['porcentagem_bolsa']; ?></td>

                                                        <td>
                                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                                        </td>
                                                        
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            </div>
                        </div>


                        <?php echo form_open('educacional/ficha_aluno_bolsa/do_create/' . $turma['matricula_aluno_id'], array('class' => 'form-vertical validatable', 'id' => 'FormBolsas')); ?>
                        <div class="modal fade" id="myModald" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> CADASTRAR BOLSAS</strong></div>
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <section class="panel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <?php
                                                                $dadosPeriodo = $this->agape_model->PeriodCoursed($turma['matricula_aluno_id'], 1);
                                                                ?>
                                                                <div class="form-group">
                                                                    <label>Período Letivo</label>

                                                                    <select required="required" name="matricula_aluno_turma_id_bolsa" class="form-control">
                                                                        <option value="">Selecione o Periodo</option>
                                                                        <?php
                                                                        foreach ($dadosPeriodo as $rowPeLetv):

                                                                            $matricula_aluno_turma_id = $rowPeLetv['matricula_aluno_turma_id'];
                                                                            if ($rowPeLetv['periodo_letivo']) {
                                                                                $periodo_letivo = $rowPeLetv['periodo_letivo'];
                                                                            } else {
                                                                                $periodo_letivo = $rowPeLetv['ano'] . '/' . $rowPeLetv['semestre'];
                                                                            }
                                                                            $periodo = $rowPeLetv['periodo'];
                                                                            if ($periodo) {
                                                                                $periodo2 = $rowPeLetv['periodo'];
                                                                            } else {
                                                                                $periodo = $rowPeLetv['periodo_mat'];
                                                                            }
                                                                            ?>
                                                                            <option value="<?php echo $matricula_aluno_turma_id; ?>">Turma: <?php echo $rowPeLetv['tur_tx_descricao']; ?> <?php echo ' ('; ?> <?php echo $periodo_letivo; ?><?php echo ')'; ?> <?php echo $periodo; ?> <?php echo ' - '; ?> <?php echo $rowPeLetv['turno']; ?></option>

                                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Bolsas</label>

                                                                    <select required="required" name="bolsas_periodo_vinculo" class="form-control" >
                                                                        <option value="">Selecione a Bolsa</option>
                                                                        <?php
                                                                        foreach ($bolsas as $row):
                                                                            ?>
                                                                            <option value="<?php echo $row['bolsa_periodo_id']; ?>"><?php echo $row['descricao']; ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Porcentagem</label>
                                                                    <input required="required" name="porcentagem" type="text" class="form-control"/> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                        <button class="btn btn-success" type="submit">Salvar Bolsa</button>
                                    </div>

                                </div>
                            </div>

                            <?php echo form_close(); ?>

                            <br/>
                        </div>

                    </section>
                </aside>

            </div>
        </div>

        <br/>

    </section>
</section>

<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>