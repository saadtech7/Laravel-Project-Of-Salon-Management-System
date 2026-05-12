@extends('layouts.app')

@section('title', 'Register as User')

@section('content')
<style>
.register-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #dc143c 0%, #000000 50%, #8b0000 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
    overflow: hidden;
}

.register-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 25% 25%, rgba(220, 20, 60, 0.4) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(0, 0, 0, 0.6) 0%, transparent 50%),
        radial-gradient(circle at 50% 10%, rgba(139, 0, 0, 0.3) 0%, transparent 50%);
    animation: deadpoolPattern 12s ease-in-out infinite;
}

@keyframes deadpoolPattern {
    0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.8; }
    33% { transform: scale(1.1) rotate(2deg); opacity: 1; }
    66% { transform: scale(0.9) rotate(-2deg); opacity: 0.9; }
}

.register-card {
    background: rgba(20, 20, 20, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.5),
        0 0 0 2px rgba(220, 20, 60, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border: 2px solid transparent;
    background-clip: padding-box;
    overflow: hidden;
    max-width: 450px;
    width: 100%;
    position: relative;
    z-index: 10;
}

.register-header {
    background: linear-gradient(135deg, #dc143c 0%, #000000 100%);
    color: white;
    padding: 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.register-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(45deg, transparent 30%, rgba(220, 20, 60, 0.1) 50%, transparent 70%),
        radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    animation: deadpoolGlow 6s ease-in-out infinite;
}

@keyframes deadpoolGlow {
    0%, 100% { opacity: 1; transform: translateX(0); }
    50% { opacity: 0.8; transform: translateX(10px); }
}

.register-header h4 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    letter-spacing: 1px;
}

.register-header .subtitle {
    margin-top: 0.5rem;
    opacity: 0.9;
    font-size: 0.95rem;
    position: relative;
    z-index: 1;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
}

.register-body {
    padding: 2.5rem;
    background: rgba(20, 20, 20, 0.8);
    color: white;
}

.register-body input,
.register-body input[type="text"],
.register-body input[type="email"],
.register-body input[type="password"] {
    color: #ffffff !important;
    background: rgba(40, 40, 40, 0.9) !important;
}

.register-body input:focus,
.register-body input[type="text"]:focus,
.register-body input[type="email"]:focus,
.register-body input[type="password"]:focus {
    color: #ffffff !important;
    background: rgba(60, 60, 60, 0.95) !important;
}

.form-floating {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-floating input {
    border: 2px solid #333333;
    border-radius: 12px;
    padding: 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(40, 40, 40, 0.9);
    color: #ffffff !important;
}

.form-floating input::placeholder {
    color: #888888 !important;
    opacity: 1;
}

.form-floating input::-webkit-input-placeholder {
    color: #888888 !important;
}

.form-floating input::-moz-placeholder {
    color: #888888 !important;
    opacity: 1;
}

.form-floating input:-ms-input-placeholder {
    color: #888888 !important;
}

.form-floating input:-moz-placeholder {
    color: #888888 !important;
    opacity: 1;
}

.form-floating input:focus {
    border-color: #dc143c;
    box-shadow: 
        0 0 0 0.2rem rgba(220, 20, 60, 0.4),
        0 0 15px rgba(220, 20, 60, 0.3),
        inset 0 0 5px rgba(0, 0, 0, 0.5);
    background: rgba(60, 60, 60, 0.95);
    outline: none;
    color: #ffffff !important;
}

.form-floating input:autofill,
.form-floating input:-webkit-autofill,
.form-floating input:-webkit-autofill:hover,
.form-floating input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px rgba(60, 60, 60, 0.95) inset !important;
    -webkit-text-fill-color: #ffffff !important;
    color: #ffffff !important;
}

.form-floating label {
    position: absolute;
    top: 1rem;
    left: 1rem;
    font-size: 1rem;
    color: #cccccc;
    transition: all 0.3s ease;
    pointer-events: none;
    background: transparent;
    transform-origin: 0 0;
    opacity: 0.7;
}

.form-floating input:focus + label,
.form-floating input:not(:placeholder-shown) + label {
    top: -0.5rem;
    left: 0.75rem;
    font-size: 0.75rem;
    color: #dc143c;
    background: rgba(20, 20, 20, 0.9);
    padding: 0.2rem 0.5rem;
    font-weight: 600;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    opacity: 1;
    transform: scale(0.85);
}

.form-floating input {
    border: 2px solid #333333;
    border-radius: 12px;
    padding: 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(40, 40, 40, 0.9);
    color: #ffffff !important;
}

.form-floating input::placeholder {
    color: transparent !important;
    opacity: 0;
}

.password-toggle-container {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #cccccc;
    cursor: pointer;
    padding: 0;
    z-index: 10;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #dc143c;
}

.register-btn {
    background: linear-gradient(135deg, #dc143c 0%, #8b0000 100%);
    border: none;
    border-radius: 12px;
    padding: 0.875rem 2rem;
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
    width: 100%;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    box-shadow: 
        0 6px 20px rgba(220, 20, 60, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.register-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.register-btn:hover::before {
    left: 100%;
}

.register-btn:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 20px 40px rgba(220, 20, 60, 0.5),
        0 8px 25px rgba(0, 0, 0, 0.6),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    background: linear-gradient(135deg, #ff1744 0%, #b71c1c 100%);
}

.login-links {
    text-align: center;
    margin-top: 1.5rem;
}

.login-links a {
    color: #dc143c;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.login-links a:hover {
    color: #ff1744;
    text-decoration: underline;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.login-links p {
    color: #cccccc;
    margin: 0.5rem 0;
}

.error-message {
    background: linear-gradient(135deg, rgba(220, 20, 60, 0.2) 0%, rgba(139, 0, 0, 0.3) 100%);
    border: 2px solid #dc143c;
    color: #ffcccc;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    font-weight: 500;
    box-shadow: 
        0 4px 15px rgba(220, 20, 60, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
}
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h4>Create Account</h4>
            <p class="subtitle">Join us as a user</p>
        </div>
        
        <div class="register-body">
            <form method="POST" action="{{ route('register.user') }}">
                @csrf

                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <div class="form-floating">
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name') }}" required placeholder=" ">
                    <label for="name">Full Name</label>
                </div>

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

                <div class="form-floating password-toggle-container">
                    <input type="password" class="form-control" id="password_confirmation" 
                           name="password_confirmation" required placeholder=" ">
                    <label for="password_confirmation">Confirm Password</label>
                    <button type="button" class="password-toggle" id="togglePasswordConfirm">
                        <i class="fa fa-eye" id="togglePasswordConfirmIcon"></i>
                    </button>
                </div>

                <button type="submit" class="register-btn">
                    Create User Account
                </button>
            </form>

            <div class="login-links">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
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

// Toggle password confirmation visibility
document.getElementById('togglePasswordConfirm').addEventListener('click', function (e) {
    const passwordConfirm = document.getElementById('password_confirmation');
    const icon = document.getElementById('togglePasswordConfirmIcon');
    
    if (passwordConfirm.type === 'password') {
        passwordConfirm.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordConfirm.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>
@endsection