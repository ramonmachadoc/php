<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa fa-list-alt"></span> AVALIAÇÃO CPA</h1>
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

                    <?php echo form_open('cpa/saveCpa', array('enctype' => 'multipart/form-data', 'id' => 'FormAddLivro')); ?>
                    <div class="panel-body">

                        <header class="panel-heading" class="text-justify">

                            <h3>CORPO DISCENTE – AVALIAÇÃO DE CADA DOCENTE POR PERÍODO (CURSO)</h3>
                            <hr/>

                            <div class="row" class="text-justify">
                                <div class="col-lg-6">
                                    Caríssimo Colegas <br/>
                                    A Comissão Própria de Avaliação – CPA, implementou em sua avaliação institucional o<br/> 
                                    questionário de avaliação discente específico para avaliar o componente curricular e a <br/>
                                    função do professor por curso em cada semestre letivo. Dessa forma, cada coordenador <br/>
                                    ou coordenadora de curso poderá trabalhar o subsídio dessa avaliação visando o <br/>
                                    melhoramento do curso. <br/><br/>

                                    <b>Participe é breve e objetivo!</b> <br/><br/>

                                    Mara Cinthia – Representante Discente na CPA <br/>
                                    Aluno do 6° período do curso de Ciências Teológicas <br/><br/>

                                    Contamos com sua colaboração para que a Faculdade Boas Novas melhore a cada dia!<br/>
                                    Prof. Me. Daniel Barros – Coordenador da CPA <br/>
                                    A CPA agradece a sua colaboração

                                    <br/>
                                </div>
                            </div>
                        </header>

                        <br/>

                        <div class="row">
                            <div class="col-lg-8">

                                <?php
                                foreach ($minhas_disciplinas as $rowDisc):

                                    $Professor = $this->aluno_model->nomeProfessor($turmasAluno['turma_id'], $rowDisc['disciplina_id']);
                                    ?>
                                    <div class="panel panel-primary" style="opacity: 1; ">
                                        <div class="panel-heading"><?php echo $rowDisc['disciplina'] ?> - <?php echo $Professor['nome'] ?></div>

                                        <div class="panel-body">
                                            <section id="unseen">
                                                <?php
                                                foreach ($perguntas as $rowPerg):
                                                    ?>
                                                    <table class="table table-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr class="bg-info">
                                                                <th  colspan="<?php
                                                                echo $this->aluno_model->CountTable('fbnov509_cpa.opcao', 'pergunta_id', $rowPerg['pergunta_id']);
                                                                ?>"><?php echo $rowPerg['pergunta'] ?></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr>
                                                                <?php
                                                                $opcoes = $this->aluno_model->GetWhere('fbnov509_cpa.opcao', 'pergunta_id', $rowPerg['pergunta_id']);
                                                                ?>
                                                        <div class="radios"> 
                                                            <td>
                                                                <?php
                                                                foreach ($opcoes as $rowOpcao):
                                                                    ?>
                                                                    <label>
                                                                        <?php echo $rowOpcao['opcao']; ?>
                                                                        <input required="required" type="radio" name="pergunta_id_<?php echo $rowPerg['pergunta_id']; ?>" value="<?php echo $rowOpcao['opcao_id']; ?>"/>
                                                                    </label>

                                                                    <?php
                                                                endforeach;
                                                                ?>
                                                            </td>
                                                        </div>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    <?php
                                                endforeach;
                                                ?>
                                            </section>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                ?>




                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12"> 
                                <br/>
                                <button type="submit" class="btn btn-info">SALVAR QUESTIONÁRIO</button>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</section>

