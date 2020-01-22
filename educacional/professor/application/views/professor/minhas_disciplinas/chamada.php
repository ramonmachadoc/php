<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                    <li><a href="<?php echo base_url(); ?>Disciplinas"><i class="fa fa-list-alt"></i> MINHAS DISCIPLINAS</a></li>
                    <li><a href="<?php echo base_url(); ?>Disciplinas/minhas_disciplinas_aula/<?php echo $Infoaulas['pdt_id']; ?>"><i class="fa fa-table"></i> AULAS</a></li>
                    <li class="active"><i class="fa fa-check"></i> CHAMADA</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <h2 style="font-weight: 300;"></span> Turma: <?php echo $Infoaulas['turma']; ?></h2>
        <h2 style="font-weight: 300;"></span> Professor: <?php echo $Infoaulas['professor']; ?></h2>
        <h2 style="font-weight: 300;"></span> Disciplina: <?php echo $Infoaulas['disciplina']; ?></h2>
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
                <?php echo form_open('Disciplinas/chamada/' . $aula_id . "/" . $Infoaulas['pdt_id'], array('class' => '', 'enctype' => 'multipart/form-data')); ?>

                <section class="panel">
                    <div class="panel-body">
                        <section id="flip-scroll">
                            <table class="table table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                    <tr>
                                        <th>#</th>
                                        <th>Matrícula</th>
                                        <th>NOME</th>
                                        <th  style="text-align: center;">PRESENTE</th>
                                        <th  style="text-align: center;">AUSENTE</th>
                                        <th  style="text-align: center;">AÇÕES</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $count = 1;
                                    $contador = 1;
                                    foreach ($alunos as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['registro_academico']; ?></td>
                                            <td><?php echo $row['nome']; ?></td>

                                            <?php
                                            $da_codigo = $row['da_codigo'];
                                            $arrayChamada = $this->professor_model->ChamadaAluno($aula_id, $da_codigo);

                                            foreach ($arrayChamada as $row3):
                                                $cod_chamada = $row3['cham_nb_codigo'];
                                                $chamada_status = $row3['cham_nb_status'];
                                                $justificativa = $row3['justificativa'];
                                            endforeach;
                                          
                                            ?>


                                            <?php if ($chamada_status == 1) { ?>
                                                <td style="text-align: center;" >
                                                    <input name="rd_resposta<?php echo $cod_chamada; ?>" id="rd_resposta<?php echo $cod_chamada; ?>" value="1"  type="radio"  checked="true"     >           
                                                </td>  
                                                <td  style="text-align: center;">
                                                    <input name="rd_resposta<?php echo $cod_chamada; ?>" id="rd_resposta<?php echo $cod_chamada; ?>" value="0"  type="radio"  >        
                                                </td>  
                                            <?php } else if ($chamada_status == 0) { ?>
                                                <td style="text-align: center;">
                                                    <input name="rd_resposta<?php echo $cod_chamada; ?>" id="rd_resposta<?php echo $cod_chamada; ?>" value="1"  type="radio"   >           
                                                </td>  
                                                <td style="text-align: center;">
                                                    <input name="rd_resposta<?php echo $cod_chamada; ?>" id="rd_resposta<?php echo $cod_chamada; ?>" value="0"  type="radio"  checked="true"   >        
                                                </td>  
                                            <?php } ?>

                                            <td class="text-center">
                                                <a data-toggle="modal" href="#myModal2"><button type="button" class="btn btn-info btn-xs">
                                                        <i class="fa fa-check"></i> 
                                                        JUST. CHAMADA
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>

                                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">



                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">JUSTIFICAR CHAMADA</h4>
                                                </div>

                                                <div class="modal-body">

                                                    <div id="resposta"></div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Descrição da Justificativa</label>
                                                                <textarea class="form-control"  rows="5" name="justificativa" id="justificativa"><?php echo rawurldecode($justificativa); ?></textarea>
                                                                <input type="hidden" name="cod_chamada" id="cod_chamada" value="<?php echo $cod_chamada; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                    <button onclick="salvarJustificativa()" class="btn btn-warning" type="button"> Confirmar</button></a>
                                                </div>


                                            </div>
                                        </div>
                                    </div>



                                <?php endforeach; ?>

                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Registrar Chamada</button>
                            </div>
                        </section>
                    </div>
                </section>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>

<script>
    function salvarJustificativa() {

        var justificativa = $('#justificativa').val(); //codigo do estado escolhido
        var cod_chamada = $('#cod_chamada').val(); //codigo do estado escolhido
        //se encontrou o estado
        if (justificativa) {
            var url = '../../Justifica/' + justificativa + "/" + cod_chamada; //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#resposta').html(dataReturn); //coloco na div o retorno da requisicao
            });
        }
    }

</script>


