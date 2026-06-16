@extends('layout.main')
@section('title', 'Edit Pengeluaran Petty Cash')
@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Edit Pengeluaran Petty Cash</h3>
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
                                <h3 class="title-3">Form Edit Pengeluaran</h3>
                            </div>
                            <div class="card-body">
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
                                        <button type="submit" class="au-btn au-btn--tosca">
                                            <i class="fa fa-save"></i> Update
                                        </button>
                                        <a href="{{ route('petty-cash.show', $detail->petty_cash_id) }}" class="au-btn au-btn--secondary">
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
