@extends('layout.main')
@section('title', 'Edit Petty Cash')
@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Edit Petty Cash: {{ $pettyCash->nomor_petty_cash }}</h3>
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
                                <h3 class="title-3">Form Edit Petty Cash</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('petty-cash.update', $pettyCash->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <label>Nomor Petty Cash</label>
                                        <input type="text" class="form-control" value="{{ $pettyCash->nomor_petty_cash }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <input type="text" class="form-control" value="{{ $pettyCash->bulan->format('F Y') }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Jumlah Awal <span class="text-danger">*</span></label>
                                        <input type="number" name="jumlah_awal" class="form-control @error('jumlah_awal') is-invalid @enderror" 
                                            placeholder="Masukkan jumlah awal" step="0.01" min="0" value="{{ $pettyCash->jumlah_awal }}">
                                        @error('jumlah_awal')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" 
                                            rows="3" placeholder="Masukkan keterangan">{{ $pettyCash->keterangan }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="au-btn au-btn--tosca">
                                            <i class="fa fa-save"></i> Update
                                        </button>
                                        <a href="{{ route('petty-cash.show', $pettyCash->id) }}" class="au-btn au-btn--secondary">
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
