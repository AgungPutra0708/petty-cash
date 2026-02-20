@extends('layout.main')
@section('title', 'Edit Customer')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit Customer</strong>
                            </div>

                            <div class="card-body card-block">
                                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Nomor Customer</label>
                                        <input type="text" name="nomor_customer" class="form-control"
                                            value="{{ old('nomor_customer', $customer->nomor_customer) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Customer</label>
                                        <input type="text" name="nama_customer" class="form-control"
                                            value="{{ old('nama_customer', $customer->name) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" rows="3" class="form-control">{{ old('alamat', $customer->address) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $customer->phone) }}">
                                    </div>

                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('customer.index') }}" class="btn btn-secondary btn-sm">
                                        Kembali
                                    </a>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
