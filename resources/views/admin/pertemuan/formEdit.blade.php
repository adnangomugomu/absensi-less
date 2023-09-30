<form action="#" onsubmit="event.preventDefault();doSubmit(this);">
    <div class="form-group">
        <label>Pertemuan Ke <small class="text-danger">*</small></label>
        <input type="number" value="{{ $row->pertemuan_ke }}" name="pertemuan_ke" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Materi <small class="text-danger">*</small></label>
        <input type="text" value="{{ $row->materi }}" name="materi" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Tanggal <small class="text-danger">*</small></label>
        <input type="date" value="{{ $row->tanggal }}" name="tanggal" class="form-control" placeholder="masukkan isian" required>
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
                    url: "{{ route('admin.pertemuan.update', $row->id) }}",
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
