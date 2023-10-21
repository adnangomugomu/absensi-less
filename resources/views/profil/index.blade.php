@extends('template.backend')
@section('title', $title)
@section('header', $header)

@section('konten')
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/css/pages/page-user-profile.css">
    <section class="page-user-profile">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="user-profile-images">
                            <img src="{{ asset('img/banner.png') }}" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                            <img src="{{ asset($row->foto) }}" onerror="this.src='{{ asset('img/default.png') }}'" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                        </div>
                        <div class="user-profile-text">
                            <h4 class="mb-0 text-bold-500 profile-text-color">{{ $row->name }}</h4>
                            <small>{{ $row->email }}</small>
                        </div>
                        <div class="card-body px-0">
                            <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                <li class="nav-item pb-0">
                                    <a class="nav-link d-flex px-1 active" id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="true"><i class="bx bx-home"></i><span class="d-none d-md-block">Profil</span></a>
                                </li>
                                <li class="nav-item pb-0">
                                    <a class="nav-link d-flex px-1" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false"><i class="bx bx-user"></i><span class="d-none d-md-block">Update Data</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="feed" aria-labelledby="feed-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-1">Detail</h5>
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex align-items-center mb-25">
                                                            <i class="bx bx-briefcase mr-50 cursor-pointer"></i><span>Role <span class="text-primary"> {{ $row->role->nama }}</span></span>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-25">
                                                            <i class="bx bx-briefcase mr-50 cursor-pointer"></i><span>Terdaftar Pada <span class="text-primary"> {{ tglIndo($row->created_at) }}</span></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-1">Informasi Profil</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Nama</th>
                                                                <td>{{ $row->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Username</th>
                                                                <td>{{ $row->username }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>{{ $row->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nomer HP</th>
                                                                <td>{{ $row->no_hp }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-1">Alamat</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Provinsi</th>
                                                                <td>{{ $row->provinsi->nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kabupaten</th>
                                                                <td>{{ $row->kabupaten->nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kecamatan</th>
                                                                <td>{{ $row->kecamatan->nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kelurahan</th>
                                                                <td>{{ $row->kelurahan->nama }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="activity" aria-labelledby="activity-tab" role="tabpanel">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">Update Foto Profil</h5>
                                            <form action="#" onsubmit="event.preventDefault();doSubmitFoto(this);">
                                                <div class="form-group">
                                                    <label class="d-block">Foto <small class="text-danger">* max 2mb</small></label>
                                                    <input type="file" accept="image/*" name="foto" class="btn btn-secondary w-25 w-sm-100" placeholder="masukkan isian" required>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">Informasi Profil</h5>
                                            <form action="#" onsubmit="event.preventDefault();doSubmitInformasi(this);">
                                                <div class="form-group">
                                                    <label>Nama Lengkap <small class="text-danger">*</small></label>
                                                    <input type="text" name="name" value="{{ $row->name }}" class="form-control" placeholder="masukkan isian" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username <small class="text-danger">*</small></label>
                                                    <input type="text" name="username" value="{{ $row->username }}" class="form-control" placeholder="masukkan isian" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email <small class="text-danger">*</small></label>
                                                    <input type="email" name="email" value="{{ $row->email }}" class="form-control" placeholder="masukkan isian" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomer HP <small class="text-danger">*</small></label>
                                                    <input type="number" name="no_hp" value="{{ $row->no_hp }}" class="form-control" placeholder="masukkan isian" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Povinsi <small class="text-danger">*</small></label>
                                                            <select id="select_prov" onchange="pilih_kab(this);" name="kode_prop" class="form-control form_select" data-placeholder="pilih provinsi" required>
                                                                <option value=""></option>
                                                                @foreach ($provinsi as $item)
                                                                    <option {{ $item->kode_wilayah == $row->kode_prop ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Kabupaten <small class="text-danger">*</small></label>
                                                            <select id="select_kab" onchange="pilih_kec(this);" name="kode_kab" class="form-control form_select" data-placeholder="pilih kabupaten" required>
                                                                <option value=""></option>
                                                                @foreach ($kabupaten as $item)
                                                                    <option {{ $item->kode_wilayah == $row->kode_kab ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Kecamatan <small class="text-danger">*</small></label>
                                                            <select id="select_kec" onchange="pilih_kel(this);" name="kode_kec" class="form-control form_select" data-placeholder="pilih kecamatan" required>
                                                                <option value=""></option>
                                                                @foreach ($kecamatan as $item)
                                                                    <option {{ $item->kode_wilayah == $row->kode_kec ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Kelurahan <small class="text-danger">*</small></label>
                                                            <select id="select_kel" name="kode_kel" class="form-control form_select" data-placeholder="pilih kelurahan" required>
                                                                <option value=""></option>
                                                                @foreach ($kelurahan as $item)
                                                                    <option {{ $item->kode_wilayah == $row->kode_kel ? 'selected' : '' }} value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">Update Password</h5>
                                            <form action="#" onsubmit="event.preventDefault();doSubmitPassword(this);">
                                                <div class="form-group">
                                                    <label>Password <small class="text-danger">*</small></label>
                                                    <input type="password" name="password" class="form-control" placeholder="masukkan isian" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ulangi Password <small class="text-danger">*</small></label>
                                                    <input type="password" name="re_password" class="form-control" placeholder="masukkan isian" required>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('.form_select').select2({
                width: '100%',
            })
        });

        function doSubmitInformasi(dt) {
            Swal.fire({
                title: 'Update data informasi ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        url: "{{ route('profil.update', $row->id) }}",
                        data: new FormData(dt),
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        beforeSend: function(res) {
                            beforeLoading(res);
                        },
                        error: function(res) {
                            errorLoading(res);
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil disimpan',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    location.reload();
                                })
                        }
                    });
                }
            })
        }

        function doSubmitPassword(dt) {
            Swal.fire({
                title: 'Update Password ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        url: "{{ route('profil.resetPassword', $row->id) }}",
                        data: new FormData(dt),
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        beforeSend: function(res) {
                            beforeLoading(res);
                        },
                        error: function(res) {
                            errorLoading(res);
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil disimpan',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    location.reload();
                                })
                        }
                    });
                }
            })
        }

        function doSubmitFoto(dt) {
            Swal.fire({
                title: 'Update Foto ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        url: "{{ route('profil.updateFoto', $row->id) }}",
                        data: new FormData(dt),
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        beforeSend: function(res) {
                            beforeLoading(res);
                        },
                        error: function(res) {
                            errorLoading(res);
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil disimpan',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    location.reload();
                                })
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
