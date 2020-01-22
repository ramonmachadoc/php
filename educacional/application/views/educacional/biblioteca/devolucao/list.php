<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li class="active"><i class="fa fa-table"></i> LISTA DE DEVOLUCÕES</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA DE DEVOLUCÕES</h1>
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

                    <div class="panel-body">
                        <div class="adv-table" style="overflow-x: auto">

                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-align: center;">Nome</th>
                                        <th class="text-center">Livro(s) Emprestado(s)</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    foreach ($emprestimos as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td></td>
                                            <td class="text-center"><?php echo $row['nome']; ?></td>
                                            <td >
                                                <?php
                                                $arrayLivro = $this->educacional_model->livrosEmprestimos($row['mat_nb_codigo']);

                                                foreach ($arrayLivro as $rowLivro):
                                                    ?>
                                                    <span ><i class=" fa fa-angle-right"></i> <?php echo "<b>" . $rowLivro['livro_id'] . "</b> - " . $rowLivro['liv_tx_titulo']; ?></span><br/>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url(); ?>biblioteca/viewDevolucao/<?php echo $row['mat_nb_codigo']; ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button></a>
                                            </td>
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




