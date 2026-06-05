@extends('layout.main')
@section('title', 'Laporan Petty Cash')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Laporan Petty Cash</h3>
                        <div class="table-data__tool" style="float: right;">
                            <div class="table-data__tool-right">
                                <a class="au-btn au-btn-icon au-btn--tosca au-btn--small" onclick="window.print()">
                                    <i class="zmdi zmdi-print"></i>Cetak</a>
                                <a class="au-btn au-btn-icon au-btn--tosca au-btn--small"
                                    href="{{ route('petty-cash.index') }}">
                                    <i class="zmdi zmdi-arrow-left"></i>Kembali</a>
                            </div>
                        </div>

                        @foreach($pettyCashes as $pettyCash)
                            <div class="au-card m-b-20">
                                <div class="au-card-title">
                                    <h3 class="title-3">
                                        Petty Cash - {{ $pettyCash->bulan->format('F Y') }} ({{ $pettyCash->nomor_petty_cash }})
                                        <span class="badge" style="float: right; margin-top: 5px;">
                                            @if($pettyCash->status == 'draft')
                                                <span class="badge badge-warning">Draft</span>
                                            @elseif($pettyCash->status == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-info">Closed</span>
                                            @endif
                                        </span>
                                    </h3>
                                </div>
                                <div class="au-card-inner">
                                    <div class="row m-b-20">
                                        <div class="col-md-3">
                                            <div class="summary-box">
                                                <label>Jumlah Awal</label>
                                                <h3 class="text-tosca">Rp {{ number_format($pettyCash->jumlah_awal, 0, ',', '.') }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="summary-box">
                                                <label>Total Pengeluaran</label>
                                                <h3 class="text-danger">Rp {{ number_format($pettyCash->total_pengeluaran, 0, ',', '.') }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="summary-box">
                                                <label>Jumlah Akhir</label>
                                                <h3 class="text-success">Rp {{ number_format($pettyCash->jumlah_akhir, 0, ',', '.') }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="summary-box">
                                                <label>Dibuat oleh</label>
                                                <h4>{{ $pettyCash->creator->name ?? '-' }}</h4>
                                                <small class="text-muted">{{ $pettyCash->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    @if($pettyCash->details->count() > 0)
                                        <table class="table table-hover table-bordered">
                                            <thead class="table-header-tosca">
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Tanggal</th>
                                                    <th width="40%">Keterangan</th>
                                                    <th width="20%">Penerima</th>
                                                    <th width="20%" class="text-right">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; $total = 0; @endphp
                                                @foreach($pettyCash->details as $detail)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $detail->tanggal_pengeluaran->format('d/m/Y') }}</td>
                                                        <td>{{ $detail->keterangan_pengeluaran }}</td>
                                                        <td>{{ $detail->penerima ?? '-' }}</td>
                                                        <td class="text-right">Rp {{ number_format($detail->jumlah_pengeluaran, 0, ',', '.') }}</td>
                                                    </tr>
                                                    @php $total += $detail->jumlah_pengeluaran; @endphp
                                                @endforeach
                                                <tr class="table-header-tosca">
                                                    <td colspan="4" class="text-right"><strong>TOTAL</strong></td>
                                                    <td class="text-right"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center text-muted">Belum ada pengeluaran untuk periode ini</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if($pettyCashes->count() == 0)
                            <div class="au-card">
                                <div class="au-card-inner">
                                    <p class="text-center text-muted">Belum ada data petty cash</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        .summary-box {
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #00897B;
            border-radius: 4px;
        }

        .summary-box label {
            display: block;
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
        }

        .summary-box h3,
        .summary-box h4 {
            margin: 0;
        }

        .table-header-tosca {
            background-color: #00897B !important;
            color: white !important;
        }

        .text-tosca {
            color: #00897B !important;
        }

        @media print {
            .table-data__tool,
            .au-btn {
                display: none !important;
            }
        }
    </style>
@endpush
