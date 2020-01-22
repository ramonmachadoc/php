<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-4">

                        <aside class="profile-nav alt blue-border">
                            <section class="panel">
                                <div class="user-heading alt blue-bg">
                                    <a href="#">

                                        <?php
                                        $arquivo = "upload/aluno/" . $turma['cadastro_aluno_id'] . ".jpg";

                                        if (file_exists($arquivo)) {
                                            ?>
                                            <img src="<?php echo base_url(); ?>upload/aluno/<?php echo $turma['cadastro_aluno_id']; ?>.jpg" alt="">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="<?php echo base_url(); ?>template/img/sem-imagem.png" alt="">
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <h1>
                                        <?php
                                        $temp = explode(" ", $turma['nome']);
                                        echo $nomeNovo = $temp[0] . " " . $temp[count($temp) - 1];
                                        ?></h1>

                                    </h1>
                                    <p><?php echo $turma['email']; ?></p>
                                </div>

                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-user"></i> Pagamento </a></li>
                                    <li ><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-share"></i> Receber Pagamento</a></li>
                                    <li ><a href="<?php echo base_url(); ?>ReceberPagamento/historicoFinanceiro/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-calendar"></i> Histórico Financeiro<span class="label label-danger pull-right r-activity"></span></a></li>
                                    <li ><a href="<?php echo base_url(); ?>OutrosPagamentos/outros/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-money"></i> Outros Pagamentos<span class="label label-danger pull-right r-activity"></span></a></li>
                                    <li ><a href="<?php echo base_url(); ?>Notificacao/notificacao/<?php echo $turma['matricula_aluno_id']; ?>"> <i class="fa fa-bell"></i> Notificação<span class="label label-danger pull-right r-activity"></span></a></li>
                            </section>
                        </aside>
                    </div>

                    <aside class="profile-info col-lg-8">
                        <section class="panel">

                            <div class="panel-body" style="font-size: 15px;">

                                <?php
                                $dadosIngresso = $this->financeiro_model->PeriodLetivo($turma['matricula_aluno_id']);
                                $dadosMatriz = $this->financeiro_model->MatrizAtual($turma['matriz_id']);

                                if ($dadosIngresso['periodo_letivo_id']) {
                                    $dadosPeriodo = $this->financeiro_model->PeriodAtual($dadosIngresso['periodo_letivo_id']);
                                    $ano_igresso = $dadosPeriodo['periodo_letivo'];
                                } else {
                                    $ano_igresso = $dadosIngresso['ano'] . '/' . $dadosIngresso['semestre'];
                                }
                                ?>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <header class="panel-heading">
                                            <b>EFETUAR PAGAMENTO</b>
                                        </header>
                                    </div>
                                </div>
                                <br/>
                                <?php
                                $dadosPeriodos = $this->financeiro_model->PeriodCoursed($turma['matricula_aluno_id'], 0);
                                ?>


                                <div class="row">
                                    <div class="col-lg-12">
                                        <section class="panel">

                                            <?php echo form_open('ReceberPagamento/efetuarPagamento/' . $id_aluno, array('enctype' => 'multipart/form-data', 'id' => 'FormPagMatriculaa')); ?>
                                            <input type="hidden" name="mensalidade_id" value="<?php echo $mensalidade['mensalidade_id']; ?>"/>


                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Data Pagamento</label>
                                                        <input type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control" required="required" id="calendario3" name="pagamento" id="pagamento">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Data do Vencimento</label>
                                                        <input type="text" value="<?php echo FormatarData($mensalidade['men_dt_vencto']); ?>"   name="pagamento2"  class="form-control" id="pagamento2" required="required">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">

                                                <div class="col-lg-6" id="div_forma_pagamento">
                                                    <div class="form-group">
                                                        <label>Forma de Pagamento</label>
                                                        <select  onchange="TipoConta();" id="forma_pagamento"  name="forma_pagamento" class="form-control">
                                                            <option value="1">À Vista</option>
                                                            <option value="2">C. Crédito</option>
                                                            <option value="3">C. Débito</option>
                                                            <option value="4">Cheque</option>
                                                            <option value="5">Boleto</option>
                                                            <option value="6">Tranferência Bancária</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-lg-2" id="qtd_parcelas" style="display: none">
                                                    <div class="form-group">
                                                        <label>Parcelas</label>
                                                        <input type="text" name="qtd_parcelas" class="form-control" >
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor a Pagar</label>
                                                        <input type="text" value="<?php echo FormatarValor($mensalidade['men_fl_valor']); ?>" data-mask="999,99" name="valor_curso" id="valor_curso" class="form-control"  required="required">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Desconto (%)</label>
                                                        <input type="text" class="form-control" name="desconto" id="calendario3" placeholder="% de desconto" minlength="1" maxlength="3" onkeyup="document.getElementById('desconto2').value = formatReal(arred((this.value / 100) * parseFloat(document.getElementById('valor_curso').value), 2) * 100);
                                                                atualizar_valor_pagar();">
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor do Desconto R$ </label>
                                                        <input type="text"  name="desconto2" value="0" required="required" class="form-control" id="desconto2">
                                                    </div >
                                                </div>

                                            </div>


                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Juros (%)</label>
                                                        <input type="text" 
                                                               onkeyup=" var valor_com_juros = 0;
                                                                       for (i = 0; i < meses_atrasados; i++) {
                                                                           var valor_somado = parseFloat(document.getElementById('valor_curso').value) + valor_com_juros;
                                                                           valor_com_juros += (this.value / 100) * valor_somado;
                                                                       }
                                                                       var resultado_juros = arred(valor_com_juros, 2);

                                                                       document.getElementById('juros2').value = resultado_juros;
                                                                       atualizar_valor_pagar();"
                                                               class="form-control" maxlength="3" minlength="1" placeholder="% de juros" id="juros" name="juros"  >

                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor do Juros R$ </label>
                                                        <input type="text"  value="0" maxlength="3" minlength="1"  id="juros2" name="juros2"  class="form-control" >

                                                    </div >
                                                </div>

                                            </div>


                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Multa (%)</label>
                                                        <input type="text" 
                                                               onkeyup="document.getElementById('multa2').value = formatReal(arred(((this.value / 100) * parseFloat(document.getElementById('valor_curso').value)), 2) * 100);
                                                                       atualizar_valor_pagar();"
                                                               maxlength="3" minlength="1" placeholder="% da multa" id="multa" name="multa"  class="form-control">
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor da Multa R$  </label>
                                                        <input type="text" name="multa2"  value="0" required="required" class="form-control" id="multa2" >
                                                    </div >
                                                </div>

                                            </div>


                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Bolsa/Financiamento (%)</label>
                                                        <input type="text" class="form-control" name="bolsa" id="bolsa" placeholder="% da bolsa" minlength="1" maxlength="3" onkeyup="document.getElementById('bolsa2').value = ((this.value / 100) * parseFloat(document.getElementById('valor_curso').value));
                                                                atualizar_valor_pagar();"  value="0">
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor da Bolsa R$  </label>
                                                        <input type="text" name="bolsa2" readonly="true" value="0" required="required" class="form-control" id="bolsa2">
                                                    </div >
                                                </div>

                                            </div>



                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Financiamento (%)</label>
                                                        <input type="text" class="form-control" name="financiamento" id="financiamento" placeholder="% da bolsa" minlength="1" maxlength="3" onkeyup="document.getElementById('financiamento2').value = ((this.value / 100) * parseFloat(document.getElementById('valor_curso').value));
                                                                atualizar_valor_pagar();" onkeypress="return SomenteNumero(event);" value="0">
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor Financ R$ </label>
                                                        <input type="text" name="financiamento2" value="0" readonly="true" required="required" class="form-control" id="financiamento2">
                                                    </div >
                                                </div>

                                            </div>


                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor a Pagar R$ (%)</label>
                                                        <input type="text" name="valor_pago2" readonly="true" required="required" class="form-control" id="valor_pago2">
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Valor Pago R$  </label>
                                                        <input type="text" required="required" data-mask="999,99" name="valor_pago" class="form-control" id="valor_pago">
                                                    </div >
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-lg-12"> 
                                                    <br/>
                                                    <button type="submit" class="btn btn-info">SALVAR</button>
                                                </div>
                                            </div>


                                        </section>
                                    </div>
                                </div>
                                <br/>
                            </div>
                        </section>
                    </aside>
                </div>

            </div>

        </div>
    </section>
</section>

<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>

<input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="data_hoje">
<input type="hidden" value="<?php echo $mensalidade['men_dt_vencto']; ?>" id="data_vencimento">

<script>





                                                                    var DateDiff = {
                                                                        inMonths: function (d1, d2) {
                                                                            d1 = new Date(d1);
                                                                            d2 = new Date(d2);
                                                                            var d1Y = d1.getFullYear();
                                                                            var d2Y = d2.getFullYear();
                                                                            var d1M = d1.getMonth();
                                                                            var d2M = d2.getMonth();

                                                                            return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
                                                                        }}
                                                                    var dataInicion = document.getElementById("data_vencimento").value;
                                                                    var dataFinaln = document.getElementById("data_hoje").value;



                                                                    function arred(d, casas) {
                                                                        var aux = Math.pow(10, casas)
                                                                        return Math.floor(d * aux) / aux
                                                                    }

//                                                                    var total = (((Date.parse(document.getElementById('data_hoje').value)) - (Date.parse(document.getElementById('data_vencimento').value))) / (1000 * 60 * 60 * 24));
//                                                                    var mesestotal = total / 30;



                                                                    var dataInicio = new Date(document.getElementById('data_vencimento').value);
                                                                    var dataFim = new Date(document.getElementById('data_hoje').value);


                                                                    var diffMilissegundos = dataFim - dataInicio;


                                                                    var diffSegundos = diffMilissegundos / 1000;
                                                                    var diffMinutos = diffSegundos / 60;
                                                                    var diffHoras = diffMinutos / 60;
                                                                    var diffDias = diffHoras / 24;
                                                                    var diffMeses = diffDias / 30;


                                                                    // var meses_atrasados = arred(mesestotal, 0);
                                                                    var meses_atrasados = DateDiff.inMonths(dataInicion, dataFinaln);
                                                                    console.log(meses_atrasados);


                                                                    function atualizar_valor_pagar() {
                                                                        var valor_pagar_curso = parseFloat(document.getElementById('valor_curso').value);
                                                                        var multa = parseFloat(document.getElementById('multa2').value.replace(',', '.'));
                                                                        var bolsa = document.getElementById('bolsa2').value;
                                                                        var financiamento = document.getElementById('financiamento2').value;

                                                                        var total_pagar = valor_pagar_curso + (document.getElementById('juros2').value - parseFloat(document.getElementById('desconto2').value.replace(',', '.')));

                                                                        //  var total_com_multa =  total_pagar + multa;
                                                                        // var total_com_multa_arr = (Math.floor(total_com_multa * Math.pow(10,2))/Math.pow(10,2));

                                                                        var valor_apagar = (total_pagar - bolsa) + multa - financiamento;


                                                                        var geral = Math.floor(valor_apagar * Math.pow(10, 2)) / Math.pow(10, 2);// (Math.floor(valor_apagar * Math.pow(10,2))/Math.pow(10,2)) ;
                                                                        document.getElementById('valor_pago2').value = formatReal(arred(geral * 100, 2));




                                                                        // alert(multa);

                                                                        //return valor_apagar;
                                                                    }


</script>

<script>
    window.onload = function () {
        atualizar_valor_pagar();
    }
</script>


<script>
    console.log(formatReal(1000));
    function formatReal(int)
    {
        var tmp = int + '';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if (tmp.length > 6)
            tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
    }
</script>



<script>


    function TipoConta() {

        var forma_pagamento = $("#forma_pagamento").val();
        if (forma_pagamento == 2) {
            document.getElementById('div_forma_pagamento').className = 'col-lg-4';
            $("#qtd_parcelas").show();

        } else {

            document.getElementById('div_forma_pagamento').className = 'col-lg-6';
            $("#qtd_parcelas").hide();
        }
    }

</script>