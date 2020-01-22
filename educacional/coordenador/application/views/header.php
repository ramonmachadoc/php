<header class="header white-bg">
    <div class="sidebar-toggle-box">

    </div>
    <!--logo start-->
    <a  href="<?php echo base_url(); ?>dashboard/" class="logo" class="logo">SYSCOORD<span>FBN</span>
             <img style="margin-left: 10px; margin-bottom: -1px;" src="<?php echo base_url(); ?>template/img/brasao.png" height="40" alt="" />
    </a>


    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">

            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="username"><?php echo $this->session->userdata('nome'); ?></span>
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