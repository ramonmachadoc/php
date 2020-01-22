<section id="main-content">
    <section class="wrapper">

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



                <div class="inbox-head">
                    <h3>LISTA DISCIPLINA(S)  <br/><br/><b> MATRIZ: <?php echo $InfoMatriz['cur_tx_abreviatura'] . "-" . $InfoMatriz['mat_tx_ano'] . "/" . $InfoMatriz['mat_tx_semestre'] ?></b></h3>
                </div>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-lg-12">

                <section class="panel">

<!--                    <header class="panel-heading">
                        <a href="<?php echo base_url(); ?>matriz/addDisciplina/<?php echo $InfoMatriz['matriz_id']; ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> DISCIPLINA</button>
                        </a>
                    </header>-->



                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="text-center" style="width: 10%;" >Cód Disc</th>
                                        <th>Disciplina</th>
                                        <th class="text-center">C.H</th>
                                        <th class="text-center">Crédito</th>
                                        <th class="text-center">Período</th>
                                       

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($disciplinas as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td style="text-align: center;"><?php echo $cont++; ?></td>
                                            <td class="text-center"><?php echo $row['disc_tx_abrev']; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td class="text-center"><?php echo $row['carga_horaria']; ?></td>
                                            <td class="text-center"><?php echo $row['credito']; ?></td>
                                            <td class="text-center"><?php echo $row['periodo']; ?></td>
                                        </tr>
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


        <section>

        </section>

        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                $('#example').dataTable({
//            "aaSorting": [[4, "desc"]]
                });
            });
        </script>
