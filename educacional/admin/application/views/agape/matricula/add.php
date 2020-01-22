<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-12">

            <section class="panel">

                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> NOVA MATRÍCULA</strong></div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <div class="panel-body">
                                    <div class="stepy-tab">
                                        <ul id="default-titles" class="stepy-titles clearfix">
                                            <li id="default-title-0" class="current-step">
                                                <div>DADOS PESSOAIS</div>
                                            </li>

                                            <li id="default-title-1" class="">
                                                <div>Step 2</div>
                                            </li>

                                            <li id="default-title-2" class="">
                                                <div>Step 3</div>
                                            </li>

                                            <li id="default-step-3" class="">
                                                <div>Step 4</div>
                                            </li>

                                            <li id="default-step-4" class="">
                                                <div>Step 5</div>
                                            </li>
                                        </ul>
                                    </div>

                                    <?php echo form_open('educacional/matricula/create', array('enctype' => 'multipart/form-data', 'id' => 'default')); ?>
                                    <fieldset title="DADOS PESSOAIS" class="step" id="default-step-0">
                                        <legend> </legend>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Curso</label>
                                                    <select name="curso" id="curso" onchange="buscar_turma_matricula()" required="required" class="form-control">
                                                        <option value="nada">Selecione o curso</option>

                                                        <?php
                                                        foreach ($cursos as $row):
                                                            ?>
                                                            <option value="<?php echo $row['cursos_id']; ?>"><?php echo $row['cur_tx_descricao']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>             


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group"  id="load_turma_matricula">
                                                    <label>Turma</label>
                                                    <select required="required" class="form-control" name="turma" id="turma">
                                                        <option value="">Selecione um Curso</option>
                                                    </select>  
                                                </div>
                                            </div>
                                            
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group"   id="load_desperiozado_matricula_nova">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group" id="load_add_disciplina_desperiodizado_mn">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group" id="load_disciplina_matricula_nova">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group" id="load_desperiodizado_tabela_mn">
                                                </div>
                                            </div>
                                        </div>

                                        <header class="panel-heading">
                                            DADOS PESSOAIS
                                        </header>

                                        <br/>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="col-sm-3 col-sm-3">Usar imagens com tam. 100x200px ou maiores</label>
                                                <div class="form-group last">
                                                    <label class="control-label col-md-3"></label>
                                                    <div class="col-md-9">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="<?php echo base_url(); ?>template/img/sem-imagem.png" alt="" />
                                                            </div>
                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                            <div>
                                                                <span style="width: 200px;" class="btn btn-white btn-file">
                                                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> selecionar imagem</span>
                                                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> trocar</span>
                                                                    <input type="file" name="img" class="default" />
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> excluir</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nome</label>
                                                    <input name="nome" id="nome" required="required" type="text" class="form-control" placeholder="Nome">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Data Nascimento</label>
                                                    <input name="data_nascimento"  id="data_nascimento" required="required" type="text" class="form-control" placeholder="03/10/1991">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">País Origem</label>
                                                    <select name="pais_origem" id="curso" required="required" class="form-control">
                                                        <option value="">Selecione o País</option>
                                                        <?php
                                                        foreach ($pais as $row_pais):
                                                            ?>
                                                            <option value="<?php echo $row_pais['codigo']; ?>"><?php echo $row_pais['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>             
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Estado Origem</label>
                                                    <select required="required" name="uf_nascimento" id="uf_nascimento" onchange="buscar_municipio()" class="form-control">
                                                        <option value="">Selecione o UF</option>
                                                        <?php
                                                        foreach ($uf as $row_uf):
                                                            ?>
                                                            <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>         
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group" id="load_muncipio_matricula_nova">
                                                    <label for="exampleInputEmail1">Cidade Origem</label>
                                                    <select required="required" class="form-control" name="cidade_origem">
                                                        <option value="">Selecione a Cidade</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Sexo</label>
                                                    <select required="required" class="form-control" name="sexo">
                                                        <option value="">Selecione o Sexo</option>
                                                        <option value="0">Masculino</option>
                                                        <option value="1">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Estado Civil</label>
                                                    <select class="form-control" name="estado_civil">
                                                        <option value="1">Solteiro(a)</option>
                                                        <option value="2">Casado(a)</option>
                                                        <option value="3">Divorciado(a)</option>
                                                        <option value="4">Viuvo(a)</option>
                                                        <option value="5">Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset  title="DOCUMENTOS" class="step" id="default-step-1" >
                                        <legend> </legend>

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">CPF</label>
                                                    <input name="cpf" id="cpf" required="required" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">RG</label>
                                                    <input name="rg" required="required" type="text" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">RG UF</label>
                                                    <select required="required" name="rg_uf" id="rg_uf"  class="form-control">
                                                        <option value="">Selecione o UF</option>
                                                        <?php
                                                        foreach ($uf as $row_uf):
                                                            ?>
                                                            <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>         
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">RG orgão Expeditor</label>
                                                    <input name="rg_orgao_expeditor" required="required" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Título</label>
                                                    <input name="titulo" required="required" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">UF Título</label>
                                                    <select required="required" name="uf_titulo" id="uf_titulo" class="form-control">
                                                        <option value="">Selecione o UF</option>
                                                        <?php
                                                        foreach ($uf as $row_uf):
                                                            ?>
                                                            <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>         
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Documento Estrangeiro</label>
                                                    <input name="documento_estrangeiro" type="text" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Certidão Reservista</label>
                                                    <input name="certidao_reservista" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Uf Certidão Reservista</label>
                                                    <select class="form-control"name="uf_certidao" id="uf_certidao" >
                                                        <option value="0">Selecione o UF</option>
                                                        <?php
                                                        foreach ($uf as $row_uf):
                                                            ?>
                                                            <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset title="INF SOCIOE." class="step" id="default-step-2" >
                                        <legend> </legend>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Quantos irmãos você tem ?</label>
                                                    <select class="form-control" required="required"  NAME="SE_txIrmaos">
                                                        <option value="">Escolha uma opção</option>
                                                        <option value="1">Nenhum</option>
                                                        <option value="2">Um</option>
                                                        <option value="3">Dois</option>
                                                        <option value="4">Três</option>
                                                        <option value="5">Quatro ou Mais</option>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Quantos filhos você tem ?</label>
                                                    <select required="required" class="form-control" required="true"  NAME="SE_txFilhos">
                                                        <option value="">Escolhe uma opção</option>
                                                        <option value="1">Nenhum</option>
                                                        <option value="2">Um</option>
                                                        <option value="3">Dois</option>
                                                        <option value="4">Três</option>
                                                        <option value="5">Quatro ou Mais</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Você mora com quem ?</label>
                                                    <select class="form-control" required="required"  NAME="SE_txReside">
                                                        <option value="">Escolha uma opção</option>
                                                        <option value="1">Com pais e(ou) parentes</option>
                                                        <option value="2">Esposo(a) e(ou) com os filho(s)</option>
                                                        <option value="3">Com amigos(compartilhando despesas ou de favor)</option>
                                                        <option value="4">Com colegas, em alojamento universit&aacute;rio</option>
                                                        <option value="5">Sozinho(a)</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Faixa de renda mensal ?</label>
                                                    <select class="form-control" required="required" NAME="SE_txRenda">
                                                        <option value="" >Escolha uma opção</option>
                                                        <option value="1" >Até 3 salários mínimos</option>
                                                        <option value="2">Mais de 3 Até 10 salários mínimos</option>
                                                        <option value="3">Mais de 10 Até 20 salários mínimos</option>
                                                        <option value="4">Mais de 20 Até 30 salários mínimos</option>
                                                        <option value="5">Mais de 30 salários mínimos</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Quantas pessoas moram com você ?</label>
                                                    <select  class="form-control" required="required"  NAME="SE_txMembros">
                                                        <option value="">Escolha uma opçao</option>
                                                        <option value="1">Nenhuma</option>
                                                        <option value="2">Um ou dois</option>
                                                        <option value="3">Três ou quatro</option>
                                                        <option value="4">Cinco ou seis</option>
                                                        <OPTION value="5">Mais de seis</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Qual situação descreve seu caso ?</label>
                                                    <select class="form-control"  required="required" NAME="SE_txTrabalho">
                                                        <option value="">Escolha uma opçao</option>
                                                        <option value="1">Não trabalho e meus gastos são financiados pela fam&iacute;lia</option>
                                                        <option value="2">Trabalho e recebo ajuda da fam&iacute;lia</option>
                                                        <option value="3">Trabalho e me sustento</option>
                                                        <option value="4">Trabalho e contribuo com o sustento da fam&iacute;lia</option>
                                                        <option value="5">Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Você tem bolsa ou financiamento estudantil ?</label>
                                                    <select class="form-control" required="true"  NAME="SE_txBolsa">
                                                        <option value="">Escolha uma opção</option>
                                                        <option value="1">Financiamento Estudantil</option>
                                                        <option value="2">Prouni integral</option>
                                                        <option value="3">Prouni parcial</option>
                                                        <option value="4">Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o</option>
                                                        <option value="5">Bolsa integral ou parcial oferecida porentidadesexternas</option>
                                                        <option value="6">Outro(s)</option>
                                                        <option value="7">Nenhum</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Se Trabalha, Qual A C.H. ?</label>
                                                    <select class="form-control" required="required"  NAME="SE_txCH">
                                                        <option value="">Escolha uma opção</option>
                                                        <option value="1">Não trabalho/ nunca exerci atividade remunerada.</option>
                                                        <option value="2">Trabalho/ trabalhei eventualmente</option>
                                                        <option value="3">Trabalho/ trabalhei at&eacute; 20 horas semanais</option>
                                                        <option value="4">Trabalho/ trabalhei mais de 20 horas semanais e menos de 40 horas semanais</option>
                                                        <option value="5">Trabalho/ trabalhei em tempo integral - 40 horas semanais ou mais</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                    </fieldset>


                                    <fieldset title="ENDEREÇO" class="step" id="default-step-3">
                                        <legend> </legend>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">CEP</label>
                                                    <input type="text" name="cep" id="cep" required="required" class="form-control"  placeholder="Cep">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Endereço</label>
                                                    <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço">
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bairro</label>
                                                    <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">UF</label>
                                                    <select  class="form-control" required="required" name="uf" id="uf" onchange="buscar_cidade()">
                                                        <option id="cidade" value="">Selecione o UF</option>
                                                        <?php
                                                        foreach ($uf as $row_uf):
                                                            ?>
                                                            <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group" id="load_cidade">
                                                    <label >Cidade</label>
                                                    <select class="form-control" required="required">
                                                        <option value="">Selecione a UF</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label >Complemento</label>
                                                    <input  type="text" class="form-control" name="complemento" placeholder="Complemento">
                                                </div>
                                            </div>
                                        </div>


                                        <header class="panel-heading">
                                            CONTATOS
                                        </header>

                                        <br/>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Fone</label>
                                                    <input type="text" class="form-control" maxlength="10"  id="fone" name="fone" placeholder="Fone"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group" id="load_cidade">
                                                    <label>Celular</label>
                                                    <input type="text" class="form-control" maxlength="10"  id="celular" name="celular" placeholder="Celular"/>
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" minlength="10" name="email" id="email" placeholder="Email"/>
                                                </div>
                                            </div>
                                        </div>


                                    </fieldset>

                                    <fieldset title="INFORMAÇÕES" class="step" id="default-step-4">
                                        <legend> </legend>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nacionalidade</label>
                                                    <select class="form-control" required="required" name="nacionalidade">
                                                        <option value="1">Brasileiro(a)</option>
                                                        <option value="2">Brasileiro(a) nascido no exterior ou naturalizado</option>
                                                        <option value="3">Extrangeiro</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Cor/raça</label>
                                                    <select class="form-control" required="required" name="cor">
                                                        <option value="">Selecione uma cor/raça</option>
                                                        <option value="1">Branca</option>
                                                        <option value="2">Preta</option>
                                                        <option value="3">Parda</option>
                                                        <option value="4">Amarela</option>
                                                        <option value="5">Indígena</option>
                                                        <option value="0">Não quis declarar</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Mãe</label>
                                                    <input type="text" class="form-control" required="required" minlength="8" name="mae" placeholder="Mãe"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Pai</label>
                                                    <input type="text" class="form-control" name="pai" placeholder="Pai"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Conjuge</label>
                                                    <input type="text" class="form-control" name="pai" placeholder="Conjuge"/>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Tem Alguma Deficiência?</label>
                                                    <select class="form-control" name="deficiencia" id="deficiencia" onchange="buscar_deficiencia()">
                                                        <option value="0">NÃO</option>
                                                        <option value="1">SIM</option>
                                                        <option value="2">NÃO INFORMADO</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Tipo De Escola Que Concluiu O Ens. Médio </label>
                                                    <select class="form-control" name="tipo_escola" id="tipo_escola" >
                                                        <option value="0">PRIVADO</option>
                                                        <option value="1">PUBLICO</option>
                                                        <option value="2">NÃO DISPÕE DA INFORMAÇÃO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Forma De Ingresso</label>
                                                    <select class="form-control" name="forma_ingresso" id="forma_ingresso" >
                                                        <option value="1">VESTIBULAR</option>
                                                        <option value="2">ENEM</option>
                                                        <option value="3">AVALIAÇÃO SERIADA</option>
                                                        <option value="4">SELEÇÃO SIMPLIFICADA</option>
                                                        <option value="5">TRANSFERÊNCIA</option>
                                                        <option value="6">DECISÃO JUDICIAL</option>
                                                        <option value="7">VAGAS REMANESCENTE</option>
                                                        <option value="8">PROGRAMAS ESPECIAIS</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <header class="panel-heading">
                                            INFORMAÇÕES DO RESPONSÁVEL
                                        </header>

                                        <br/>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Responsavel</label>
                                                    <input class="form-control" type="text" name="responsavel"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Fone Responsavel</label>
                                                    <input type="text" class="form-control" name="fone_responsavel"/>
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>RG Responsavel</label>
                                                    <input type="text" class="form-control" name="rg_responsavel"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>CPF Responsável</label>
                                                    <input class="form-control" data-mask="999-99-999-9999-9" type="text" name="cpf_responsavel"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Celular Responsável</label>
                                                    <input class="form-control" type="text" name="celular_responsavel"/>
                                                </div>
                                            </div>

                                        </div>


                                        <header class="panel-heading">
                                            OBSERVAÇÕES GERAIS
                                        </header>
                                        <br/>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>OBSERVAÇÕES</label>
                                                    <textarea name="obs_documento" class="form-control" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <br/>
                                    </fieldset>

                                    <input type="submit" class="finish btn btn-danger" value="Finish"/>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </section>
</section>

<script>
    $(function () {
        $('#default').stepy({
            backLabel: 'Anterior',
            validate: true,
            block: true,
            nextLabel: 'Próximo',
            titleClick: true,
            titleTarget: '.stepy-tab'
        });
    });
    // busca turmas, conforme curso selecioando
    function buscar_turma_matricula() {
        var curso = $('#curso').val(); //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = '../educacional/carrega_turma_matricula/' + curso; //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma_matricula').html(dataReturn); //coloco na div o retorno da requisicao
            });
        }
    }

    //busca aluno desperiorizado
    function buscar_desperiorizado_matricula() {
        var url = '../educacional/carrega_div_desperiorizado/'; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_desperiozado_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
        });
        buscar_disciplina_desperiodizado_tabela_mn();
    }

    function buscar_disciplina_desperiodizado_tabela_mn() {
        //  var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        //se encontrou o estado
        var url = '../educacional/carrega_disciplina_desperiodizado_tabela_mn/'; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_desperiodizado_tabela_mn').html(dataReturn); //coloco na div o retorno da requisicao

        });
    }

    function buscar_disciplina_matricula_nova() {

        var curso = $('#curso').val();
        var turma = $('#turma').val(); //codigo do estado escolhido

        //se encontrou o estado
        var url = '../educacional/carrega_disciplina_matricula_nova/' + curso + '/' + turma; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_disciplina_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
        });
    }
    function adicionar_disciplina_desperiodizado_mn() {
        // var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        var turma = $('#turma').val(); //codigo da turma selecionada
        var matriz_disciplina_id = $('#matriz_disciplina_id_mn').val(); //codigo do id da tabela matriz_disciplina, onde chega no id da disciplina

        //se encontrou o estado
        var url = '../educacional/insert_disciplina_desperiodizado_mn/' + turma + '/' + matriz_disciplina_id; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_add_disciplina_desperiodizado_mn').html(dataReturn); //coloco na div o retorno da requisicao
        });
        buscar_disciplina_desperiodizado_tabela_mn();
        // buscar_ficha_periodizado(matricula_aluno_id);
    }

    function apagar_disciplina_desperiodizado(disciplina_desperiodizado_id) {
        var id_disciplina_desperiodizado = disciplina_desperiodizado_id; //$('#disciplina_desperiodizado_id').val(); //codigo do id da tabela matricula_aluno
        // var matricula_aluno_id = $('#matricula_aluno_id').val();
        //se encontrou o estado
        var url = '../educacional/delete_disciplina_desperiodizado_mn/' + id_disciplina_desperiodizado; //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function (dataReturn) {
            $('#load_desperiozado_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
        });
        buscar_disciplina_desperiodizado_tabela_mn();
        //buscar_ficha_periodizado_um();
    }


    function buscar_municipio() {

        var uf = $('#uf_nascimento').val(); //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = '../educacional/carrega_municipio_matricula_nova/' + uf; //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_matricula_nova').html(dataReturn); //coloco na div o retorno da requisicao
            });
        }
    }


    function buscar_cidade() {

        var uf2 = $('#uf').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf2) {
            var url = '../educacional/carrega_cidade/' + uf2;  //caminho do arquivo php que irÃ¡ buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_cidade').html(dataReturn);  //coloco na div o retorno da requisicao
            });
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
<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>