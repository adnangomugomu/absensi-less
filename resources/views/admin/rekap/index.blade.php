@extends('template.backend')

@section('title', $title)

@section('header', $header)

@section('konten')
    <section class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-custom" style="width: 100%" id="table-data">
                        <thead>
                            <tr>
                                <th style="width: 30px;">NO</th>
                                <th>NAMA</th>
                                <th>FOTO</th>
                                <th>TOTAL PERTEMUAN</th>
                                <th>REKAP PDF</th>
                                <th style="width: 120px;">AKSI</th>
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
                    url: '{{ route('admin.rekap.getTable') }}',
                    type: 'GET',
                    dataType: 'JSON',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
                    },
                    {
                        data: 'total_pertemuan',
                        name: 'total_pertemuan'
                    },
                    {
                        data: 'cetak_pdf',
                        name: 'cetak_pdf'
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

        function detailData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.rekap.detail', '') }}/" + id,
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
                        judul: 'Detail Rekap',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }
    </script>
@endsection
