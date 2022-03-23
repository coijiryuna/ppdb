<!DOCTYPE html>
<html lang="en">

<!doctype html>
<html lang="en-US">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/icon.jpg'); ?>" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('assets/js/styles.css'); ?>" type="text/css" />

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.min.css">

    <title>PPDB </title>
</head>

<body>

    <!-- N A V B A R -->
    <nav class="navbar navbar-default navbar-expand-lg fixed-top custom-navbar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon ion-md-menu"></span>
        </button>
        <img src="" class="img-fluid nav-logo-mobile" height="35" width="200" alt="<?= $school->nama ?>">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="container">
                <img src="" class="img-fluid nav-logo-desktop" alt="<?= $school->nama ?>">
                <ul class="navbar-nav ml-auto nav-right" data-easing="easeInOutExpo" data-speed="1250" data-offset="65">
                    <li class="nav-item nav-custom-link">
                        <a class="nav-link" href="index.html">Home <i class="icon ion-ios-arrow-forward icon-mobile"></i></a>
                    </li>
                    <li class="nav-item nav-custom-link">
                        <a class="nav-link" href="#marketing">Informasi <i class="icon ion-ios-arrow-forward icon-mobile"></i></a>
                    </li>
                    <li class="nav-item nav-custom-link">
                        <a class="nav-link" href="#testimonials">Kontak <i class="icon ion-ios-arrow-forward icon-mobile"></i></a>
                    </li>
                    <li class="nav-item nav-custom-link">
                        <a class="nav-link" href="<?= base_url('loginuser/logout'); ?>">Keluar <i class="icon ion-ios-arrow-forward icon-mobile"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- E N D  N A V B A R -->

    <?= $this->renderSection('content') ?>
    <!--  F O O T E R  -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <a href="#"><i class="icon ion-logo-facebook"></i></a>
                    <a href="#"><i class="icon ion-logo-instagram"></i></a>
                    <a href="#"><i class="icon ion-logo-twitter"></i></a>
                    <a href="#"><i class="icon ion-logo-youtube"></i></a>
                </div>
                <div class="col-md-6 col-xs-12">
                    <small><?= date('Y'); ?> &copy; <?= $school->nama; ?> <a href="http://facebook/coijiryuna" target="blank" class="external-links">Rudi Yulianto, S.E.Sy</a></small>
                </div>
            </div>
        </div>
    </footer>
    <!--  E N D  F O O T E R  -->
    <!-- External JavaScripts -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/localization/messages_id.min.js" integrity="sha512-DfJ6Ig0o86NC5sD0irSVxGaD3V/wXPhBh+Ma5TXcXhRE5NROXN5lNU5srIUc2p3+6RBBAy8v0YLuwIV9WYbMEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?= $this->renderSection('js') ?>
</body>

</html>