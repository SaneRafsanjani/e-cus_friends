<table>
    <tr>
        <th>Bulan</th>
        <th><?php echo e($month); ?></th>
    </tr>
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
            <th>Tanggal</th>
            <th>Penyuapan</th>
            <th>Kecurangan</th>
            <th>Pemalakan</th>
            <th>Korupsi</th>
            <th>Pencurian</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($r->rownum); ?></td>
                <td><?php echo e($r->setDateFormat($r->TANGGAL_PENGADUAN)); ?></td>
                <td><?php echo e($r->PENYUAPAN); ?></td>
                <td><?php echo e($r->KECURANGAN); ?></td>
                <td><?php echo e($r->PEMALAKAN); ?></td>
                <td><?php echo e($r->KORUPSI); ?></td>
                <td><?php echo e($r->PENCURIAN); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\xampp\htdocs\wbs\resources\views/complaint/admin/export/daily-excel.blade.php ENDPATH**/ ?>