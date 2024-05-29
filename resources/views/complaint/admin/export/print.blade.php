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

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

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
            <td width="15%"><img style="width: 100px; align-items: center;"
                    src="{{ asset('assets/images/logo/logo-rsud.png') }}"></td>
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
            <td width="100%" style="font-weight: bold; text-align: center; font-size: 18px"><span>Detail
                    Laporan</span></td>
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
                <td width="70%">{{ $complaint->TANGGAL_PENGADUAN }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengaduan</th>
                <td>{{ $complaint->TANGGAL_PENGADUAN }}</td>
            </tr>
            <tr>
                <th>Kode Pengaduan</th>
                <td>{{ $complaint->KODE_PENGADUAN }}</td>
            </tr>
            <tr>
                <th>Tanggal Kerusakan</th>
                <td>{{ $complaint->TANGGAL_KEJADIAN }}</td>
            </tr>
            <tr>
                <th>Ruangan</th>
                <td>{{ $complaint->LOKASI }}</td>
            </tr>
            <tr>
                <th>Uraian Pengaduan</th>
                <td>{{ $complaint->URAIAN }}</td>
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
                <td width="70%">{{ $complaint->NAMA_PELAPOR }}</td>
            </tr>
            <tr>
                <th>Nama Pelapor</th>
                <td>{{ $complaint->NAMA_TERLAPOR }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
