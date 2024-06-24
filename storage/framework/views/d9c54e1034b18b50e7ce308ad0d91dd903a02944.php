<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Dashboard</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="complaint-table">
                                <thead>
                                    <tr>
                                        <th>Kode Pengaduan</th>
                                        <th>Tanggal/Bulan/Tahun</th>
                                        <th>Keterangan Shift</th>
                                        <th>Nama Petugas</th>
                                        <th>Identitas Pasien</th>
                                        <th>Kondisi IGD</th>
                                        <th>  </th>
                                        <th> Action</th>
                                        <th>  </th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('before-style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-style'); ?>
<style>

    .edit-button {
        margin-left: 100%;
        width: 70px;

    }

    #complaint-table th:nth-child(7),
    #complaint-table td:nth-child(7),
    #complaint-table th:nth-child(8),
    #complaint-table td:nth-child(8),
    #complaint-table th:nth-child(9),
    #complaint-table td:nth-child(9) {
        width: -10%;
    }


</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css" integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-script'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#complaint-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                ajax: {
                    url: '<?php echo url()->current(); ?>',
                    beforeSend: function(response) {
                        response.setRequestHeader('Authorization', localStorage.getItem('token'));
                    },
                },
                columns: [
                    {
                        data: 'KODE_PENGADUAN',
                        name: 'KODE_PENGADUAN',
                        visible: false // Menyembunyikan kolom
                    },
                    {
                        data: 'TANGGAL_INPUT',
                        name: 'TANGGAL_INPUT'
                    },
                    {
                        data: 'KETERANGAN_SHIFT',
                        name: 'KETERANGAN_SHIFT'
                    },

                    {
                        data: 'NAMA_PETUGAS',
                        name: 'NAMA_PETUGAS'
                    },
                    {
                        data: 'IDENTITAS',
                        name: 'IDENTITAS'
                    },

                    {
                        data: 'KONDISI_IGD',
                        name: 'KONDISI_IGD'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        "className": 'edit-button',
                        searchable: false,

                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        "className": 'edit-button',
                        searchable: false
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        "className": 'edit-button',
                        searchable: false
                    },



                ],
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Backupan\Sahabat_pelanggan\resources\views/complaint/admin/index.blade.php ENDPATH**/ ?>