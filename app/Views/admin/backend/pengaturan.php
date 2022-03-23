<?= $this->include('admin/load/select2') ?>
<?= $this->include('admin/load/datatables') ?>
<?= $this->extend('admin/layout/index') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" onclick="sch()" href="#sekolah" data-toggle="tab">Data Sekolah</a></li>
                    <li class="nav-item"><a class="nav-link" onclick="jurusan()" href="#jur" data-toggle="tab">Jurusan/Peminatan</a></li>
                    <li class="nav-item"><a class="nav-link" onclick="ppdb()" href="#ppdb" data-toggle="tab">Pengaturan PPDB</a></li>
                    <li class="nav-item"><a class="nav-link" onclick="set()" href="#sya" data-toggle="tab">Persyarat PPDB</a></li>
                    <li class="nav-item"><a class="nav-link" onclick="contact()" href="#contact" data-toggle="tab">Contact Person</a></li>

                </ul>
            </div>
            <!-- sekolah -->
            <div class="tab-content ">
                <div class="active tab-pane pt-4" id="sekolah">
                    <form id="add-form" class="pl-3 pr-3" enctype="multipart/form-data" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="oldlogo" id="oldlogo">
                        <input type="hidden" name="oldban1" id="oldban1">
                        <input type="hidden" name="oldban2" id="oldban2">
                        <div class="form-group">
                            <label for="sekolah"> Nama Sekolah: <span class="text-danger">*</label>
                            <input type="text" id="sekolah" name="sekolah" class="form-control" placeholder="Nama Sekolah" required>
                        </div>
                        <div class="form-group">
                            <label for="visi"> Visi: <span class="text-danger">*</span> </label>
                            <textarea cols="40" rows="5" id="visi" name="visi" class="form-control" placeholder="Visi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="alamat"> Alamat: <span class="text-danger">*</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email" maxlength="50">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="provinsi"> Provinsi: <span class="text-danger">*</label>
                                    <select id="provinsi" name="provinsi" class="form-control" placeholder="Provinsi" required>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kabupaten"> Kabupaten: <span class="text-danger">*</label>
                                    <select type="number" id="kabupaten" name="kabupaten" class="form-control" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kecamatan"> Kecamatan: <span class="text-danger">*</label>
                                    <select type="number" id="kecamatan" name="kecamatan" class="form-control" required>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="maps"> Maps: </label>
                                    <input type="text" id="maps" name="maps" class="form-control" placeholder="Googla Maps">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo"> Logo: <span class="text-danger">* </label>
                                    <input type="file" id="logo" name="logo" class="form-control" onchange="onFileUpload(this);" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <div class="d-grid text-center">
                                        <img class="img-thumbnail" height="100px" width="200px" id="scrlogo" src="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="baner1"> Banner 1: <span class="text-danger">*</span> </label>
                                    <input type="file" id="baner1" name="baner1" class="form-control" onchange="onBaner1(this);" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <div class="d-grid text-center">
                                        <img class="img-thumbnail" height="100px" width="200px" id="gam1" src="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="baner2"> Banner 2: <span class="text-danger">*</span> </label>
                                    <input type="file" id="baner2" name="baner2" class="form-control" onchange="onBaner2(this);" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <div class="d-grid text-center">
                                        <img class="img-thumbnail" height="100px" width="200px" id="gam2" src="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" onclick="school()" id="add-form-btn">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ppdb pengaturan -->
            <div class="tab-content ">
                <div class="tab-pane pt-4" id="ppdb">
                    <form id="add-form-set" class="pl-3 pr-3" enctype="multipart/form-data" method="POST">
                        <?= csrf_field() ?>
                        <div class="row">
                            <input type="hidden" id="oldbros" name="oldbros" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenjang"> Jenjang: </label>
                                    <select id="jenjang" name="jenjang" class="custom-select" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tapel"> Tahun Pelajaran: <span class="text-danger">*</span> </label>
                                    <input type="text" id="tapel" name="tapel" class="form-control" placeholder="Tahun Pelajaran" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester"> Semester: <span class="text-danger">*</span> </label>
                                    <input type="text" id="semester" name="semester" class="form-control" placeholder="Semester" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jalur"> Jalur: <span class="text-danger">*</span> </label>
                                    <input type="text" id="jalur" name="jalur" class="form-control" placeholder="Jalur" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="info"> Info PPDB: <span class="text-danger">*</span> </label>
                                    <textarea type="text" id="info" name="info" class="form-control" placeholder="info"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status"> Pengumuman PPDB: </label>
                                    <textarea cols="40" rows="5" id="status" name="status" class="form-control" placeholder="Pengumuman PPDB"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brosur"> Brosur: </label>
                                    <input type="file" id="brosur" name="brosur" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" onclick="setppdb()" class="btn btn-success" id="add-form-btn-set">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- persyaratan -->
            <div class="tab-content ">
                <div class="tab-pane" id="sya">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-sm btn-success" onclick="add_syarat()" title="Tambah"> <i class="fa fa-plus"></i> Tambah</button>
                    </div>
                    <br>
                    <table id="data-syarat" class="table table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Syarat Pendaftaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- contact -->
            <div class="tab-content pt-4">
                <div class="tab-pane" id="contact">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-sm btn-success" onclick="add_contact()" title="Tambah"> <i class="fa fa-plus"></i> Tambah</button>
                    </div>
                    <br>
                    <table id="data-contact" class="table table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama </th>
                                <th>Telphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- jrusan -->
            <div class="tab-content pt-4">
                <div class="tab-pane" id="jur">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-sm btn-success" onclick="add_jurusan()" title="Tambah"> <i class="fa fa-plus"></i> Tambah</button>
                    </div>
                    <br>
                    <table id="data-jurusan" class="table table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Jurusan/Peminatan </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('admin/backend/syarat'); ?>
