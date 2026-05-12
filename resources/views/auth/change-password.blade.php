@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h4><i class="fas fa-key me-2"></i>Change Password</h4>
            <p class="subtitle">Update your account password</p>
        </div>
        
        <div class="register-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <div class="form-floating password-toggle-container">
                    <input type="password" class="form-control" id="current_password" 
                           name="current_password" required placeholder=" ">
                    <label for="current_password">Current Password</label>
                    <button type="button" class="password-toggle" onclick="togglePassword('current_password', 'currentIcon')">
                        <i class="fa fa-eye" id="currentIcon"></i>
                    </button>
                </div>

                <div class="form-floating password-toggle-container">
                    <input type="password" class="form-control" id="new_password" 
                           name="new_password" required placeholder=" ">
                    <label for="new_password">New Password</label>
                    <button type="button" class="password-toggle" onclick="togglePassword('new_password', 'newIcon')">
                        <i class="fa fa-eye" id="newIcon"></i>
                    </button>
                </div>

                <div class="form-floating password-toggle-container">
                    <input type="password" class="form-control" id="new_password_confirmation" 
                           name="new_password_confirmation" required placeholder=" ">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <button type="button" class="password-toggle" onclick="togglePassword('new_password_confirmation', 'confirmIcon')">
                        <i class="fa fa-eye" id="confirmIcon"></i>
                    </button>
                </div>

                <button type="submit" class="register-btn">
                    <i class="fas fa-check me-2"></i>Update Password
                </button>

                <div class="text-center mt-3">
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="text-decoration-none" style="color: #dc143c;">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection
