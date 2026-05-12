@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h4>Welcome to</h4>
            <h2 style="font-size:2.5rem;font-weight:800;letter-spacing:4px;margin:0.1rem 0 0.3rem;text-transform:uppercase;text-shadow:2px 2px 4px rgba(0,0,0,0.8)">Salon</h2>
            <p class="subtitle">Sign in to your account</p>
        </div>
        
        <div class="login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email') }}" required placeholder=" ">
                    <label for="email">Email Address</label>
                </div>

                <div class="form-floating password-toggle-container">
                    <input type="password" class="form-control" id="password" name="password" 
                           required placeholder=" ">
                    <label for="password">Password</label>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fa fa-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>

                <div class="remember-checkbox">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="login-btn">
                    Sign In
                </button>
            </form>

            <div class="divider">
                <span>Don't have an account?</span>
            </div>

            <div class="register-links">
                <a href="{{ route('register.user') }}" class="register-btn">Register as User</a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function (e) {
    const password = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>
@endsection