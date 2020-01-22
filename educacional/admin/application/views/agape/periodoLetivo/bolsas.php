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
                    <h3>VINCULAR BOLSAS  <br/><br/><b> PERIODO LETIVO: <?php echo $InfoPeriodo['periodo_letivo']; ?> </b></h3>
                </div>
                
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-body">
                        <?php echo form_open('PeriodoLetivo/vinculoBolsaPeriodo', array('enctype' => 'multipart/form-data', 'id' => 'FormAddBolsa')); ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Bolsas</label>
                                    <select class="form-control" name="bolsa_id">
                                        <option value="">Selecione a Bolsa</option>
                                       
                                        <?php 
                                        foreach($bolsas as $rowBolsa):
                                            ?>
                                         <option value="<?php echo $rowBolsa['bolsas_id']; ?>"><?php echo $rowBolsa['descricao']; ?></option>
                                        <?php
                                        endforeach;
                                        
                                        ?>
                                       
                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Período Letivo</label>
                                    <select class="form-control" required="required" name="periodo_letivo">
                                        <option value="<?php echo $InfoPeriodo['periodo_letivo_id']; ?>"> <?php echo $InfoPeriodo['periodo_letivo']; ?></option>
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


        <div class="row">
            <div class="col-lg-12">

                <section class="panel">

                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="text-center" style="width: 10%;" >Bolsa</th>

                                        <th class="text-center">OPÇÕES</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $cont = 1;
                                    foreach ($BolsasPeriodo as $row):
                                        ?>
                                        <tr class="gradeU">
                                            <td style="text-align: center; width: 5%;"><?php echo $cont++; ?></td>

                                            <td style="width: 70%;"><?php echo $row['descricao']; ?></td>

                                            <td style="text-align: center;">
                                                <a href="<?php echo base_url(); ?>PeriodoLetivo/deleteBolsa/<?php echo $row['bolsa_periodo_id']; ?>/<?php echo $InfoPeriodo['periodo_letivo_id']; ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
                                            </td>

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


    </section>

</section>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
//            "aaSorting": [[4, "desc"]]
        });
    });
</script>
