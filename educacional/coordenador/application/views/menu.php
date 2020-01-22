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
                    <span>DASHBOARD</span>
                </a>
            </li>


            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-pencil"></i>
                    <span>CADASTROS</span>
                </a>
                <ul class="sub">
                    <li><a style="background: none;" href="<?php echo base_url(); ?>professor"><i class="fa fa-users"></i>PROFESSOR</a></li>
<!--                    <li><a style="background: none;" href="<?php echo base_url(); ?>professor"><i class="fa fa-edit"></i>ATIV COMPLEMENTAR</a></li>-->
                </ul>
            </li>



            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-search"></i>
                    <span>CONSULTA</span>
                </a>
                <ul class="sub">
                    <li><a style="background: none;" href="<?php echo base_url(); ?>ReceberPagamento"><i class="fa fa-user"></i>DADOS ALUNO</a></li>
                    <li><a style="background: none;" href="<?php echo base_url(); ?>bolsa/bolsas"><i class="fa fa-briefcase"></i>BOLSAS</a></li>
                    <li><a style="background: none;" href="<?php echo base_url(); ?>Curso/cursos"><i class="fa fa-th"></i>CURSOS</a></li>
                    <li><a style="background: none;" href="<?php echo base_url(); ?>turma"><i class="fa fa-table"></i>TURMA</a></li>
                    <li><a style="background: none;" href="<?php echo base_url(); ?>ReceberPagamento"><i class="fa fa-money"></i>MENSALIDADES</a></li>
                    <li><a style="background: none;" href="<?php echo base_url(); ?>matriz"><i class="fa fa-sitemap"></i>MATRIZ</a></li>
<!--                    <li><a style="background: none;" href="<?php echo base_url(); ?>PeriodoLetivo"><i class="fa fa-list-alt"></i>PERÍODO LETIVO</a></li>-->
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
