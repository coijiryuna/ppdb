<?= $this->include('admin/load/select2') ?>
<?= $this->include('admin/load/datatables') ?>
<?= $this->extend('admin/layout/index') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" onclick="data1()" href="#data1" data-toggle="tab">Data Selesai</a></li>
                    <li class="nav-item"><a class="nav-link" onclick="data2()" href="#data2" data-toggle="tab">Pendaftar</a></li>
                </ul>
            </div>
            <div class="tab-content pt-4">
                <div class="tab-pane active" id="data1">
                    <table id="data-siswa" class="table table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>NISN</th>
                                <th width="30px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-content pt-4">
                <div class="tab-pane " id="data2">
                    <table id="data-prog0" class="table table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>NISN</th>
                                <th width="30px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    var tableSiswa = $('#data-siswa').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [
            [1, 'asc']
        ],

        ajax: {
            url: '<?= route_to('backand/datapendaftar') ?>',
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0, 1, 2, 3, 4]
        }],
        columns: [{
                'data': null
            },
            {
                'data': 'nama'
            },
            {
                'data': 'nik'
            },
            {
                'data': 'nisn'
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                            <button type="button" title="Edit Persyaratan" class="btn btn-sm btn-warning" onclick="edit_lulus('${data.id}')"><i class="fas fa-pencil-alt"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    tableSiswa.on('draw.dt', function() {
        var PageInfo = $('#data-siswa').DataTable().page.info();
        tableSiswa.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    var progres0 = $('#data-prog0').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [
            [1, 'asc']
        ],

        ajax: {
            url: '<?= base_url('backand/datapendaftar/get_prog0') ?>',
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0, 1, 2, 3, 4]
        }],
        columns: [{
                'data': null
            },
            {
                'data': 'nama'
            },
            {
                'data': 'nik'
            },
            {
                'data': 'nisn'
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                            <button type="button" title="Edit Persyaratan" class="btn btn-sm btn-warning" onclick="edit_lulus('${data.id}')"><i class="fas fa-pencil-alt"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    progres0.on('draw.dt', function() {
        var PageInfo = $('#data-prog0').DataTable().page.info();
        progres0.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    function data1() {
        $("#data").addClass('active');
        $("#data2").removeClass('active');
    };

    function data2() {
        $("#data2").addClass('active');
        $("#data1").removeClass('active');
    };
</script>
<?= $this->endSection(); ?>