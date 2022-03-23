<div class="modal fade">
    <div id="card-print">

        <body class="document">
            <div class="row">
                <div class="col-xl-12">
                    <table style="border:0;margin-left:8pt;padding-bottom:1px" cellspacing="0">
                        <tr style="height:20pt">
                            <td style="width:72pt;" colspan="3">
                                <p style="padding-top: 5pt;text-align: center;margin-bottom:0em"><img src="<?= base_url('gambar/' . $school->logo); ?>" alt="" height="72px" width="72px"></p>
                            </td>
                            <td style="width:740pt;" colspan="2">
                                <p style="font-size:12px;text-align: center;">PENERIMAAN PESERTA DIDIK BARU TAHUN PELAJARAN <?= $set->tapel; ?></p>
                                <p style="font-size:18px;text-align: center;"><?= $school->nama; ?></p>
                                <p style="text-align: center;font-style: italic;">Alamat :<?= $school->alamat, ' ', $school->nama_kec, ' ', $school->nama_kab ?></p>

                            </td>
                        </tr>
                    </table>
                    <hr>
                </div>
                <div class="col-xl-12">
                    <p style="text-indent: 0pt;text-align: center;font-size:larger;font-weight: bold;">KARTU PENDAFTARAN</p>
                </div>
                <hr>
                <div class="col-xl-12">
                    <p style="text-indent: 0pt;text-align: center;font-size:larger;font-weight: bold;">Data Calon Siswa</p>
                    <table style="border-collapse:collapse;margin-left:8pt" cellspacing="0">
                        <tr style="height:auto">
                            <td style="width: 200px;" colspan="3">
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Nama Calon Siswa</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Tempat,Tgl Lahir</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> NISN</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> NIK</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Alamat</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Kelurahan/Desa</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Kecamatan</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Kabupaten</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Provinsi</p>
                                <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> Telphone</p>
                            </td>
                            <td style="width:5pt">
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                                <p class="s4" style="padding-top: 5pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">:</p>
                            </td>
                            <td style="width: 700px;" colspan="2">
                                <p id="nama-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="tgl-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="nisn-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="nik-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="alm-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="des-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="kec-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="kab-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="prov-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                                <p id="telp-lmb" class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"> </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div class="col-xl-12">
                    <p style="text-indent: 0pt;text-align: center;font-size:larger;font-weight: bold;">PERSYARATAN PENDAFTARAN</p>
                    <hr>
                    <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Silakan ceklist persyaratan </p> <br>
                    <p id="syar"></p>
                </div>
                </br>
                <br>
                <div class="col-xl-12 pt-4">
                    <table style="border:0;margin-left:8pt;padding-bottom:1px" cellspacing="0">
                        <tr style="height:20pt">
                            <td style="width:72pt;" colspan="3">
                                <p style="padding-top: 5pt;text-align: center;margin-bottom:0em"><img id="qrcode" src="" alt="QRCODE" width="100" height="100" /></p>
                            </td>
                            <td style="width:72pt;" colspan="3">
                                <p style="padding-top: 5pt;text-align: center;margin-bottom:0em"><img id="foto_sis" src="" alt="QRCODE" width="140" height="175" /></p>
                            </td>
                            <td style="width:100px;">
                            </td>
                            <td style="width:250pt;" colspan="2">
                                <p id="kc-lmb" style="text-align: center;"></p>
                                <br>
                                <br>

                                <br>
                                <br>
                                <p id="nam-lmb" style="text-align: center;" class="pt-4"></p>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <p class="s4" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Lembar pendaftaran diserahkan ke Panitia Penerimaan Peserta Didik Baru <?= $set->tapel; ?> dengan melampirkan syarat diatas. </p> <br>
                </div>
            </div>
        </body>
    </div>
</div>