<?= $this->extend('ppdb/layout') ?>
<?= $this->section('content') ?>
<section>
    <div class="container">
        <aside class=" masthead text-center ">
            <div class="container px-5 align-items-center">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2 bg-gradient-primary-to-secondary text-white">
                                <h3>Data Pendaftar</h3>
                                <p class="text-white">Lengkapi Data Anda sebelum melakukan ke tahap selanjutnya</p>
                            </div>
                            <form id="add-form" enctype="multipart/form-data" method="POST">
                                <?= csrf_field(); ?>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="diri">
                                        <div class="h-100 p-5 mb-4 mt-2">
                                            <p> Data Diri Sesuai dengan Kartu Keluarga</p>
                                            <div class="row">
                                                <input type="hidden" id="id" name="id" class="form-control" value="<?= session()->get('id'); ?>" maxlength="5" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="nama" name="nama" class="form-control" value="<?= session()->get('nama'); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group mb-3">
                                                        <select id="jk" name="jk" class="form-control" placeholder="Jenis Kelamin" required>
                                                            <option value="">Pilih Jenis Kelamin</option>
                                                            <option value="L">Laki Laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group mb-3">
                                                        <select id="agama" name="agama" class="form-control" required>
                                                            <option value="">Pilih Agama</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Kristen">Kristen</option>
                                                            <option value="Budha">Buddha</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Khonghucu">Khonghucu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="tmptlahir" name="tmptlahir" class="form-control" placeholder="Tempat Lahir" maxlength="100" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="date" id="tgllahir" name="tgllahir" class="form-control" dateISO="true" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <p> Data Alamat Sesuai dengan Kartu Keluarga</p>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" maxlength="100" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="rt" name="rt" class="form-control" placeholder="RT" maxlength="3" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="rw" name="rw" class="form-control" placeholder="RW" maxlength="3" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="dusun" name="dusun" class="form-control" placeholder="Dusun" maxlength="100" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <select id="provinsi" name="provinsi" class="form-control" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <select id="kabupaten" name="kabupaten" class="form-control" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <select id="kecamatan" name="kecamatan" class="form-control" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <select id="kelurahan" name="kelurahan" class="form-control" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="domisili" name="domisili" class="form-control" placeholder="Alamat Domisili Lengkap">
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Sekolah Asal</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="sklAsal" name="sklAsal" class="form-control" placeholder="Sekolah Asal" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="almtSkl" name="almtSkl" class="form-control" placeholder="Alamat Sekolah" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <p> Data Ijaza</p>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="noUn" name="noUn" class="form-control" placeholder="No Ujian Nasional">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="noIjazah" name="noIjazah" class="form-control" placeholder="No Ijazah">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="noSkhun" name="noSkhun" class="form-control" placeholder="No SKHUN">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="btn-group mb-4 ">
                                                <a class="btn btn-success rounded-1 btn-md ml-3 mr-3" onclick="orangtua()" id="2up">Selanjutnya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="ortu">
                                        <div class="h-100 p-5 mb-4">
                                            <p> Data Orangtua Sesuai dengan Kartu Keluarga</p>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="nmIbu" name="nmIbu" class="form-control" placeholder="Nama Ibu Kandung" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <select id="pendIbu" name="pendIbu" class="form-control" maxlength="20" required>
                                                            <option value="">Pilih Pendidikan</option>
                                                            <option value="SD">SD</option>
                                                            <option value="SMP">SMP</option>
                                                            <option value="SMA">SMA</option>
                                                            <option value="D1">D1</option>
                                                            <option value="D2">D2</option>
                                                            <option value="D3">D3</option>
                                                            <option value="S1">S1</option>
                                                            <option value="S2">S2</option>
                                                            <option value="S3">S3</option>
                                                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <select id="krjibu" name="krjibu" class="form-control" required>
                                                            <option value="">Pilih Pekerjaan</option>
                                                            <option value="Buruh">Buruh</option>
                                                            <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                            <option value="Nelayan">Nelayan</option>
                                                            <option value="Pedagang Besar">Pedagang Besar</option>
                                                            <option value="Pedagang Kecil">Pedagang Kecil</option>
                                                            <option value="Pensiunan">Pensiunan</option>
                                                            <option value="Petani">Petani</option>
                                                            <option value="Peternak">Peternak</option>
                                                            <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                                            <option value="Sudah Meninggal">Sudah Meninggal</option>
                                                            <option value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                                            <option value="Tidak bekerja">Tidak bekerja</option>
                                                            <option value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                                            <option value="Wiraswasta">Wiraswasta</option>
                                                            <option value="Wirausaha">Wirausaha</option>
                                                            <option value="Lainnya">Lainnya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="hasilIbu" name="hasilIbu" class="form-control" placeholder="Penghasilan " required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="nmayh" name="nmayh" class="form-control" placeholder="Nama Ayah Kandung" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <select id="pendayah" name="pendayah" class="form-control" maxlength="20" required>
                                                            <option value="">Pilih Pendidikan</option>
                                                            <option value="SD">SD</option>
                                                            <option value="SMP">SMP</option>
                                                            <option value="SMA">SMA</option>
                                                            <option value="D1">D1</option>
                                                            <option value="D2">D2</option>
                                                            <option value="D3">D3</option>
                                                            <option value="S1">S1</option>
                                                            <option value="S2">S2</option>
                                                            <option value="S3">S3</option>
                                                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <select id="krjayah" name="krjayah" class="form-control" required>
                                                            <option value="">Pilih Pekerjaan</option>
                                                            <option value="Buruh">Buruh</option>
                                                            <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                            <option value="Nelayan">Nelayan</option>
                                                            <option value="Pedagang Besar">Pedagang Besar</option>
                                                            <option value="Pedagang Kecil">Pedagang Kecil</option>
                                                            <option value="Pensiunan">Pensiunan</option>
                                                            <option value="Petani">Petani</option>
                                                            <option value="Peternak">Peternak</option>
                                                            <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                                            <option value="Sudah Meninggal">Sudah Meninggal</option>
                                                            <option value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                                            <option value="Tidak bekerja">Tidak bekerja</option>
                                                            <option value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                                            <option value="Wiraswasta">Wiraswasta</option>
                                                            <option value="Wirausaha">Wirausaha</option>
                                                            <option value="Lainnya">Lainnya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="hasilayh" name="hasilayh" class="form-control" placeholder="Penghasilan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <p> Status Siswa</p>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <select type="text" id="stsTinggal" name="stsTinggal" class="form-control" placeholder="Status Tinggal" required>
                                                            <option value="">Pilih Status Tinggal</option>
                                                            <option value="Bersama Orangtua">Bersama Orangtua</option>
                                                            <option value="Bersama Wali">Bersama Wali</option>
                                                            <option value="Sendiri">Sendiri/Kos/Kontrak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="anakke" name="anakke" class="form-control" placeholder="Anak ke" maxlength="2" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="jmlsdr" name="jmlsdr" class="form-control" placeholder="Jumlah Saudara" maxlength="2" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <p> Data Wali Siswa</p>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="nmWl" name="nmWl" class="form-control" placeholder="Nama Wali">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <select id="pendWl" name="pendWl" class="form-control" maxlength="20">
                                                            <option value="">Pilih Pendidikan</option>
                                                            <option value="SD">SD</option>
                                                            <option value="SMP">SMP</option>
                                                            <option value="SMA">SMA</option>
                                                            <option value="D1">D1</option>
                                                            <option value="D2">D2</option>
                                                            <option value="D3">D3</option>
                                                            <option value="S1">S1</option>
                                                            <option value="S2">S2</option>
                                                            <option value="S3">S3</option>
                                                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <select id="kerjaWl" name="kerjaWl" class="form-control">
                                                            <option value="">Pilih Pekerjaan</option>
                                                            <option value="Buruh">Buruh</option>
                                                            <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                            <option value="Nelayan">Nelayan</option>
                                                            <option value="Pedagang Besar">Pedagang Besar</option>
                                                            <option value="Pedagang Kecil">Pedagang Kecil</option>
                                                            <option value="Pensiunan">Pensiunan</option>
                                                            <option value="Petani">Petani</option>
                                                            <option value="Peternak">Peternak</option>
                                                            <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                                            <option value="Sudah Meninggal">Sudah Meninggal</option>
                                                            <option value="Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
                                                            <option value="Tidak bekerja">Tidak bekerja</option>
                                                            <option value="Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                                            <option value="Wiraswasta">Wiraswasta</option>
                                                            <option value="Wirausaha">Wirausaha</option>
                                                            <option value="Lainnya">Lainnya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="hasilWl" name="hasilWl" class="form-control" placeholder="Penghasilan">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="altWl" name="altWl" class="form-control" placeholder="Alamat Wali">
                                                    </div>
                                                </div>
                                            </div>
                                            <p> Data Bantuan yang diterima</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="noKps" name="noKps" class="form-control" placeholder="No KPS">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="noKip" name="noKip" class="form-control" placeholder="No KIP">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="noKis" name="noKis" class="form-control" placeholder="No KIS">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <input type="text" id="noPkh" name="noPkh" class="form-control" placeholder="No PKH">
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="mt-8" type="checkbox" id="agre" name="agre">
                                            <input type="hidden" class="mt-8" type="checkbox" id="progres" name="progres">
                                            <label for="scales">Saya setuju! Data yang saya masukkan sesuai dengan data yang sebenarnya </label>

                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="btn-group mb-4">
                                                <button class="btn btn-primary rounded-1 btn-md" onclick="diri()" id="1up" data-toggle="tab">Sebelumnya</button>
                                                <button class="btn btn-success rounded-1 btn-md ml-3 mr-3" onclick="simpan()" id="add-form-btn">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>
