<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cupom Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
    <!-- fonte -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page" style="">
    <div class="login-box">
        <div class="login-logo">
            <div class="row" style="margin-bottom:25px;">
                <div class="text-center">
                    <!-- logo imagem
                       <img src="<?php echo BASE_URL; ?>app/assets/images/logo.png" style="width: 20%;">
                    -->
                </div>
            </div>
        </div>
        <p class="login-box-msg">Faça o login no painel administrativo</p>
        <form method="POST" action="<?php echo BASE_URL_PAINEL; ?>login/index_post">
            <div class="form-group has-feedback">
                <input style="border-radius:5px;height: 40px;" type="text" class="form-control" placeholder="login" name="login">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input style="border-radius:5px;height: 40px;" type="password" class="form-control" placeholder="senha" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>

                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" style="border-radius: 5px;color: #FFF;border-color: #000;" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>