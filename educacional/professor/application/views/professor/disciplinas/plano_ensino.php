<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>PlanoEnsino"><i class="fa fa-list-alt"></i> LISTA PLANO(S) DE ENSINO</a></li>
                    <li class="active"><i class="fa fa-print"></i> IMPRIMIR</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="row">

            <aside class="profile-info col-lg-12">
                <section class="panel">
                    <header class="panel-heading summary-head" style="height: 40px; line-height: 50px;">
                        <!-- <h4>DADOS ALUNO</h4>-->
                        <p></p>
                    </header>

                    <div  class="panel-body" style="font-size: 15px; margin-left: 30px;">


                        <div class="row" id="teste" >
                            <div style='width: 890px; height: auto; margin-left: 15px;'>


                                <div style=" width: 700px; float: left;">

                                    <div style="width: 700px;  height: 35px; text-align: justify; font-weight: bold;  font-size: 30px; margin-top: 10px;">PLANO DE ENSINO</div>
                                    <div style="width: 700px;  height: 27px;   font-size: 15px; padding-left: 4px; padding-top: 2px; margin-top: 10px;">CURSO : <?php echo $infoPlano['cur_tx_descricao']; ?></div>
                                    <div style="width: 700px;  height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">DISCIPLINA : <?php echo $infoPlano['disc_tx_descricao']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">PROFESSOR : <?php echo $infoPlano['nome']; ?></div>
                                    <div style="width: 700px; height: 27px;    font-size: 15px; padding-left: 4px;padding-top: 2px;">CH : <?php echo $infoPlano['carga_horaria'] . " Horas"; ?> </div>

                                </div>

                                <div style=" width: 190px; float: left; height: 136px;">

                                    <img style="margin-top: 5px; margin-left: 30px;" width="120" height="120" src="<?php echo base_url(); ?>template/img/brasao7.png" alt="">
                                </div>


                                <?php
                                $rowReferencias = $this->professor_model->getTableRow('referencias', 'ref_nb_codigo', 'emet_nb_codigo', $ementa['emet_nb_codigo']);
                                ?>



                                <div style="width: 890px;  height: 26px; text-align: center; font-weight: bold; float: left; border:1px solid #ddd; font-size: 15px; margin-top: 5px;">EMENTA</div>
                                <div style="width: 890px;  height: auto; text-align: justify; float: left; border:1px solid #ddd; font-size: 12px; margin-top: 0px;"><?php echo $ementa['ement_tx_descricao']; ?></div>

                                <div style="width: 890px;  height: 26px; text-align: center; font-weight: bold; float: left;border:1px solid #ddd; font-size: 15px; margin-top: 0px;">OBJETIVO GERAL</div>
                                <div style="width: 890px;  height: auto; text-align: justify; float: left; border:1px solid #ddd;padding: 5px; font-size: 12px; margin-top: 0px;"><?php echo $infoPlanoDesc['pe_tx_objetivo_geral']; ?></div>


                                <div style="width: 890px;  height: 26px; text-align: center; font-weight: bold; float: left; border:1px solid #ddd; font-size: 15px; margin-top: 0px;">OBJETIVOS ESPECÍFICOS</div>
                                <div style="width: 890px;  height: auto; text-align: justify; float: left; border:1px solid #ddd; font-size: 12px; margin-top: 0px; padding: 5px;"><?php echo $infoPlanoDesc['oe_tx_descricao']; ?></div>


                                <div style="width: 890px; height: 26px; text-align: center; font-weight: bold; float: left; border:1px solid #ddd; font-size: 15px; margin-top: 0px;">COMPETÊNCIAS E HABILIDADES</div>
                                <div style="width: 890px;  height: auto; text-align: justify; float: left; border:1px solid #ddd; font-size: 12px; margin-top: 0px; padding: 5px;"><?php echo $infoPlanoDesc['ch_tx_descricao']; ?></div>


                                <div style="width: 890px; height: 26px; text-align: center; font-weight: bold; float: left; border:1px solid #ddd; font-size: 15px; margin-top: 0px;">AVALIAÇÃO DO PROCESSO ENSINO-APRENDIZAGEM</div>
                                <div style="width: 890px;  height: auto; text-align: justify; float: left; border:1px solid #ddd; font-size: 12px; margin-top: 0px; padding: 5px;"><?php echo $infoPlanoDesc['ava_tx_descricao']; ?></div>


                                <div style="width: 890px; height: 26px; text-align: center; font-weight: bold; float: left; border:1px solid #ddd; font-size: 15px; margin-top: 0px;">INSTRUMENTO</div>
                                <div style="width: 890px;  height: auto; text-align: justify; float: left; border:1px solid #ddd; font-size: 12px; margin-top: 0px; padding: 5px;"><?php echo $infoPlanoDesc['pe_tx_instrumento']; ?></div>


                                <div style="width: 890px; height: 26px; text-align: center; font-weight: bold; float: left; border:1px solid #ddd; font-size: 15px; margin-top: 0px;">REFERÊNCIAS</div>
                                <div style="width: 890px;  height: auto; text-align: justify; float: left; border:1px solid #ddd; font-size: 12px; margin-top: 0px; padding: 5px;"><?php echo $rowReferencias['ref_tx_descricao']; ?></div>


                                <!--                                <div class="adv-table" style="margin-top: 0px; float: left;">
                                                                    <table  style=""  class="display table table-bordered table-striped"  id="example">
                                                                        <thead>
                                                                            <tr style="font-size: 14px;">
                                                                                <th style="text-align: center;">EMENTA</th>
                                                                                <th  style="text-align: center;">OBJETIVO GERAL</th>
                                                                                <th  style="text-align: center;">OBJETIVOS ESPECÍFICOS</th>
                                                                                <th  style="text-align: center;">COMPETÊNCIAS E HABILIDADES</th>
                                                                                <th  style="text-align: center;">AVALIAÇÃO DO PROCESSO ENSINO-APRENDIZAGEM</th>
                                                                                <th  style="text-align: center;">INSTRUMENTO</th>
                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                
                                
                                
                                                                            <tr  style="font-size: 12px; text-align: justify;"  class="gradeU">
                                                                                <td><?php echo $ementa['ement_tx_descricao']; ?></td>
                                                                                <td><?php echo $infoPlanoDesc['pe_tx_objetivo_geral']; ?></td>
                                                                                <td><?php echo $infoPlanoDesc['oe_tx_descricao']; ?></td>
                                                                                <td><?php echo $infoPlanoDesc['ch_tx_descricao']; ?></td>
                                                                                <td><?php echo $infoPlanoDesc['ava_tx_descricao']; ?></td>
                                                                                <td><?php echo $infoPlanoDesc['pe_tx_instrumento']; ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>-->


                                <hr style="float: left; width: 890px;"/>
                                <div style="width: 890px;page-break-after: always; float: left; height: 28px; text-align: center; font-weight: bold; border:1px solid #ddd; font-size: 20px; margin-top: 0px;">PLANO DE AULA</div>

                                <div class="adv-table">
                                    <table style="font-size: 12px;"  class="display table table-bordered table-striped" id="example">
                                        <thead>
                                            <tr style="font-size: 14px;" >
                                                <th style="text-align: center; width: 10%">AULAS</th>
                                                <th style="text-align: center;width: 10%">TEMPO</th>
                                                <th style="text-align: center;width: 10%">DATA</th>
                                                <th style="text-align: center;">CONTEÚDO</th>
                                                <th style="text-align: center;">METODOLOGIA</th>
                                                <th style="text-align: center;">RECURSOS</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $contador = 1;
                                            foreach ($aulas as $row) {
                                                ?>
                                                <tr style="text-align: justify;" class="gradeU">
                                                    <td style="text-align: center;"><?php echo $contador++; ?></td>
                                                    <td style="text-align: center;"><?php echo $row['aul_tx_tempo']; ?></td>
                                                    <td style="text-align: center;"><?php
                                                        if ($row['aul_dt_aula'] == '0000-00-00' || $row['aul_dt_aula'] == '1970-01-01' || $row['aul_dt_aula'] == '') {
                                                            echo "";
                                                        } else {
                                                            echo FormatarData($row['aul_dt_aula']);
                                                        }
                                                        ?></td>
                                                    <td><?php echo $row['pec_tx_descricao']; ?></td>
                                                    <td><?php echo $row['pec_tx_estrategia']; ?></td>
                                                    <td><?php echo $row['pec_tx_recurso']; ?></td>

                                                </tr>
    <?php
}
?>
                                        </tbody>
                                    </table>
                                </div>



                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button onclick="printDiv('teste')"style="margin-top: 20px; margin-left: 40px;" type="button" class="btn btn-success btn-sm"><i class="fa fa-print"></i> IMPRIMIR PLANO DE ENSINO </button>
                        </div>
                    </div>

                    <br/>
                </section>
            </aside>
        </div>  
    </section>
</section>

<script>

    function printDiv(divID)
    {
        //pega o Html da DIV
        var divElements = document.getElementById(divID).innerHTML;
        //pega o HTML de toda tag Body
        var oldPage = document.body.innerHTML;

        //Alterna o body 
        document.body.innerHTML =
                "<html><head><style></style></head><body>" +
                divElements +
                "</body>";

        //Imprime o body atual
        window.print();

        //Retorna o conteudo original da página. 
        document.body.innerHTML = oldPage;
    }

</script>

