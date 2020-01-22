

<script>

    /** 

     * AJAX - busca todas as unidades gestoras de acordo com o ano

     */

    function alteraAreaNaSessaoAJAX(area_id, empresa_id, usuario_id, botao)

    {

        $.ajax({

            url:   '<?php echo Yii::app()->baseUrl; ?>/permissao/mudadadosdapermissaonasessao',

            //data:  'area_id=' + area_id,    

            data:  {area_id: area_id, empresa_id: empresa_id, usuario_id: usuario_id},    

            type:  'POST',    

            cache: false,

            

            beforeSend: function() {         

                //apaga todos os icones

                $('#AVSEC-MAP_confirm').remove();

                $('#AVSEC-MAO_confirm').remove();

                $('#QUALIDADE-MAP_confirm').remove();

                $('#QUALIDADE-MAO_confirm').remove();

                $('#SGSO-MAP_confirm').remove();

                $('#SGSO-MAO_confirm').remove();



                mostrarIcone(area_id, botao, 'request'); 

            },

            success: function(data) { },

            complete: function() {         

                setTimeout(function() {

                    mostrarIcone(area_id, botao, 'response');   

                }, 500);

                $(location).attr('href', '<?php echo Yii::app()->request->baseUrl; ?>/usuario/index');

                //location.reload();

            }           

        });

         

    }   



    function mostrarIcone(id, botao, tipoRequisicao){
        switch(botao) {
            case 'BOTAO-AVSEC-MAP':
                var elementoID = 'AVSEC-MAP_confirm';
            break;
            case 'BOTAO-AVSEC-MAO':
                var elementoID = 'AVSEC-MAO_confirm';
            break;
            case 'BOTAO-QUALIDADE-MAP':
                var elementoID = 'QUALIDADE-MAP_confirm';
            break;
            case 'BOTAO-QUALIDADE-MAO':
                var elementoID = 'QUALIDADE-MAO_confirm';
            break;
            case 'BOTAO-SGSO-MAP':
                var elementoID = 'SGSO-MAP_confirm';
            break;
            case 'BOTAO-SGSO-MAO':
                var elementoID = 'SGSO-MAO_confirm';
            break;
        }   

        //inseri o icone 
        if(tipoRequisicao == 'request')
            $( '#' + botao ).append('<span id="'+elementoID+'" class="badge bg-theme"><i class="fa fa-refresh fa-spin fa-fw" aria-hidden="true"></i></span>');  
        else if(tipoRequisicao == 'response')
            $( '#' + botao ).append('<span id="'+elementoID+'" class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>');  

    }  
       

</script>


<!-- **********************************
       BARRA SUPERIOR & NOTIFICAÇÕES
*************************************** -->

