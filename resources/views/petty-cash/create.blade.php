@extends('layout.main')
@section('title', 'Buat Petty Cash')
@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Buat Petty Cash Baru</h3>
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
                                <h3 class="title-3">Form Pembuatan Petty Cash</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('petty-cash.store') }}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label>Nomor Petty Cash <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_petty_cash" class="form-control @error('nomor_petty_cash') is-invalid @enderror" 
                                            placeholder="Nomor akan otomatis terisi" value="{{ $nomorPettyCash }}" readonly>
                                        @error('nomor_petty_cash')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Bulan <span class="text-danger">*</span></label>
                                        <input type="month" name="bulan" class="form-control @error('bulan') is-invalid @enderror"
                                            value="{{ old('bulan', date('Y-m')) }}">
                                        @error('bulan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jumlah Awal <span class="text-danger">*</span></label>
                                        <input type="number" name="jumlah_awal" class="form-control @error('jumlah_awal') is-invalid @enderror" 
                                            placeholder="Masukkan jumlah awal" step="0.01" min="0" value="{{ old('jumlah_awal') }}">
                                        @error('jumlah_awal')
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
                                            <i class="fa fa-save"></i> Buat
                                        </button>
                                        <a href="{{ route('petty-cash.index') }}" class="au-btn au-btn--secondary">
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
