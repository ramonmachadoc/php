<section id="main-content">
    <section class="wrapper site-min-height">

        <h1 style="font-weight: 300;"><span class="fa   fa-pencil-square"></span> LISTA DE DESPESA(S)</h1>
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
                    <header class="panel-heading">
                        <a href="<?php echo base_url(); ?>Despesas/add"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus">
                                </span> DESPESA</button>
                        </a>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fornecedor</th>
                                        <th>Categoria</th>
                                        <th>Vencimento</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $cont = 1;
                                    $cont1 = 1;
                                    $cont2 = 1;
                                    foreach ($depesas as $row):
                                        ?>
                                        <tr class="gradeU" style="text-align: center;">

                                            <td><?php echo $cont1++; ?></td>
                                            <td><?php echo $row['fornecedor']; ?> </td>
                                            <td><?php echo $row['categoria']; ?> </td>
                                            <td><?php echo FormatarData($row['data_vencto']); ?>  </td>
                                            <td><?php echo FormatarValor($row['valor']); ?></td>


                                            <td> 
                                                <?php
                                                if ($row['cpr_status'] == 1) {

                                                    if ($row['data_vencto'] == date('Y-m-d')) {
                                                        ?>
                                                        <button style="width: 85px;" type="button" class="btn btn-warning btn-sm">Venc Hoje</button>

                                                        <?php
                                                    } else if ($row['data_vencto'] < date('Y-m-d')) {
                                                        ?>
                                                        <button style="width: 85px;" type="button" class="btn btn-danger btn-sm">Em atraso</button>
                                                        <?php
                                                    } else {
                                                        ?>  
                                                        <button style="width: 85px;" type="button" class="btn btn-primary btn-sm">Em Aberto</button>

                                                        <?php
                                                    }
                                                    ?>

                                                    <?php
                                                } else if ($row['cpr_status'] == 2) {
                                                    ?>
                                                    <button style="width: 85px;"  type="button" class="btn btn-success btn-sm">Pago</button>

                                                    <?php
                                                }
                                                ?>
                                            </td>

                                            <td class="center hidden-phone">
                                                <?php
                                                if ($row['cpr_status'] == 1 || $row['cpr_status'] == 3 || $row['cpr_status'] == 4) {
                                                    ?>
                                                    <a data-toggle="modal" href="#myModal<?php echo $cont++; ?>">
                                                        <button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button>
                                                       
<!--                                                        <a href="<?php echo base_url(); ?>Despesas/edit/<?php echo $row['cpr_codigo']; ?>">
                                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                                        </a>-->
                                                        
                                                    </a>
                                                    <?php
                                                }
                                                ?>

                                                <a href="<?php echo base_url(); ?>Despesas/deleteConta/<?php echo $row['cpr_codigo']; ?>">
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                                </a>

                                            </td>
                                        </tr>

                                    <div class="modal fade"  id="myModal<?php echo $cont2++; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Efetuar Pagamento</h4>
                                                </div>
                                                <div class="modal-body">


                                                    <?php echo form_open('Despesas/efetuarPagamento/', array('enctype' => 'multipart/form-data')); ?>

                                                    <input type="hidden" name="cpr_codigo" value="<?php echo $row['cpr_codigo']; ?>"/>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Valor Pagamento</label>
                                                                <input type="text" value="<?php echo FormatarValor($row['valor']); ?>" class="form-control" required="required" id="calendario3" name="valor_pagamento">
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Data do Vencimento</label>
                                                                <input type="text" value="<?php echo FormatarData($row['data_vencto']); ?>"  name="data_vencimento"  class="form-control" required="required">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Data Pagamento</label>
                                                                <input type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>" required="required" id="calendario3" name="data_pagamento">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Forma de Pagamento</label>

                                                                <select name="forma_pagamento" class="form-control">
                                                                    <option value="1">ESPÉCIE</option>
                                                                    <option value="2">CARTÃO DE CRÉDITO</option>
                                                                    <option value="3">CARTÃO DE DÉBITO</option>
                                                                    <option value="4">CHEQUE</option>
                                                                    <option value="5">BOLETO</option>
                                                                    <option value="6">TRANSF. BANCARIA</option>
                                                                    <option value="7">OUTRO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                                    <button class="btn btn-success" type="submit">Salvar</button>
                                                </div>
                                                <?php echo form_close(); ?>

                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
//            "aaSorting": [[6, "desc"]]
        });
    });
</script>