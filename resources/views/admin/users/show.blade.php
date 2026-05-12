@extends('layouts.app')

@section('title', 'User Details - ' . $user->name)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>User Details</h1>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users List</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ $user->name }} 
                    @if($user->role === 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-primary">User</span>
                    @endif
                    @if($user->id === auth()->id())
                        <span class="badge bg-info">You</span>
                    @endif
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>User ID:</strong></div>
                    <div class="col-sm-9">{{ $user->id }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Full Name:</strong></div>
                    <div class="col-sm-9">{{ $user->name }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Email:</strong></div>
                    <div class="col-sm-9">{{ $user->email }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Role:</strong></div>
                    <div class="col-sm-9">
                        @if($user->role === 'admin')
                            <span class="badge bg-danger">Administrator</span>
                        @else
                            <span class="badge bg-primary">Regular User</span>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Email Status:</strong></div>
                    <div class="col-sm-9">
                        @if($user->email_verified_at)
                            <span class="badge bg-success">Verified</span>
                            <small class="text-muted d-block">Verified on {{ $user->email_verified_at->format('F d, Y \a\t h:i A') }}</small>
                        @else
                            <span class="badge bg-warning">Not Verified</span>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Registered:</strong></div>
                    <div class="col-sm-9">
                        {{ $user->created_at->format('F d, Y \a\t h:i A') }}
                        <small class="text-muted d-block">{{ $user->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Last Updated:</strong></div>
                    <div class="col-sm-9">
                        {{ $user->updated_at->format('F d, Y \a\t h:i A') }}
                        <small class="text-muted d-block">{{ $user->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                @if($user->id !== auth()->id())
                    <div class="d-grid gap-2">
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" 
                                    onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                <i class="fa fa-trash"></i> Delete User
                            </button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> You cannot delete your own account.
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Account Summary</h5>
            </div>
            <div class="card-body">
                <p class="mb-1"><strong>Member since:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                <p class="mb-1"><strong>Last updated:</strong> {{ $user->updated_at->diffForHumans() }}</p>
                <p class="mb-0"><strong>Status:</strong>
                    @if($user->email_verified_at)
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-warning text-dark">Unverified</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection