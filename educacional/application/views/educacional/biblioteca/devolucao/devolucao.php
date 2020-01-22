<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-table"></i> LISTA DE DEVOLUCÕES</a></li>
                    <li class="active"><i class="fa fa-table"></i> DEVOLUÇÕES</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h1 style="font-weight: 300;"><span class="fa fa-user"></span> <?php echo $dataStudent['nome']; ?> </h1>
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


                <div class="row">
                    <div class="col-lg-12" id="load_paginacao">
                        <?php echo form_open('biblioteca/devolutionBooks/' . $student_id, array('enctype' => 'multipart/form-data')); ?>
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
                                                        if ($row['le_nb_status'] == 2) {
                                                            if (date('Y-m-d') > $row['le_dt_prev_dev']) {
                                                                ?>
                                                                <span style="line-height: 21px;" class="label label-warning label-mini">EM ATRASO</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span style="line-height: 21px;" class="label label-success label-mini">SEM ATRASO</span>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <span style="line-height: 21px;" class="label label-default label-mini">DEVOLVIDO</span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url(); ?>biblioteca/deleteEmprestimo/<?php echo $row['livro_emprestimo_id']; ?>/<?php echo $row['mat_nb_codigo']; ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
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
                                    DEVOLVER
                                </button>
                            </div>
                        </section>
                        <?php echo form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- page end-->
    </section>
</section>




