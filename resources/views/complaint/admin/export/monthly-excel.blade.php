<table>
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
            <th>Nama Pelapor</th>
            <th>Lokasi</th>
            <th>Uraian Kerusakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $r)
            <tr>
                <td>{{ $r->rownum }}</td>
                <td>{{ $r->TANGGAL_PENGADUAN }}</td>
                <td>{{ $r->NAMA_TERLAPOR }}</td>
                <td>{{ $r->LOKASI }}</td>
                <td>{{ $r->URAIAN }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
