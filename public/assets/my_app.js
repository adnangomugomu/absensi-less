function formatRupiah(angka) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}

$('body').on('keyup', '.rupiah', function() {
    $(this).val(formatRupiah(this.value));
});

function show_modal_custom(obj) {
    if (obj.judul.indexOf('class="fa') != -1) {
        var judul = obj.judul;
    } else {
        var judul = '<i class="bx bx-info-circle mr-1"></i>' + obj.judul;
    }

    $('#modal_custom .modal-title').html(judul);
    $('#modal_custom .modal-body').html(obj.html);
    $("#modal_custom_size").removeClass();
    $("#modal_custom_size").addClass('modal-dialog');
    $("#modal_custom_size").addClass(obj.size);
    $('#modal_custom').modal('show');
}

function show_modal_custom_2(obj) {
    if (obj.judul.indexOf('class="fa') != -1) {
        var judul = obj.judul;
    } else {
        var judul = '<i class="bx bx-info-circle mr-1"></i>' + obj.judul;
    }

    $('#modal_custom_2 .modal-title').html(judul);
    $('#modal_custom_2 .modal-body').html(obj.html);
    $("#modal_custom_size_2").removeClass();
    $("#modal_custom_size_2").addClass('modal-dialog');
    $("#modal_custom_size_2").addClass(obj.size);
    $('#modal_custom_2').modal('show');
}

function logout(dt) {
    Swal.fire({
        title: 'Logout',
        text: 'apakah anda yakin akan logout',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            location.href = $(dt).attr('href');
        }
    })
}

function beforeLoading(res) {
    Swal.fire({
        title: 'Loading ...',
        html: '<i style="font-size:50px;" class="bx bx-loader-alt bx-spin"></i>',
        allowOutsideClick: false,
        showConfirmButton: false,
    });
}

function errorLoading(res) {
    if (res.responseJSON.msg) {
        var text = res.responseJSON.msg;
    } else {
        var text = res.responseJSON.message;
    }
    Swal.fire({
        icon: 'warning',
        title: 'Gagal',
        text: text,
        showConfirmButton: true,
    })
}

function detail_gambar(dt) {
    var img = $(dt).attr('src');
    if (!img) img = $(dt).attr('href');

    var html = `
        <img class="img rounded" style="width:100%;" src="${img}" />
    `;

    show_modal_custom({
        judul: 'Detail Gambar',
        html: html,
        size: 'modal-lg',
    });
}