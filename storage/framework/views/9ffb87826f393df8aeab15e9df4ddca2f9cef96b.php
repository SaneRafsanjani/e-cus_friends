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
            <th>Tanggal Pengaduan</th>
            <th>Jam Kejadian</th>
            <th>Kode Pengaduan</th>
            <th>Waktu Proses</th>
            <th>Nama Pelapor</th>
            <th>Lokasi</th>
            <th>Nama Barang</th>
            <th>Volume</th>
            <th>Uraian</th>
            <th>Tanggal Mulai</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Tanggal Selesai</th>
            <th>Total Waktu Pengerjaan</th>
            <th>Durasi Terima Laporan</th>
            <th>Pelaksana</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <?php
                    $combinedDT  = date('Y-m-d', strtotime($r->TANGGAL_PENGADUAN));
                    $combinedDT2 = date('H:i:s', strtotime($r->TANGGAL_KEJADIAN));
                    $FinalDT     = date('Y-m-d H:i:s', strtotime("$combinedDT  $combinedDT2"));
                    $cDT         = date('Y-m-d', strtotime($r->WAKTU_MULAI));
                    $cDT2        = date('H:i:s', strtotime($r->WAKTU_MULAI));
                    $finalcDT2   = date('Y-m-d H:i:s', strtotime("$cDT  $cDT2"));



                ?>
            <tr>
                <td><?php echo e($r->rownum); ?></td>
                <td><?php echo e($r->setDateFormat($r->TANGGAL_PENGADUAN)); ?></td>
                
                
                <td><?php echo e(date('H:i:s', strtotime($r->TANGGAL_KEJADIAN))); ?></td>
                <td><?php echo e($r->KODE_PENGADUAN); ?></td>
                <td><?php echo e($r->WAKTU_DIPROSES); ?></td>
                <td><?php echo e($r->NAMA_TERLAPOR); ?></td>
                <td><?php echo e($r->LOKASI); ?></td>
                <td><?php echo e($r->NAMA_BARANG); ?></td>
                <td><?php echo e($r->VOLUME); ?></td>
                <td><?php echo e($r->URAIAN); ?></td>
                <td><?php echo e(date('Y-m-d', strtotime($r->WAKTU_MULAI))); ?></td>
                <td><?php echo e(date('H:i:s', strtotime($r->WAKTU_MULAI))); ?></td>
                <td><?php echo e(date('H:i:s', strtotime($r->WAKTU_SELESAI))); ?></td>
                <td><?php echo e(date('Y-m-d', strtotime($r->WAKTU_SELESAI))); ?></td>
                <td><?php echo e($r->diffinminute($r->WAKTU_SELESAI, $r->WAKTU_MULAI)); ?> Menit</td>
                <td><?php echo e($r->diffinminute($finalcDT2, $FinalDT )); ?> Menit</td>
                <td><?php echo e($r->PELAKSANA); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\xampp\htdocs\esimrs\resources\views/complaint/admin/export/daily-excel.blade.php ENDPATH**/ ?>