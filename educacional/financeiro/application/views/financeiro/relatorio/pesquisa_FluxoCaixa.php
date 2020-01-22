<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-4">
                <section class="panel">
                    <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Relatórios Rápidos</strong></div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <a href="<?php echo base_url(); ?>Relatorio/entradas_saidas/0" target="_blank"> <button style="height: 6.4rem; width: 85%; margin: auto" class="btn btn-space btn-cinza btn-xs btn-block" type="button">
                                        <i class="fa fa-list"></i>
                                        Todas entradas e saídas do mês
                                    </button>
                                </a>
                            </div>
                        </div>

                        </br>

                        <div class="row">
                            <div class="col-sm-12">
                                <a href="<?php echo base_url(); ?>Relatorio/outrosPagamentos/0" target="_blank" > <button style="height: 6.4rem; width: 85%; margin: auto" class="btn btn-space btn-cinza btn-xs btn-block" type="button">
                                        <i class="fa fa-list"></i>
                                        Todos outros pagamentos do mês
                                    </button>
                                </a>
                            </div>
                        </div>

                        </br>

                        <div class="row">
                            <div class="col-sm-12">
                                <button style="height: 6.4rem; width: 85%; margin: auto" class="btn btn-space btn-cinza btn-xs btn-block" type="button">
                                    <i class="fa fa-list"></i>
                                    Todos alunos inadimplentes do mês
                                </button>
                            </div>
                        </div>

                    </div>
                </section>
            </div>


            <div class="col-lg-8">
                <section class="panel">
                    <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Relatórios Customizáveis</strong></div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <section class="panel">

                                    <div class="panel-body">

                                        <?php echo form_open('relatorio/FluxoCaixa', array('target' => '_blank', 'enctype' => 'multipart/form-data', 'id' => 'FormAddCategoria')); ?>

                                        <div class="row">

                                            <div class="col-lg-4" id="data_inicio">
                                                <div class="form-group">
                                                    <label>Exibir de</label>
                                                    <div class="iconic-input">
                                                        <i class="fa fa-calendar"></i>
                                                        <input type="text" name="data_inicio" data-mask="99/99/9999" value="<?php echo date('d/m/Y'); ?>" required="required" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-4" id="data_fim">
                                                <div class="form-group">
                                                    <label>Exibir até</label>
                                                    <div class="iconic-input">
                                                        <i class="fa fa-calendar"></i>
                                                        <input type="text" name="data_fim" data-mask="99/99/9999" value="<?php echo date('d/m/Y'); ?>"  required="required" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-8" id="meses" style="display: none">
                                                <div class="form-group">
                                                    <label>Mês</label>
                                                    <select name="mes" class="form-control">
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                </div>
                                            </div>




                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Tipo de Relatório</label>
                                                    <select onchange="TipoRelatorio();" id="tipo_relatorio" name="tipo_relatorio" class="form-control">
                                                        <option value="1">Geral</option>
                                                        <option value="2">Pagamentos de alunos</option>
                                                        <option value="3">Contas a pagar e receber</option>
                                                        <option value="4">Contas a receber</option>
                                                        <option value="5">Contas a pagar</option>
                                                        <option value="6">Outros Pag de alunos</option>
                                                        <option value="7">Adimplentes</option>
                                                        <option value="8">Inadimplentes</option>
                                                    </select> 
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Tipo de pagamento</label>
                                                    <select name="tipo_pagamento" class="form-control">
                                                        <option value="0">Todos</option>
                                                        <option value="1">À Vista</option>
                                                        <option value="2">C. Crédito</option>
                                                        <option value="3">C. Débito</option>
                                                        <option value="4">Cheque</option>
                                                        <option value="5">Boleto</option>
                                                        <option value="6">Tranferência Bancária</option>
                                                    </select> 
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Curso</label>
                                                    <select name="curso_id" class="form-control">
                                                        <option value="0">Todos</option>
                                                        <?php foreach ($cursos as $row): ?>
                                                            <option value="<?php echo $row['cursos_id']; ?>"><?php echo $row['cur_tx_descricao']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select> 
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Turma</label>
                                                    <select class="form-control">
                                                        <option value="1">Geral</option>
                                                        <option value="2">Entradas e Pag de alunos</option>
                                                        <option value="2">Contas a pagar e receber</option>
                                                        <option value="2">Contas a receber</option>
                                                        <option value="2">Contas a pagar</option>
                                                        <option value="2">Outros Pag de alunos</option>
                                                    </select> 
                                                </div>
                                            </div>

                                        </div>


                                        <hr/>


                                        <div class="row">
                                            <div class="col-lg-12"> 
                                                <button type="submit" class="btn btn-default pull-right "><i class="fa fa-search"></i> Gerar relatório</button>
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
        </div>
    </section>
</section>

<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>

<script>

    function TipoRelatorio() {

        var tipo_relatorio = $("#tipo_relatorio").val();
        if (tipo_relatorio == 7) {
            $("#data_inicio").hide();
            $("#data_fim").hide();
            $("#meses").show();

        } else {
            $("#data_inicio").show();
            $("#data_fim").show();
            $("#meses").hide();
        }
    }

</script>