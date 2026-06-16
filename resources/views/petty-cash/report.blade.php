@extends('layout.main')

@section('title', 'Laporan Petty Cash')

@section('content')

<div class="main-content">

    <div class="section__content section__content--p30">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <h3 class="title-5 m-b-20">
                        Laporan Petty Cash
                    </h3>

                    <div class="card">

                        <div class="card-body">

                            <div class="row mb-4">

                                <div class="col-md-3">

                                    <label>Bulan</label>

                                    <input
                                        type="month"
                                        id="filter_bulan"
                                        class="form-control">

                                </div>

                                <div class="col-md-3">

                                    <label>Pembuat</label>

                                    <select
                                        id="filter_creator"
                                        class="form-control">

                                        <option value="">
                                            Semua Pembuat
                                        </option>

                                        @foreach($creators as $creator)

                                            <option
                                                value="{{ $creator->id }}">

                                                {{ $creator->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-md-6">

                                    <label>&nbsp;</label>

                                    <div>

                                        <button
                                            id="btnFilter"
                                            class="au-btn au-btn--blue au-btn--small">

                                            Filter

                                        </button>

                                        <button
                                            id="btnPdf"
                                            class="au-btn au-btn--yellow au-btn--small">

                                            PDF Rekap
                                        </button>

                                        <button
                                            id="btnExcel"
                                            class="au-btn au-btn--green au-btn--small">

                                            Excel Rekap

                                        </button>

                                    </div>

                                </div>

                            </div>

                            <table
                                class="table table-bordered table-striped"
                                id="reportTable">

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
                                    <th>Aksi</th>

                                </tr>

                                </thead>

                            </table>

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
        .summary-box {
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #00897B;
            border-radius: 4px;
            height: 100%;
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
@push('scripts')

<script>

$(function () {

    let table = $('#reportTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: {

            url: "{{ route('petty-cash.report.data') }}",

            data: function (d) {

                d.bulan =
                    $('#filter_bulan').val();

                d.creator_id =
                    $('#filter_creator').val();
            }
        },

        columns: [

            {
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },

            {
                data: 'nomor_petty_cash'
            },

            {
                data: 'periode'
            },

            {
                data: 'creator_name'
            },

            {
                data: 'approver_name'
            },

            {
                data: 'jumlah_awal'
            },

            {
                data: 'total_pengeluaran'
            },

            {
                data: 'jumlah_akhir'
            },

            {
                data: 'status_badge'
            },

            {
                data: 'action',
                searchable: false,
                orderable: false
            }

        ]
    });

    $('#btnFilter').click(function () {

        table.ajax.reload();

    });

    $('#btnPdf').click(function () {

        let bulan =
            $('#filter_bulan').val();

        let creator =
            $('#filter_creator').val();

        window.open(
            "{{ route('petty-cash.report.pdf') }}" +
            '?bulan=' + bulan +
            '&creator_id=' + creator,
            '_blank'
        );

    });

    $('#btnExcel').click(function () {

        let bulan =
            $('#filter_bulan').val();

        let creator =
            $('#filter_creator').val();

        window.location =
            "{{ route('petty-cash.report.excel') }}" +
            '?bulan=' + bulan +
            '&creator_id=' + creator;
    });

});

</script>

@endpush