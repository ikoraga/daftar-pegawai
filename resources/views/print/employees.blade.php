<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pegawai</title>
    <style>
        @page {
            margin: 15px;
            size: A4 landscape;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #000;
        }

        .header h2 {
            font-size: 13px;
            font-weight: bold;
            margin: 0 0 3px 0;
            text-transform: uppercase;
        }

        .header p {
            font-size: 9px;
            margin: 0;
        }

        .info {
            margin-bottom: 12px;
            font-size: 8px;
        }

        .info-row {
            margin-bottom: 2px;
        }

        .info-label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th {
            background-color: #2d3748;
            color: #fff;
            padding: 5px 3px;
            text-align: center;
            font-size: 7.5px;
            font-weight: bold;
            border: 1px solid #1a202c;
            line-height: 1.2;
        }

        td {
            padding: 4px 3px;
            font-size: 7.5px;
            border: 1px solid #d0d0d0;
            vertical-align: middle;
            line-height: 1.3;
            word-wrap: break-word;
            overflow: hidden;
        }

        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .col-no {
            width: 2%;
            text-align: center;
            font-weight: bold;
        }

        .col-nip {
            width: 7%;
            text-align: left;
        }

        .col-nama {
            width: 10%;
            text-align: left;
        }

        .col-ttl {
            width: 8%;
            text-align: left;
            font-size: 7px;
        }

        .col-jk {
            width: 3%;
            text-align: center;
        }

        .col-agama {
            width: 5%;
            text-align: center;
        }

        .col-pangkat {
            width: 11%;
            text-align: left;
            font-size: 7px;
        }

        .col-jabatan {
            width: 12%;
            text-align: left;
        }

        .col-eselon {
            width: 5%;
            text-align: center;
        }

        .col-unit {
            width: 10%;
            text-align: left;
        }

        .col-tempat {
            width: 9%;
            text-align: left;
        }

        .col-telepon {
            width: 8%;
            text-align: left;
            font-size: 7px;
        }

        .col-npwp {
            width: 10%;
            text-align: left;
            font-size: 7px;
        }

        .footer {
            margin-top: 12px;
            text-align: right;
            font-size: 7px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Daftar Pegawai</h2>
        <p>Sistem Informasi Kepegawaian</p>
    </div>

    <div class="info">
        <div class="info-row">
            <span class="info-label">Jumlah Pegawai:</span>
            <span>{{ count($employees) }} orang</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-nip">NIP</th>
                <th class="col-nama">Nama Lengkap</th>
                <th class="col-ttl">Tempat, Tgl Lahir</th>
                <th class="col-jk">JK</th>
                <th class="col-agama">Agama</th>
                <th class="col-pangkat">Pangkat/Gol</th>
                <th class="col-jabatan">Jabatan</th>
                <th class="col-eselon">Eselon</th>
                <th class="col-unit">Unit Kerja</th>
                <th class="col-tempat">Tempat Tugas</th>
                <th class="col-telepon">Telepon</th>
                <th class="col-npwp">NPWP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $i => $emp)
                <tr>
                    <td class="col-no">{{ $i + 1 }}</td>
                    <td class="col-nip">{{ $emp->nip ?? '-' }}</td>
                    <td class="col-nama">{{ $emp->full_name }}</td>
                    <td class="col-ttl">{{ $emp->birth_place ?? '-' }},
                        {{ \Carbon\Carbon::parse($emp->birth_date)->format('d/m/Y') }}
                    </td>
                    <td class="col-jk">{{ $emp->gender ? 'L' : 'P' }}</td>
                    <td class="col-agama">{{ $emp->religion->name ?? '-' }}</td>
                    <td class="col-pangkat">
                        {{ $emp->rank->code ?? '-' }}{{ isset($emp->rank->name) ? ' - ' . $emp->rank->name : '' }}
                    </td>
                    <td class="col-jabatan">{{ $emp->position->name ?? '-' }}</td>
                    <td class="col-eselon">{{ $emp->echelon->name ?? '-' }}</td>
                    <td class="col-unit">{{ $emp->unit->name ?? '-' }}</td>
                    <td class="col-tempat">{{ $emp->duty_place ?? '-' }}</td>
                    <td class="col-telepon">{{ $emp->phone ?? '-' }}</td>
                    <td class="col-npwp">{{ $emp->npwp ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y, H:i') }} WIB
    </div>

</body>

</html>