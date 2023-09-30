<div class="row">
    <div class="col-md-4">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Nama</h4>
            <div>{{ $row->name }}</div>
        </div>
    </div>
</div>

<h4>Daftar Pertemuan</h4>
<div class="table-responsive">
    <table class="table table-bordered table-custom">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>PERTEMUAN KE</th>
                <th>MATERI</th>
                <th>WAKTU ABSEN</th>
                <th>FOTO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($row->absensi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pertemuan->tanggal }}</td>
                    <td>{{ $item->pertemuan->pertemuan_ke }}</td>
                    <td>{{ $item->pertemuan->materi }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <img src="{{ asset($item->foto_absensi) }}" alt="foto" class="img rounded" style="width: 150px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
