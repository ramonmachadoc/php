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
                <a  href="<?php
                echo base_url();
                echo $this->uri->segment('1')
                ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Painel Administrativo</span>
                </a>
            </li>


            <?php
            $modulos = $this->educacional_model->getJoin('modulos.nome as modulos, modulos.modulos_id as modulo_id', 'acessos', 'menus', 'modulos', 'perfis_id', $this->session->userdata('perfisId'), 'modulos', 'menus', 'modulos');

            foreach ($modulos as $rowModulos):
                ?>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-laptop"></i>
                        <span><?php echo $rowModulos['modulos']; ?></span>
                    </a>
                    <ul class="sub">

                        <?php
                        $menus = $this->educacional_model->getJoin('menus.nome as menus, target, men_tx_img as imagem, men_tx_url as url', 'acessos', 'menus', 'menus', 'perfis_id', $this->session->userdata('perfisId'), 'modulos', 'menus', null, 'modulos.modulos_id', $rowModulos['modulo_id']);

                        foreach ($menus as $rowMenus):
                            ?>
                            <li>
                                <a target="<?php echo $rowMenus['target']; ?>" href="<?php echo base_url();?><?php echo $rowMenus['url']; ?>">
                                    <i class="fa <?php echo $rowMenus['imagem']; ?>"></i>
                                    <?php echo $rowMenus['menus']; ?></a>
                            </li>

                            <?php
                        endforeach;
                        ?>
                    </ul>
                </li>

                <?php
            endforeach;
            ?>
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
