@extends('layout.main')
@section('title', 'Edit Bilyet')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
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
                                    <label>Nomor Bilyet</label>
                                    <input type="text" name="nomor_bilyet" class="form-control"
                                        value="{{ old('nomor_bilyet', $bilyet->nomor_bilyet) }}">
                                </div>

                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" name="nama_bank" class="form-control"
                                        value="{{ old('nama_bank', $bilyet->nama_bank) }}">
                                </div>

                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" step="0.01" name="jumlah" class="form-control"
                                        value="{{ old('jumlah', $bilyet->jumlah) }}">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Terbit</label>
                                    <input type="date" name="tanggal_terbit" class="form-control"
                                        value="{{ old('tanggal_terbit', $bilyet->tanggal_terbit) }}">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Jatuh Tempo</label>
                                    <input type="date" name="tanggal_jatuh_tempo" class="form-control"
                                        value="{{ old('tanggal_jatuh_tempo', $bilyet->tanggal_jatuh_tempo) }}">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" rows="3"
                                        class="form-control">{{ old('keterangan', $bilyet->keterangan) }}</textarea>
                                </div>

                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-save"></i> Update
                                </button>
                                <a href="{{ route('bilyet.index') }}" class="btn btn-secondary btn-sm">
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
