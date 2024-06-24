<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 120%;
            border-collapse: separate;
            border-spacing: 0 10px;
            /* Atur jarak antar baris */
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        @media  print {
            @page  {
                size: landscape;
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu Laporan</th>
                <th>Keterangan Shift</th>
                <th>Nama Petugas</th>
                <th>Identitas</th>
                <th>Kondisi IGD</th>
                <th>Dokumentasi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $combinedDT = date('Y-m-d', strtotime($r->TANGGAL_INPUT));
                ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><?php echo e($r->setDateFormat($r->TANGGAL_INPUT)); ?></td>
                    <td><?php echo e($r->KETERANGAN_SHIFT); ?></td>
                    <td><?php echo e($r->NAMA_PETUGAS); ?></td>
                    <td><?php echo e($r->IDENTITAS); ?></td>
                    <td><?php echo e($r->KONDISI_IGD); ?></td>
                    <td>
                        <div>
                            <img src="<?php echo e(public_path('storage/' . $r->FILE)); ?>" style="width: 50%">
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>

</html>
<?php /**PATH D:\Backupan\Sahabat_pelanggan\resources\views/complaint/admin/export/cetak_pdf.blade.php ENDPATH**/ ?>