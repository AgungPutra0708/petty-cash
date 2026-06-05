@extends('layout.main')
@section('title', 'Edit Pengeluaran Petty Cash')
@section('content')
    <div class="main-content">
        <div class="page-content--top">
            <div class="level level-breadcrumb">
                <div class="level-left">
                    <h2 class="heading heading-2">
                        <span class="heading-icon">
                            <i class="zmdi zmdi-money"></i>
                        </span>
                        <span class="m-l-20">Edit Pengeluaran Petty Cash</span>
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
                                <h3 class="title-3">Form Edit Pengeluaran</h3>
                            </div>
                            <div class="au-card-inner">
                                <form action="{{ route('petty-cash-detail.update', $detail->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <label>Tanggal Pengeluaran <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_pengeluaran" class="form-control @error('tanggal_pengeluaran') is-invalid @enderror"
                                            value="{{ $detail->tanggal_pengeluaran->format('Y-m-d') }}" required>
                                        @error('tanggal_pengeluaran')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan <span class="text-danger">*</span></label>
                                        <textarea name="keterangan_pengeluaran" class="form-control @error('keterangan_pengeluaran') is-invalid @enderror" 
                                            rows="3" required>{{ $detail->keterangan_pengeluaran }}</textarea>
                                        @error('keterangan_pengeluaran')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Penerima</label>
                                        <input type="text" name="penerima" class="form-control @error('penerima') is-invalid @enderror" 
                                            placeholder="Nama penerima" value="{{ $detail->penerima }}">
                                        @error('penerima')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jumlah Pengeluaran <span class="text-danger">*</span></label>
                                        <input type="number" name="jumlah_pengeluaran" class="form-control @error('jumlah_pengeluaran') is-invalid @enderror" 
                                            step="0.01" min="0" value="{{ $detail->jumlah_pengeluaran }}" required>
                                        @error('jumlah_pengeluaran')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-tosca">
                                            <i class="fa fa-save"></i> Update
                                        </button>
                                        <a href="{{ route('petty-cash.show', $detail->petty_cash_id) }}" class="btn btn-secondary">
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
