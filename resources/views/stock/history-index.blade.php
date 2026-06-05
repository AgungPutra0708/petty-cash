@extends('layout.main')
@section('title', 'Riwayat Stok Barang')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Riwayat Pemasukan & Pengeluaran Stok</h3>
                        <div class="table-data__tool" style="float: right;">
                            <div class="table-data__tool-right">
                                <a class="au-btn au-btn-icon au-btn--tosca au-btn--small"
                                    href="{{ route('history-stock.report') }}">
                                    <i class="zmdi zmdi-file"></i>Laporan</a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Tipe</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
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
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.table-data2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('history-stock.data') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
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
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'status_badge',
                        name: 'status',
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endpush
