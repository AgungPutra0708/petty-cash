@extends('layout.main')
@section('title', 'Pengeluaran Barang')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Pengeluaran Barang</h3>
                        <div class="table-data__tool" style="float: right;">
                            <div class="table-data__tool-right">
                                @if(Auth::user()->isMaker() || Auth::user()->isAdmin())
                                    <a class="au-btn au-btn-icon au-btn--tosca au-btn--small"
                                        href="{{ route('pengeluaran.create') }}">
                                        <i class="zmdi zmdi-plus"></i>Tambah Pengeluaran</a>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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

    <!-- Modal Rejection -->
    <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Penolakan Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="rejectionForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="rejectionStockId" name="stock_id">
                        <div class="form-group">
                            <label>Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="catatan_rejection" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                </form>
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
                ajax: "{{ route('pengeluaran.data') }}",
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
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Yakin mau hapus?',
                text: 'Data pengeluaran barang yang dihapus tidak bisa dikembalikan!',
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
                        url: '/pengeluaran/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if(data.success) {
                                Swal.fire('Terhapus!', data.message, 'success');
                            } else {
                                Swal.fire('Gagal!', data.message, 'error');
                            }
                            $('.table-data2').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-submit-approval', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Submit untuk Approval?',
                text: 'Pengeluaran akan masuk ke approval queue',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#00897B',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Submit',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/pengeluaran/' + id + '/submit-approval',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if(data.success) {
                                Swal.fire('Berhasil!', data.message, 'success');
                            } else {
                                Swal.fire('Gagal!', data.message, 'error');
                            }
                            $('.table-data2').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-approve', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Approve Pengeluaran?',
                text: 'Pengeluaran akan disetujui dan stok akan terupdate',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#00897B',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Approve',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/pengeluaran/' + id + '/approve',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if(data.success) {
                                Swal.fire('Berhasil!', data.message, 'success');
                            } else {
                                Swal.fire('Gagal!', data.message, 'error');
                            }
                            $('.table-data2').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-reject', function() {
            let id = $(this).data('id');
            $('#rejectionStockId').val(id);
            $('#rejectionModal').modal('show');
        });

        $('#rejectionForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#rejectionStockId').val();
            let catatan = $('textarea[name="catatan_rejection"]').val();

            $.ajax({
                type: 'POST',
                url: '/pengeluaran/' + id + '/reject',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    catatan_rejection: catatan
                },
                success: function(data) {
                    $('#rejectionModal').modal('hide');
                    $('#rejectionForm')[0].reset();
                    if(data.success) {
                        Swal.fire('Berhasil!', data.message, 'success');
                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                    $('.table-data2').DataTable().ajax.reload();
                },
                error: function(error) {
                    Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                }
            });
        });
    </script>
@endpush
