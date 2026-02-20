@extends('layout.main')
@section('title', 'Tambah Customer')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Tambah Customer</strong>
                            </div>

                            <div class="card-body card-block">
                                <form action="{{ route('customer.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label>Nomor Customer</label>
                                        <input type="text" name="nomor_customer"
                                            class="form-control @error('nomor_customer') is-invalid @enderror"
                                            value="{{ old('nomor_customer') }}">
                                        @error('nomor_customer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Customer</label>
                                        <input type="text" name="nama_customer"
                                            class="form-control @error('nama_customer') is-invalid @enderror"
                                            value="{{ old('nama_customer') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" rows="3" class="form-control">{{ old('alamat') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}">
                                    </div>

                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('customer.index') }}" class="btn btn-secondary btn-sm">
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