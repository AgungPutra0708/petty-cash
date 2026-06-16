@extends('layout.main')
@section('title', 'Petty Cash')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Manajemen Petty Cash</h3>
                        <div class="table-data__tool" style="float: right;">
                            <div class="table-data__tool-right">
                                <a class="au-btn au-btn-icon au-btn--tosca au-btn--small"
                                    href="{{ route('petty-cash.create') }}">
                                    <i class="zmdi zmdi-plus"></i>Buat Petty Cash</a>
                                <a class="au-btn au-btn-icon au-btn--tosca au-btn--small"
                                    href="{{ route('petty-cash.report') }}">
                                    <i class="zmdi zmdi-file"></i>Laporan</a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Petty Cash</th>
                                        <th>Bulan</th>
                                        <th>Jumlah Awal</th>
                                        <th>Total Pengeluaran</th>
                                        <th>Jumlah Akhir</th>
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
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.table-data2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('petty-cash.data') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nomor_petty_cash',
                        name: 'nomor_petty_cash'
                    },
                    {
                        data: 'bulan_display',
                        name: 'bulan'
                    },
                    {
                        data: 'jumlah_awal',
                        name: 'jumlah_awal',
                        render: function(data) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'total_pengeluaran',
                        name: 'total_pengeluaran',
                        render: function(data) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'jumlah_akhir',
                        name: 'jumlah_akhir',
                        render: function(data) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                        }
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
                text: 'Data petty cash yang dihapus tidak bisa dikembalikan!',
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
                        url: '/petty-cash/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire('Terhapus!', data.message, 'success');
                                $('.table-data2').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }
                        },
                        error: function(error) {
                            Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-approve', function () {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Yakin mau approve?',
                text: 'Pastikan semua data sudah benar sebelum approve!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, approve',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (!result.isConfirmed) {
                    return;
                } else{
                    $.ajax({
                        url: '/petty-cash/' + id + '/approve',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Berhasil!', res.message, 'success');
                                $('.table-data2').DataTable().ajax.reload();
                            }else {
                                Swal.fire('Error!', res.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error!', 'Gagal approve data', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush
