<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            font-family: sans-serif;
            font-size: 12px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        th,td{
            border:1px solid #000;
            padding:6px;
        }

        th{
            background:#eaeaea;
        }

        .text-right{
            text-align:right;
        }

        h3{
            text-align:center;
        }
    </style>
</head>
<body>

<h3>LAPORAN RINGKASAN STOK</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Stok Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stocks as $i => $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td class="text-right">{{ $item->total_masuk }}</td>
                <td class="text-right">{{ $item->total_keluar }}</td>
                <td class="text-right">{{ $item->qty }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>