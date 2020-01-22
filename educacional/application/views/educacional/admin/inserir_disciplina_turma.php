<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li class="active"><i class="fa fa-table"></i> INSERIR DISCIPLINA TURMA</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-heading"><strong><span class="glyphicon glyphicon-tasks"></span> INSERIR DISCIPLINAS TURMA</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">

                                    <div class="panel-body">

                                        <?php echo form_open('adm/InserirDisciplinaTurma'); ?>

                                        <div class="row">

                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label>TURMA</label>
                                                    <select class="form-control" name="turma_id">
                                                        <?php
                                                        foreach ($turmas as $row):
                                                            ?>
                                                            <option value="<?php echo $row['turma_id'] ?>"><?php echo $row['tur_tx_descricao']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12"> 
                                                <br/>
                                                <button type="submit" class="btn btn-info">PESQUISAR TURMA</button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php echo form_close(); ?>
                                </section>
                            </div>

                        </div>

                    </div>
                </section>
            </div>
        </div>         



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



                <?php if (isset($alunosMatriculados)) { ?>

                    <?php echo form_open('adm/InserirDisciplinaTurma/inconsistenciaDisciplinas'); ?>
                    <section class = "panel">

                        <!--                                                <header class="panel-heading">
                                                                                <button type="submit" class="btn btn-default">CORRIGIR INCONSISTÊNCIA DE DISCIPLINAS</button>
                                                                            </header>-->


                        <div class = "panel-body">
                            <div class = "adv-table" style = "overflow-x: auto">

                                <table class = "display table table-bordered table-striped" id = "example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th style = "text-align: center;">Nome</th>
                                            <th style = "text-align: center;">OBS </th>
                                            <th style = "text-align: center;">Matricula Turma</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $cont = 1;
                                        $matricula_aluno_turma = array();
                                        foreach ($alunosMatriculados as $rowMatriculados):
                                            //verificar forma de consulta SQL retornar apenas alunos regulares.
                                            if ($rowMatriculados['desperiodizado'] <> 1) {

                                                $dados = array("matricula_aluno_turma_id" => $rowMatriculados['matricula_aluno_turma_id']);
                                                //Verifica se alunos estão cadastrados em pelo menos uma disciplina
                                                $countDisciplina = $this->educacional_model->countWhere('disciplina_aluno', 'matricula_aluno_turma_id', $rowMatriculados['matricula_aluno_turma_id']);
                                                if ($countDisciplina == 0) {
                                                    ?>
                                                    <tr class="gradeU">
                                                        <td style="text-align: center; width: 4%;"><?php echo $cont++; ?></td>
                                                        <td><?php echo $rowMatriculados['nome']; ?></td>
                                                        <td><span class="label label-danger label-mini">SEM DISCIPLINAS CADASTRADAS</span></td>
                                                        <td><input type="hidden" value="<?php echo $rowMatriculados['matricula_aluno_turma_id'] ?>" name="teste[]"/>  <?php echo $rowMatriculados['matricula_aluno_turma_id'] ?></td>

                                                    </tr>
                                                    <?php
                                                    //array_push($matricula_aluno_turma, $dados);
                                                } else {

                                                    //verificar se as disciplinas colocadas, estão batendo com a matriz.
                                                    $disciplinasMatriculado = $this->educacional_model->GetWhere('matriz_disciplina_id', 'disciplina_aluno', 'matricula_aluno_turma_id', $rowMatriculados['matricula_aluno_turma_id']);
                                                    $disciplina_matriz = $this->educacional_model->disciplinasMatrizAtual($rowMatriculados['curso_id'], $rowMatriculados['periodo_atual']);

                                                    //ARRAY COM DISCPLINAS DO ALUNO 
                                                    $array_disciplina = array();
                                                    foreach ($disciplinasMatriculado as $rowDisciplinasMatriculado):
                                                        array_push($array_disciplina, $rowDisciplinasMatriculado['matriz_disciplina_id']);
                                                    endforeach;


                                                    //ARRAY COM DISCPLINAS DA MATRIZ 
                                                    $array_matriz = array();
                                                    foreach ($disciplina_matriz as $rowMatrizDisciplina):
                                                        array_push($array_matriz, $rowMatrizDisciplina['matriz_disciplina_id']);
                                                    endforeach;


                                                    $result = array_diff_key($array_disciplina, $array_matriz);

                                                    if ($result) {
                                                        ?>
                                                        <tr class="gradeU">
                                                            <td style="text-align: center; width: 4%;"><?php echo $cont++; ?></td>
                                                            <td><?php echo $rowMatriculados['nome']; ?></td>
                                                            <td><span class="label label-warning label-mini">UMA OU MAIS DISCIPLINA(S) NÃO BATE COM A MATRIZ ATUAL</span></td>
                                                         <td><input type="hidden" value="<?php echo $rowMatriculados['matricula_aluno_turma_id'] ?>" name="teste[]"/>  <?php echo $rowMatriculados['matricula_aluno_turma_id'] ?></td>


                                                        </tr>
                                                        <?php
                                                        // array_push($matricula_aluno_turma, $dados);
                                                    }
                                                }
                                            }

                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <?php echo form_close(); ?>
                    <?php
                }
                ?>      
            </div>
        </div>
    </section>
</section>




