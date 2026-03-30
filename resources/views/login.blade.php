@extends('layout.auth')

@section('login')
    <div class="container">
        <div class="login-wrap">
            <div class="login-content">
                <div class="login-logo">
                    <h1>Management System</h1>
                </div>
                <div class="login-form">
                    <form action="{{ route('login.authenticate') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                        </div>
                        <button class="au-btn au-btn--block au-btn--pink-pastel m-b-20" type="submit">sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
