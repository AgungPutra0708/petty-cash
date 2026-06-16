@extends('layout.main')
@section('title', 'Tambah User')
@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Tambah User</h3>
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
                                <h3 class="title-3">Form Tambah User</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                            placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                            placeholder="Masukkan email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                            placeholder="Masukkan password (min 8 karakter)" required>
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" 
                                            placeholder="Konfirmasi password" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <div>
                                            @foreach($roles as $role)
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                                        {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                                    {{ $role->display_name }}
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('roles')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="au-btn au-btn--tosca">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('user.index') }}" class="au-btn au-btn--secondary">
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
