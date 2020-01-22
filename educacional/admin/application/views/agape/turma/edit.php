<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
            <section class="panel">
                <div class="panel-heading"><strong><span class="fa fa-users"></span> NOVA TURMA</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('turma/edit/' . $TurmaEdit['turma_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddTurma')); ?>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <input type="text" value="<?php echo $TurmaEdit['tur_tx_descricao']; ?>" name="descricao" required="required" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Periodo Letivo</label>
                                                <select class="form-control" required="required" name="periodo_letivo">
                                                    <option value="">Selecione o Período</option>
                                                    <?php
                                                    foreach ($periodoLetivo as $row):
                                                        ?>
                                                        <option <?php
                                                        if ($TurmaEdit['periodo_letivo_id'] == $row['periodo_letivo_id']) {
                                                            echo "selected='true'";
                                                        }
                                                        ?> value="<?php echo $row['periodo_letivo_id']; ?>"><?php echo $row['periodo_letivo']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Curso</label>
                                                <select required='required' class="form-control" name="curso" id='curso' onchange="buscar_matriz();">
                                                    <option value="">Selecione o Curso</option>
                                                    <?php
                                                    foreach ($cursos as $rowCurso):
                                                        ?>
                                                        <option

                                                            <?php
                                                            if ($TurmaEdit['curso_id'] == $rowCurso['cursos_id']) {
                                                                echo "selected='true'";
                                                            }
                                                            ?>
                                                            value="<?php echo $rowCurso['cursos_id']; ?>"><?php echo $rowCurso['cur_tx_descricao']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group" id='load_matriz'>
                                                <label>Matriz</label>
                                                <select class='form-control' name='matriz' required="required">

                                                    <?php
                                                    foreach ($matriz as $rowMatriz):
                                                        ?>
                                                        <option
                                                        <?php
                                                        if ($TurmaEdit['matriz_id'] == $rowMatriz['matriz_id']) {
                                                            echo "selected='true'";
                                                        }
                                                        ?>
                                                            value="<?php echo $rowMatriz['matriz_id']; ?>"><?php echo $rowMatriz['mat_tx_ano'] . "/" . $rowMatriz['mat_tx_semestre']; ?> - <?php
                                                                if ($rowMatriz['atual'] == 1) {
                                                                    echo "ATUAL";
                                                                } else {
                                                                    echo "OFICIAL";
                                                                }
                                                                ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" required="required" name="status">
                                                    <?php
                                                    if ($TurmaEdit['status'] == 1) {
                                                        ?>
                                                        <option value="1">ABERTA</option>
                                                        <option value="0">FECHADA</option>

                                                        <?php
                                                    } else if ($TurmaEdit['status'] == 0) {
                                                        ?>
                                                        <option value="0">FECHADA</option>
                                                        <option value="1">ABERTA</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Turno</label>
                                                <select required="required" class="form-control" name="turno">
                                                    <option value="">Selecione o Turno</option>
                                                    <?php
                                                    foreach ($turnos as $rowTurno):
                                                        ?>
                                                        <option
                                                        <?php
                                                        if ($TurmaEdit['turno_id'] == $rowTurno['turno_id']) {
                                                            echo "selected='true'";
                                                        }
                                                        ?>
                                                            value="<?php echo $rowTurno['turno_id']; ?>"><?php echo $rowTurno['descricao']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Período</label>
                                                <select required="" class="form-control" name="periodo">
                                                    <option value="">Selecione o Curso</option>
                                                    <?php
                                                    foreach ($periodos as $rowPeriodo):
                                                        ?>
                                                        <option

                                                            <?php
                                                            if ($TurmaEdit['periodo_id'] == $rowPeriodo['periodo_id']) {
                                                                echo "selected='true'";
                                                            }
                                                            ?>

                                                            value="<?php echo $rowPeriodo['periodo_id']; ?>"><?php echo $rowPeriodo['periodo']; ?></option>
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
                                            <button type="submit" class="btn btn-info">Cadastrar</button>
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
    </section>
</section>

<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>


<script>
                                                    function buscar_matriz() {
                                                        var curso = $('#curso').val();  //codigo do estado escolhido
                                                        //se encontrou o estado
                                                        if (curso) {
                                                            var url = '../Turma/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                                                            $.get(url, function (dataReturn) {
                                                                $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
                                                            });
                                                        }
                                                    }
</script>