@extends('template.backend')

@section('title', $title)

@section('header', $header)

@section('tombol')
    <button class="btn btn-warning" onclick="history.go(-1);"><i class="bx bx-left-arrow-circle"></i> Kembali</button>
@endsection

@section('style')
    <style>
        .absen {
            width: 100%;
            height: 290px;
        }
    </style>
@endsection

@section('konten')
    <section class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="#" onsubmit="event.preventDefault();doSubmit(this);">
                    <div class="form-group">
                        <label>Nama Yang Hadir <small class="text-danger">*</small></label>
                        <select name="user_id" class="form-control form_select" data-placeholder="pilih nama" required>
                            <option value=""></option>
                            @foreach ($user as $item)
                                <option {{ $row->user_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Kamera <small class="text-danger">*</small></label>
                                <video id="webcam" class="border border-primary rounded absen" autoplay playsinline></video>
                                <canvas id="canvas" class="d-none border border-primary rounded absen"></canvas>
                                <audio id="snapSound" src="{{ asset('other/snap.wav') }}" preload = "auto"></audio>
                                <button type="button" id="btn_take" class="btn btn-success" onclick="snapKamera();"><i class="bx bx-camera"></i> Take Picture</button>
                                <button type="button" id="btn_start" class="btn btn-primary" style="display: none;" onclick="startKamera();"><i class="bx bx-sync"></i> Start Camera</button>
                                <button type="button" id="btn_flip" class="btn btn-danger d-block d-md-none" onclick="flipKamera();"><i class="bx bxs-slideshow"></i> Change Camera</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Foto Absensi <small class="text-danger">*</small></label>
                                <div class="border border-primary rounded absen">
                                    <img src="" alt="hasil foto" style="display: none;" class="absen" id="foto_hasil">
                                    <input type="hidden" name="gambar_data" id="gambar_data">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">SIMPAN ABSENSI</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.form_select').select2({
                width: '100%',
            })
        });

        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
        webcam.start()

        function snapKamera() {
            var img = webcam.snap();
            $('#gambar_data').val(img);
            Swal.fire({
                    icon: 'success',
                    title: 'Berhasil mengambil foto',
                    showConfirmButton: true,
                })
                .then(() => {
                    webcam.stop();
                    $('#foto_hasil').slideDown(500);
                    $('#foto_hasil').attr('src', img);
                    $('#btn_take').hide();
                    $('#btn_start').show();
                })
        }

        function startKamera() {
            webcam.start();
            $('#btn_take').show();
            $('#btn_start').hide();
        }

        function flipKamera() {
            webcam.flip();
            webcam.start(); 
        }

        function doSubmit(dt) {

            Swal.fire({
                title: 'Simpan Data ?',
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
                        url: "{{ route('admin.absensi.update', [$row->pertemuan_id,$id]) }}",
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
                            $('#modal_custom').modal('hide');
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil disimpan',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    history.go(-1);
                                })
                        }
                    });
                }
            })
        }
    </script>
@endsection
