<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 200px;
            margin-bottom: 10px;
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo Perusahaan" class="logo">
        <h1>{{ $title }}</h1>
    </div>

    <table>
        {{-- <thead>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ number_format($supplier->nilai, 4) }}</td>
                </tr>
            @endforeach
        </tbody> --}}
        <thead class="table-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Supplier</th>
                @foreach ($kriteria as $kriteriaItem)
                    <th scope="col">{{ $kriteriaItem }}</th>
                @endforeach

                <th scope="col">Nilai</th>


            </tr>
        </thead>
        <tbody>

            @foreach ($suppliers->sortByDesc('nilai') as $index => $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $supplier->name }}
                    </td>
                    @foreach ($supplier->kriterias as $key => $kriteria)
                        <td>{{ \App\Models\Subkriteria::find($kriteria->pivot->subkriteria_id)->name }}</td>
                    @endforeach
                    <td>{{ number_format($supplier->nilai, 4) }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dibuat pada tanggal: {{ $date }}</p>
    </div>
</body>

</html>
