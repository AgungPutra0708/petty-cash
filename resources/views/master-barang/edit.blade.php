@extends('layout.main')
@section('title', 'Edit Master Barang')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit Master Barang</strong>
                            </div>

                            <div class="card-body card-block">
                                <form action="{{ route('master-barang.update', $barang->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Nomor Barang</label>
                                        <input type="text" name="nomor_barang" class="form-control"
                                            value="{{ old('nomor_barang', $barang->nomor_barang) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control"
                                            value="{{ old('nama_barang', $barang->name) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="3" class="form-control">{{ old('description', $barang->description) }}</textarea>
                                    </div>

                                    <button class="btn au-btn--pink-pastel btn-sm" type="submit">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('master-barang.index') }}" class="btn btn-secondary btn-sm">
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
