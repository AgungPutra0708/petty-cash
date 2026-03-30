@extends('layout.main')
@section('title', 'Edit Bilyet')

@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Edit Bilyet</h3>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>

        <div class="section__content section__content--p30 p-t-50 p-b-50">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit Bilyet</strong>
                            </div>

                            <div class="card-body card-block">
                                <form action="{{ route('bilyet.update', $bilyet->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Customer</label>
                                        <select name="customer_id" id="customer_id"
                                            class="form-control select2 @error('customer_id') is-invalid @enderror">
                                            <option value="">Pilih Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ old('customer_id', $bilyet->customer_id) == $customer->id ? 'selected' : '' }}>
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
                                        <input type="text" name="nomor_bilyet"
                                            class="form-control @error('nomor_bilyet') is-invalid @enderror"
                                            value="{{ old('nomor_bilyet', $bilyet->nomor_bilyet) }}">
                                        @error('nomor_bilyet')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Bank</label>
                                        <input type="text" name="nama_bank"
                                            class="form-control @error('nama_bank') is-invalid @enderror"
                                            value="{{ old('nama_bank', $bilyet->nama_bank) }}">
                                        @error('nama_bank')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah" step="0.01"
                                            class="form-control @error('jumlah') is-invalid @enderror"
                                            value="{{ old('jumlah', $bilyet->jumlah) }}">
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Terbit</label>
                                        <input type="date" name="tanggal_terbit"
                                            class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                            value="{{ old('tanggal_terbit', $bilyet->tanggal_terbit) }}">
                                        @error('tanggal_terbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Jatuh Tempo</label>
                                        <input type="date" name="tanggal_jatuh_tempo"
                                            class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror"
                                            value="{{ old('tanggal_jatuh_tempo', $bilyet->tanggal_jatuh_tempo) }}">
                                        @error('tanggal_jatuh_tempo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $bilyet->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn au-btn--pink-pastel btn-sm">
                                            <i class="fa fa-save"></i> Update
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
