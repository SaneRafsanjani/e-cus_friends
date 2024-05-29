@extends('layouts.admin.master')

@section('title', 'Complaint Detail')

@section('breadcrumb-title')
    <h3>Complaint Detail</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href=""> Complaint Detail</i></a></li>
@endsection

@push('after-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css" integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="card-header">
                        <div class="btn-group">
                            {{-- <a href="{{ route('admin.complaint.ev.download', $id) }}" target="_blank"
                                class="btn btn-outline-primary"><i class="fa fa-download"></i> Download Bukti</a> --}}
                            <a href="{{ route('admin.complaint.print', $id) }}" class="btn btn-outline-primary"
                                target="_blank"><i class="fa fa-print"></i> Print</a>
                            <button class="btn btn-outline-primary" type="button" data-bs-target="#notes" data-bs-toggle="modal"><i class="fa fa-check"></i>
                            Notes</button>
                            @if ($complaint->STATUS == 1)
                                <button class="btn btn-outline-primary" type="button" id="proceed_complaint"
                                    data-id="{{ $id }}" data-status="2"><i class="fa fa-check"></i>
                                    Proses</button>
                                {{-- @elseif ($complaint->STATUS == 2)
                                <button class="btn btn-outline-primary" type="button" id="proceed_complaint"
                                    data-id="{{ $id }}" data-status="3"><i class="fa fa-check"></i>
                                    Selesai</button> --}}
                            @endif
                            @if ($complaint->IS_MULAI == 0)
                                <button class="btn btn-outline-primary" type="button" id="proceed_start"
                                    data-id="{{ $id }}"><i class="fa fa-check"></i>Mulai
                                    Pekerjaan</button>
                            @elseif ($complaint->IS_MULAI == 1)
                                @if ($complaint->FILE_SELESAI == null)
                                    <button class="btn btn-outline-primary" type="button" data-bs-target="#selesai_lapor"
                                        data-bs-toggle="modal"><i class="fa fa-check"></i>Selesai
                                        Pekerjaan</button>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-rensponsive">
                                <table class="table">
                                    <tr>
                                        <th colspan="2">
                                            <h5>Data Pengaduan</h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengaduan</th>
                                        <td>{{ $complaint->TANGGAL_KEJADIAN }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pengaduan</th>
                                        <td>{{ $complaint->KODE_PENGADUAN }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Tanggal Kerusakan</th>
                                        <td>{{ $complaint->TANGGAL_KEJADIAN }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Nama Barang</th>
                                        <td>{{ $complaint->NAMA_BARANG }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{ $complaint->KATEGORI == 1 ? 'Software' : 'Hardware' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ruangan</th>
                                        <td>{{ $complaint->LOKASI }}</td>
                                    </tr>
                                    <tr>
                                        <th>Uraian Pengaduan</th>
                                        <td>{{ $complaint->URAIAN }}</td>
                                    </tr>
                                    <tr>
                                        <th>Foto</th>
                                        <td><button class="btn btn-pill btn-primary btn-sm" type="button"
                                                data-bs-target="#lihat" data-bs-toggle="modal" type="button">Lihat</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            <h5>Data Pelapor</h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Nama Pelapor</th>
                                        <td>{{ $complaint->NAMA_TERLAPOR }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            <h5>Detail Pengerjaan</h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Start</th>
                                        <td>{{ $complaint->WAKTU_MULAI }}</td>
                                    </tr>
                                    <tr>
                                        <th>End</th>
                                        <td>{{ $complaint->WAKTU_SELESAI }}</td>
                                    </tr>
                                    <tr>
                                        <th>Selisih Waktu</th>
                                        <td>{{ $complaint->SELISIH }} Menit</td>
                                    </tr>
                                    <tr>
                                        <th>Pelaksana</th>
                                        <td>{{ $complaint->PELAKSANA }}</td>
                                    </tr>
                                    <tr>
                                        <th>Foto Pengerjaan</th>
                                        <td><button class="btn btn-pill btn-primary btn-sm" type="button"
                                                data-bs-target="#lihat_pekerjaan" data-bs-toggle="modal"
                                                type="button">Lihat</button>
                                        </td>
                                    </tr>
                                </table>
                                {{-- <button class="mt-4" type="submit" id="add_complaint_button">Submit</button> --}}
                                {{-- <div class="form-group col-md-12 mb-2">
                                        <label for="file">Lampiran Bukti</label>
                                        <input name="file" type="file" id="file" class="form-control">
                                        <small class="text-danger">Batas Upload File: 10 mb</small><br>
                                        <small class="text-danger">Format File Yang Bisa Diupload: .jpg, .jpeg, .png</small>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto Kerusakan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $complaint->FILE) }}" style="width: 100%">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lihat_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto Selesai Pengerjaan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $complaint->FILE_SELESAI) }}" style="width: 100%">
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Upload Selesai Pekerjaan --}}
    <div class="modal fade" id="selesai_lapor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto Kerusakan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form_upload_foto">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Petugas :</label>
                            <input type="text" class="form-control" id="petugas" name="petugas">
                            <input type="hidden" id="id" name="id" value="{{ $id }}">
                            <input type="hidden" id="complaint_ticket" name="complaint_ticket"
                                value="{{ $complaint->KODE_PENGADUAN }}">
                        </div>
                        <div class="form-group">
                            <label for="">Upload Pekerjaan :</label>
                            <input type="file" name="file_selesai" id="file_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-id="{{ $id }}" id="proceed_upload_finish"
                            type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Notes --}}
    <div class="modal fade" id="notes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto Kerusakan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="create_notes">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Notes :</label>
                            <textarea type="text" class="form-control" id="notes" name="notes"></textarea>
                            <input type="hidden" id="id" name="id" value="{{ $id }}">
                            <input type="hidden" id="complaint_ticket" name="complaint_ticket"
                                value="{{ $complaint->KODE_PENGADUAN }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-id="{{ $id }}" id="create_notes"
                            type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#proceed_complaint').on('click', function() {
                Swal.fire({
                    title: 'Proses?',
                    text: "Laporan Akan Dipindahkan Ke Tindak Lanjut",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $('#proceed_complaint').attr('data-id');
                        var status = $('#proceed_complaint').attr('data-status');

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.complaint.update') }}",
                            data: {
                                id: id,
                                status: status
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.code == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses',
                                        text: 'Silahkan Cek Menu Tindak Lanjut',
                                    }).then((result) => {
                                        window.location.href =
                                            "{{ route('admin.complaint.followup') }}"
                                    });
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Ada Kesalahan, Silahkan Hubungi SIMRS',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                }).then((result) => {
                                    location.reload()
                                });
                            }
                        });
                    }
                })
            });

            $('#proceed_start').on('click', function() {
                Swal.fire({
                    title: 'Mulai Pekerjaan?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $('#proceed_start').attr('data-id');

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.complaint.start') }}",
                            data: {
                                id: id,
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.code == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses',
                                        text: 'Selamat Bekerja'
                                    }).then((result) => {
                                        "{{ route('admin.complaint.inbox') }}"
                                    });
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Ada Kesalahan, Silahkan Hubungi SIMRS',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    location.reload()
                                });
                            }
                        })
                    }
                })
            })

            $('#form_upload_foto').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.complaint.file') }}",
                    data: data,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Terima Kasih!'
                            }).then((result) => {
                                location.reload()
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ada Kesalahan, Silahkan Hubungi SIMRS',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            location.reload()
                        });
                    }
                })
            })

            $('#create_notes').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.complaint.notes') }}",
                    data: data,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Terima Kasih!'
                            }).then((result) => {
                                location.reload()
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ada Kesalahan, Silahkan Hubungi SIMRS',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            location.reload()
                        });
                    }
                })
            })

            // $('#proceed_end').on('click', function() {
            //     Swal.fire({
            //         title: 'Pekerjaan Sudah Selesai?',
            //         icon: 'info',
            //         showCancelButton: true,
            //         confirmButtonText: 'Ya',
            //         cancelButtonText: 'Tidak'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             var id = $('#proceed_end').attr('data-id');

            //             $.ajaxSetup({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 }
            //             });

            //             $.ajax({
            //                 type: "post",
            //                 url: "{{ route('admin.complaint.end') }}",
            //                 data: {
            //                     id: id,
            //                 },
            //                 dataType: "json",
            //                 success: function(response) {
            //                     if (response.code == 200) {
            //                         Swal.fire({
            //                             icon: 'success',
            //                             title: 'Sukses',
            //                             text: 'Terima Kasih!'
            //                         }).then((result) => {
            //                             "{{ route('admin.complaint.inbox') }}"
            //                         });
            //                     }
            //                 },
            //                 error: function(response) {
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: 'Oops...',
            //                         text: 'Ada Kesalahan, Silahkan Hubungi SIMRS',
            //                         allowOutsideClick: false,
            //                         allowEscapeKey: false
            //                     }).then((result) => {
            //                         location.reload()
            //                     });
            //                 }
            //             })
            //         }
            //     })
            // })

            $('#swal_dummy_message').on('click', function() {
                Swal.fire({
                    title: 'Proses?',
                    text: "Laporan Akan Diproses",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Silhkan Proses Laporan',
                        });
                    }
                })
            });
        });
    </script>
@endpush
