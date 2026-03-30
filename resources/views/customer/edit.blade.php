@extends('layout.main')
@section('title', 'Edit Customer')

@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Edit Customer</h3>
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
                                        @error('nomor_customer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Customer</label>
                                        <input type="text" name="nama_customer" class="form-control"
                                            value="{{ old('nama_customer', $customer->name) }}">
                                        @error('nama_customer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" rows="3" class="form-control">{{ old('alamat', $customer->address) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $customer->phone) }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn au-btn--pink-pastel btn-sm">
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
