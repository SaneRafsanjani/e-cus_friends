<html>

<head>
	<title></title>
	<style type="text/css">
		body {
			font-size: 12px;
			font-family: "helvetica", Courier, monospace;
		}

		.line-title-2 {
			border: 0;
			border-style: inset;
			border-top: 4px solid #000;
		}

        .line-title-1 {
			border: 0;
			border-style: inset;
			border-top: 2px solid #000;
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
            font-size: 18px;
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: center;
		}
	</style>
</head>

<body style="padding: 10px" onload="window.print()">
	<table width="100%">
		<tr>
			<td width="15%"><img style="width: 100px; align-items: center;" src="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>"></td>
			<td width="80%" style="text-align: center;">
				<span style="font-weight: bold; font-size: 20px">
                    RUMAH SAKIT UMUM DAERAH KOTA BOGOR
				</span>
				<br>
				<span>Jl. DR. Sumeru No.120 Kota Bogor 16112</span><br>
				<span>Telp. (0251) 8312292, Fax. (0251) 8371001</span><br>
				<span>Situs web: www.rsudkotabogor.co.id, Email: official@rsudkotabogor.co.id</span>
			</td>
		</tr>
	</table>
	<br>
	<hr class="line-title-1">
	<hr class="line-title-2">
    <table width="100%">
        <tr>
            <td width="100%" style="font-weight: bold; text-align: center; font-size: 18px"><span>Detail Laporan</span></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="table" width="100%">
        <thead>
            <tr>
                <th colspan="2">Data Pengaduan</th>
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
    <table class="table">
        <thead>
            <tr>
                <th colspan="2">Data Pelapor</th>
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
<?php /**PATH D:\xampp\htdocs\wbs\resources\views/complaint/admin/export/print.blade.php ENDPATH**/ ?>