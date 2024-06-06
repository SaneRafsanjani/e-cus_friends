{{-- <table>
    <tr>
        <th>Bulan</th>
        <th>{{ $month }}</th>
    </tr>
    <tr>
        <th>Tahun</th>
        <th>{{ $year }}</th>
    </tr>
</table> --}}
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
        @foreach ($report as $r)


                <?php
                    $combinedDT  = date('Y-m-d', strtotime($r->TANGGAL_INPUT));
                    // $combinedDT2 = date('H:i:s', strtotime($r->TANGGAL_KEJADIAN));
                    // $FinalDT     = date('Y-m-d H:i:s', strtotime("$combinedDT  $combinedDT2"));
                    // $cDT         = date('Y-m-d', strtotime($r->WAKTU_MULAI));
                    // $cDT2        = date('H:i:s', strtotime($r->WAKTU_MULAI));
                    // $finalcDT2   = date('Y-m-d H:i:s', strtotime("$cDT  $cDT2"));
                ?>
            <tr>
                <td>{{ $r->rownum }}</td>
                <td>{{ $r->setDateFormat($r->TANGGAL_INPUT) }}</td>
                <td>{{ $r->KETERANGAN_SHIFT }}</td>
                <td>{{ $r->KONDISI_IGD }}</td>
                {{-- <td>{{ $combinedDT }}</td> --}}
                {{-- <td>{{ date('Y-m-d H:i:s', strtotime("$combinedDT  $combinedDT2")) }}</td> --}}
                {{-- <td>{{ date('H:i:s', strtotime($r->TANGGAL_KEJADIAN)) }}</td>
                <td>{{ $r->KODE_PENGADUAN }}</td>
                <td>{{ $r->WAKTU_DIPROSES }}</td>
                <td>{{ $r->NAMA_TERLAPOR }}</td>
                <td>{{ $r->LOKASI }}</td>
                <td>{{ $r->NAMA_BARANG }}</td>
                <td>{{ $r->VOLUME }}</td>
                <td>{{ $r->URAIAN }}</td> --}}
                {{-- <td>{{ date('Y-m-d', strtotime($r->WAKTU_MULAI)) }}</td>
                <td>{{ date('H:i:s', strtotime($r->WAKTU_MULAI)) }}</td>
                <td>{{ date('H:i:s', strtotime($r->WAKTU_SELESAI)) }}</td>
                <td>{{ date('Y-m-d', strtotime($r->WAKTU_SELESAI)) }}</td>
                <td>{{ $r->diffinminute($r->WAKTU_SELESAI, $r->WAKTU_MULAI) }} Menit</td>
                <td>{{ $r->diffinminute($finalcDT2, $FinalDT ) }} Menit</td>
                <td>{{ $r->PELAKSANA }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
