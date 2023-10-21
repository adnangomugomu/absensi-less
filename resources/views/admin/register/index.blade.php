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
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>ROLE</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>NOMER HP</th>
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
                    url: '{{ route('admin.registrasi.getTable') }}',
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
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
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
                url: "{{ route('admin.registrasi.create') }}",
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
                        judul: 'Tambah Data Registrasi',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function editData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.registrasi.edit', '') }}/" + id,
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
                        judul: 'Edit Data Registrasi',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function detailData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.registrasi.detail', '') }}/" + id,
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
                        judul: 'Detail Data Registrasi',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function resetPassword(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.registrasi.resetPassword', '') }}/" + id,
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
                        judul: 'Reset Password',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function hapusData(id) {
            Swal.fire({
                title: 'Hapus Data Registrasi ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.registrasi.delete', '') }}/" + id,
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

        function pilih_kab(dt) {
            $.ajax({
                type: "POST",
                url: "{{ route('profil.get_kab') }}",
                data: {
                    kode_wilayah: $(dt).val(),
                },
                dataType: "JSON",
                beforeSend: function(res) {
                    beforeLoading(res);
                },
                error: function(res) {
                    errorLoading(res);
                },
                success: function(res) {
                    Swal.close();
                    var html = '<option value=""></option>';
                    $.map(res.data, function(e, i) {
                        html += `
                            <option value="${e.kode_wilayah}">${e.nama}</option>
                       `;
                    });
                    $('#select_kab').html(html);
                    $('#select_kec').html('<option value=""></option>');
                    $('#select_kel').html('<option value=""></option>');
                }
            });
        }

        function pilih_kec(dt) {
            $.ajax({
                type: "POST",
                url: "{{ route('profil.get_kec') }}",
                data: {
                    kode_wilayah: $(dt).val(),
                },
                dataType: "JSON",
                beforeSend: function(res) {
                    beforeLoading(res);
                },
                error: function(res) {
                    errorLoading(res);
                },
                success: function(res) {
                    Swal.close();
                    var html = '<option value=""></option>';
                    $.map(res.data, function(e, i) {
                        html += `
                            <option value="${e.kode_wilayah}">${e.nama}</option>
                       `;
                    });
                    $('#select_kec').html(html);
                    $('#select_kel').html('<option value=""></option>');
                }
            });
        }

        function pilih_kel(dt) {
            $.ajax({
                type: "POST",
                url: "{{ route('profil.get_kel') }}",
                data: {
                    kode_wilayah: $(dt).val(),
                },
                dataType: "JSON",
                beforeSend: function(res) {
                    beforeLoading(res);
                },
                error: function(res) {
                    errorLoading(res);
                },
                success: function(res) {
                    Swal.close();
                    var html = '<option value=""></option>';
                    $.map(res.data, function(e, i) {
                        html += `
                            <option value="${e.kode_wilayah}">${e.nama}</option>
                       `;
                    });
                    $('#select_kel').html(html);
                }
            });
        }
    </script>
@endsection
