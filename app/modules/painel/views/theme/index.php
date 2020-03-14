<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cupom</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE/dist/css/adminlte.min.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE/plugins/jquery/jquery.min.js"></script>

</head>

<body class="hold-transition text-sm  layout-top-nav">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
      <div class="container">
        <a href="<?php echo BASE_URL_PAINEL; ?>" class="navbar-brand">
          <!-- <img style="background: aliceblue;" src="<?php echo BASE_URL; ?>app/assets/images/logo.png" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
          <span class="brand-text font-weight-light">Cupom Painel</span>
        </a>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?php echo BASE_URL_PAINEL;?>clientes" class="nav-link">Clientes</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-12 text-center">
              <h1> <?php echo ucfirst($titlePage); ?> </h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container">
          <?php $this->loadView($viewName, $viewData, false); ?>
        </div>
      </section>

    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 0.0.0
      </div>
    </footer>

  </div>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE/plugins/filterizr/jquery.filterizr.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE/dist/js/adminlte.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE/dist/js/demo.js"></script>
</body>

</html>