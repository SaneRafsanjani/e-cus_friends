<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengaduan SIMRS</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Pengaduan SIMRS</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Pengaduan</th>
				<th>Kode Pengaduan</th>
				<th>Nama Pelapor</th>
				<th>Unit</th>
				<th>Tanggal Pengaduan</th>
                <th>Nama Barang</th>
                <th>Volume</th>
                <th>Uraian</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pegawai as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nama}}</td>
				<td>{{$p->email}}</td>
				<td>{{$p->alamat}}</td>
				<td>{{$p->telepon}}</td>
				<td>{{$p->pekerjaan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