<header class="header black-bg">

    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips font-white" data-placement="right" data-original-title="Esconder Barra"></div>
    </div>

    <!--LOGO-->
    <a href="#" class="logo"><b>SGE</b></a>

    <!--DROPDOWN DE NOTIFICAÇÕES-->
    <div class="nav notify-row" id="top_menu">
        <ul class="nav top-menu">
           <!-- AREA -->
            <?php /*foreach($areas as $area) : ?>

                <li class="dropdown">
                    <a id='<?php echo $area->descricao?>' data-toggle="dropdown" class="dropdown-toggle" onclick="alteraAreaNaSessaoAJAX('<?php echo $area->area_id ?>','<?php echo $area->descricao?>')">
                        <i class="fa fa-align-justify font-white">&nbsp;<?php echo $area->descricao?></i>
                        <!--<span class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>-->
                    </a>
                </li>
            <?php endforeach; */?>
            <!-- SETOR
            <li class="dropdown">
                <a data-toggle="dropdown1" class="dropdown-toggle">
                    <i class="fa fa-cog font-white">&nbsp;Engenharia</i>
                    <span class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>
                </a>
            </li>
            -->
            <!-- AUDITADO
            <li class="dropdown">
                <a data-toggle="dropdown2" class="dropdown-toggle">
                    <i class="fa fa-user font-white">&nbsp;faxandre</i>
                    <span class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>
                </a>
            </li>
            -->
        </ul>
    </div>


    <div class="top-menu">
        <!--  LOGIN/LOGOUT -->
		<ul class="nav pull-right top-menu">
            <li><a class="logout <?php echo !Yii::app()->user->isGuest?'show':'hide'; ?>" href="<?php echo Yii::app()->createUrl('site/logout'); ?>" style="font-weight:bold">Logout</a></li>
            <li><a class="logout <?php echo Yii::app()->user->isGuest ? 'show' : 'hide'; ?>" href="<?php echo Yii::app()->createUrl('site/login'); ?>" style="font-weight:bold">Login</a></li>
        </ul>

        <!-- AREA -->
        <?php if( isset(Yii::app()->user->perfil) and Yii::app()->user->getState('perfil') != Permissao::ADMINISTRADOR ) : ?>   

        <?php /*foreach($areas as $area) : ?>
                <ul id="icones-areas" class="nav pull-right top-menu">
                    <li>
                        <a id='BOTAO-<?php echo $area->descricao?>' data-toggle="dropdown" class="dropdown-toggle" onclick="alteraAreaNaSessaoAJAX('<?php echo $area->area_id ?>','<?php echo Yii::app()->user->usuario_id ?>','BOTAO-<?php echo $area->descricao?>')">
                            <i class="fa fa-align-justify font-white">&nbsp; &nbsp;<?php echo $area->descricao.' / '.Yii::app()->user->getState('empresa'); ?></i>
                            <?php if ($area->area_id == Yii::app()->user->getState('area_id') ) : ?>
                                <span id='<?php echo $area->descricao?>_confirm' class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            <?php endforeach; */
        ?>



        <?php if( isset(Yii::app()->user->permissoes) and (Yii::app()->user->getState('perfil') != Permissao::GERENTE_AUDITADO) ) : ?>

            <?php foreach( Yii::app()->user->getState('permissoes') as $key => $permissao )  : ?>  

                <!--$areas[] = Area::model()->findByPk($permissao['area_id']);-->
                <ul id="icones-areas" class="nav pull-right top-menu">
                    <li>
                        <a id='BOTAO-<?php echo @$permissao->area->descricao."-".$permissao->empresa->sigla?>' data-toggle="dropdown" class="dropdown-toggle aleatorio" 
                           onclick="alteraAreaNaSessaoAJAX(
                                        '<?php echo @$permissao->area->area_id ?>',
                                        '<?php echo $permissao->empresa->empresa_id ?>',
                                        '<?php echo Yii::app()->user->usuario_id ?>',
                                        'BOTAO-<?php echo @$permissao->area->descricao."-".$permissao->empresa->sigla ?>'
                                    )">

                            <i class="fa fa-align-justify font-white">&nbsp;&nbsp;<?php echo @$permissao->area->descricao.' / '.$permissao->empresa->sigla; ?></i>
                            <?php if (@$permissao->area->area_id == Yii::app()->user->getState('area_id') and $permissao->empresa->empresa_id == Yii::app()->user->getState('empresa_id') ) : ?>
                                <span id='<?php echo @$permissao->area->descricao."-".$permissao->empresa->sigla."_confirm" ?>' class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            <?php endforeach; ?>

        <?php endif; ?> 

            <?php if ( isset(Yii::app()->user->permissoes) and (Yii::app()->user->getState('perfil') == Permissao::GERENTE_AUDITADO) ): ?>
                
                <?php
                    $v_aux =0 ;
                    $v_array_aux[] = null;
                ?>

                <?php foreach( Yii::app()->user->getState('permissoes') as $key => $permissao )  : ?>  
                    
                    <ul id="icones-areas" class="nav pull-right top-menu">
                        <?php
                            //if( ($v_aux != $permissao->empresa->empresa_id) and  ($v_aux != $permissao->setor->setor_id) ){ 
                            //if( $v_aux != $permissao->empresa->empresa_id ){ 
                            if ( !in_array($permissao->empresa->empresa_id, $v_array_aux) ) { 
                            
                            ?>
                                <li>

                                    <a id='BOTAO-<?php echo @$permissao->area->descricao."-".$permissao->empresa->sigla?>' data-toggle="dropdown" class="dropdown-toggle aleatorio" 

                                       onclick="alteraAreaNaSessaoAJAX(
                                                    '<?php echo @$permissao->area->area_id ?>',
                                                    '<?php echo $permissao->empresa->empresa_id ?>',
                                                    '<?php echo Yii::app()->user->usuario_id ?>',
                                                    'BOTAO-<?php echo @$permissao->area->descricao."-".$permissao->empresa->sigla ?>'
                                                )">



                                        <i class="fa fa-align-justify font-white">&nbsp;

                                            <!-- &nbsp;<?php //echo @$permissao->empresa->sigla."/".@$permissao->setor->descricao; ?> -->
                                            &nbsp;<?php echo @$permissao->empresa->sigla;?>

                                        </i>

                                        <?php if (@$permissao->area->area_id == Yii::app()->user->getState('area_id') and $permissao->empresa->empresa_id == Yii::app()->user->getState('empresa_id') ) : ?>

                                            <span id='<?php echo @$permissao->area->descricao."-".$permissao->empresa->sigla."_confirm" ?>' class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>

                                        <?php endif; ?>



                                    </a>

                                </li> <?php
                                $v_aux = $permissao->empresa->empresa_id;
                                $v_array_aux[] = $permissao->empresa->empresa_id;
                            }
                        ?>
                    </ul>
                    



                <?php endforeach; ?>
            <?php endif ?>



        <?php endif; ?>



        <?php if( Yii::app()->user->getState('auditado') == Usuario::SIM ) : ?>   

            <ul id="icones-areas" class="nav pull-right top-menu">

                <li>

                    <a id='BOTAO-SETOR' href="<?php echo Yii::app()->request->baseUrl; ?>/usuario/index" class="dropdown-toggle aleatorio">

                        <i class="fa fa-align-justify font-white">

                            &nbsp;<?php echo Yii::app()->user->getState('setor').' / '.Yii::app()->user->getState('empresasigla'); ?>

                        </i>

                        <!--<span class="badge bg-theme"><i class="fa fa-check" aria-hidden="true"></i></span>-->

                    </a>

                </li>

            </ul>

        <?php endif; ?>



    </div>







    <style>

        /*#iconeUser{

            font-size: 12px;

            float:right;

            margin-right: 10px; 

            margin-top: 21px;

        }*/

        .aleatorio{ font-size: 12px !important; margin-top: 18px !important; }

        /*.badge{ top: -25px !important; }*/

        /*bg-theme*/

        #BOTAO-SGSO, #BOTAO-AVSEC, #BOTAO-QUALIDADE, #BOTAO-SETOR {

            margin-top: 18px;

            font-size: small !important; 

        }

    </style>



</header>