@extends('template.backend')

@section('title', $title)

@section('konten')
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Pertemuan - {{ $row->name }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
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
                                        <img src="{{ asset($item->foto_absensi) }}" alt="foto" onclick="detail_gambar(this);" class="img rounded" style="width: 150px;">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
