<form action="#" onsubmit="event.preventDefault();doSubmit(this);">
    <div class="form-group">
        <label>Nama Lengkap <small class="text-danger">*</small></label>
        <input type="text" name="name" value="{{ $row->name }}" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Username <small class="text-danger">*</small></label>
        <input type="text" name="username" value="{{ $row->username }}" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Email <small class="text-danger">*</small></label>
        <input type="email" name="email" value="{{ $row->email }}" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Nomer HP <small class="text-danger">*</small></label>
        <input type="number" name="no_hp" value="{{ $row->no_hp }}" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Povinsi <small class="text-danger">*</small></label>
                <select id="select_prov" onchange="pilih_kab(this);" name="kode_prop" class="form-control form_select" data-placeholder="pilih provinsi" required>
                    <option value=""></option>
                    @foreach ($provinsi as $item)
                        <option {{ $item->kode_wilayah == $row->kode_prop ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Kabupaten <small class="text-danger">*</small></label>
                <select id="select_kab" onchange="pilih_kec(this);" name="kode_kab" class="form-control form_select" data-placeholder="pilih kabupaten" required>
                    <option value=""></option>
                    @foreach ($kabupaten as $item)
                        <option {{ $item->kode_wilayah == $row->kode_kab ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Kecamatan <small class="text-danger">*</small></label>
                <select id="select_kec" onchange="pilih_kel(this);" name="kode_kec" class="form-control form_select" data-placeholder="pilih kecamatan" required>
                    <option value=""></option>
                    @foreach ($kecamatan as $item)
                        <option {{ $item->kode_wilayah == $row->kode_kec ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Kelurahan <small class="text-danger">*</small></label>
                <select id="select_kel" name="kode_kel" class="form-control form_select" data-placeholder="pilih kelurahan" required>
                    <option value=""></option>
                    @foreach ($kelurahan as $item)
                        <option {{ $item->kode_wilayah == $row->kode_kel ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
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
                    url: "{{ route('profil.update', $row->id) }}",
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
