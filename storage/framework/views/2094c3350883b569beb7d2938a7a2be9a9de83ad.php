<?php $__env->startSection('title', 'Edit Complaint'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Edit Complaint</h3>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Complaint</h5>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.complaint.update', $id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?> <!-- Tambahkan ini untuk spoofing metode PUT -->
                            <div class="form-group">
                                <label for="TANGGAL_INPUT">Tanggal Input</label>
                                <input type="text" name="TANGGAL_INPUT" class="form-control" value="<?php echo e($complaint->TANGGAL_INPUT); ?>">
                            </div>
                            <div class="form-group">
                                <label for="KETERANGAN_SHIFT">Keterangan Shift</label>
                                <input type="text" name="KETERANGAN_SHIFT" class="form-control" value="<?php echo e($complaint->KETERANGAN_SHIFT); ?>">
                            </div>
                            <div class="form-group">
                                <label for="NAMA_PETUGAS">Nama Petugas</label>
                                <input type="text" name="NAMA_PETUGAS" class="form-control" value="<?php echo e($complaint->NAMA_PETUGAS); ?>">
                            </div>
                            <div class="form-group">
                                <label for="IDENTITAS">Identitas Pasien</label>
                                <input type="text" name="IDENTITAS" class="form-control" value="<?php echo e($complaint->IDENTITAS); ?>">
                            </div>
                            <div class="form-group">
                                <label for="KONDISI_IGD">Kondisi IGD</label>
                                <input type="text" name="KONDISI_IGD" class="form-control" value="<?php echo e($complaint->KONDISI_IGD); ?>">
                            </div>
                            <!-- Tambahkan field lain yang ingin diupdate -->

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Backupan\Sahabat_pelanggan\resources\views/complaint/admin/editadmin.blade.php ENDPATH**/ ?>