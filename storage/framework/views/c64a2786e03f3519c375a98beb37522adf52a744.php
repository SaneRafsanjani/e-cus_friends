<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/vendors/bootstrap/bootstrap.min.css')); ?>">
    <style>
        .line-title-1 {
    border: 0;
    border-style: inset;
    border-top: 2px solid black;
    margin: 0;
    padding: 0;
}

.line-title-2 {
    border: 0;
    border-style: inset;
    border-top: 5px solid black;
    margin-top: 4px;
    padding: 0;
}

.table {
    border-collapse: collapse;
    width: 100%;
}

.table td, .table th {
    border: 1px solid #ddd;
    padding: 8px;
}

.table tr:nth-child(even){background-color: #f2f2f2;}

.table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
}
    </style>
</head>
<body onload="window.print()">
    
	<table width="100%">
		<tr>
			<td width="15%"><img style="width: 120px; align-items: center;" src="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>"></td>
			<td width="85%" style="text-align: center;">
				<span style="font-weight: 700; font-size: 20px">RUMAH SAKIT UMUM DAERAH KOTA BOGOR</span><br>
				<span style="font-size: 18px; font-weight: 400" class="lh-sm">
                    Jalan Dokter Sumeru No.120 Kota Bogor 16112 <br>
                    Telp. (0251) 8312292, Fax. (0251) 8371001 <br>
                    Situs web: www.rsudkotabogor.co.id, Email: official@rsudkotabogor.co.id
                </span>

			</td>
		</tr>
	</table>
	<br>
	<hr class="line-title-1">
	<hr class="line-title-2">

    
    <div class="container">
        <div class="fw-bold text-center">BERITA ACARA</div>
        <div class="fw-bold text-center">NOMOR: 000/000-SPI/XX/0000</div>
        <br>
        <div class="fw-bold text-center">PEMBAHASAN LAPORAN DUGAAN PELANGGARAN</div>
        <div class="fw-bold text-center">DI RSUD KOTA BOGOR</div>
    </div>
    <br><br>
    <div style="padding-left: 70px; padding-right: 20px">Pada Tanggal <b><?php echo e($news->TANGGAL); ?></b> di <b><?php echo e($news->TEMPAT); ?></b> dengan pimpinan rapat <b><?php echo e($news->PIMPINAN_RAPAT); ?></b> telah dilakukan pembahasan:</div>
    <div style="padding-left: 70px; padding-right: 20px">
        <?php echo $news->PEMBAHASAN; ?>

    </div>

    <div class="position-absolute" style="bottom: 30%; right: 0; padding-right: 20px">
        <div>Bogor, <?php echo e($news->TANGGAL); ?></div>
    </div>
    <div class="position-absolute" style="bottom: 20%; right: 0; padding-right: 20px">
        <div>(<?php echo e($news->PIMPINAN_RAPAT); ?>)</div>
    </div>

    <div style="page-break-after: always"></div>

    
    <br><br><br><br><br>
    <div class="container">
        <div class="fw-bold text-center">DETAIL LAPORAN</div>
    </div>
    <br>
    <br>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th colspan="2" class="text-center">Data Pengaduan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="30%">Tanggal Pengaduan</td>
                <td width="70%"><?php echo e($complaint->TANGGAL_PENGADUAN); ?></td>
            </tr>
            <tr>
                <td>Kode Pengaduan</td>
                <td><?php echo e($complaint->KODE_PENGADUAN); ?></td>
            </tr>
            <tr>
                <td>Jenis Pelanggaran</td>
                <td><?php echo e($complaint->violation->NAMA); ?></td>
            </tr>
            <tr>
                <td>Nama Terlapor</td>
                <td><?php echo e($complaint->NAMA_TERLAPOR); ?></td>
            </tr>
            <tr>
                <td>Tanggal Perkiraan Kejadian</td>
                <td><?php echo e($complaint->TANGGAL_KEJADIAN); ?></td>
            </tr>
            <tr>
                <td>Lokasi Kejadian</td>
                <td><?php echo e($complaint->LOKASI); ?></td>
            </tr>
            <tr>
                <td>Uraian Kejadian</td>
                <td><?php echo e($complaint->URAIAN); ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2" class="text-center">Data Pelapor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="30%">Nama Pelapor</td>
                <td width="70%"><?php echo e($complaint->NAMA_PELAPOR); ?></td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td><?php echo e($complaint->province->NAMA); ?></td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td><?php echo e($complaint->regency->NAMA); ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td><?php echo e($complaint->district->NAMA); ?></td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td><?php echo e($complaint->village->NAMA); ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?php echo e($complaint->ALAMAT); ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
<html>
<?php /**PATH D:\xampp\htdocs\wbs\resources\views/complaint/admin/export/pdf.blade.php ENDPATH**/ ?>