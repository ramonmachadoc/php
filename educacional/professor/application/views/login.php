<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keyword" content="Sky admin, administrador de sites">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>template/img/favicon.png">
    <?php include 'includes.php'; ?>
    <title> Login | <?php echo $system_title; ?> </title>
</head>

<!--sidebar end-->

<body class="login-body">
    <div class="container">

        <?php echo form_open('login/validate_login', array('class' => 'form-signin')); ?>


        <h2 class="form-signin-heading">PORTAL FBN - PROFESSOR</h2>
        
        
        <h2 class="form-signin-heading" style="background-image: url(<?php echo base_url(); ?>template/img/bg-topo.png);">
            <img style="margin-left: 0px; margin-bottom: -15px; margin-top: -10px;" src="<?php echo base_url(); ?>template/img/brasao.png"  height="100" width="100" alt="" />
        </h2>

        <div class="login-wrap">
            <input type="text" name="usuario" required="required" class="form-control" placeholder="Usuário" autofocus>
            <input type="password" name="senha" required="required" class="form-control" placeholder="Senha">

            <label class="checkbox">
                <span class="pull-right ">
                    <a data-toggle="modal" href="#myModal"> Esqueceu a senha?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Entrar</button>
            <hr/>


        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #312A1F;">
                        <h4 class="modal-title">Esqueceu a senha?</h4>
                    </div>
                    <div class="modal-body">
                        <p>coloque seu email, para mandar-mos um lembrete</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button">Lembrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <?php echo form_close(); ?>

    </div>

</body>
</html>
