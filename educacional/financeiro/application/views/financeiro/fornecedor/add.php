<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVO FORNECEDOR</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <div class="panel-body">

                                    <?php echo form_open('fornecedor/add', array('enctype' => 'multipart/form-data', 'id' => 'FormAddFornecedor')); ?>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Razão Social</label>
                                                <input type="text" name="razaosocial" required="required" class="form-control" id="razaosocial" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nome Fantasia</label>
                                                <input type="text" name="nome_fantasia" required="required" class="form-control"  required="required">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Telefone</label>
                                                <input type="text" name="telefone" data-mask="(99) 9999-9999" class="form-control"  required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input name="celular" data-mask="(99) 99999-9999" class="form-control" >
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control">
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>CEP</label>
                                                <input type="text" name="cep" maxlength="8" minlength="8" id="cep" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Endereço</label>
                                                <input type="text" name="endereco" id="endereco" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="text" name="numero" required="required" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Bairro</label>
                                                <input type="text" name="bairro"  id="bairro" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>UF</label>
                                                <input type="text" name="uf" id="uf" required="required" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Cidade</label>
                                                <input type="text" name="cidade" id="cidade"  class="form-control" required="required">
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Complemento</label>
                                                <input type="text" name="complemento" class="form-control">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tipo Pessoa</label>
                                                <select required="required" class="form-control" id="tipo_pessoa" onchange="MudaTipo()" name="tipo_pessoa">
                                                    <option value="">Selecione o Tipo</option>
                                                    <option value="1">Física</option>
                                                    <option value="2">Jurídica</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-lg-4" id="cpf" style="display: none;">
                                            <div class="form-group">
                                                <label>CPF</label>
                                                <input type="text"  name="cpf" required="required" data-mask="999-999-999-99" id="cpf" class="form-control"  >
                                            </div>
                                        </div>


                                        <div class="col-lg-4" id="rg" style="display: none;">
                                            <div class="form-group">
                                                <label>RG</label>
                                                <input type="text" name="rg" class="form-control">
                                            </div>
                                        </div>




                                        <div class="col-lg-4" id="cnpj">
                                            <div class="form-group">
                                                <label>CNPJ</label>
                                                <input type="text" name="cnpj" data-mask="99.999.999/9999-99"  class="form-control" required="required">
                                            </div>
                                        </div>


                                        <div class="col-lg-4" id="inscestadual">
                                            <div class="form-group">
                                                <label>INSC ESTADUAL</label>
                                                <input type="text" name="inscestadual" class="form-control">
                                            </div>
                                        </div>



                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Insc Municipal</label>
                                                <input type="text" name="inscmunicipal"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Seguimento</label>
                                                <input type="text" name="seguimento" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <br/>
                                            <button type="submit" class="btn btn-info">CADASTRAR</button>
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
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/bootstrap-inputmask.min.js"></script>
<script>
                                                    function MudaTipo() {

                                                        var tipo = $("#tipo_pessoa").val();

                                                        if (tipo == 1) {
                                                            $("#cpf").show();
                                                            $("#rg").show();
                                                            $("#cnpj").hide();
                                                            $("#inscestadual").hide();

                                                        } else if (tipo == 2) {

                                                            $("#cpf").hide();
                                                            $("#rg").hide();
                                                            $("#cnpj").show();
                                                            $("#inscestadual").show();
                                                        } else {
                                                            $("#cpf").hide();
                                                            $("#rg").hide();
                                                            $("#cnpj").show();
                                                            $("#inscestadual").show();
                                                        }
                                                    }
</script>



<script type="text/javascript" >

    $(document).ready(function () {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }
        //Quando o campo cep perde o foco.
        $("#cep").blur(function () {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...")
                    $("#bairro").val("...")
                    $("#cidade").val("...")
                    $("#uf").val("...")
                    $("#ibge").val("...")

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });

</script>