<?= $this->include('admin/backend/contact'); ?>
<?= $this->include('admin/backend/jurusan'); ?>

<?= $this->endSection() ?>
<?= $this->section('js'); ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
<script>
    var base_url = '<?= base_url(); ?>';
    $('textarea#status')
        .summernote({
            height: "300px",
            codemirror: {
                theme: 'monokai'
            },
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            }
        });

    function onFileUpload(input, id) {
        id = id || '#scrlogo';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(id).attr('src', e.target.result).width(200)
            };
            reader.readAsDataURL(input.files[0]);
            $('#scrlogo').removeProp('src').show();
        }
    }

    function onBaner1(input, id) {
        id = id || '#gam1';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(id).attr('src', e.target.result).width(200)
            };
            reader.readAsDataURL(input.files[0]);
            $('#gam1').removeProp('src').show();
        }
    }

    function onBaner2(input, id) {
        id = id || '#gam2';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(id).attr('src', e.target.result).width(200)
            };
            reader.readAsDataURL(input.files[0]);
            $('#gam2').removeProp('src').show();
        }
    }

    $(function() {
        var id = 1;
        $.ajax({
            url: '<?= base_url($sekolah . '/getOne') ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $("#add-form #oldlogo").val(response.logo);
                $("#add-form #oldban1").val(response.baner1);
                $("#add-form #oldban2").val(response.baner2);
                $("#add-form #visi").val(response.visi);
                $("#add-form #sekolah").val(response.nama);
                $("#add-form #alamat").val(response.alamat);

                $("#add-form #email").val(response.email);
                $("#add-form #maps").val(response.maps);
                $("#add-form-set #info").val(response.info);
                if (response.logo == null) {
                    $('#scrlogo').removeProp('src').hide();
                } else {
                    $('#scrlogo').attr('src', base_url + '/gambar/' + response.logo).show();
                }
                if (response.logo == null) {
                    $('#gam1').removeProp('src').hide();
                } else {
                    $('#gam1').attr('src', base_url + '/gambar/' + response.baner1).show();
                }
                if (response.logo == null) {
                    $('#gam2').removeProp('src').hide();
                } else {
                    $('#gam2').attr('src', base_url + '/gambar/' + response.baner2).show();
                }
            }
        });
    });

    $(function() {
        var id = 1;
        $.ajax({
            url: '<?= base_url($controller . '/getOne') ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                // reset the form 
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $("#add-form-set #jenjang").val(data.jenjang);
                $("#add-form-set #tapel").val(data.tapel);
                $("#add-form-set #semester").val(data.semester);
                $("#add-form-set #jalur").val(data.jalur);
            }
        });
    });

    $(function() {
        var id = 1;
        $.ajax({
            url: '<?= base_url($controller . '/getinfo') ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                // reset the form 
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $("#add-form-set #status").summernote('code', data.status);
                $("#add-form-set #oldbros").val(data.brosur);
            }
        });
    });

    function sch() {
        $("#sekolah").addClass('active');
        $("#sya").removeClass('active');
        $("#ppdb").removeClass('active');
        $("#contact").removeClass('active');
        $("#jur").removeClass('active');
    };

    function ppdb() {
        $("#ppdb").addClass('active');
        $("#sekolah").removeClass('active');
        $("#sya").removeClass('active');
        $("#contact").removeClass('active');
        $("#jur").removeClass('active');
    };

    function set() {
        $("#sya").addClass('active');
        $("#ppdb").removeClass('active');
        $("#sekolah").removeClass('active');
        $("#contact").removeClass('active');
        $("#jur").removeClass('active');
    };

    function contact() {
        $("#contact").addClass('active');
        $("#sya").removeClass('active');
        $("#ppdb").removeClass('active');
        $("#sekolah").removeClass('active');
        $("#jur").removeClass('active');
    };

    function jurusan() {
        $("#jur").addClass('active');
        $("#contact").removeClass('active');
        $("#sya").removeClass('active');
        $("#ppdb").removeClass('active');
        $("#sekolah").removeClass('active');
    };

    // provinsi
    $(function() {
        $.ajax({
            url: '<?= base_url($controller . '/jenjang') ?>',
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data == false) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Data Jenjang tidak tersedia!',
                        showConfirmButton: false,
                        timer: 6000
                    })
                } else {
                    var html = '<option value="">Pilih Jenjang</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                    }
                    $('#jenjang').html(html);
                }
            }
        });
    });
    // provinsi
    $(function() {
        $.ajax({
            url: '<?= base_url($controller . '/getProv') ?>',
            method: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data == false) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Data Provinsi tidak tersedia!',
                        showConfirmButton: false,
                        timer: 6000
                    })
                } else {
                    var html = '<option value="">Pilih Provinsi</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama_prov + '</option>';
                    }
                    $('#provinsi').html(html);
                }
            }
        });
    });
    // kabupaten
    $('#kabupaten').change(function() {
        var id = $('#kabupaten').val();
        $.ajax({
            url: '<?= base_url($controller . '/getKec') ?>',
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data == false) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Data Kecamatan tidak tersedia!',
                        showConfirmButton: false,
                        timer: 6000
                    })
                } else {
                    var html = '<option value="">Pilih Kecamatan</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama_kec + '</option>';
                    }
                    $('#kecamatan').html(html);
                }
            }
        });
        return false;
    });
    // kecamatan
    $('#provinsi').change(function() {
        var id = $('#provinsi').val();
        $.ajax({
            url: '<?= base_url($controller . '/getKab') ?>',
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data == false) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Data Kabupaten tidak tersedia!',
                        showConfirmButton: false,
                        timer: 6000
                    })
                } else {
                    var html = '<option value="">Pilih Kabupaten</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama_kab + '</option>';
                    }
                    $('#kabupaten').html(html);
                }
            }
        });
        return false;
    });
    // Setting Sekolah
    function school() {
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
                var formData = new FormData(form);
                $(".text-danger").remove();
                $.ajax({
                    url: '<?= base_url($sekolah . '/edit') ?>',
                    type: 'post',
                    data: formData, // /converting the form data into array and sending it to server
                    // mimeType: "multipart/form-data",
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
                                title: 'Terimakasih',
                                text: response.messages,
                                showConfirmButton: false,
                                timer: 4500
                            }).then(function() {
                                window.location.reload();
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
                        $('#add-form-btn').html('Simpan');
                    }
                });
                return false;
            }
        });
        $('#add-form').validate();
    }
    // setting PPDB
    function setppdb() {
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

            submitHandler: function() {
                var dataform = new FormData(document.getElementById("add-form-set"));
                // var dataform = $('#add-form-set');
                $(".text-danger").remove();
                $.ajax({
                    url: '<?= base_url($controller . '/simpan') ?>',
                    type: 'post',
                    data: dataform, // /converting the form data into array and sending it to server
                    mimeType: "multipart/form-data",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#add-form-btn-set').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terimakasih',
                                text: response.messages,
                                showConfirmButton: false,
                                timer: 4500
                            }).then(function() {
                                window.location.reload();
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
                        $('#add-form-btn-set').html('Simpan');
                    }
                });
                return false;
            }
        });
        $('#add-form-set').validate();
    }
</script>
<?= $this->endSection(); ?>