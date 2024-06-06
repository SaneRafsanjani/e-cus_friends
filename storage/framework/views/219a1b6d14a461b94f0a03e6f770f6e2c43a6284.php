<?php $__env->startSection('title', 'Complaint Detail'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Data Laporan</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item"><a href="">Data Laporan</i></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-style'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css" integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">

                    <div class="card-body">
                        <div class="row">
                            <div class="table-rensponsive">
                                <table class="table">
                                    <tr>
                                        <th colspan="2">
                                            <h5>Data Laporan</h5>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>Keterangan Waktu</th>
                                        <td><?php echo e($complaint->TANGGAL_INPUT); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Keterangan Shift</th>
                                        <td><?php echo e($complaint->KETERANGAN_SHIFT); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Kondisi IGD</th>
                                        <td><?php echo e($complaint->KONDISI_IGD); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Foto</th>
                                        <td><button class="btn btn-pill btn-primary btn-sm" type="button"
                                            data-bs-target="#lihat" data-bs-toggle="modal" type="button">Lihat</button></td>
                                    </tr>



                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto Kerusakan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo e(asset('storage/' . $complaint->FILE)); ?>" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-script'); ?>
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
                            url: "<?php echo e(route('admin.complaint.update')); ?>",
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
                                            "<?php echo e(route('admin.complaint.followup')); ?>"
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
                            url: "<?php echo e(route('admin.complaint.start')); ?>",
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
                                        "<?php echo e(route('admin.complaint.inbox')); ?>"
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
                            url: "<?php echo e(route('admin.complaint.end')); ?>",
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
                                        "<?php echo e(route('admin.complaint.inbox')); ?>"
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\RSUD\e-cus_friends\resources\views/complaint/admin/showadmin.blade.php ENDPATH**/ ?>