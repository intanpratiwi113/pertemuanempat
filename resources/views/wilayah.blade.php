<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Wilayah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f5f5;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 24px;
            border: 1px solid #ddd;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }

        form {
            border: 1px solid #ddd;
            padding: 16px;
            margin-bottom: 16px;
        }

        input, select, button {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            box-sizing: border-box;
        }

        button {
            background: #2563eb;
            color: white;
            border: 0;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .success {
            background: #dcfce7;
            padding: 10px;
            margin-bottom: 16px;
        }

        .error {
            background: #fee2e2;
            padding: 10px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Input Data Wilayah</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="grid">
            <form method="POST" action="/provinsi">
                @csrf
                <h3>Input Provinsi</h3>
                <input type="text" name="nama" placeholder="Nama provinsi">
                <button type="submit">Simpan Provinsi</button>
            </form>

            <form method="POST" action="/kota">
                @csrf
                <h3>Input Kota</h3>
                <input type="text" name="nama" placeholder="Nama kota">
                <select name="provinsi_id">
                    <option value="">Pilih provinsi</option>
                    @foreach ($provinsi as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <button type="submit">Simpan Kota</button>
            </form>

            <form method="POST" action="/kecamatan">
                @csrf
                <h3>Input Kecamatan</h3>
                <input type="text" name="nama" placeholder="Nama kecamatan">
                <select name="kota_id">
                    <option value="">Pilih kota</option>
                    @foreach ($kota as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <button type="submit">Simpan Kecamatan</button>
            </form>

            <form method="POST" action="/kelurahan">
                @csrf
                <h3>Input Kelurahan</h3>
                <input type="text" name="nama" placeholder="Nama kelurahan">
                <select name="kecamatan_id">
                    <option value="">Pilih kecamatan</option>
                    @foreach ($kecamatan as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <button type="submit">Simpan Kelurahan</button>
            </form>
        </div>

        <h2>Data Kelurahan</h2>
        <table>
            <thead>
                <tr>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>Kota</th>
                    <th>Provinsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelurahan as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kecamatan->nama }}</td>
                        <td>{{ $item->kecamatan->kota->nama }}</td>
                        <td>{{ $item->kecamatan->kota->provinsi->nama }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada data kelurahan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
