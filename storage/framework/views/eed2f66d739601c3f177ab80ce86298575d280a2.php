
<table>

</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Waktu Laporan</th>
            <th>Keterangan Shift</th>
            <th>Kondisi IGD</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <?php
                    $combinedDT  = date('Y-m-d', strtotime($r->TANGGAL_INPUT));
                    // $combinedDT2 = date('H:i:s', strtotime($r->TANGGAL_KEJADIAN));
                    // $FinalDT     = date('Y-m-d H:i:s', strtotime("$combinedDT  $combinedDT2"));
                    // $cDT         = date('Y-m-d', strtotime($r->WAKTU_MULAI));
                    // $cDT2        = date('H:i:s', strtotime($r->WAKTU_MULAI));
                    // $finalcDT2   = date('Y-m-d H:i:s', strtotime("$cDT  $cDT2"));
                ?>
            <tr>
                <td><?php echo e($r->rownum); ?></td>
                <td><?php echo e($r->setDateFormat($r->TANGGAL_INPUT)); ?></td>
                <td><?php echo e($r->KETERANGAN_SHIFT); ?></td>
                <td><?php echo e($r->KONDISI_IGD); ?></td>
                
                
                
                
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\RSUD\e-cus_friends\resources\views/complaint/admin/export/daily-excel.blade.php ENDPATH**/ ?>