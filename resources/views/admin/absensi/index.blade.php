@extends('template.backend')

@section('title', $title)

@section('header', $header)

@section('tombol')
    <button class="btn btn-warning" onclick="history.go(-1);"><i class="bx bx-left-arrow-circle"></i> Kembali</button>
    <a class="btn btn-primary" href="{{ route('admin.absensi.create', $row->id) }}"><i class="bx bx-plus"></i> Tambah Data</a>
@endsection

@section('konten')
    <section class="card">
        <div class="card-content">
            <div class="card-body">

                <div class="row bg-success bg-light p-2 rounded">
                    <div class="col-md-4">
                        <div class="card text-center mb-0">
                            <div class="card-content">
                                <div class="card-body py-1">
                                    <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                        <i class="bx bx-user-check font-medium-5"></i>
                                    </div>
                                    <div class="text-muted line-ellipsis">PERTEMUAN KE</div>
                                    <h3 class="mb-0">{{ $row->pertemuan_ke }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center mb-0">
                            <div class="card-content">
                                <div class="card-body py-1">
                                    <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                        <i class="bx bx-notepad font-medium-5"></i>
                                    </div>
                                    <div class="text-muted line-ellipsis">MATERI</div>
                                    <div class="mb-0">{{ $row->materi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center mb-0">
                            <div class="card-content">
                                <div class="card-body py-1">
                                    <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                        <i class="bx bx-calendar-event font-medium-5"></i>
                                    </div>
                                    <div class="text-muted line-ellipsis">TANGGAL</div>
                                    <h3 class="mb-0">{{ $row->tanggal }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-custom" style="width: 100%" id="table-data">
                        <thead>
                            <tr>
                                <th style="width: 30px;">NO</th>
                                <th>NAMA</th>
                                <th>FOTO</th>
                                <th>WAKTU</th>
                                <th style="width: 50px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            load_table();
        });

        function load_table() {
            $('#table-data').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ordering: true,
                autoWidth: false,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: '{{ route('admin.absensi.getTable', $row->id) }}',
                    type: 'GET',
                    dataType: 'JSON',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'foto_absensi',
                        name: 'foto_absensi',
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [],
                columnDefs: [{
                    targets: [0, -1],
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                }],
            })
        }

        function editData(id) {
            location.href = "{{ route('admin.absensi.edit', '') }}/" + id;
        }

        function detailData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.absensi.detail', '') }}/" + id,
                dataType: "JSON",
                data: {},
                beforeSend: function(res) {
                    beforeLoading(res);
                },
                error: function(res) {
                    errorLoading(res);
                },
                success: function(res) {
                    Swal.close();
                    show_modal_custom({
                        judul: 'Detail Data Role',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function hapusData(id) {
            Swal.fire({
                title: 'Hapus Data Role ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.absensi.delete', '') }}/" + id,
                        dataType: "JSON",
                        beforeSend: function(res) {
                            beforeLoading(res);
                        },
                        error: function(res) {
                            errorLoading(res);
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil dihapus',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    $('#modal_custom').modal('hide');
                                    $('#table-data').DataTable().ajax.reload();
                                });
                        }
                    });
                }
            })
        }
    </script>
@endsection
