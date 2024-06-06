@extends('layouts.admin.master')

@section('title', 'Berita Acara')

@section('breadcrumb-title')
<h3>Berita Acara</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href=""> Complaint at</i></a></li>
<li class="breadcrumb-item"><a href=""> Berita Acara</i></a></li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-12">
			<div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-header">

                </div>
				<div class="card-body">
                    <div id="add_news_error_message"></div>
                    <form action="" method="post" id="add_news">
                        <div class="row">
                            <div class="form-group col-md-4 mb-4">
                                <label for="employee_id">Tanggal</label>
                                <input type="hidden" id="id" name="id" value="{{ $id }}">
                                <input class="form-control" id="date" type="date" name="date">
                            </div>
                            <div class="form-group col-md-4 mb-4">
                                <label for="name">Tempat Acara</label>
								<input class="form-control" id="place" type="text" name="place">
                            </div>
                            <div class="form-group col-md-4 mb-4">
                                <label for="name">Pimpinan Rapat</label>
								<input class="form-control" id="name" type="text" name="name">
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <label for="discussion">Pembahasan</label>
                                <textarea id="discussion" name="discussion"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" id="add_news_button">Submit</button>
                        <div id="add_news_loading" role="status"></div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('after-css')
@endpush

@push('after-script')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const protocol = window.location.protocol === 'https:' ? 'https' : 'http';
    const hostname = window.location.hostname;

    $(document).ready(function () {
        $('#add_news').submit(function (e) {
            e.preventDefault();
            var data = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('admin.complaint.news.store') }}",
                data: data,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#add_news_button').attr('disabled', 'disabled');
                    $('#add_news_loading').addClass('spinner-border text-primary');
                },
                success: function (response) {
                    if (response.code == 400) {
                        $('#add_news_error_message').html('');
                        $('#add_news_error_message').addClass('alert alert-danger');
                        $.each(response.message, function (key, value) {
                            $('#add_news_error_message').append('<span><i class="bi bi-x"></i> '+value+'</span><br>');
                        });
                    } else {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Berita Acara Berhasil Dibuat',
                            icon: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            window.location.href = `${protocol}://${hostname}/wbs/admns/complaint/follow-up/show/${response.id}`
                        });
                    }
                    $('#add_news_button').removeAttr('disabled', 'disabled');
                    $('#add_news_loading').removeClass('spinner-border text-primary');
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Ooops',
                        text: 'Ada Kesalahan, Silahkan hubungi SIMRS',
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
    ClassicEditor
        .create(document.querySelector('#discussion'))
        .then(editor => {console.log(editor);})
        .catch(error => {console.error(error);});
</script>
@endpush

