@extends('layout.main')
@section('title', 'Tambah Master Barang')
@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Tambah Master Barang</h3>
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
                                <strong>Tambah Master Barang</strong>
                            </div>

                            <div class="card-body card-block">
                                <form action="{{ route('master-barang.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label>Nomor Master Barang</label>
                                        <input type="text" name="nomor_barang"
                                            class="form-control @error('nomor_barang') is-invalid @enderror"
                                            value="{{ old('nomor_barang') }}">
                                        @error('nomor_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Master Barang</label>
                                        <input type="text" name="nama_barang"
                                            class="form-control @error('nama_barang') is-invalid @enderror"
                                            value="{{ old('nama_barang') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="form-actions form-group">
                                        <button type="submit" class="au-btn au-btn--tosca">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('master-barang.index') }}" class="au-btn au-btn--secondary">
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