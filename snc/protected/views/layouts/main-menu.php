<!-- *************************
        MENU LATERAL
****************************** -->

<aside>
    <div id="sidebar"  class="nav-collapse">
        <!--sidebar menu start -->
        <div id="img_perfil" class="centralizar">
            <a href="<?php echo Yii::app()->createUrl("usuario/index"); ?>">
                <div class="centered">
                    <?php if( isset(Yii::app()->user->perfil) ) : ?>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/perfil_auditor.jpg" width="100">
                    <?php else : ?>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/perfil_adm.jpg" width="100">
                    <?php endif; ?>
                    <h5 lass="centered"><?php echo Yii::app()->user->login; ?></h5>
                </div>
            </a>
            <h5 class="centered">
                <?php echo isset(Yii::app()->user->perfil) ? Yii::app()->user->perfiltexto : "Auditado";  ?>
            </h5>
        </div>

        <ul class="sidebar-menu" id="nav-accordion">

           <!-- MENU ADMINISTRADOR -->
            <?php if( isset(Yii::app()->user->perfil) and Yii::app()->user->getState('perfil') == Permissao::ADMINISTRADOR ) : ?>

                <li class="sub-menu">
                    <a id="sub-menu-adm-evento" href="javascript:;" >
                        <i class="fa fa-bullhorn"></i> <span>Não Conformidades</span>
                    </a>
                    <ul class="sub">
                       <li id="admevento-cadastrar">
                            <a href="<?php echo Yii::app()->createUrl('evento/create'); ?>">Incluir</a>
                        </li>
                       <li id="admevento-listar">
                            <a href="<?php echo Yii::app()->createUrl('evento/indexadministrador'); ?>"> Acompanhar </a>
                        </li>
                        <li id="admevento-acompanhamento">
                             <a href="<?php echo Yii::app()->createUrl('evento/acompanhar'); ?>"> Acompanhamento </a>
                         </li>

                    </ul>
               </li>

               <li class="sub-menu">
                   <a id="sub-menu-adm-relatorios" href="javascript:;" >
                      <i class="fa fa-file-pdf-o"></i> <span>RELATÓRIOS</span>
                  </a>
                  <ul class="sub">
                      <!-- <li id="adm-relatorio2">
                           <a href="#"> Em Processo</a>
                       </li>
                       <li id="adm-relatorio3">
                           <a href="#"> Em Atraso</a>
                       </li>
                       <li id="adm-relatorio4">
                           <a href="#"> Encerrados</a>
                       </li> -->
                       <li id="adm-relatorio5">
                           <a href="<?php echo Yii::app()->createUrl('exportar/excel'); ?>"> Exportar Excel</a>
                       </li>

                       <li id="adm-relatorio1">
                           <a href="<?php echo Yii::app()->createUrl('indicadores/gerar'); ?>"> Indicadores</a>
                       </li>
                   </ul>
               </li>

                <li class="sub-menu">
                    <a id="sub-menu-adm-gerenc" href="javascript:;" >
                        <i class="fa fa-cogs"></i> <span>Configuração</span>
                    </a>
                    <ul class="sub">
                        <li id="admgerenc-usuario">
                            <a href="<?php echo Yii::app()->createUrl('usuario/admin'); ?>"> Usuário</a>
                        </li>
                        <li id="admgerenc-responsavel">
                            <a href="<?php echo Yii::app()->createUrl('responsavel/admin'); ?>">Responsável</a>
                        </li>
                        <!--<li id="adm-permissao">
                            <a href="<?php //echo Yii::app()->createUrl('permissao/admin'); ?>"> Permissão</a>
                        </li>-->
                        <li id="admgerenc-setor">
                            <a href="<?php echo Yii::app()->createUrl('setor/admin'); ?>"> Setor Envolvido</a>
                        </li>
                        <li id="admgerenc-tipoevento">
                            <a href="<?php echo Yii::app()->createUrl('tipoauditoria/admin'); ?>"> Tipo de Evento</a>
                        </li>
                        <li id="admgerenc-auditor">
                            <a href="<?php echo Yii::app()->createUrl('auditorrelator/admin'); ?>"> Auditor / Relator</a>
                        </li>
                       <li id="admgerenc-origemauditor">
                           <a href="<?php echo Yii::app()->createUrl('origemauditor/admin'); ?>"> Origem do Auditor</a>
                        </li>
                       <li id="admgerenc-origemauditado">
                           <a href="<?php echo Yii::app()->createUrl('origemauditado/admin'); ?>"> Origem do Auditado</a>
                       </li>
                       <li id="admgerenc-equip">
                           <a href="<?php echo Yii::app()->createUrl('equipamento/admin'); ?>"> Equipamento</a>
                        </li>
                        <li id="admgerenc-causaraiz">
                            <a href="<?php echo Yii::app()->createUrl('causaraiz/admin'); ?>"> Causa Raiz</a>
                         </li>
                    </ul>
                </li>

            <!-- MENU GERENTE -->

            <?php elseif( isset(Yii::app()->user->perfil) and Yii::app()->user->getState('perfil') == Permissao::GERENTE ) : ?>

                <li class="sub-menu">
                    <a id="sub-menu-adm-evento" href="javascript:;" >
                        <i class="fa fa-bullhorn"></i> <span>Não Conformidades</span>
                    </a>

                    <ul class="sub">
                        <li id="admevento-cadastrar">
                            <a href="<?php echo Yii::app()->createUrl('evento/create'); ?>"> Incluir </a>
                        </li>

                        <li id="admevento-listar">
                            <a href="<?php echo Yii::app()->createUrl('evento/indexadministrador'); ?>"> Acompanhamento </a>
                        </li>

                        <!-- <li id="adm-relatorio1">
                            <a href="<?php //echo Yii::app()->createUrl('indicadores/gerar'); ?>"> Indicadores</a>
                        </li> -->
                    </ul>
                </li>

            <!-- MENU AUDITOR -->
            <?php elseif( isset(Yii::app()->user->perfil) and Yii::app()->user->getState('perfil') == Permissao::AUDITOR ) : ?>

                <li class="sub-menu">
                    <a id="sub-menu-adm-evento" href="javascript:;" >
                        <i class="fa fa-bullhorn"></i> <span>Não Conformidades</span>
                    </a>
                    <ul class="sub">
                        <li id="admevento-cadastrar">
                            <a href="<?php echo Yii::app()->createUrl('evento/create'); ?>"> Incluir </a>
                        </li>
                        <li id="admevento-listar">
                            <a href="<?php echo Yii::app()->createUrl('evento/indexadministrador'); ?>"> Acompanhar </a>
                        </li>

                    </ul>
                </li>

            <!-- MENU AUDITADO -->
            <?php elseif( Yii::app()->user->getState('auditado') == Usuario::SIM || (Yii::app()->user->getState('auditado') == Usuario::NAO && Yii::app()->user->getState('perfil') == Permissao::GERENTE_AUDITADO ) ) : ?>



               <li class="sub-menu">
                   <a id="sub-menu-auditado-evento" href="javascript:;" >
                       <i class="fa fa-bullhorn"></i> <span>Não Conformidades</span>
                   </a>
                    <ul class="sub">
                        <li id="auditado-evento-listar">
                            <a href="<?php echo Yii::app()->createUrl('evento/indexauditado'); ?>"> Listar </a>
                        </li>
                    </ul>
                </li>

            <?php endif; ?>
        </ul>
    </div>
</aside>
