<table>
    <tr>
        <th>Bulan</th>
        <th>{{ $month }}</th>
    </tr>
    <tr>
        <th>Tahun</th>
        <th>{{ $year }}</th>
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
        @foreach ($report as $r)


                <?php
                    $combinedDT  = date('Y-m-d', strtotime($r->TANGGAL_PENGADUAN));
                    $combinedDT2 = date('H:i:s', strtotime($r->TANGGAL_KEJADIAN));
                    $FinalDT     = date('Y-m-d H:i:s', strtotime("$combinedDT  $combinedDT2"));
                    $cDT         = date('Y-m-d', strtotime($r->WAKTU_MULAI));
                    $cDT2        = date('H:i:s', strtotime($r->WAKTU_MULAI));
                    $finalcDT2   = date('Y-m-d H:i:s', strtotime("$cDT  $cDT2"));



                ?>
            <tr>
                <td>{{ $r->rownum }}</td>
                <td>{{ $r->setDateFormat($r->TANGGAL_PENGADUAN) }}</td>
                {{-- <td>{{ $combinedDT }}</td> --}}
                {{-- <td>{{ date('Y-m-d H:i:s', strtotime("$combinedDT  $combinedDT2")) }}</td> --}}
                <td>{{ date('H:i:s', strtotime($r->TANGGAL_KEJADIAN)) }}</td>
                <td>{{ $r->KODE_PENGADUAN }}</td>
                <td>{{ $r->WAKTU_DIPROSES }}</td>
                <td>{{ $r->NAMA_TERLAPOR }}</td>
                <td>{{ $r->LOKASI }}</td>
                <td>{{ $r->NAMA_BARANG }}</td>
                <td>{{ $r->VOLUME }}</td>
                <td>{{ $r->URAIAN }}</td>
                <td>{{ date('Y-m-d', strtotime($r->WAKTU_MULAI)) }}</td>
                <td>{{ date('H:i:s', strtotime($r->WAKTU_MULAI)) }}</td>
                <td>{{ date('H:i:s', strtotime($r->WAKTU_SELESAI)) }}</td>
                <td>{{ date('Y-m-d', strtotime($r->WAKTU_SELESAI)) }}</td>
                <td>{{ $r->diffinminute($r->WAKTU_SELESAI, $r->WAKTU_MULAI) }} Menit</td>
                <td>{{ $r->diffinminute($finalcDT2, $FinalDT ) }} Menit</td>
                <td>{{ $r->PELAKSANA }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
