<!DOCTYPE html>
<html lang="<?= config('App')->defaultLocale ?>">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
  <title><?= $title ?? '' ?> | <?= config('Boilerplate')->appName ?></title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.0/css/all.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.min.css">
  <!-- Render section boilerplate css -->
  <?= $this->renderSection('css') ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.0.4/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="layout-fixed layout-navbar-fixed sidebar-mini <?= config('Boilerplate')->theme['footer']['fixed'] ? 'layout-footer-fixed' : '' ?> <?= config('Boilerplate')->theme['body-sm'] ? 'text-sm' : '' ?>">
  <div class="wrapper">

    <!-- Navbar -->
    <?= $this->include('admin/layout/header') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('admin/layout/mainsidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?= $this->include('admin/layout/contentheader') ?>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?= $this->renderSection('content') ?>
        </div>
      </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        <strong><a href="https://github.com/agungsugiarto/boilerplate">Boilerplate</a></strong>
      </div>
      <strong>&copy; <?= date('Y') ?> <a href="<?= config('Boilerplate')->theme['footer']['vendorlink'] ?>"><?= config('Boilerplate')->theme['footer']['vendorname'] ?></a>.</strong> All rights reserved.
    </footer>
  </div>

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.4/dist/js/adminlte.min.js"></script>
  <!-- Preload Scriptt -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/localization/messages_id.min.js" integrity="sha512-DfJ6Ig0o86NC5sD0irSVxGaD3V/wXPhBh+Ma5TXcXhRE5NROXN5lNU5srIUc2p3+6RBBAy8v0YLuwIV9WYbMEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  <script>
    $('.sidebar-toggle').on('click', function(event) {
      event.preventDefault();
      if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        sessionStorage.setItem('sidebar-toggle-collapsed', '')
      } else {
        sessionStorage.setItem('sidebar-toggle-collapsed', '1')
      }
    });
    (function() {
      if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        var body = document.getElementsByTagName('body')[0];
        body.className = body.className + ' sidebar-collapse'
      }
    })()
  </script>
  <!-- Render section boilerplate js -->
  <?= $this->renderSection('js') ?>
  <script>
    $.ajaxSetup({
      headers: {
        '<?= config('App')->CSRFHeaderName ?>': $('meta[name="<?= config('App')->CSRFTokenName ?>"]').attr('content')
      }
    })
  </script>
  <!-- Sweeat alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    <?php if (session('sweet-success')) { ?>
      Toast.fire({
        icon: 'success',
        title: '<?= session('sweet-success.') ?>'
      });
    <?php } ?>
    <?php if (session('sweet-warning')) { ?>
      Toast.fire({
        icon: 'warning',
        title: '<?= session('sweet-warning.') ?>'
      });
    <?php } ?>
    <?php if (session('sweet-error')) { ?>
      Toast.fire({
        icon: 'error',
        title: '<?= session('sweet-error.') ?>'
      });
    <?php } ?>
  </script>
</body>

</html>