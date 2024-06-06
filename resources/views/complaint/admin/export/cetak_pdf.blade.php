<style>
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px; /* Atur jarak antar baris */
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr {
        background-color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

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
        @foreach ($report as $key => $r)
            <?php
                $combinedDT  = date('Y-m-d', strtotime($r->TANGGAL_INPUT));
            ?>
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $r->setDateFormat($r->TANGGAL_INPUT) }}</td>
                <td>{{ $r->KETERANGAN_SHIFT }}</td>
                <td>{{ $r->KONDISI_IGD }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
