<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-8">
            <section class="panel">
                <div class="panel-heading"><strong><span class="fa fa-users"></span> NOVA DISCIPLINA - MATRIZ: <?php echo $InfoMatriz['cur_tx_abreviatura'] . "-" . $InfoMatriz['mat_tx_ano'] . "/" . $InfoMatriz['mat_tx_semestre'] ?></strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo form_open('matriz/editDisciplina/'.$InfoMatriz['matriz_id']."/".$matriz_disciplina['iddisc']."/".$matriz_disciplina['matriz_disciplina_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddBolsa')); ?>

                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Código Disciplina</label>
                                                <input type="text" name="codigo" value="<?php echo $matriz_disciplina['disc_tx_abrev'] ?>" required="required" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Disciplina</label>
                                                <input type="text" name="disciplina" value="<?php echo $matriz_disciplina['disc_tx_descricao']; ?>" required="required" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Carga Horária</label>
                                                <input type="text" name="ch" value="<?php echo $matriz_disciplina['carga_horaria']; ?>" required="required" class="form-control" >
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Crédito</label>
                                                <input type="text" name="credito" value="<?php echo $matriz_disciplina['credito']; ?>" required="required" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Período</label>
                                                <select name="periodo" class="form-control">
                                                    <option value="">Selecione o Período</option>

                                                    <?php
                                                    foreach ($periodos as $row):
                                                        ?>
                                                        <option
                                                            
                                                            <?php 
                                                            
                                                            if($matriz_disciplina['periodo'] == $row['periodo_id']){
                                                                echo 'selected="true"';
                                                            }
                                                            
                                                            ?>
                                                            
                                                            
                                                            value="<?php echo $row['periodo_id']; ?>"><?php echo $row['periodo']; ?></option>
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
