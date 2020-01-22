<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> LISTA MINHAS DISCIPLINAS</h1>
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
                                        <th>ID</th>
                                        <th style="text-align: center;">P. Letivo</th>
                                        <th style="text-align: center;">Turma</th>
                                        <th style="text-align: center;">Período</th>
                                        <th style="text-align: center;">Disciplina</th>
                                        <th>Professor</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $matricula = $this->aluno_model->getTableRow('matricula_aluno', 'registro_academico', 'registro_academico', $this->session->userdata('login'));
                                    $disciplinas = $this->aluno_model->GetMatriculaTurma($matricula['matricula_aluno_id']);
                                    $contador = 1;
                                                                                                     
                                    
                                    foreach ($disciplinas as $disRow):
                                        
                                 

                                        $minhas_disciplinas = $this->aluno_model->GetMinhasDisciplinas($disRow['matricula_aluno_turma_id']);

                                        foreach ($minhas_disciplinas as $row):
                                            ?>
                                            <tr class="gradeU">
                                                <td style="text-align: center;"><?php echo $contador++; ?></td>
                                                <td style="text-align: center; width: 8%;"><?php echo $disRow['periodo_letivo'];  ?></td>
                                                <td style=""><?php  echo $disRow['tur_tx_descricao'];  ?></td>
                                                <td style="width: 5%; text-align: center;"><?php echo $disRow['periodo_id'] . "º";  ?></td>
                                                <td ><?php echo $row['disciplina'];  ?></td>
                                                <td>

                                                    <?php
                                                    $Professor = $this->aluno_model->nomeProfessor($disRow['turma_id'], $row['disciplina_id']);
                                                    echo $Professor['nome'];
                                                    ?>
                                                </td>

                                                <td class="center hidden-phone">

                                                    <a target="_blank" href="<?php echo base_url(); ?>minhas_disciplinas/PlanoEnsino/<?php echo $Professor['pdt_id'];  ?>">
                                                        <button type="button" style="background-color: #4682B4;" class="btn btn-default btn-sm "><i class="fa fa-bookmark"></i> P. ENSINO</button>
                                                    </a>

                                            </tr>

                                            <?php
                                        endforeach;
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

<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>template/assets/advanced-datatable/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>template/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/assets/data-tables/DT_bootstrap.js"></script>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
            "aaSorting": [[6, "desc"]]
        });
    });
</script>-->