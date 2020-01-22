<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE PROFESSOR(ES)</h1>
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
                        <a href="<?php echo base_url(); ?>professor/add"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> PROFESSOR</button>
                        </a>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Nascimento</th>
                                        <th>Login</th>
                                        <th class="text-center" style='width: 10%'>OPÇÕES</th>
                                        <th class="text-center" style='width: 10%'>STATUS</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $cont = 1;
                                    $cont2 = 1;
                                    $cont3 = 1;
                                    foreach ($professor as $rowProfessor):
                                        ?>
                                        <tr class="gradeU">
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $rowProfessor['nome']; ?></td>
                                            <td>
                                                <?php
                                                $data = explode('-', $rowProfessor['nascimento']);
                                                echo $data[2] . "/" . $data[1] . "/" . $data[0];
                                                ?>
                                            </td>
                                            <td><?php echo $rowProfessor['login']; ?></td>
                                            <td style='text-align: center;'>

                                                <a href='<?php echo base_url(); ?>professor/disciplinas/<?php echo $rowProfessor['professor_id']; ?>'><button type="button" class="btn btn-info btn-xs">
                                                        <i class="fa fa-table"></i> 
                                                        DISCIPLINAS
                                                    </button>
                                                </a>


                                            </td>

                                            <td style='text-align: center;'>

                                                <?php
                                                if ($rowProfessor['situacao'] == 'A') {
                                                    ?>
                                                    <button style="width: 80px;" type="button" class="btn btn-success btn-xs">ATIVO</button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button style="width: 80px;" type="button" class="btn btn-danger btn-xs">INATIVO</button>
                                                    <?php
                                                }
                                                ?>
                                            </td>


                                            <td class="center hidden-phone">
                                                <a href="<?php echo base_url(); ?>professor/edit/<?php echo $rowProfessor['professor_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>


                                                <?php
                                                if ($rowProfessor['situacao'] == 'A') {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>professor/ban/<?php echo $rowProfessor['professor_id']; ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-unlock "></i></button></a>

                                                    <?php
                                                } else
                                                if ($rowProfessor['situacao'] == 'I') {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>professor/unlock/<?php echo $rowProfessor['professor_id']; ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-lock "></i></button></a>

                                                    <?php
                                                }
                                                ?>



                                            </td>


                                        </tr>

                                    <div class="modal fade" id="myModal2<?php echo $cont2++; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Excluir Professor</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente excluir este Professor?
                                                </div>
                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                    <a href="<?php echo base_url(); ?>/professor/delete/<?php echo $rowProfessor['professor_id']; ?>"><button class="btn btn-warning" type="button"> Confirmar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

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

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
//            "aaSorting": [[4, "desc"]]
        });
    });
</script>
