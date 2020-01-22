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

            <!--            <li class="sub-menu">
                            <a href="javascript:;" >
                                <i class="fa fa-pencil"></i>
                                <span>R ACADÊMICO.</span>
                            </a>
            
                        </li>-->


            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>Disciplinas">
                    <i class="fa fa-list-alt"></i>
                    <span>MINHAS DISCIPLINAS</span>
                </a>

            </li>



            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>PlanoEnsino">
                    <i class="fa fa-bookmark"></i>
                    <span>PLANO DE ENSINO</span>
                </a>
            </li>



            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>mapa" >
                    <i class="fa fa-map-marker"></i>
                    <span>MAPA DE NOTAS</span>
                </a>

            </li>



            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>DisciplinasProfessor" >
                    <i class="fa fa-pencil"></i>
                    <span>DISCIPLINAS</span>
                </a>

            </li>


            <li class="sub-menu">
                <a href="<?php echo base_url(); ?>agenda">
                    <i class="fa fa-calendar"></i>
                    <span>AGENDA</span>
                </a>

            </li>
            
            
             <li class="sub-menu">
                <a href="<?php echo base_url(); ?>MinhaBiblioteca" target="_blank" >
                    <i class="fa fa-book"></i>
                    <span>Minha Biblioteca</span>
                    <button type="button" class="btn btn-danger btn-xs" style="margin-left: 7px;">Novo </button>
                </a>
            </li>


<!--            <li class="sub-menu">
                <a href="http://fbnovas.edu.br/cpaq/cpa3/?resposta=ok">
                    <i class="fa fa-calendar"></i>
                    <span>AVALIAÇÃO DOCENTE - CPA</span>
                    <span style="margin-left: 35px;">(03 a 13/02/2017)</span>
                </a>

            </li>-->

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
