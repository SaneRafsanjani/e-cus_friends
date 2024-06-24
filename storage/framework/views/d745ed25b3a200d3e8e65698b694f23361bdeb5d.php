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
                            <option value="2">Diproses</option>
                            <option value="3">Diterima</option>
                        </select>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="display" id="complaint_table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pengaduan</th>
                                    <th>Nama Terlapor</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Tanggal Pelaporan</th>
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

<?php $__env->startPush('after-script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#status').on('change', function () {
            $('#complaint_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    data.status = $('#status').val();
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
                { data: 'rownum', name: 'rownum' },
                { data: 'KODE_PENGADUAN', name: 'KODE_PENGADUAN' },
                { data: 'NAMA_TERLAPOR', name: 'NAMA_TERLAPOR' },
                { data: 'violation', name: 'violation' },
                { data: 'date', name: 'date' },
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\wbs\resources\views/complaint/admin/index-followup.blade.php ENDPATH**/ ?>