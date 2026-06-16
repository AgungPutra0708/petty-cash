<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Petty Cash</title>

    <style>

        body{
            font-family:sans-serif;
            font-size:12px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:6px;
        }

        .text-right{
            text-align:right;
        }

    </style>

</head>
<body>

<h2>
    PETTY CASH
</h2>

<table>
    <tr>
        <td>Nomor</td>
        <td>{{ $pettyCash->nomor_petty_cash }}</td>
    </tr>

    <tr>
        <td>Periode</td>
        <td>{{ $pettyCash->bulan->format('F Y') }}</td>
    </tr>

    <tr>
        <td>Pembuat</td>
        <td>{{ $pettyCash->creator?->name }}</td>
    </tr>

    <tr>
        <td>Approver</td>
        <td>{{ $pettyCash->approver?->name }}</td>
    </tr>
</table>

<br>

<table>

    <thead>

    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Penerima</th>
        <th>Jumlah</th>
    </tr>

    </thead>

    <tbody>

    @php
        $no=1;
        $total=0;
    @endphp

    @foreach($pettyCash->details as $detail)

        <tr>

            <td>{{ $no++ }}</td>

            <td>
                {{ $detail->tanggal_pengeluaran->format('d/m/Y') }}
            </td>

            <td>
                {{ $detail->keterangan_pengeluaran }}
            </td>

            <td>
                {{ $detail->penerima }}
            </td>

            <td class="text-right">
                {{ number_format($detail->jumlah_pengeluaran,0,',','.') }}
            </td>

        </tr>

        @php
            $total += $detail->jumlah_pengeluaran;
        @endphp

    @endforeach

    <tr>

        <td colspan="4">
            TOTAL
        </td>

        <td class="text-right">

            {{ number_format($total,0,',','.') }}

        </td>

    </tr>

    </tbody>

</table>

</body>
</html>