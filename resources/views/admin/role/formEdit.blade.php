<form action="#" onsubmit="event.preventDefault();doSubmit(this);">
    <div class="form-group">
        <label>Nama Role <small class="text-danger">*</small></label>
        <input type="text" value="{{ $row->nama }}" name="nama" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">UPDATE</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.form_select').select2({
            width: '100%',
        })
    });

    function doSubmit(dt) {

        Swal.fire({
            title: 'Update Data ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    url: "{{ route('admin.role.update', $row->id) }}",
                    data: new FormData(dt),
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    beforeSend: function(res) {
                        beforeLoading(res);
                    },
                    error: function(res) {
                        errorLoading(res);
                    },
                    success: function(res) {
                        $('#modal_custom').modal('hide');
                        Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil disimpan',
                                showConfirmButton: true,
                            })
                            .then(() => {
                                $('#table-data').DataTable().ajax.reload();
                            })
                    }
                });
            }
        })
    }
</script>
