<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> EDITAR PERÍODO LETIVO</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <div class="panel-body">

                                    <?php echo form_open('PeriodoLetivo/edit/'.$PeriodoEdit['periodo_letivo_id'], array('enctype' => 'multipart/form-data', 'id' => 'FormAddPeriodo')); ?>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Período Letivo</label>
                                                <input type="text" value="<?php echo $PeriodoEdit['periodo_letivo']; ?>" required="required" name="periodo_letivo" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <input type="text" value="<?php echo $PeriodoEdit['periodo_letivo_descricao']; ?>" required="required" name="periodo_letivo_descricao" class="form-control" >
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Dias Letivos</label>
                                                <input type="text" value="<?php echo $PeriodoEdit['dias_letivos']; ?>" required="required" name="dias_letivos" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data Início</label>
                                                <input type="text" required="required" value="<?php echo FormatarData($PeriodoEdit['data_inicio']); ?>"data-mask="99/99/9999" name="data_inicio" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data Previsão Término</label>
                                                <input type="text" required="required" value="<?php echo FormatarData($PeriodoEdit['data_prev_termino']) ?>" data-mask="99/99/9999" name="data_prev_termino" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data Término</label>
                                                <input type="text" required="required" value="<?php echo FormatarData($PeriodoEdit['data_termino']) ?>" data-mask="99/99/9999" name="data_termino" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Situação Período</label>
                                                <select class="form-control" required="required" name="periodo_encerrado">

                                                    <?php
                                                    if ($PeriodoEdit['periodo_encerrado'] == 1) {
                                                        ?>
                                                        <option value="1">Período Aberto</option>
                                                        <option value="0">Período Encerrado</option>

                                                        <?php
                                                    } else if ($PeriodoEdit['periodo_encerrado'] == 0) {
                                                        ?>
                                                        <option value="0">Período Encerrado</option>
                                                        <option value="1">Período Aberto</option>

                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Ano</label>
                                                <input type="text" value="<?php echo $PeriodoEdit['ano']; ?>" name="ano" required="required" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Semestre</label>
                                                <select class="form-control" required="required" name="semestre">

                                                    <?php
                                                    if ($PeriodoEdit['semestre'] == 1) {
                                                        ?>
                                                        <option value="1">Primeiro Semestre</option>
                                                        <option value="2">Segundo Semestre</option>

                                                        <?php
                                                    } else if ($PeriodoEdit['semestre'] == 2) {
                                                        ?>
                                                        <option value="2">Segundo Semestre</option>
                                                        <option value="1">Primeiro Semestre</option>

                                                        <?php
                                                    }
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

                                    <?php echo form_close(); ?>
                                </div>
                            </section>
                        </div>

                    </div>

                </div>
            </section>
        </div>
    </section>
</section>
<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>