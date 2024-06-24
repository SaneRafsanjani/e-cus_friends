

$(document).ready(function () {


    Swal.fire({
        title: 'Perhatian',
        text: 'Pengaduan ini hanya diperuntukan Sahabat pelanggan',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        timer: 500
    });


    $('#add_complaint').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url:  "/complaint/store",
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#add_complaint_button').attr('disabled', 'disabled');
                $('#add_complaint_loading').addClass('spinner-border');
            },
            success: function (response) {
                if (response.code == 400) {
                    $('#add_complaint_error_message').html('');
                    $('#add_complaint_error_message').addClass('alert-error');
                    $('#add_complaint_error_message').addClass('mt-3');
                    $.each(response.message, function (key, value) {
                        $('#add_complaint_error_message').append('<span><i class="bi bi-x"></i> '+value+'</span><br>');
                    });
                    $('html, body').animate({
                        scrollTop: $("#main").offset().top
                    }, 50);
                    grecaptcha.reset();
                } else {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Terimakasih Telah Melakukan Laporan',
                        icon: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    // }).then((result) => {
                    //     Swal.fire({
                            // title: 'Simpan Nomor Pengaduan Anda',
                            // text: response.ticket,
                            // icon: 'info',
                            // allowOutsideClick: false,
                            // allowEscapeKey: false,
                        }).then((result) => {
                            location.reload()
                        })
                    // });
                }
                $('#add_complaint_button').removeAttr('disabled', 'disabled');
                $('#add_complaint_loading').removeClass('spinner-border');
            },
            error: function (response) {
                Swal.fire({
                    title: 'Ooops',
                    text: 'Ada Kesalahan, Silahkan hubungi Pihak RSUD Kota Bogor',
                    icon: 'error',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    location.reload()
                });

            }
        });
    });

    $('#search_complaint').submit(function (e) {
        e.preventDefault();
        var complaint = $('#complaint_ticket').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: "/complaint/search/show",
            data: {complaint:complaint},
            dataType: "json",
            beforeSend: function (response) {
                $('#search_complaint_button').attr('disabled', 'disabled');
                $('#search_complaint_loading').addClass('spinner-border');
            },
            success: function (response) {
                $('#search_result').html('');
                $('#search_result').html(response.complaint);
                $('#search_complaint_button').removeAttr('disabled');
                $('#search_complaint_loading').removeClass('spinner-border');
            },
            error: function (response) {
                Swal.fire({
                    title: 'Ooops',
                    text: 'Ada Kesalahan, Silahkan hubungi Pihak RSUD Kota Bogor',
                    icon: 'error',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    location.reload()
                });

            }
        });
    });

    $('#add_foto_selesai').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url:  "/admns/complaint/file/store",
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#add_complaint_button').attr('disabled', 'disabled');
                $('#add_complaint_loading').addClass('spinner-border');
            },
            success: function(response) {
                if (response.code == 400) {
                    $('#add_complaint_error_message').html('');
                    $('#add_complaint_error_message').addClass('alert-error');
                    $('#add_complaint_error_message').addClass('mt-3');
                    $.each(response.message, function(key, value) {
                        $('#add_complaint_error_message').append(
                            '<span><i class="bi bi-x"></i> ' + value +
                            '</span><br>');
                    });
                    $('html, body').animate({
                        scrollTop: $("#main").offset().top
                    }, 50);
                    grecaptcha.reset();
                } else {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Upload Berhasi;',
                        icon: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then((result) => {
                        location.reload()
                    });
                }
                $('#add_complaint_button').removeAttr('disabled', 'disabled');
                $('#add_complaint_loading').removeClass('spinner-border');
            },
            error: function(response) {
                Swal.fire({
                    title: 'Ooops',
                    text: 'Ada Kesalahan, Silahkan hubungi Pihak RSUD Kota Bogor',
                    icon: 'error',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    location.reload()
                });
            }
        });
    });
});


