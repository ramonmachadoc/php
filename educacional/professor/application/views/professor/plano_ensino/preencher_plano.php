<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>PlanoEnsino"><i class="fa fa-list-alt"></i> LISTA PLANO(S) DE ENSINO</a></li>
                    <li class="active"><i class="fa fa-edit"></i> PREENCHER</li>
                </ul>
                <!--breadcrumbs end -->
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

                <section class="panel">

                    <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> PREENCHER PLANO DE ENSINO</strong></div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">

                                    <div class="panel-body">
                                        <div class="stepy-tab">
                                            <ul id="default-titles" class="stepy-titles clearfix">
                                                <li id="default-title-0" class="current-step">
                                                    <div>INFORMAÇÕES</div>
                                                </li>

                                                <li id="default-title-1" class="">
                                                    <div>PLANO DE AULA</div>
                                                </li>


                                            </ul>
                                        </div>

                                        <?php echo form_open('PlanoEnsino/PlanoEnsino/' . $infoPlano['pdt_nb_codigo'] . "/" . $infoPlano['disciplina_id'] . "/" . $infoPlano['carga_horaria'] . "/" . $OutrasPlano['pe_nb_codigo'] . "/" . $Ementa['emet_nb_codigo'], array('enctype' => 'multipart/form-data', 'id' => 'default')); ?>
                                        <fieldset title="INFORMAÇÕES" class="step" id="default-step-0">
                                            <legend> </legend>

                                            <hr/>
                                            <header style="margin-left: -10px; " class="panel-heading">
                                                <h3><b>CURSO:</b> <?php echo $infoPlano['cur_tx_descricao']; ?></h3>
                                                <h3><b>DISCIPLINA:</b> <?php echo $infoPlano['disc_tx_descricao']; ?></h3>
                                                <h3><b>PROFESSOR:</b> <?php echo $infoPlano['nome']; ?></h3>
                                                <h3><b>CH:</b> <?php echo $infoPlano['carga_horaria']; ?></h3>
                                            </header>

                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Ementa</label>
                                                        <textarea rows="3" name="ementa" id="ementa" class="form-control"><?php echo $Ementa['ement_tx_descricao']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Objetivo Geral</label>
                                                        <textarea rows="5" name="objetivoGeral" id="objetivoGeral" class="form-control"><?php echo $OutrasPlano['pe_tx_objetivo_geral']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Objetivos específicos</label>
                                                        <textarea rows="5" name="objetivoEspecifico" id="objetivoEspecifico" class="form-control"><?php echo $OutrasPlano['oe_tx_descricao']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Competências e Habilidades</label>
                                                        <textarea rows="5" name="competenciasHabilidades" id="competenciasHabilidades" class="form-control"><?php echo $OutrasPlano['ch_tx_descricao']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Avaliação do Processo Ensino-Apredizagem</label>
                                                        <textarea rows="5" name="avaliacao" id="avaliacao" class="form-control"><?php echo $OutrasPlano['ava_tx_descricao']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Instrumento</label>
                                                        <textarea rows="5" name="instrumento" id="instrumento" class="form-control"><?php echo $OutrasPlano['pe_tx_instrumento']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Referências Bibliográficas</label>

                                                        <?php
                                                        $rowReferencias = $this->professor_model->getTableRow('referencias', 'ref_nb_codigo', 'emet_nb_codigo', $Ementa['emet_nb_codigo']);
                                                        ?>


                                                        <textarea rows="5" name="referencias" id="referencias" class="form-control"><?php echo  $rowReferencias['ref_tx_descricao']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                        <fieldset  title="PLANO DE AULA" class="step" id="default-step-1" >
                                            <legend> </legend>


                                            <header style="text-align: center;" class="panel-heading">
                                                PLANO DE AULA
                                            </header>


                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <section class="panel">

                                                        <div class="panel-body">
                                                            <section id="flip-scroll">
                                                                <table class="table table-bordered table-striped table-condensed cf">
                                                                    <thead class="cf">
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Tempos</th>
                                                                            <th class="numeric">Data</th>
                                                                            <th class="numeric">Contéudo</th>
                                                                            <th class="numeric">Metodologia</th>
                                                                            <th class="numeric">Recursos</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                        $cont = 1;
                                                                        foreach ($Aulas as $row):
                                                                            ?>

                                                                            <tr>
                                                                                <td><?php echo $cont++; ?></td>
                                                                                <td style="width: 8%"><input placeholder="1º 2º" name="tempo<?php echo $row['aul_nb_codigo']; ?>" style="width: 80px;" class="form-control" type="text" value="<?php echo $row['aul_tx_tempo']; ?>"/></td>
                                                                                <td style="width: 10%"><input data-mask="99/99/9999" name="data<?php echo $row['aul_nb_codigo']; ?>" style="width: 100px;" type="text" class="form-control" value="<?php
                                                                                    if ($row['aul_dt_aula'] == '0000-00-00' || $row['aul_dt_aula'] == '1970-01-01' || $row['aul_dt_aula'] == '') {
                                                                                        echo "";
                                                                                    } else {
                                                                                        echo FormatarData($row['aul_dt_aula']);
                                                                                    }
                                                                                    ?>"/></td>
                                                                                <td><textarea name="descricao<?php echo $row['aul_nb_codigo'] ?>" rows="4" class="form-control"><?php echo $row['pec_tx_descricao']; ?></textarea></td>
                                                                                <td><textarea name="estrategia<?php echo $row['aul_nb_codigo']; ?>" rows="4" class="form-control"><?php echo $row['pec_tx_estrategia']; ?></textarea></td>
                                                                                <td><textarea name="recurso<?php echo $row['aul_nb_codigo']; ?>" rows="4" class="form-control"><?php echo $row['pec_tx_recurso']; ?></textarea></td>



                                                                            </tr>

                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </section>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>

                                        </fieldset>

                                        <input type="submit" class="finish btn btn-danger" value="SALVAR PLANO"/>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </section>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>
<!--script for this page only-->

<script>

    //step wizard

    $(function () {
        $('#default').stepy({
            autoFocus: false,
            backLabel: 'Anterior',
            block: true,
            nextLabel: 'Próximo',
            titleClick: true,
            titleTarget: '.stepy-tab'
        });
    });
</script>