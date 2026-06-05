@extends('layout.main')
@section('title', 'Tambah Pemasukan Barang')
@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Tambah Pemasukan Barang</h3>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <div class="section__content section__content--p30 p-t-50 p-b-50">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="title-3">Form Tambah Pemasukan Barang</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pemasukan.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Pilih Barang <span class="text-danger">*</span></label>
                                        <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror">
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach($barangs as $barang)
                                                <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                                    {{ $barang->nomor_barang }} - {{ $barang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('barang_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" 
                                            placeholder="Masukkan jumlah" min="1" value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                            value="{{ old('tanggal', date('Y-m-d')) }}">
                                        @error('tanggal')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" 
                                            rows="3" placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="au-btn au-btn--tosca">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('pemasukan.index') }}" class="au-btn au-btn--secondary">
                                            <i class="fa fa-arrow-left"></i> Kembali
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
