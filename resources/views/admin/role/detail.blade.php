<div class="row">
    <div class="col-md-4">
        <div class="mb-2 alert border-secondary bg-image1">
            <h4>Role</h4>
            <div>{{ $row->nama }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-danger">Hapus Data</button>
    </div>
</div>
