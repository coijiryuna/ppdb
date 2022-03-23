<div id="add-modal-cont" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="text-center bg-info p-3">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Tambah Kontak</h4>
            </div>
            <div class="modal-body">
                <form id="add-form-cont" class="pl-3 pr-3">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama"> Nama: </label>
                                <input cols="40" rows="5" id="nama" name="nama" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="telp"> Telphone: </label>
                                <input type="number" id="telp" name="telp" class="form-control" placeholder="Telp" maxlength="12" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success" id="add-form-cont-btn">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="edit-modal-cont" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="text-center bg-info p-3">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Ubah Kontak</h4>
            </div>
            <div class="modal-body">
                <form id="edit-form-cont" class="pl-3 pr-3">
                    <?= csrf_field() ?>
                    <div class="row">
                        <input type="hidden" id="id" name="id" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama"> Nama: </label>
                                <input cols="40" rows="5" id="nama" name="nama" class="form-control" placeholder="Nama">
                            </div>

                            <div class="form-group">
                                <label for="telp"> Telp: </label>
                                <input type="text" id="telp" name="telp" class="form-control" placeholder="Telp" maxlength="13">
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success" id="edit-form-cont-btn">Ubah</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->section('js'); ?>
<script>
    var tableContact = $('#data-contact').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [
            [1, 'asc']
        ],

        ajax: {
            url: '<?= base_url($controller . '/get_cont') ?>',
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0, 1, 2]
        }],
        columns: [{
                'data': null
            },
            {
                'data': 'nama'
            },
            {
                'data': 'telp'
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                            <button type="button" title="Edit Persyaratan" class="btn btn-sm btn-warning" onclick="edit_contact('${data.id}')"><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" title="Hapus Persyaratan" class="btn btn-sm btn-primary" onclick="remove_contact('${data.id}')"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    tableContact.on('draw.dt', function() {
        var PageInfo = $('#data-contact').DataTable().page.info();
        tableContact.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    function add_contact() {
        // reset the form 
        $("#add-form-cont")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal-cont').modal('show');
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
                var form = $('#add-form-cont');
                // remove the text-danger
                $(".text-danger").remove();
                $.ajax({
                    url: '<?= base_url($controller . '/add_ct') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add-form-cont-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data-contact').DataTable().ajax.reload(null, false).draw(false);
                                $('#add-modal-cont').modal('hide');
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
                                    timer: 1500
                                })
                            }
                        }
                        $('#add-form-cont-btn').html('Simpan');
                    }
                });
                return false;
            }
        });
        $('#add-form-cont').validate();
    }

    function edit_contact(id) {
        $.ajax({
            url: '<?= base_url($controller . '/get_ct') ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#edit-form-cont")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal-cont').modal('show');

                $("#edit-form-cont #id").val(response.id);
                $("#edit-form-cont #nama").val(response.nama);
                $("#edit-form-cont #telp").val(response.telp);

                // submit the edit from 
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
                        var form = $('#edit-form-cont');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?= base_url($controller . '/edit_ct') ?>',
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#edit-form-cont-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                            },
                            success: function(response) {
                                if (response.success === true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.messages,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        $('#data-contact').DataTable().ajax.reload(null, false).draw(false);
                                        $('#edit-modal-cont').modal('hide');
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
                                            timer: 1500
                                        })
                                    }
                                }
                                $('#edit-form-cont-btn').html('Update');
                            }
                        });
                        return false;
                    }
                });
                $('#edit-form-cont').validate();
            }
        });
    }

    function remove_contact(id) {
        Swal.fire({
            title: 'Are you sure of the deleting process?',
            text: "You cannot back after confirmation",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url($controller . '/remove_ct') ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data-contact').DataTable().ajax.reload(null, false).draw(false);
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        })
    }
</script>
<?= $this->endSection(); ?>