<section id="main-content">
    <section class="wrapper">


        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> PAINEL ADMINISTRATIVO</a></li>
                    <li><a href="<?php echo base_url(); ?>ReceberPagamento/pagamentosAlunos/"><i class="fa fa-book"></i> BIBLIOTECA</a></li>
                    <li class="active"><i class="fa fa-table"></i> LISTA DE LIVROS</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>


        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-heading"><strong><span class="glyphicon glyphicon-book"></span> NOVO LIVRO</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">

                                    <div class="panel-body">

                                        <?php echo form_open('biblioteca/CreateLivro', array('enctype' => 'multipart/form-data', 'id' => 'FormAddLivro')); ?>


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
                                                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar imagem</span>
                                                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Trocar</span>
                                                                    <input type="file" name="img" class="default" />
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Excluir</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Título do Livro</label>
                                                    <input type="text" name="titulo" id="titulo" minlength="5" required="required" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Subtitulo</label>
                                                    <input type="text" name="subtitulo" class="form-control">
                                                </div>
                                            </div>



                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Tipo de Obra</label>
                                                    <select class="form-control" required="required" name="tipo_obra">
                                                        <option value="">Selecione o Tipo de Obra</option>

                                                        <?php
                                                        foreach ($tipoObra as $rowObra):
                                                            ?>
                                                            <option value="<?php echo $rowObra['to_nb_codigo'] ?>"><?php echo $rowObra['to_tx_descricao']; ?></option>

                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Número de Exemplar</label>
                                                    <input type="text" name="numero_exemplar" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Categoria</label>

                                                    <select class="form-control" required="required" name="categoria">
                                                        <option value="">Selecione a Categoria</option>

                                                        <?php
                                                        foreach ($categoria as $row):
                                                            ?>
                                                            <option value="<?php echo $row['categoria_livro_id']; ?>"><?php echo $row['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Palavra Chave</label>

                                                    <div style="height: 45px;">
                                                        <input name="palavra_chave" required="required" id="tagsinput1" class="tagsinput"/>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Autor(es)</label>
                                                    <div style="height: 45px;">
                                                        <input name="autores" required="required" id="tagsinput2" class="tagsinput"/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                        <header class="panel-heading">
                                            OUTRAS INFORMAÇÕES
                                        </header>

                                        <br/>


                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>CUTTER</label>
                                                    <input type="text" name="cutter" required="required" class="form-control" >
                                                </div>
                                            </div>


                                        

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Tradutor</label>
                                                    <input type="text" name="tradutor" class="form-control" >
                                                </div>
                                            </div>



                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Editora</label>
                                                    <input type="text" name="editora" required="required" class="form-control" i>
                                                </div>
                                            </div>


                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Local de Edição</label>
                                                    <input type="text" name="local_edicao" required="required" class="form-control" >
                                                </div>
                                            </div>


                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label>Edição</label>
                                                    <input type="text" name="edicao" class="form-control">
                                                </div>
                                            </div>

                                        </div>




                                        <div class="row">


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>CDD</label>
                                                    <input type="text" name="cdd" required="required" class="form-control" >
                                                </div>
                                            </div>



                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>País</label>
                                                    <input type="text" name="pais" required="required" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Idioma</label>
                                                    <input type="text" name="idioma" required="required" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label>Ano</label>
                                                    <input type="text" name="ano" required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Série</label>
                                                    <input type="text" name="serie"  class="form-control">
                                                </div>
                                            </div>


                                        </div>



                                        <div class="row">


                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>ISBN</label>
                                                    <input type="text" required="required" name="isbn" class="form-control" >
                                                </div>
                                            </div>


                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label>NºPáginas</label>
                                                    <input type="text" name="numero_pagina"  class="form-control" >
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Número de Chamada</label>
                                                    <input type="text" name="numero_chamada" required="required" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Forma de Aquisição</label>
                                                    <select name="forma_aquisicao" class="form-control" required="required">
                                                        <option value="">Selecione a Forma de Aquisição</option>
                                                        <option value="1">Compra</option>
                                                        <option value="2">Doação</option>
                                                        <option value="3">Permuta</option>
                                                    </select>


                                                </div>
                                            </div>


                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Prateleira</label>
                                                    <input type="text" name="prateleira" required="required" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label>Bloco</label>
                                                    <input type="text" name="bloco" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>


                                        <hr/>
                                        <div class="row">
                                            <div class="col-lg-12"> 
                                                <br/>
                                                <button type="submit" class="btn btn-info">CADASTRAR LIVRO</button>
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
<script src="<?php echo base_url(); ?>template/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/js/form-validation-script.js"></script>