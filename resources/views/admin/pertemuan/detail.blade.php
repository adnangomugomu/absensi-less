<div class="row">
    <div class="col-md-4">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>PERTEMUAN KE</h4>
            <div>{{ $row->pertemuan_ke }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>MATERI</h4>
            <div>{{ $row->materi }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>TANGGAL</h4>
            <div>{{ $row->tanggal }}</div>
        </div>
    </div>
</div>

<h4>Peserta Yang Hadir</h4>
<div class="table-responsive">
    <table class="table table-bordered table-custom">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>WAKTU ABSEN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($row->absensi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-danger w-25">Hapus Data</button>
    </div>
</div>
