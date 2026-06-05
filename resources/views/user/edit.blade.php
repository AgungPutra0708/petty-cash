@extends('layout.main')
@section('title', 'Edit User')
@section('content')
    <div class="main-content">
        <div class="page-content--top">
            <div class="level level-breadcrumb">
                <div class="level-left">
                    <h2 class="heading heading-2">
                        <span class="heading-icon">
                            <i class="zmdi zmdi-account-box"></i>
                        </span>
                        <span class="m-l-20">Edit User: {{ $user->name }}</span>
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
                                <h3 class="title-3">Form Edit User</h3>
                            </div>
                            <div class="au-card-inner">
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
