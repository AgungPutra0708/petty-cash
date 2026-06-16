@extends('layout.main')
@section('title', 'Edit User')
@section('content')
    <div class="main-content">
        <section class="p-t-10 p-l-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Edit User: {{ $user->name }}</h3>
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
                                <h3 class="title-3">Form Edit User</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                            placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                            placeholder="Masukkan email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                            placeholder="Masukkan password baru">
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" 
                                            placeholder="Konfirmasi password">
                                    </div>

                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <div>
                                            @foreach($roles as $role)
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                                        {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                                                    {{ $role->display_name }}
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('roles')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-tosca">
                                            <i class="fa fa-save"></i> Update
                                        </button>
                                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
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
