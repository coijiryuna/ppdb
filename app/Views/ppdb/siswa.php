<?= $this->extend('ppdb/layout') ?>
<?= $this->section('content') ?>
<style>
    .image-upload>input {
        display: none;
    }

    @media (max-width: 575.98px) {
        .resume>p {
            text-align: left;
            padding: 0px 20px;
            display: none;
        }

        .masthead {
            padding-top: 1rem;
        }
    }
</style>
<section>
    <div class="container">
        <aside class=" masthead bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 pt-3">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-primary-to-secondary">
                                <h5 class="modal-title font-alt text-white">Data Pendaftaran</h5>
                            </div>
                            <div class="modal-body border-0">
                                <form id="add-form" class="pl-3 pr-3" enctype="multipart/form-data" method="POST">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" id="oldfoto" name="oldfoto">
                                    <div class="image-upload text-center mb-4">
                                        <label for="file-input">
                                            <img id="foto" src="" alt="Foto" width="140" height="175" />
                                        </label>
                                        <input id="file-input" name="file-input" type="file" onchange="onFileUpload(this)" accept="image/*">
                                        <p class="text-center">Klik Foto untuk ubah</p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" id="nama" name="nama" class="form-control">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="number" id="nik" name="nik" class="form-control" malgength="16" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="number" id="nisn" name="nisn" class="form-control" required>
                                    </div>
                                    <p>Perbaiki Nama, NIK dan NISN sebelum mencetak Lembar Pendaftaran</p>
                                    <div id="add-form-bnt" class="d-grid"><button class="btn btn-primary rounded-2" type="submit" onclick="simpan()">Simpan</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 pt-3">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-primary-to-secondary">
                                <h5 class="modal-title font-alt text-white">Resume Pendaftar</h5>
                            </div>
                            <div class="modal-body border-0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="resume">
                                            <p> Nama Calon Siswa</p>
                                            <p> Tempat,Tanggal lahir</p>
                                            <p> NISN</p>
                                            <p> NIK</p>
                                            <p> Alamat</p>
                                            <p> Kelurahan/Desa</p>
                                            <p> Kecamatan</p>
                                            <p> Kabupaten</p>
                                            <p> Provinsi</p>
                                            <p> Telphone</p>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <p style="font-weight: bold;" id="nama-sis"></p>
                                        <p id="tgl-sis"></p>
                                        <p id="nisn-sis"></p>
                                        <p id="nik-sis"></p>
                                        <p id="alm-sis"></p>
                                        <p id="des-sis"></p>
                                        <p id="kec-sis"></p>
                                        <p id="kab-sis"></p>
                                        <p id="prov-sis"></p>
                                        <p id="telp-sis"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-grid"><button class="btn btn-success rounded-2" onclick="printcard()"><i class="bi bi-printer-fill"></i> Lembar Pendaftaran </button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>
<?= $this->include('ppdb/lembar'); ?>

<?= $this->endsection(); ?>
<?= $this->section('js'); ?>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link href="https://printjs-4de6.kxcdn.com/print.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
    var base_url = '<?= base_url(); ?>';

    function onFileUpload(input, id) {
        id = id || '#foto';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(id).attr('src', e.target.result).width(200)
            };
            reader.readAsDataURL(input.files[0]);
            $('#foto').removeProp('src').show();
        }
    }

    $(function() {
        $.ajax({
            url: '<?= base_url('ppdb/data/resume') ?>',
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                $("#add-form #oldfoto").val(data.foto);
                $("#add-form #nama").val(data.nama);
                $("#add-form #nisn").val(data.nisn);
                $("#add-form #nik").val(data.nik);

                $('#nama-sis').append(data.nama);
                $('#tgl-sis').append(data.tmp_lahir, ', ', moment(data.tgl_lahir).format('DD MMMM YYYY'));
                $('#nisn-sis').append(data.nisn);
                $('#nik-sis').append(data.nik);
                $('#alm-sis').append(data.alamat, ' RT.', data.rt, '/', data.rw, ' Dusun ', data.dusun);
                $('#des-sis').append(data.nama_des);
                $('#kec-sis').append(data.nama_kec);
                $('#kab-sis').append(data.nama_kab);
                $('#prov-sis').append(data.nama_prov);
                $('#telp-sis').append(data.telp);
                if (data.foto == null) {
                    $('#foto').removeProp('src').hide();
                } else {
                    $('#foto').attr('src', base_url + '/foto/' + data.foto).show();
                }
                // kartu
                $('#nama-lmb').append(data.nama);
                $('#tgl-lmb').append(data.tmp_lahir, ', ', moment(data.tgl_lahir).format('DD MMMM YYYY'));
                $('#nisn-lmb').append(data.nisn);
                $('#nik-lmb').append(data.nik);
                $('#alm-lmb').append(data.alamat, ' RT.', data.rt, '/', data.rw, ' Dusun ', data.dusun);
                $('#des-lmb').append(data.nama_des);
                $('#kec-lmb').append(data.nama_kec);
                $('#kab-lmb').append(data.nama_kab);
                $('#prov-lmb').append(data.nama_prov);
                $('#telp-lmb').append(data.telp);
                $('#nam-lmb').append(data.nama);
                $('#kc-lmb').append(data.nama_kec, ', ', moment().format('DD MMMM YYYY'));
                if (data.foto == null) {
                    $('#qrcode').removeProp('src').hide();
                } else {
                    $('#qrcode').attr('src', base_url + '/qrcode/awal/' + data.qr_code).show();
                }
                if (data.foto == null) {
                    $('#foto_sis').removeProp('src').hide();
                } else {
                    $('#foto_sis').attr('src', base_url + '/foto/' + data.foto).show();
                }

            }
        });
    });

    function printcard() {
        const style = 'p{margin-bottom: 0em; }';
        printJS({
            printable: 'card-print',
            type: 'html',
            css: ['<?= base_url('assets/surat/css/sheets-of-paper-a4.css'); ?>'],
            scanStyles: false,
            style: style
        })
    }

    $(function() {
        $.ajax({
            url: '<?= base_url('ppdb/data/get_all') ?>',
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<input type="checkbox" value="' + data[i].id + '" >   ' + data[i].sarat + '</br > ';
                }
                document.getElementById("syar").innerHTML = html;
            }
        });
    });

    function simpan() {
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
                var formData = new FormData(form); // remove the text-danger
                $(".text-danger").remove();
                $.ajax({
                    url: '<?= base_url('ppdb/data/edit') ?>',
                    type: 'post',
                    data: formData, //form.serialize(), // /converting the form data into array and sending it to server
                    mimeType: "multipart/form-data",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'PPDB Muhammadiyah',
                                text: response.messages,
                                showConfirmButton: false,
                                timer: 6000
                            }).then(function() {
                                location = '<?= base_url('ppdb/data') ?>';
                            });
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
                                    position: 'bottom-end',
                                    icon: 'error',
                                    title: response.messages,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        }
                        $('#add-form-btn').html('Simpan');
                    }
                });
                return false;
            }
        });
        $('#add-form').validate();
    }
</script>
<?= $this->endsection(); ?>