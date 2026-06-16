<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family:sans-serif;
    font-size:11px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,
table td{
    border:1px solid #000;
    padding:5px;
}

</style>

</head>

<body>

<h2>
    LAPORAN PETTY CASH
</h2>

<table>

<thead>

<tr>
    <th>No</th>
    <th>Nomor</th>
    <th>Periode</th>
    <th>Pembuat</th>
    <th>Approver</th>
    <th>Jumlah Awal</th>
    <th>Pengeluaran</th>
    <th>Saldo</th>
    <th>Status</th>
</tr>

</thead>

<tbody>

@foreach($pettyCashes as $item)

<tr>

<td>
{{ $loop->iteration }}
</td>

<td>
{{ $item->nomor_petty_cash }}
</td>

<td>
{{ $item->bulan->format('F Y') }}
</td>

<td>
{{ $item->creator?->name }}
</td>

<td>
{{ $item->approver?->name }}
</td>

<td>
{{ number_format($item->jumlah_awal,0,',','.') }}
</td>

<td>
{{ number_format($item->total_pengeluaran,0,',','.') }}
</td>

<td>
{{ number_format($item->jumlah_akhir,0,',','.') }}
</td>

<td>
{{ strtoupper($item->status) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>