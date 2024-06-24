<style>
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px; /* Atur jarak antar baris */
    }

    th, td {
        padding: 8px;
        text-align: left;
    }


</style>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Waktu Laporan</th>
            <th>Keterangan Shift</th>
            <th>Kondisi IGD</th>
            <th>Dokumentasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $combinedDT  = date('Y-m-d', strtotime($r->TANGGAL_INPUT));
            ?>
            <tr>
                <td><?php echo e($key + 1); ?></td>
                <td><?php echo e($r->setDateFormat($r->TANGGAL_INPUT)); ?></td>
                <td><?php echo e($r->KETERANGAN_SHIFT); ?></td>
                <td><?php echo e($r->KONDISI_IGD); ?></td>
                <div>
                    <img src="<?php echo e(public_path('storage/' . $r->FILE)); ?>" style="width: 70%">
                </div>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\Pengaduan\esimrs\resources\views/complaint/admin/export/cetak_pdf.blade.php ENDPATH**/ ?>