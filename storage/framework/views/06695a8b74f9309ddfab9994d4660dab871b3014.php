<?php $__env->startSection('title', 'Follow Up Complaint'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Follow Up Complaint</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item"><a href=""> Follow Up Complaint</i></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="card-header">
                        <h5>Follow Up Complaint Table</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-3">
                            <select name="status" id="status" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <option value="2">Mulai</option>
                                <option value="3">Diproses</option>
                                <option value="4">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="prioritas" id="prioritas" class="form-select">
                                <option value="">-- Pilih Prioritas --</option>
                                <option value="1">Tidak Darurat</option>
                                <option value="2">Darurat</option>
                            </select>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="display" id="complaint_table">
                                <thead>
                                    <tr>
                                        <th>Kode Pengaduan</th>
                                        <th>Nama Pelapor</th>
                                        <th>Tanggal Pengaduan</th>
                                        <th>Ruangan</th>
                                        <th>Status</th>
                                        <th>Prioritas</th>
                                        <th>Uraian Pengaduan</th>
                                        <th>Aksi</th>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css" integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-script'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#status').on('change', function() {
                $('#complaint_table')
                    .on('preXhr.dt', function(e, settings, data) {
                        data.status = $('#status').val();
                    });

                $('#complaint_table').DataTable().ajax.reload()
            });
            $('#prioritas').on('change', function() {
                $('#complaint_table')
                    .on('preXhr.dt', function(e, settings, data) {
                        data.prioritas = $('#prioritas').val();
                    });
                $('#complaint_table').DataTable().ajax.reload()
            });
            $('#complaint_table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                ajax: {
                    url: '<?php echo url()->current(); ?>',
                },
                columns: [
                    {
                        data: 'KODE_PENGADUAN',
                        name: 'KODE_PENGADUAN'
                    },
                    {
                        data: 'NAMA_TERLAPOR',
                        name: 'NAMA_TERLAPOR'
                    },
                    {
                        data: 'TANGGAL_PENGADUAN',
                        name: 'TANGGAL_PENGADUAN'
                    },
                    {
                        data: 'LOKASI',
                        name: 'LOKASI'
                    },
                    {
                        data: 'STATUS',
                        name: 'STATUS'
                    },
                    {
                        data: 'PRIORITAS',
                        name: 'PRIORITAS'
                    },
                    {
                        data: 'URAIAN',
                        name: 'URAIAN'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Pengaduan\esimrs\resources\views/complaint/admin/index-followup.blade.php ENDPATH**/ ?>