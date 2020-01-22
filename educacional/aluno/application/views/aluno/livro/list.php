<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>

                    <li class="active"><i class="fa fa-table"></i> LISTA DE LIVROS</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA DE LIVRO(S)</h1>
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

                        <div class="row">

                            <div class="col-lg-9">

                            </div>

                            <div class="col-lg-3">
                                <?php echo form_open('livro/search/', array('enctype' => 'multipart/form-data', 'id' => 'FormPesquisaCat')); ?>

                                <div class="input-group m-bot15 pull-right">
                                    <span class="input-group-btn">
                                        <button style="height: 34px;" type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                    </span>
                                    <input value="<?php
                                    if (isset($nome)) {
                                        echo $nome;
                                    }
                                    ?>" name="nome" type="text" class="form-control">
                                </div>

                                <?php echo form_close(); ?>

                            </div>
                        </div>
                    </header>

                    <div class="panel-body">

                        <section id="flip-scroll">
                            <table class="table table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                    <tr>
                                        <th class="text-center">COD</th>
                                        <th>Título</th>
                                        <th>Autor</th>
                                        <th>Categoria</th>
                                        <th>Palavra(s) chave</th>
                                        <th class="text-center">Exemplares</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($data_list as $row):
                                        ?>

                                        <tr>
                                            <td style="width: 4%; text-align: center;"><?php echo $row['livro_id']; ?></td>
                                            <td><?php echo $row['liv_tx_titulo']; ?></td>
                                            <td><?php echo $row['liv_tx_autor']; ?></td>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td>

                                                <?php
                                                $array = explode(',', $row['palavra_chave']);
                                                foreach ($array as $valores) {

                                                    if ($valores <> "") {
                                                        ?>
                                                        <button class="btn btn-sm btn-green btn-xs ladda-button" data-style="expand-right" data-size="xs">
                                                            <span class="ladda-label"><?php echo $valores; ?></span>
                                                            <span class="ladda-spinner"></span>
                                                        </button>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <a href="#">
                                                    <span style="line-height: 21px;" class="label label-inverse" data-placement="top" data-toggle="tooltip" data-original-title="Exemplares"><?php echo $row['quantidade']; ?></span>
                                                </a>

                                            </td>


                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>

                                </tbody>
                            </table>
                        </section>



                        <div>

                            <label class="pull-left">Total de Registros: <?php echo $total; ?></label>
                            <?php echo $pagination; ?>

                        </div>
                    </div>
                </section>


    </section>




</div>
</div>
<!-- page end-->
</section>
</section>