<?= $this->endsection(); ?>
<?= $this->section('js') ?>
<script>
    $("#1up").hide('true');
    $("#add-form-btn").hide('true');

    function diri() {
        $("#1up").hide('true');
        $("#diri").addClass('active');
        $("#ortu").removeClass('active');
    }

    function orangtua() {
        $("#1up").show();
        $("#ortu").addClass('active');
        $("#diri").removeClass('active');
    }

    $('#agre').click(function() {
        if ($(this).is(':checked')) {
            Swal.fire({
                icon: 'success',
                title: 'Terimakasih',
                text: "Saya setuju! Data yang saya masukkan sudah sesuai",
                showConfirmButton: true,
                timer: 9000
            }).then(function() {
                $("#1up").hide('true');
                $("#add-form-btn").show('true');
                $("#progres").val('1');
            })
        }
        if (!$(this).is(':checked')) {
            $("#add-form-btn").hide('true');
            $("#1up").show('true');
            $("#progres").val('0');
        }
    });

    $(function() {
        $.ajax({
            url: '<?= base_url('datapendaftar/getProv') ?>',
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
    $('#provinsi').change(function() {
        var id = $('#provinsi').val();
        $.ajax({
            url: '<?= base_url('datapendaftar/getKab') ?>',
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
    // kecamatan
    $('#kabupaten').change(function() {
        var id = $('#kabupaten').val();
        $.ajax({
            url: '<?= base_url('datapendaftar/getKec') ?>',
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
    // desa/kelurahan
    $('#kecamatan').change(function() {
        var id = $('#kecamatan').val();
        $.ajax({
            url: '<?= base_url('datapendaftar/getDes') ?>',
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
                        title: 'Data Desa/Kelurahan tidak tersedia!',
                        showConfirmButton: false,
                        timer: 6000
                    })
                } else {
                    var html = '<option value="">Pilih Desa / Kelurahan</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama_des + '</option>';
                    }
                    $('#kelurahan').html(html);
                }
            }
        });
        return false;
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
                var form = $('#add-form');
                // remove the text-danger
                $(".text-danger").remove();
                $.ajax({
                    url: '<?= base_url('datapendaftar/add') ?>',
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