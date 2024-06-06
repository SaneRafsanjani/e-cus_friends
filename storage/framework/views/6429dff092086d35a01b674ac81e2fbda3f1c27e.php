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

    th {
        background-color: #f2f2f2;
    }

    tr {
        background-color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

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
        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $combinedDT  = date('Y-m-d', strtotime($r->TANGGAL_INPUT));
            ?>
            <tr>
                <td><?php echo e($key + 1); ?></td>
                <td><?php echo e($r->setDateFormat($r->TANGGAL_INPUT)); ?></td>
                <td><?php echo e($r->KETERANGAN_SHIFT); ?></td>
                <td><?php echo e($r->KONDISI_IGD); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\RSUD\e-cus_friends\resources\views/complaint/admin/export/cetak_pdf.blade.php ENDPATH**/ ?>