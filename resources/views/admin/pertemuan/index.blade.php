@extends('template.backend')

@section('title', $title)

@section('header', $header)
@section('tombol')
    <button class="btn btn-primary" onclick="tambahData();"><i class="bx bx-plus"></i> Tambah Data</button>
@endsection
@section('konten')
    <section class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-custom" style="width: 100%" id="table-data">
                        <thead>
                            <tr>
                                <th style="width: 30px;">NO</th>
                                <th>TANGGAL</th>
                                <th>MATERI</th>
                                <th>PERTEMUAN KE</th>
                                <th>ABSENSI</th>
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
                    url: '{{ route('admin.pertemuan.getTable') }}',
                    type: 'GET',
                    dataType: 'JSON',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'materi',
                        name: 'materi'
                    },
                    {
                        data: 'pertemuan_ke',
                        name: 'pertemuan_ke',
                        className: 'text-center',
                    },
                    {
                        data: 'absensi',
                        name: 'absensi'
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

        function tambahData() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.pertemuan.create') }}",
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
                        judul: 'Tambah Pertemuan',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function editData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.pertemuan.edit', '') }}/" + id,
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
                        judul: 'Edit Pertemuan',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function detailData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.pertemuan.detail', '') }}/" + id,
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
                        judul: 'Detail Pertemuan',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function hapusData(id) {
            Swal.fire({
                title: 'Hapus Pertemuan ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.pertemuan.delete', '') }}/" + id,
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
