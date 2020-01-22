<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li><a href="<?php echo base_url(); ?>biblioteca/livro"><i class="fa fa-table"></i> LISTA DE LIVRO(S)</a></li>
                    <li class="active"><i class="fa fa-table"></i> LISTA DE EXEMPLAR(ES)</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA DE EXEMPLAR(ES)</h1>
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
                        <a href="<?php echo base_url(); ?>biblioteca/createExemplar/<?php echo $idExemplar; ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> NOVO EXEMPLAR</button>
                        </a>
                    </header>

                    <div class="panel-body">
                        <div class="adv-table" style="overflow-x: auto">

                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-center">COD</th>
                                        <th style="text-align: center;">Título</th>
                                        <th style="text-align: center;">Status</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($exemplares as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td style="text-align: center; width: 5%;">

                                                <?php
                                                if ($cont++ == 1) {
                                                    ?>
                                                    <span style="line-height: 21px;" class="label label-inverse">  <?php echo $row['livro_id']; ?></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span style="line-height: 21px;" class="label label-primary">  <?php echo $row['livro_id']; ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td> <?php echo $row['liv_tx_titulo']; ?></td>
                                            <td class="text-center"> 
                                                <?php
                                                if ($row['sl_nb_codigo'] == 2) {
                                                    ?>
                                                    <span style="line-height: 21px;" class="label label-danger"> EMPRESTADO</span>
                                                    <?php
                                                } else if ($row['sl_nb_codigo'] == 1 && $row['liv_tx_exemplar'] > 1) {
                                                    ?>
                                                    <span style="line-height: 21px;" class="label label-success"> DISPONÍVEL</span>
                                                    <?php
                                                }

                                                if ($row['liv_tx_exemplar'] == 1) {
                                                    ?>
                                                    <span style="line-height: 21px; width: 150px;" class="label label-warning"> CONS. LOCAL</span>
                                                    <?php
                                                }
                                                ?>

                                            </td>

                                            <td class="text-center" >
                                                <a href="<?php echo base_url(); ?>biblioteca/updateLivro/<?php echo $row['livro_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                                <a href="<?php echo base_url(); ?>biblioteca/ExcluirLivro/"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
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




