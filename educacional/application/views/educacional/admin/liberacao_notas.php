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


                                    <?php
                                    $cont = 1;
                                    foreach ($disciplinas as $row):
                                        ?>

                                        <tr class="gradeU">
                                            <td style="text-align: center; width: 4%;"><?php echo $cont++; ?></td>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td class="text-center"><?php echo $row['periodo_letivo_id']; ?></td>

                                            <td class="text-center" >

                                                <?php
                                                if ($datePrazo['1bim'] < date('Y-m-d')) {
                                                    $liberacao = $this->educacional_model->GetWhereRow('liberacao_prazo', 'professor_disciplina_turma_id', $row['pdt_nb_codigo'], 'tipo_liberacao', 1, 'liberacao_prazo_id');
                                                    if ($liberacao['data_prazo'] < date('Y-m-d')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>adm/LiberacaoNotas/liberacao/1/<?php echo $row['pdt_nb_codigo'] ?>"><button type="button" class="btn btn-danger btn-xs">1 BIM</button></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-xs">1 BIM</button>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-xs">1 BIM</button>
                                                    <?php
                                                }
                                                ?>



                                                <?php
                                                if ($datePrazo['2bim'] < date('Y-m-d')) {
                                                    $liberacao = $this->educacional_model->GetWhereRow('liberacao_prazo', 'professor_disciplina_turma_id', $row['pdt_nb_codigo'], 'tipo_liberacao', 2, 'liberacao_prazo_id');
                                                    if ($liberacao['data_prazo'] < date('Y-m-d')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>adm/LiberacaoNotas/liberacao/2/<?php echo $row['pdt_nb_codigo'] ?>"><button type="button" class="btn btn-danger btn-xs">2 BIM</button></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-xs">2 BIM</button>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-xs">2 BIM</button>
                                                    <?php
                                                }
                                                ?>



                                                <?php
                                                if ($datePrazo['3bim'] < date('Y-m-d')) {
                                                    $liberacao = $this->educacional_model->GetWhereRow('liberacao_prazo', 'professor_disciplina_turma_id', $row['pdt_nb_codigo'], 'tipo_liberacao', 3, 'liberacao_prazo_id');
                                                    if ($liberacao['data_prazo'] < date('Y-m-d')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>adm/LiberacaoNotas/liberacao/3/<?php echo $row['pdt_nb_codigo'] ?>"><button type="button" class="btn btn-danger btn-xs">3 BIM</button></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-xs">3 BIM</button>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-xs">3 BIM</button>
                                                    <?php
                                                }
                                                ?>

                                                <button type="button" class="btn btn-info btn-xs">P.E</button>

                                                                                                    <!--<a href="<?php echo base_url(); ?>biblioteca/updateCategoria/"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>-->
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




