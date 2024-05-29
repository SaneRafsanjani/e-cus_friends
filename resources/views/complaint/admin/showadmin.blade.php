@extends('layouts.admin.master')

@section('title', 'Complaint Detail')

@section('breadcrumb-title')
    <h3>Complaint Detail</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="">Complaint Detail</i></a></li>
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
                            @if ($complaint->STATUS == 1)
                                <button class="btn btn-outline-primary" type="button" id="proceed_complaint"
                                    data-id="{{ $id }}" data-status="2"><i class="fa fa-check"></i>
                                    Proses</button>
                                {{-- @elseif ($complaint->STATUS == 2)
                                <button class="btn btn-outline-primary" type="button" id="proceed_complaint"
                                    data-id="{{ $id }}" data-status="3"><i class="fa fa-check"></i>
                                    Selesai</button> --}}
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
                                    <tr>
                                        <th>Tanggal Kerusakan</th>
                                        <td>{{ $complaint->TANGGAL_KEJADIAN }}</td>
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
                                        <th>Notes</th>
                                        <td>{{ $complaint->NOTES }}</td>
                                    </tr>
                                    <tr>
                                        <th>Foto</th>
                                        <td><button class="btn btn-pill btn-primary btn-sm" type="button"
                                            data-bs-target="#lihat" data-bs-toggle="modal" type="button">Lihat</button></td>
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
                                </table>
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

            $('#proceed_end').on('click', function() {
                Swal.fire({
                    title: 'Mulai Pekerjaan?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $('#proceed_end').attr('data-id');

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.complaint.end') }}",
                            data: {
                                id: id,
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.code == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses',
                                        text: 'Terima Kasih!'
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
