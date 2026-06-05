@extends('layout.main')
@section('title', 'Detail Petty Cash')
@section('content')
    <div class="main-content">
        <div class="page-content--top">
            <div class="level level-breadcrumb">
                <div class="level-left">
                    <h2 class="heading heading-2">
                        <span class="heading-icon">
                            <i class="zmdi zmdi-money"></i>
                        </span>
                        <span class="m-l-20">Detail Petty Cash: {{ $pettyCash->nomor_petty_cash }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="au-card m-b-20">
                            <div class="au-card-title">
                                <h3 class="title-3">Informasi Petty Cash</h3>
                            </div>
                            <div class="au-card-inner">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-label">Nomor</span>
                                            <span class="info-value">{{ $pettyCash->nomor_petty_cash }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-label">Bulan</span>
                                            <span class="info-value">{{ $pettyCash->bulan->format('F Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-label">Jumlah Awal</span>
                                            <span class="info-value">Rp {{ number_format($pettyCash->jumlah_awal, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-label">Total Pengeluaran</span>
                                            <span class="info-value text-danger">Rp {{ number_format($pettyCash->total_pengeluaran, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-label">Jumlah Akhir</span>
                                            <span class="info-value text-tosca"><strong>Rp {{ number_format($pettyCash->jumlah_akhir, 0, ',', '.') }}</strong></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-label">Status</span>
                                            <span class="info-value">
                                                @if($pettyCash->status == 'draft')
                                                    <span class="badge badge-warning">Draft</span>
                                                @elseif($pettyCash->status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-info">Closed</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <span class="info-label">Dibuat oleh</span>
                                            <span class="info-value">{{ $pettyCash->creator->name ?? '-' }} ({{ $pettyCash->created_at->format('d/m/Y H:i') }})</span>
                                        </div>
                                    </div>
                                </div>
                                @if($pettyCash->keterangan)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="info-box">
                                                <span class="info-label">Keterangan</span>
                                                <span class="info-value">{{ $pettyCash->keterangan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="au-card m-b-20">
                            <div class="au-card-title">
                                <h3 class="title-3">Riwayat Pengeluaran</h3>
                                @if($pettyCash->status == 'draft')
                                    <div style="float: right;">
                                        <button class="au-btn au-btn-icon au-btn--tosca au-btn--small" data-toggle="modal" data-target="#addDetailModal">
                                            <i class="zmdi zmdi-plus"></i> Tambah Pengeluaran
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="au-card-inner">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-header-tosca">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Penerima</th>
                                                <th class="text-right">Jumlah</th>
                                                @if($pettyCash->status == 'draft')
                                                    <th>Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($pettyCash->details->count() > 0)
                                                @php $no = 1; @endphp
                                                @foreach($pettyCash->details as $detail)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $detail->tanggal_pengeluaran->format('d/m/Y') }}</td>
                                                        <td>{{ $detail->keterangan_pengeluaran }}</td>
                                                        <td>{{ $detail->penerima ?? '-' }}</td>
                                                        <td class="text-right">Rp {{ number_format($detail->jumlah_pengeluaran, 0, ',', '.') }}</td>
                                                        @if($pettyCash->status == 'draft')
                                                            <td>
                                                                <a href="{{ route('petty-cash-detail.edit', $detail->id) }}" class="item" title="Edit">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </a>
                                                                <button class="item btn-delete-detail" data-id="{{ $detail->id }}" title="Delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">Belum ada pengeluaran</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-header-tosca">
                                                <td colspan="4" class="text-right"><strong>Total Pengeluaran</strong></td>
                                                <td class="text-right"><strong>Rp {{ number_format($pettyCash->total_pengeluaran, 0, ',', '.') }}</strong></td>
                                                @if($pettyCash->status == 'draft')
                                                    <td></td>
                                                @endif
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="au-card m-b-20">
                            <div class="au-card-title">
                                <h3 class="title-3">Aksi</h3>
                            </div>
                            <div class="au-card-inner">
                                @if($pettyCash->status == 'draft')
                                    <a href="{{ route('petty-cash.edit', $pettyCash->id) }}" class="btn btn-tosca">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                @endif
                                <a href="{{ route('petty-cash.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengeluaran -->
    <div class="modal fade" id="addDetailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('petty-cash-detail.store', $pettyCash->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Pengeluaran <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_pengeluaran" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan <span class="text-danger">*</span></label>
                            <textarea name="keterangan_pengeluaran" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Penerima</label>
                            <input type="text" name="penerima" class="form-control" placeholder="Nama penerima">
                        </div>
                        <div class="form-group">
                            <label>Jumlah <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_pengeluaran" class="form-control" step="0.01" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-tosca">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        .info-box {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .info-label {
            display: block;
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .info-value {
            display: block;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .table-header-tosca {
            background-color: #00897B !important;
            color: white !important;
        }

        .text-tosca {
            color: #00897B !important;
        }
    </style>

    <script>
        $(document).on('click', '.btn-delete-detail', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Yakin mau hapus?',
                text: 'Pengeluaran yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/petty-cash-detail/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire('Terhapus!', data.message, 'success');
                                location.reload();
                            }
                        },
                        error: function(error) {
                            Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush
