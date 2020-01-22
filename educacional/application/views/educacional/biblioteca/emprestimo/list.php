<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li class="active"><i class="fa fa-table"></i> LISTA DE EMPRESTIMO(S)</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA DE EMPRESTIMO(S)</h1>
        <hr style="border: 1px solid #333;">
        <div class="divider"></div>
        <div class="divider"></div>

        <!-- page start-->
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


                <section class="panel">

                    <header class="panel-heading">
                        <a href="<?php echo base_url(); ?>biblioteca/CreateEmprestimo"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> EMPRESTIMO</button>
                        </a>
                    </header>

                    <div class="panel-body">
                        <div class="adv-table" style="overflow-x: auto">

                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-align: center;">Nome</th>
                                        <th class="text-center">Livro(s) Emprestado(s)</th>
                                        <th class="text-center">Dt Emprestimo</th>
                                        <th class="text-center">Dt Prev Dev</th>
                                        <th class="text-center">Dias atraso</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($emprestimos as $row):
                                        $dias  = getWorkingDays($row['le_dt_prev_dev'], date('Y-m-d'));
                                        ?>
                                        <tr class="gradeU 
                                        <?php
                                        if ($dias-1 > 0) {
                                            echo "danger";
                                        }
                                        ?>
                                            ">
                                            <td><?php echo $cont++; ?></td>
                                            <td class="text-center"><?php echo $row['nome']; ?></td>
                                            <td ><?php echo $row['livroId'] . " - " . $row['liv_tx_titulo']; ?></td>
                                            <td class="text-center"><?php echo FormatarData($row['le_dt_emprestimo']); ?></td>
                                            <td class="text-center"><?php echo FormatarData($row['le_dt_prev_dev']); ?></td>
                                            <td class="text-center"><?php
                                                if ($dias <= 0) {
                                                    echo "0";
                                                } else {
                                                    echo $dias -1;
                                                }
                                                ?></td>

                                            <td></td>
                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>




