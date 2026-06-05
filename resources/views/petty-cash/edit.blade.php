@extends('layout.main')
@section('title', 'Edit Petty Cash')
@section('content')
    <div class="main-content">
        <div class="page-content--top">
            <div class="level level-breadcrumb">
                <div class="level-left">
                    <h2 class="heading heading-2">
                        <span class="heading-icon">
                            <i class="zmdi zmdi-money"></i>
                        </span>
                        <span class="m-l-20">Edit Petty Cash: {{ $pettyCash->nomor_petty_cash }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="au-card m-b-20">
                            <div class="au-card-title">
                                <h3 class="title-3">Form Edit Petty Cash</h3>
                            </div>
                            <div class="au-card-inner">
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
                                        <button type="submit" class="btn btn-tosca">
                                            <i class="fa fa-save"></i> Update
                                        </button>
                                        <a href="{{ route('petty-cash.show', $pettyCash->id) }}" class="btn btn-secondary">
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
