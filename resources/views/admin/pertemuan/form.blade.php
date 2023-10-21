<form action="#" onsubmit="event.preventDefault();doSubmit(this);">   
    <div class="form-group">
        <label>Pertemuan Ke <small class="text-danger">*</small></label>
        <input type="number" name="pertemuan_ke" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Materi <small class="text-danger">*</small></label>
        <input type="text" name="materi" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Tanggal <small class="text-danger">*</small></label>
        <input type="date" value="{{ date('Y-m-d') }}" name="tanggal" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">UPDATE</button>
    </div>
</form>

<script>
    function doSubmit(dt) {

        Swal.fire({
            title: 'Simpan Data ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.pertemuan.store') }}",
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
