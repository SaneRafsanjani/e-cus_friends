<table>
    <tr>
        <th>Tahun</th>
        <th><?php echo e($year); ?></th>
    </tr>
</table>
<table>

</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pengaduan</th>
            <th>Nama Pelapor</th>
            <th>Lokasi</th>
            <th>Uraian Kerusakan</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($r->rownum); ?></td>
                <td><?php echo e($r->TANGGAL_PENGADUAN); ?></td>
                <td><?php echo e($r->NAMA_TERLAPOR); ?></td>
                <td><?php echo e($r->LOKASI); ?></td>
                <td><?php echo e($r->URAIAN); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\xampp\htdocs\ipsrs\resources\views/complaint/admin/export/monthly-excel.blade.php ENDPATH**/ ?>