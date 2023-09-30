<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap - {{ $row->name }}</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table tr th,
    table tr td {
        border: 1px solid #34495e;
    }
</style>

<body>
    <h4>Daftar Pertemuan - {{ $row->name }}</h4>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>PERTEMUAN KE</th>
                <th>MATERI</th>
                <th>WAKTU ABSEN</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
