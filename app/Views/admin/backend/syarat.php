<!-- Add modal content -->
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="text-center bg-info p-3">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Tambah Syarat</h4>
            </div>
            <div class="modal-body">
                <form id="add-syarat" class="pl-3 pr-3">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sarat"> Sarat: </label>
                                <textarea cols="40" rows="5" id="sarat" name="sarat" class="form-control" placeholder="Sarat"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success" id="add-syarat-btn">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add modal content -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="text-center bg-info p-3">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Update Syarat</h4>
            </div>
            <div class="modal-body">
                <form id="edit-sarat" class="pl-3 pr-3">
                    <?= csrf_field() ?>
                    <div class="row">
                        <input type="hidden" id="id_sy" name="id_sy" class="form-control" placeholder="Id" malgength="11" required>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sarat"> Sarat: </label>
                                <textarea cols="40" rows="5" id="sarat" name="sarat" class="form-control" placeholder="Sarat"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success" id="edit-sarat-btn">Ubah</button>
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
    // persyaratan
    var tableSyarat = $('#data-syarat').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [
            [1, 'asc']
        ],

        ajax: {
            url: '<?= base_url($controller . '/get_syarat') ?>',
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
                'data': 'sarat'
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                            <button type="button" title="Edit Persyaratan" class="btn btn-sm btn-warning" onclick="edit_syarat('${data.id_sy}')"><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" title="Hapus Persyaratan" class="btn btn-sm btn-primary" onclick="remove_syarat('${data.id_sy}')"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    tableSyarat.on('draw.dt', function() {
        var PageInfo = $('#data-syarat').DataTable().page.info();
        tableSyarat.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    function add_syarat() {
        // reset the form 
        $("#add-syarat")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal').modal('show');
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
                var form = $('#add-syarat');
                // remove the text-danger
                $(".text-danger").remove();
                $.ajax({
                    url: '<?= base_url('backand/pengaturan/add_syarat') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add-syarat-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data-syarat').DataTable().ajax.reload(null, false).draw(false);
                                $('#add-modal').modal('hide');
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
                        $('#add-syarat-btn').html('Add');
                    }
                });

                return false;
            }
        });
        $('#add-syarat').validate();
    }

    function edit_syarat(id_sy) {
        $.ajax({
            url: '<?= base_url('backand/pengaturan/getEdit') ?>',
            type: 'post',
            data: {
                id_sy: id_sy
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#edit-sarat")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-sarat #id_sy").val(response.id_sy);
                $("#edit-sarat #sarat").val(response.sarat);

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
                        var form = $('#edit-sarat');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?= base_url('backand/pengaturan/edit_syarat') ?>',
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#edit-sarat-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                            },
                            success: function(response) {
                                if (response.success === true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.messages,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        $('#data-syarat').DataTable().ajax.reload(null, false).draw(false);
                                        $('#edit-modal').modal('hide');
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
                                $('#edit-sarat-btn').html('Update');
                            }
                        });
                        return false;
                    }
                });
                $('#edit-sarat').validate();
            }
        });
    }

    function remove(id_sy) {
        Swal.fire({
            title: 'Anda yakin hapus data?',
            text: "Data tidak dapat dikembalikan setelah konfirmasi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.value) {
                $.ajax({
                    url: '<?= base_url('backand/pengaturan/remove_syarat') ?>',
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
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
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