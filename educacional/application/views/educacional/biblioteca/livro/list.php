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

                            <div class="col-lg-7">
                                <a href="<?php echo base_url(); ?>biblioteca/CreateLivro"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                        </span> LIVRO</button>
                                </a>
                            </div>

                            <div class="col-lg-5">
                                <?php echo form_open('biblioteca/search/', array('enctype' => 'multipart/form-data', 'id' => 'FormPesquisaCat')); ?>

                                <div class="input-group m-bot15 pull-right">
                                    <span class="input-group-btn">

                                        <select name="tipo" style="height: 34px;" class="btn btn-white">
                                            <option value="1">Autor</option>
                                            <option value="2">Título</option>
                                            <option value="3">Registro</option>
                                            <option value="4">Palavra-chave</option>
                                        </select>

                                    </span>
                                    <input value="<?php
                                    if (isset($nome)) {
                                        echo $nome;
                                    }
                                    ?>" name="nome" type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button style="height: 34px;" type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                    </span>
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
                                                <a href="<?php echo base_url(); ?>biblioteca/exemplares/<?php echo $row['livro_id']; ?>">
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

                            <!--                                 <li><a href="#">«</a></li>-->
                            <?php echo $pagination; ?>


                        </div>

                    </div>
                </section>


















<!--                <section class="panel">

                    <header class="panel-heading">
                        <a href="<?php echo base_url(); ?>biblioteca/CreateLivro"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> LIVRO</button>
                        </a>
                    </header>

                    <div class="panel-body">
                        <div class="adv-table" style="overflow-x: auto">

                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="text-align: center;">Título</th>
                                        <th style="text-align: center;">Autor(es)</th>
                                        <th style="text-align: center;">Categoria</th>
                                        <th style="text-align: center;">STATUS</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>

                                <tbody>

                <?php
                $cont = 1;
                foreach ($data_list as $row):
                    ?>

                                                                                                                    <tr class="gradeU">
                                                                                                                        <td style="text-align: center; width: 4%;"><?php echo $cont++; ?></td>
                                                                                                                        <td><?php echo $row['liv_tx_titulo']; ?></td>
                                                                                                                        <td style="">

                    <?php
                    $array = explode(',', $row['liv_tx_autor']);
                    foreach ($array as $valores) {
                        echo $valores . " ";
                    }
                    ?>
                                                                                                                        </td>

                                                                                                                        <td><?php //echo $row['nome'];                 ?></td>

                                                                                                                        <td class="text-center" style="width: 9%;">

                    <?php
                    if ($row['sl_nb_codigo'] == 1) {
                        ?>
                                                                                                                                                                                                            <button style="width: 100px;" type="button" class="btn btn-azul btn-sm">DISPONÍVEL</button>
                        <?php
                    } else if ($row['sl_nb_codigo'] == 0) {
                        ?>
                                                                                                                                                                                                            <button style="width: 100px;" type="button" class="btn btn-amarelo btn-sm">INDISPONIVEL</button>
                        <?php
                    }
                    ?>

                                                                                                                        </td>

                                                                                                                        <td class="text-center" >
                                                                                                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>

                                                                                                                            <a href="<?php echo base_url(); ?>biblioteca/ExcluirLivro/<?php echo $row['livro_id']; ?>"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>

                                                                                                                        </td>

                                                                                                                    </tr>

                    <?php
                endforeach;
                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>-->




            </div>
        </div>
        <!-- page end-->
    </section>
</section>
