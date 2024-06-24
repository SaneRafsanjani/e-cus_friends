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
            <th>Kode Pengaduan</th>
            <th>Nama Pelapor</th>
            <th>Lokasi</th>
            <th>Nama Barang</th>
            <th>Volume</th>
            <th>Uraian</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Total Waktu Pengerjaan</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($r->rownum); ?></td>
                <td><?php echo e($r->setDateFormat($r->TANGGAL_PENGADUAN)); ?></td>
                <td><?php echo e($r->KODE_PENGADUAN); ?></td>
                <td><?php echo e($r->NAMA_TERLAPOR); ?></td>
                <td><?php echo e($r->LOKASI); ?></td>
                <td><?php echo e($r->NAMA_BARANG); ?></td>
                <td><?php echo e($r->VOLUME); ?></td>
                <td><?php echo e($r->URAIAN); ?></td>
                <td><?php echo e(date('H:i:s', strtotime($r->WAKTU_MULAI))); ?></td>
                <td><?php echo e(date('H:i:s', strtotime($r->WAKTU_SELESAI))); ?></td>
                <td><?php echo e($r->diffinminute($r->WAKTU_SELESAI, $r->WAKTU_MULAI)); ?> Menit</td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\ipsrs\resources\views/complaint/admin/export/daily-excel.blade.php ENDPATH**/ ?>