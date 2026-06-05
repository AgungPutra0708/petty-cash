@extends('layout.main')
@section('title', 'Laporan Stok Barang')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Laporan Stok Barang</h3>
                        <div class="table-data__tool" style="justify-self: right;">
                            <div class="table-data__tool-right">
                                <button class="au-btn au-btn-icon au-btn--tosca au-btn--small" onclick="printPdf()">
                                    <i class="zmdi zmdi-print"></i>Cetak PDF
                                </button>
                                <button class="au-btn au-btn-icon au-btn--tosca au-btn--small" onclick="exportExcel()">
                                    <i class="zmdi zmdi-download"></i>Cetak Excel
                                </button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="title-3">Ringkasan Stok</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-stock">
                                        <thead class="table-header-tosca">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th class="text-right">Masuk</th>
                                                <th class="text-right">Keluar</th>
                                                <th class="text-right">Stok Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="title-3">Detail Riwayat Stok</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-history">
                                        <thead class="table-header-tosca">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Barang</th>
                                                <th>Tipe</th>
                                                <th class="text-right">Jumlah</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
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
@push('scripts')
    <script>
        $(function() {
            $('#table-stock').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                ajax: "{{ route('history-stock.report.data') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'total_masuk',
                        className: 'text-right'
                    },
                    {
                        data: 'total_keluar',
                        className: 'text-right'
                    },
                    {
                        data: 'qty',
                        className: 'text-right'
                    }
                ]
            });

            $('#table-history').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                lengthChange: false,
                searching: false,
                ajax: "{{ route('history-stock.data') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'barang_name',
                        name: 'barang.name'
                    },
                    {
                        data: 'type_badge',
                        name: 'type',
                        orderable: false
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    }
                ]
            });
        });
        function exportExcel() {
            window.location.href =
                "{{ route('history-stock.export-excel') }}";
        }

        function printPdf() {
            window.location.href =
                "{{ route('history-stock.export-pdf') }}";
        }
    </script>
@endpush