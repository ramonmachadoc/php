<section id="main-content">
    <section class="wrapper site-min-height">
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


                <!--widget start-->
                <section class="panel">
                    <div class="twt-feed blue-bg" style="background-color: #878383">
                        <h1><?php echo $InfoProfessor['nome']; ?></h1>
                        <p><?php echo $InfoProfessor['email']; ?></p>
                        <a href="#">
                            <img src="<?php echo base_url(); ?>template/img/sem-imagem.png" alt="">
                        </a>


                    </div>

                    <div class="weather-category twt-category">

                        <div class="col-lg-12">

                            <section class="panel">

                                <div class="panel-heading"><strong><span class="fa fa-table"></span> VINCULAR DISCIPLINA</strong></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <section class="panel">

                                                <?php echo form_open('professor/disciplinas/' . $InfoProfessor['professor_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddProfessor')); ?>

                                                <div class="panel-body">

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Curso</label>
                                                                <select  required="required" class='form-control' name='cursos_id' id='cursos_id' onchange="buscar_periodo_letivo();">
                                                                    <option  value=''>Selecione o Curso</option>
                                                                    <?php
                                                                    foreach ($cursos as $rowCursos):
                                                                        ?>
                                                                        <option value='<?php echo $rowCursos['cursos_id'] ?>'><?php echo $rowCursos['cur_tx_descricao']; ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group" id='load_periodo_letivo_pd'>
                                                                <label>Periodo Letivo</label>
                                                                <select required="required" class="form-control">
                                                                    <option value="">Selecione o Curso</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-3">
                                                            <div class="form-group" id="load_turma_pd">
                                                                <label>Turma</label>
                                                                <select required="required" class="form-control">
                                                                    <option value="">Selecione o Periodo Letivo</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-3">
                                                            <div class="form-group" id="load_disciplina_pd">
                                                                <label>Disciplina</label>
                                                                <select required="required" class="form-control">
                                                                    <option value="">Selecione a Turma</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-12"> 
                                                            <br/>
                                                            <button type="submit" class="btn btn-info">VINCULAR DISCIPLINA</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </section>
                                        </div>
                                        </section>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <section class="panel">


                                <div class="panel-body">
                                    <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 5%;">ID</th>
                                                    <th class="text-center" style="width: 10%;" >Periodo Letivo</th>
                                                    <th>Curso</th>
                                                    <th>Turma</th>
                                                    <th>Periodo</th>
                                                    <th>Disciplinas</th>
                                                    <th class="text-center" style="width: 12%;">OPÇÕES</th>
                                                    <th class="text-center">AÇÕES</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $cont = 1;
                                                $cont2 = 1;
                                                $cont3 = 1;
                                                foreach ($disciplina as $row):
                                                    ?>
                                                    <tr class="gradeU">
                                                        <td style="text-align: center;"><?php echo $cont++; ?></td>
                                                        <td class="text-center">

                                                            <?php
                                                            if ($row['periodo_letivo']) {

                                                                echo $row['periodo_letivo'];
                                                            } else {

                                                                echo $row['ano'] . "/" . $row['semestre'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-center"><?php echo $row['cur_tx_abreviatura']; ?></td>
                                                        <td><?php echo $row['tur_tx_descricao']; ?></td>
                                                        <td class="text-center"><?php echo $row['periodo']; ?></td>
                                                        <td><?php echo $row['disc_tx_descricao']; ?></td>
                                                        <td style="text-align: center; width: 20%;">

                                                            <a href='<?php echo base_url(); ?>PlanoEnsino/PlanoEnsino/<?php echo $row['pdt_id']; ?>'><button type="button" class="btn btn-azul_2 btn-sm">
                                                                    <i class="fa fa-print"></i> 
                                                                    P. ENSINO
                                                                </button>
                                                            </a>

                                                            <a href="<?php echo base_url(); ?>Mapa/Mapa/<?php echo $row['pdt_id']; ?>/<?php echo $row['turma_id']; ?>/<?php echo $row['disciplina_id']; ?>"><button type="button" class="btn btn-cinza btn-sm">
                                                                    <i class="fa fa-map-marker"></i> 
                                                                    MAPA NOTA
                                                                </button>
                                                            </a>

                                                        </td>

                                                        <td class="center hidden-phone" style="width: 6%;">
                                                            <a  data-toggle="modal" href="#myModal2<?php echo $cont2++; ?>" ><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
                                                        </td>


                                                    </tr>



                                                <div class="modal fade" id="myModal2<?php echo $cont3++; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">Excluir Disciplina</h4>
                                                            </div>
                                                            <div class="modal-body">


                                                                <?php
                                                                if ($this->coordenador_model->CountTable('aulas', 'pdt_nb_codigo', $row['pdt_id']) > 0) {

                                                                    echo '<span class="label label-warning">ATENÇÃO!</span>';
                                                                    echo "<br/><hr/>";
                                                                    echo "<h5>O <b>Plano de ensino</b> e as <b>Aulas</b> já foram criadas. <br/> <br/> <b>Deseja realmente excluir esta disciplina? </b> </h5>";
                                                                } else {

                                                                    echo "<h5><b>Deseja realmente excluir esta disciplina?</b></h5>";
                                                                }
                                                                ?>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                                <a href="<?php echo base_url(); ?>professor/deleteDisciplina/<?php echo $row['prof_curso']; ?>/<?php echo $row['pdt_id']; ?>/<?php echo $InfoProfessor['professor_id']; ?>"><button class="btn btn-warning" type="button"> Confirmar</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


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


                </section>
                </section>


                <script>

                    function buscar_periodo_letivo() {

                        var curso = $('#cursos_id').val();  //codigo do estado escolhido
                        //se encontrou o estado
                        if (curso) {
                            var url = '../carrega_periodo_letivo/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                            $.get(url, function (dataReturn) {
                                $('#load_periodo_letivo_pd').html(dataReturn);  //coloco na div o retorno da requisicao
                            });
                        }
                    }


                    function buscar_turma() {
                        var curso = $('#cursos_id').val();  //codigo do estado escolhido
                        //se encontrou o estado
                        if (curso) {
                            var url = '../carrega_turma/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                            $.get(url, function (dataReturn) {
                                $('#load_turma_pd').html(dataReturn);  //coloco na div o retorno da requisicao
                            });
                        }
                    }


                    function buscar_disciplina_pd() {
                        var curso = $('#cursos_id').val();
                        var turma = $('#turma').val();  //codigo do estado escolhido
                        //se encontrou o estado
                        if (turma) {

                            var url = '../carrega_disciplina/' + turma + '/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                            $.get(url, function (dataReturn) {
                                $('#load_disciplina_pd').html(dataReturn);  //coloco na div o retorno da requisicao
                            });
                        }
                    }
                </script>

                <script type="text/javascript" charset="utf-8">
                    $(document).ready(function () {
                        $('#example').dataTable({
//            "aaSorting": [[4, "desc"]]
                        });
                    });
                </script>
