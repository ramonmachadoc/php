<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Alternar Navegação"></div>
    </div>

  
    
    <!--logo start-->
    <a  href="<?php echo base_url(); ?>dashboard/" class="logo" class="logo"><?php echo "SGA";
    
    if($this->session->userdata('login_type')== ""){
        
    }
    
    ?><span>FBN</span>
<!--        <img style="margin-left: 10px; margin-bottom: -1px;" src="<?php echo base_url(); ?>template/img/brasao.png" height="40" alt="" />-->
    </a>


    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">

            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="username"><?php
                        $temp = explode(" ", $this->session->userdata('nome'));
                        echo $nomeNovo = $temp[0] . " " . $temp[count($temp) - 1];
                        ?>
                    </span>
                    <b class="caret"></b>
                </a>

                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li><a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-key"></i> SAIR</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>