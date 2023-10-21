<div class="row">
    <div class="col-md-6">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Nama</h4>
            <div>{{ $row->user->name }}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Waktu Absen</h4>
            <div>{{ $row->created_at }}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Foto Absen</h4>
            <div>
                <img class="img img-fluid rounded" src="{{ asset($row->foto_absensi) }}" alt="foto" style="width: 100%;">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-danger">Hapus Data</button>
    </div>
</div>
