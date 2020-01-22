<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li style="text-align: center;">
                <span>MENU ADMINISTRATIVO</span>

            </li>
            <li style="text-align: center;">
                <span>• • • • • • • • • • • • • • • • • • •</span>

            </li>


            <li>
                <a  href="<?php echo base_url(); ?>dashboard">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>minhas_disciplinas">
                    <i class="fa fa-list-alt"></i>
                    <span>Minhas Disciplinas</span>
                </a>

            </li>



            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>Minhas_notas">
                    <i class="fa fa-bookmark"></i>
                    <span>Minhas Notas</span>
                </a>
            </li>



            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>boletim" >
                    <i class="fa fa-table"></i>
                    <span>Demonst. Notas</span>
                </a>

            </li>


            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>situacao" >
                    <i class="fa fa-money"></i>
                    <span>Sit. Financeira</span>
                </a>
            </li>


            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>livro/livro" >
                    <i class="fa fa-search"></i>
                    <span>Cons. A   cervo Biblioteca</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fas fa-plus"></i>
                    <span>Relatórios</span>
                </a>
                <ul class="sub">
                    <li><a style="background: none;" href="<?php echo base_url(); ?>Historico/historico_aluno"><i class="fa fa-list-alt"></i>Histórico</a></li>
                    <li><a style="background: none;" href="<?php echo base_url(); ?>Matriz"><i class="fa fa-sitemap"></i>Matriz Curricular</a></li>
                    <li><a style="background: none;" href="<?php echo base_url(); ?>Declaracao"><i class="fa fa-list-alt"></i>Declaração de Matrícula</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>integracao" target="_blank" >
                    <i class="fa fa-book"></i>
                    <span>Minha Biblioteca</span>
                    <button type="button" class="btn btn-danger btn-xs" style="margin-left: 7px;">Novo </button>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fas fa-plus"></i>
                    <span>Chamados</span>
                    <span class="btn btn-danger btn-xs">Novo</span>
                </a>
                <ul class="sub">
                  <li><a style="background: none;" href="<?php echo base_url(); ?>Chamado/lista"><i class="fa fa-sitemap"></i>Meus Chamados</a></li>
                </ul>
            </li>

            <hr/>



            <li>
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">CONTATO DIRETO SKYadmin</h4>
                            </div>
                            <div class="modal-body">

                                <form role="form">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NOME</label>
                                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Seu nome">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">EMAIL</label>
                                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="seu email">
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label for="exampleInputEmail1">ASSUNTO</label>
                                        <select name="tipo_arquivo" class="form-control m-bot15">
                                            <option>MENSAGEM</option>
                                            <option>PROBLEMAS TÉCNICOS</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">MENSAGEM</label>
                                        <textarea name="texto" id="" class="form-control" rows="7"></textarea>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <hr/>
                                        <label class="col-sm-12">se precisar, envie o print do seu problema</label>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="file" class="default" />
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-default">enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
        <!-- sidebar menu end-->

    </div>
</aside>
