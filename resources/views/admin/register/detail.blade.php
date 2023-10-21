<div class="row">
    <div class="col-md-4">
        <div class="mb-2 alert border-secondary bg-image1">
            <img src="{{ asset($row->foto) }}" onerror="this.src='{{ asset('img/default.png') }}'" alt="foto profil" class="img rounded" style="width: 150px;">
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Role</h4>
            <div>{{ $row->role->nama }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Nama Lengkap</h4>
            <div>{{ $row->name }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Username</h4>
            <div>{{ $row->username }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Nomer HP</h4>
            <div>{{ $row->no_hp }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Email</h4>
            <div>{{ $row->email }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Provinsi</h4>
            <div>{{ $row->provinsi->nama }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Kabupaten</h4>
            <div>{{ $row->kabupaten->nama }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Kecamatan</h4>
            <div>{{ $row->kecamatan->nama }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Kelurahan</h4>
            <div>{{ $row->kelurahan->nama }}</div>
        </div>
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Terdaftar Pada</h4>
            <div>{{ tglIndo($row->created_at, 'd-M-Y H:i') }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-danger">Hapus Data</button>
    </div>
</div>
