<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/"><i class="fa fa-table"></i> RECEBER PAGAMENTO ALUNO</a></li>
                    <li class="active"><i class="fa fa-share"></i> RECEBER PAGAMENTO</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="row">

            <div class="col-lg-12">

                <div class="row">


                    <div class="col-lg-5">


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
                                        ?>
                                    </h6>

                                    </h1>
                                    <h6>Curso: <?php echo $turma['cur_tx_descricao']; ?></h6>
                                    <h6>Reg. Academico: <?php echo $turma['registro_academico']; ?></h6>
                                    <h6>Periodo Atual: <?php echo $turma['periodoAtual']; ?></h6>
                                    <h6> Bolsita? <?php echo $turma['SituacaoAluno']; ?></h6>


                                </div>


                            </section>
                        </aside>
                        <!--widget end-->

                    </div>

                    <aside class="profile-info col-lg-7">

                        <section class="panel">
                            <div class="panel-heading"><strong><span class="glyphicon glyphicon-book"></span> EMPRESTIMO(S) LIVRO(S) </strong></div>
                            <div class="panel-body" style="padding: 4px">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <section class="panel">

                                            <div class="panel-body" >
                                                
                                                <?php
                                                
                                               
                                                if ($turma['periodoAtual'] == 7 || $turma['periodoAtual'] == 8) {
                                                    $diasUteis = somar_dias_uteis(date('d/m/Y'), 5);
                                                } else {
                                                    $diasUteis = somar_dias_uteis(date('d/m/Y'), 3);
                                                }
                                                ?>

                                                <?php echo form_open('biblioteca/emprestarLivro', array('enctype' => 'multipart/form-data', 'id' => 'FormAddLivro')); ?>

                                                <input type="hidden" name="matricula_id" value="<?php echo $matricula_id; ?>"/>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Dt Empréstimo</label>
                                                            <input type="text" name="dt_emprestimo" id="aluno_busca" class="form-control" value="<?php echo date('d/m/Y'); ?>"/>
                                                        </div>
                                                    </div> 

                                                    <div class="col-lg-3">
                                                        <div class="form-group" id="load_turma">
                                                            <label>Dt Devolução</label>
                                                            <input type="text" name="dt_devolucao"  value="<?php echo $diasUteis;?>" id="aluno_busca" class="form-control">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4">
                                                        <div style="margin-top: 23px;" class="input-group m-bot15">
                                                            <span class="input-group-btn">

                                                                <button class="btn btn-white" type="button"><b>COD:</b>
                                                                </button>
                                                            </span>
                                                            <input name="livro_id" type="text" class="form-control">
                                                        </div>
                                                    </div>


                                                    <div  style="margin-top: 23px;" class="col-lg-2"> 
                                                        <br/>
                                                        <button style="margin-top: -16px;"  class="btn btn-info"><span class="glyphicon glyphicon-plus"> </span></button>
                                                    </div>

                                                </div>

                                                <?php echo form_close(); ?>




                                            </div>

                                        </section>
                                    </div>

                                </div>

                            </div>
                        </section>

                    </aside>

                </div>

            </div>
        </div>

        <br/>
        <div class="divider"></div>



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


                <div class="row">
                    <div class="col-lg-12" id="load_paginacao">
                        <?php echo form_open('biblioteca/lendBooks/' . $student_id, array('enctype' => 'multipart/form-data')); ?>

                        <section class="panel">
                            <header class="panel-heading">
                                LISTA DE LIVRO(S) EMPRESTADO(S)
                            </header>
                            <div class="panel-body">
                                <section id="unseen">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Livro</th>
                                                <th class="text-center">Dt Empréstimo</th>
                                                <th class="text-center">Dt Prev Devolução</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">Ações</th>
                                                <th class="text-center">Selecionar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = 1;
                                            foreach ($emprestimos as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $cont++; ?></td>
                                                    <td><?php echo $row['liv_tx_titulo']; ?></td>
                                                    <td class="text-center"><?php echo FormatarData($row['le_dt_emprestimo']); ?></td>
                                                    <td class="text-center"><?php echo FormatarData($row['le_dt_prev_dev']); ?></td>

                                                    <td class="text-center">
                                                        <?php
                                                        if ($row['le_nb_status'] == 0) {
                                                            ?>
                                                            <span style="line-height: 21px;" class="label label-warning label-mini">ABERTO</span>
                                                            <?php
                                                        } else if ($row['le_nb_status'] == 2) {
                                                            ?>
                                                            <span style="line-height: 21px;" class="label label-danger label-mini">EMPRESTADO</span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url(); ?>biblioteca/deleteEmprestimo/<?php echo $row['livro_emprestimo_id']; ?>/<?php echo $row['mat_nb_codigo']; ?>/<?php echo $row['livro_id']; ?>"><span class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></span></a>
                                                    </td>

                                                    <td class="text-center">
                                                        <input type="checkbox" name="loans[]" value="<?php echo $row['livro_emprestimo_id']; ?>">
                                                    </td>

                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </section>

                                <button class="btn btn-success btn-sm pull-right" type="submit">
                                    <i class="fa fa-check"></i>
                                    EMPRESTAR
                                </button>

                            </div>
                        </section>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>


