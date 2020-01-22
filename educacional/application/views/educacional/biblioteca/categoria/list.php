<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li class="active"><i class="fa fa-table"></i> LISTA DE CATEGORIA(S)</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA DE CATEGORIA(S)</h1>
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
                        <a href="<?php echo base_url(); ?>biblioteca/CreateCategoria"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> CATEGORIA</button>
                        </a>
                    </header>

                    <div class="panel-body">
                        <div class="adv-table" style="overflow-x: auto">

                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="text-align: center;">Categoria</th>

                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($categorias as $row):
                                        ?>

                                        <tr class="gradeU">
                                            <td style="text-align: center; width: 4%;"><?php echo $cont++; ?></td>
                                            <td><?php echo $row['nome']; ?></td>


                                            <td class="text-center" >

                                                <a href="<?php echo base_url(); ?>biblioteca/updateCategoria/<?php echo $row['categoria_livro_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
    <!--                                                <a href="<?php echo base_url(); ?>biblioteca/ExcluirLivro/"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>-->



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




