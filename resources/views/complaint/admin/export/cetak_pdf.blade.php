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

        @media print {
            @page {
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
            @foreach ($report as $key => $r)
                <?php
                $combinedDT = date('Y-m-d', strtotime($r->TANGGAL_INPUT));
                ?>
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $r->setDateFormat($r->TANGGAL_INPUT) }}</td>
                    <td>{{ $r->KETERANGAN_SHIFT }}</td>
                    <td>{{ $r->NAMA_PETUGAS }}</td>
                    <td>{{ $r->IDENTITAS }}</td>
                    <td>{{ $r->KONDISI_IGD }}</td>
                    <td>
                        <div>
                            <img src="{{ public_path('storage/' . $r->FILE) }}" style="width: 50%">
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
