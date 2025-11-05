<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pegawai</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
            text-transform: uppercase;
            font-size: 11px;
        }

        td {
            font-size: 11px;
            vertical-align: top;
        }

        .footer {
            text-align: right;
            font-size: 10px;
            margin-top: 10px;
            color: #777;
        }
    </style>
</head>

<body>

    <h2>DAFTAR PEGAWAI</h2>
    @if(isset($employees[0]->unit))
        <p><strong>Unit Kerja:</strong> {{ $employees[0]->unit->name ?? '-' }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Lengkap</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pangkat / Golongan</th>
                <th>Jabatan</th>
                <th>Eselon</th>
                <th>Unit Kerja</th>
                <th>Tempat Tugas</th>
                <th>No. Telepon</th>
                <th>NPWP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $i => $emp)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $emp->nip ?? '-' }}</td>
                    <td>{{ $emp->full_name }}</td>
                    <td>{{ $emp->birth_place ?? '-' }}, {{ \Carbon\Carbon::parse($emp->birth_date)->format('d M Y') }}</td>
                    <td>{{ $emp->gender ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $emp->religion->name ?? '-' }}</td>
                    <td>{{ $emp->rank->code ?? '-' }} - {{ $emp->rank->name ?? '-' }}</td>
                    <td>{{ $emp->position->name ?? '-' }}</td>
                    <td>{{ $emp->echelon->name ?? '-' }}</td>
                    <td>{{ $emp->unit->name ?? '-' }}</td>
                    <td>{{ $emp->duty_place ?? '-' }}</td>
                    <td>{{ $emp->phone ?? '-' }}</td>
                    <td>{{ $emp->npwp ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->format('d M Y H:i') }}
    </div>

</body>

</html>