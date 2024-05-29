<table>
    <tr>
        <th>Tahun</th>
        <th>{{ $year_start }} - {{ $year_end }}</th>
    </tr>
</table>
<table>

</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Penyuapan</th>
            <th>Kecurangan</th>
            <th>Pemalakan</th>
            <th>Korupsi</th>
            <th>Pencurian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $r)
            <tr>
                <td>{{ $r->rownum }}</td>
                <td>{{ $r->YEAR_COMPLAINT }}</td>
                <td>{{ $r->PENYUAPAN }}</td>
                <td>{{ $r->KECURANGAN }}</td>
                <td>{{ $r->PEMALAKAN }}</td>
                <td>{{ $r->KORUPSI }}</td>
                <td>{{ $r->PENCURIAN }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
