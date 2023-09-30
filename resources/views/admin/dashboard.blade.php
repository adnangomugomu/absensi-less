@extends('template.backend')

@section('title', $title)

@section('konten')
    <div class="row">
        <div class="col-sm-6 col-12 dashboard-users-success">
            <div class="card text-center bg-image1">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted fw-600 line-ellipsis">Total Peserta</div>
                        <h3 class="mb-0">{{ $total_peserta }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-12 dashboard-users-success">
            <div class="card text-center bg-image1">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                            <i class="bx bx-calendar font-medium-5"></i>
                        </div>
                        <div class="text-muted fw-600 line-ellipsis">Total Pertemuan</div>
                        <h3 class="mb-0">{{ $total_pertemuan }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
