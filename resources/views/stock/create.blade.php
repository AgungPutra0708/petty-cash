@extends('layout.main')
@section('title', 'Tambah Bilyet')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Tambah Bilyet</strong>
                            </div>

                            <div class="card-body card-block">
                                <form action="{{ route('bilyet.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label>Customer</label>
                                        <select name="customer_id" id="customer_id" class="form-control select2 @error('customer_id') is-invalid @enderror">
                                            <option value="">Pilih Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nomor Bilyet</label>
                                        <input type="text" name="nomor_bilyet" id="nomor_bilyet"
                                            class="form-control @error('nomor_bilyet') is-invalid @enderror"
                                            value="{{ old('nomor_bilyet') }}">
                                        @error('nomor_bilyet')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Bank</label>
                                        <input type="text" name="nama_bank"
                                            class="form-control @error('nama_bank') is-invalid @enderror"
                                            value="{{ old('nama_bank') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah" step="0.01"
                                            class="form-control @error('jumlah') is-invalid @enderror"
                                            value="{{ old('jumlah') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Terbit</label>
                                        <input type="date" name="tanggal_terbit"
                                            class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                            value="{{ old('tanggal_terbit') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Jatuh Tempo</label>
                                        <input type="date" name="tanggal_jatuh_tempo"
                                            class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror"
                                            value="{{ old('tanggal_jatuh_tempo') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
                                    </div>

                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('bilyet.index') }}" class="btn btn-secondary btn-sm">
                                            Kembali
                                        </a>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {

    $('.select2').select2();

    $('#customer_id').on('change', function() {
        let customerId = $(this).val();

        if (customerId) {
            $.get('/bilyet/get-last-number/' + customerId, function(data) {
                console.log(data.next_number);
                
                $('#nomor_bilyet').val(data.next_number).change();
            });
        } else {
            $('#nomor_bilyet').val('');
        }
    });

});
</script>
@endpush
