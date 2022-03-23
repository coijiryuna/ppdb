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
    <link href="<?php echo base_url('assets/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>PPDB <?= $school->nama; ?></title>
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
                        <a class="nav-link" href="#hero">Home <i class="icon ion-ios-arrow-forward icon-mobile"></i></a>
                    </li>
                    <li class="nav-item nav-custom-link">
                        <a class="nav-link" href="#marketing">Informasi <i class="icon ion-ios-arrow-forward icon-mobile"></i></a>
                    </li>
                    <li class="nav-item nav-custom-link">
                        <a class="nav-link" href="#contact">Kontak <i class="icon ion-ios-arrow-forward icon-mobile"></i></a>
                    </li>
                    <li class="nav-item nav-custom-link">
                        <a class="nav-link" data-toggle="modal" data-target="#loginmodal">Masuk <i class="bi bi-box-arrow-in-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- E N D  N A V B A R -->
    <!-- H E R O -->
    <section id="hero" class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <img src="<?= base_url('gambar/' . $school->baner1); ?>" class="img-fluid" alt="Demo image">
                </div>
                <div class="col-md-7 content-box hero-content">
                    <span>Penerimaan Peserta Didik Baru Tahun Pelajaran <?= $set->tapel; ?></span>
                    <h1><b><?= $school->nama; ?></b></h1>
                    <p style="font-size: medium;" class="text-black"><?= $school->info; ?></p>
                    <button type="button" class="btn btn-outline-primary mt-4" data-toggle="modal" data-target="#daftarmodal">Daftar <i class="bi bi-arrow-right-circle"></i></button>
                    <button type="button" class="btn btn-outline-dark mt-4 ml-4" data-toggle="modal" data-target="#loginmodal">Masuk <i class="bi bi-box-arrow-in-right"></i></button>

                </div>
            </div>
        </div>
    </section>
    <!-- E N D  H E R O -->
    <section id="marketing" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="content-box">
                        <span>Penerimaan Peserta Didik Baru Tahun Pelajaran <?= $set->tapel; ?></span>
                        <h2>Informasi</h2>
                        <?= $info->status; ?>
                        <a class="btn btn-warning mt-4" href="<?= base_url('brosur/' . $info->brosur); ?>" id="pseudo-dynamism" target="_blank">Download</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <img src="<?= base_url('gambar/' . $school->baner2); ?>" class="img-fluid" alt="Demo image">
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT -->
    <section id="contact" class="contact bg-white">
        <div class="container">
            <div class="section-title">
                <h2>Kontak</h2>
                <p>Informasi lebih jelas Mengenai Lembaga dan PPDB bisa kontak salah satu nomor di bawah ini <br> atau dapat langsung mengunjungi kantor pada peta di bawah ini</p>
            </div>
            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Alamat:</h4>
                            <p><?= $school->alamat; ?> Kec. <?= $school->nama_kec; ?> <br><?= $school->nama_kab; ?> <?= $school->nama_prov; ?></p>
                        </div>
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p><?= $school->email; ?></p>
                        </div>
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Contact Person:</h4>
                            <p>(Untuk Telp dan Whatsapp) <br />
                                <?php foreach ($kontak as $key) {
                                    echo $key->nama . ' : ' . $key->telp . '<br>';
                                } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <iframe src="<?= $school->maps; ?>" frameborder="0" style="border:0; width: 100%; height: auto;" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- Feedback Modal-->
    <div class="modal fade" id="daftarmodal" tabindex="-1" role="dialog" aria-labelledby="daftarmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary p-4">
                    <h5 class="modal-title font-alt text-black">Form Pendaftaran</h5>
                    <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body border-0 p-4">
                    <form id="add-form" method="post">
                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap Sesuai Akta/Ijaza" maxlength="255" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" id="nik" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan" maxlength="16" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" id="nisn" name="nisn" class="form-control" placeholder="NISN" maxlength="16" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" id="telp" name="telp" class="form-control" placeholder="Telphone" maxlength="13" required>
                        </div>
                        <?php if ($set->kode == 2) { ?>
                            <div class="input-group mb-3">
                                <select id="par" name="par" class="form-control" placeholder="Jenjang" required>
                                </select>
                            </div>
                        <?php
                        } ?>

                        <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg" onclick="add()" id="submitButton" type="submit">Daftar</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary p-4">
                    <h5 class="modal-title font-alt text-black">Login Pendaftaran</h5>
                    <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body border-0 p-4">
                    <form method="post" action="<?= base_url('loginuser/process'); ?>">
                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <input type="number" id="nik" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan" maxlength="16" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" id="nisn" name="nisn" class="form-control" placeholder="NISN" required>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg" type="submit">Masuk</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
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
                    <small><?= date('Y'); ?> &copy; <?= $school->nama; ?> <a href="http://facebook.com/coijiryuna" target="blank" class="external-links"> art by : Rudi Yulianto, S.E.Sy</a></small>
                </div>
            </div>
        </div>
    </footer>
    <!--  E N D  F O O T E R  -->
    <!-- External JavaScripts -->
    <script src="<?= base_url('assets/js/scripts.js'); ?>"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/localization/messages_id.min.js" integrity="sha512-DfJ6Ig0o86NC5sD0irSVxGaD3V/wXPhBh+Ma5TXcXhRE5NROXN5lNU5srIUc2p3+6RBBAy8v0YLuwIV9WYbMEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {
            $.ajax({
                url: '<?= base_url($controller . '/getjurusan') ?>',
                method: "POST",
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '<option value="">Pilih Jurusan/Peminatan</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].jurusan + '</option>';
                    }
                    $('#par').html(html);

                }
            });
        });

        function add() {
            // reset the form 
            $(".form-control").removeClass('is-invalid').removeClass('is-valid');
            // submit the add from 
            $.validator.setDefaults({
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                errorElement: 'div ',
                errorClass: 'invalid-feedback',
                errorPlacement: function(error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else if ($(element).is('.select')) {
                        element.next().after(error);
                    } else if (element.hasClass('select2')) {
                        //error.insertAfter(element);
                        error.insertAfter(element.next());
                    } else if (element.hasClass('selectpicker')) {
                        error.insertAfter(element.next());
                    } else {
                        error.insertAfter(element);
                    }
                },

                submitHandler: function(form) {

                    var form = $('#add-form');
                    // remove the text-danger
                    $(".text-danger").remove();

                    $.ajax({
                        url: '<?= base_url($controller . '/add') ?>',
                        type: 'post',
                        data: form.serialize(), // /converting the form data into array and sending it to server
                        dataType: 'json',
                        beforeSend: function() {
                            $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                        },
                        success: function(response) {
                            if (response.success === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terimakasih',
                                    text: response.messages,
                                    showConfirmButton: false,
                                    timer: 6000
                                }).then(function() {
                                    $("#add-form")[0].reset();
                                    $('#daftarmodal').modal('hide');
                                })
                            } else {
                                if (response.messages instanceof Object) {
                                    $.each(response.messages, function(index, value) {
                                        var id = $("#" + index);
                                        id.closest('.form-control')
                                            .removeClass('is-invalid')
                                            .removeClass('is-valid')
                                            .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
                                        id.after(value);
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.messages,
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                }
                            }
                            $('#add-form-btn').html('Daftar');
                        }
                    });

                    return false;
                }
            });
            $('#add-form').validate();
        }
        const Toast = Swal.mixin({
            //toast: true,
            //position: 'top-end',
            showConfirmButton: true,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        <?php if (session('error')) { ?>
            Toast.fire({
                icon: 'info',
                title: 'PPDB <?= $school->nama ?>',
                text: '<?= session('error.') ?>'
            });
        <?php } ?>
    </script>
</body>

</html>