
<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-10">

            <section class="panel">

                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVO PROFESSOR</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <?php echo form_open('professor/add', array('enctype' => 'multipart/form-data', 'id' => 'FormAddProfessor')); ?>

                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" required="required" name="nome" id="nome" required="required" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Data de Nascimento</label>
                                                <input type="text" data-mask="99/99/9999" name="nascimento" required="required" class="form-control" placeholder="00/00/0000">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select name="sexo" required="required" class="form-control">
                                                    <option value="">Selecione o Sexo</option>
                                                    <option value="F">Feminino</option>
                                                    <option value="M">Masculino</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>CEP</label>
                                                <input type="text" name="cep" required="required" name="curso" id="cep" class="form-control"  placeholder="Digite o CEP">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Endereço</label>
                                                <input type="text" name="endereco" required="required" id="endereco" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Bairro</label>
                                                <input type="text" required="required" name="bairro" id="bairro"  class="form-control">
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Cidade</label>
                                                <input type="text" name="cidade" required="required" id="cidade" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <input type="text" name="uf" required="required" id="uf" class="form-control">
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
                                                <label>Situação</label>

                                                <select name="situacao" required="required" class="form-control">
                                                    <option value="">Selecione o Sexo</option>
                                                    <option value="A">ATIVO</option>
                                                    <option value="0">INATIVO</option>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Login</label>
                                                <input type="text" name="login" required="required"  class="form-control" placeholder="Digite o Login">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="password" name="senha" required="required"  class="form-control" placeholder="*************">
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
                            </section>
                        </div>
                        </section>
                    </div>
            </section>
    </section>

    <script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>
    <script type="text/javascript" >

        $(document).ready(function () {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");

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


                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
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