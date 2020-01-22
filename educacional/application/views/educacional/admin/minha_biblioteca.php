<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li class="active"><i class="fa fa-table"></i> LISTA DE LIBERAÇÃO DE NOTA (S)</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> Lista de Liberação</h1>
        <hr style="border: 1px solid #999999;">
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
                        <a href="<?php echo base_url(); ?>biblioteca/CreateCategoria"><button class="btn btn-azul_2"><span class="glyphicon glyphicon-calendar">
                                </span> Configurar datas</button>
                        </a>
                    </header>

                    <div class="panel-body">
                        <div class="adv-table" style="overflow-x: auto">

                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="text-align: center;">Professor</th>
                                        <th style="text-align: center;">Disciplina</th>
                                        <th style="text-align: center;">Turma</th>
                                        <th style="text-align: center;">Período Letivo</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr class="gradeU">
                                        <td style="text-align: center; width: 4%;">dadasd</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"><button type="button" class="btn btn-info btn-xs">P.E</button> </td>
                                    </tr>


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




