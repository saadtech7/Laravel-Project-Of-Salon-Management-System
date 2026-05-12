@extends('layouts.app')

@section('title', 'All Users - Admin Panel')

@section('content')
<style>
.users-container {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 2rem 0;
}

.users-header {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 50%, #1f2937 100%);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.3),
        0 0 40px rgba(22, 101, 52, 0.4),
        inset 0 0 20px rgba(251, 191, 36, 0.2);
    position: relative;
    overflow: hidden;
}

.users-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(45deg, transparent 30%, rgba(22, 101, 52, 0.3) 50%, transparent 70%),
        radial-gradient(circle at 80% 20%, rgba(251, 191, 36, 0.4) 0%, transparent 50%),
        linear-gradient(90deg, transparent 0%, rgba(31, 41, 55, 0.2) 50%, transparent 100%);
    animation: lokiMagic 15s ease-in-out infinite;
}

@keyframes lokiMagic {
    0%, 100% { 
        opacity: 0.6; 
        transform: translateX(0) rotateZ(0deg);
    }
    25% { 
        opacity: 1; 
        transform: translateX(2px) rotateZ(0.5deg);
    }
    50% { 
        opacity: 0.8; 
        transform: translateX(-1px) rotateZ(-0.3deg);
    }
    75% { 
        opacity: 1; 
        transform: translateX(1px) rotateZ(0.2deg);
    }
}

.users-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    position: relative;
    z-index: 1;
    text-shadow: 
        3px 3px 6px rgba(0, 0, 0, 0.8),
        0 0 20px rgba(22, 101, 52, 0.8),
        0 0 30px rgba(251, 191, 36, 0.6);
    letter-spacing: 2px;
}

.users-header .lead {
    font-size: 1.2rem;
    opacity: 0.95;
    margin: 0.5rem 0 0 0;
    position: relative;
    z-index: 1;
    text-shadow: 
        2px 2px 4px rgba(0, 0, 0, 0.6),
        0 0 15px rgba(251, 191, 36, 0.6);
}

.back-btn {
    background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
    color: #166534;
    border: 2px solid #166534;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 
        0 4px 15px rgba(22, 101, 52, 0.2),
        inset 0 0 10px rgba(251, 191, 36, 0.1);
    text-shadow: 0 0 10px rgba(22, 101, 52, 0.3);
}

.back-btn:hover {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 
        0 8px 25px rgba(22, 101, 52, 0.4),
        0 0 20px rgba(251, 191, 36, 0.3);
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.users-card {
    background: white;
    border-radius: 15px;
    box-shadow: 
        0 5px 15px rgba(0, 0, 0, 0.08),
        0 0 20px rgba(22, 101, 52, 0.1);
    border: none;
    overflow: hidden;
    transition: all 0.3s ease;
}

.users-card:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 15px 35px rgba(0, 0, 0, 0.15),
        0 0 30px rgba(251, 191, 36, 0.2);
}

.users-card .card-header {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    color: white;
    border: none;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
}

.users-card .card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 30% 70%, rgba(22, 101, 52, 0.4) 0%, transparent 50%),
        linear-gradient(45deg, transparent 30%, rgba(31, 41, 55, 0.2) 50%, transparent 70%);
    animation: scepterGlow 8s ease-in-out infinite;
}

@keyframes scepterGlow {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.7; }
}

.users-card .card-header h5 {
    margin: 0;
    font-weight: 600;
    font-size: 1.2rem;
    position: relative;
    z-index: 1;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.users-card .card-body {
    padding: 1.5rem;
}

.users-table {
    margin: 0;
}

.users-table th {
    border: none;
    background: linear-gradient(135deg, #dcfce7 0%, #fef3c7 100%);
    color: #14532d;
    font-weight: 600;
    padding: 1rem;
    font-size: 0.9rem;
    text-shadow: 0 0 5px rgba(22, 101, 52, 0.3);
}

.users-table td {
    border: none;
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #dcfce7;
}

.users-table tr:hover {
    background: linear-gradient(135deg, #f0fdf4 0%, #fffbeb 100%);
    box-shadow: inset 0 0 15px rgba(22, 101, 52, 0.1);
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    margin-right: 0.75rem;
    box-shadow: 
        0 4px 15px rgba(22, 101, 52, 0.4),
        inset 0 0 10px rgba(251, 191, 36, 0.3);
    border: 2px solid #1f2937;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.badge-role {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.badge-admin {
    background: linear-gradient(135deg, #166534 0%, #92400e 100%);
    color: #fbbf24;
    box-shadow: 
        0 4px 15px rgba(22, 101, 52, 0.4),
        inset 0 0 10px rgba(146, 64, 14, 0.3);
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    border: 1px solid #fbbf24;
}

.badge-user {
    background: linear-gradient(135deg, #fbbf24 0%, #1f2937 100%);
    color: white;
    box-shadow: 
        0 4px 15px rgba(251, 191, 36, 0.4),
        inset 0 0 10px rgba(31, 41, 55, 0.3);
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
}

.badge-verified {
    background: linear-gradient(135deg, #1f2937 0%, #166534 100%);
    color: #fbbf24;
    box-shadow: 0 2px 8px rgba(31, 41, 55, 0.3);
    text-shadow: none;
    padding: 0.25rem 0.6rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
    white-space: nowrap;
    border: 1px solid #fbbf24;
}

.badge-unverified {
    background: linear-gradient(135deg, #f59e0b 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    text-shadow: none;
    padding: 0.25rem 0.6rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
    white-space: nowrap;
}

.badge-you {
    background: linear-gradient(135deg, #7c3aed 0%, #166534 100%);
    color: #fbbf24;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    border: 1px solid #fbbf24;
}

.action-btn {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    border: none;
    transition: all 0.3s ease;
    margin: 0 0.25rem;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.4), transparent);
    transition: left 0.5s ease;
}

.action-btn:hover::before {
    left: 100%;
}

.action-btn.view {
    background: linear-gradient(135deg, #dcfce7 0%, #fef3c7 100%);
    color: #166534;
    border: 2px solid #166534;
    font-weight: 600;
    box-shadow: 
        0 4px 15px rgba(22, 101, 52, 0.2),
        inset 0 0 10px rgba(251, 191, 36, 0.1);
}

.action-btn.view:hover {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 
        0 8px 25px rgba(22, 101, 52, 0.4),
        0 0 20px rgba(251, 191, 36, 0.3);
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
}

.action-btn.delete {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #dc2626;
    border: 2px solid #dc2626;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(220, 38, 38, 0.2);
}

.action-btn.delete:hover {
    background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 
        0 8px 25px rgba(220, 38, 38, 0.4),
        0 0 20px rgba(153, 27, 27, 0.3);
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
}

.stats-card {
    background: white;
    border-radius: 15px;
    box-shadow: 
        0 5px 15px rgba(0, 0, 0, 0.08),
        0 0 20px rgba(22, 101, 52, 0.1);
    border: none;
    overflow: hidden;
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 15px 35px rgba(0, 0, 0, 0.15),
        0 0 30px rgba(251, 191, 36, 0.2);
}

.stats-card .card-header {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    color: white;
    border: none;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
}

.stats-card .card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 60% 40%, rgba(22, 101, 52, 0.4) 0%, transparent 50%),
        linear-gradient(45deg, transparent 30%, rgba(31, 41, 55, 0.2) 50%, transparent 70%);
    animation: illusionMagic 10s ease-in-out infinite;
}

@keyframes illusionMagic {
    0%, 100% { opacity: 0.4; }
    50% { opacity: 0.8; }
}

.stats-card .card-header h5 {
    margin: 0;
    font-weight: 600;
    position: relative;
    z-index: 1;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.stats-card .card-body {
    padding: 1.5rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    border-radius: 10px;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 50% 50%, rgba(251, 191, 36, 0.1) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-item:hover::before {
    opacity: 1;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 
        0 15px 35px rgba(0, 0, 0, 0.15),
        0 0 25px rgba(22, 101, 52, 0.3);
}

.stat-item.total {
    background: linear-gradient(135deg, #dcfce7 0%, #fef3c7 100%);
    border: 2px solid #166534;
    box-shadow: 
        0 4px 15px rgba(22, 101, 52, 0.2),
        inset 0 0 15px rgba(251, 191, 36, 0.1);
}

.stat-item.admins {
    background: linear-gradient(135deg, #fef3c7 0%, #f3e8ff 100%);
    border: 2px solid #fbbf24;
    box-shadow: 
        0 4px 15px rgba(251, 191, 36, 0.2),
        inset 0 0 15px rgba(124, 58, 237, 0.1);
}

.stat-item.users {
    background: linear-gradient(135deg, #f3f4f6 0%, #dcfce7 100%);
    border: 2px solid #1f2937;
    box-shadow: 
        0 4px 15px rgba(31, 41, 55, 0.2),
        inset 0 0 15px rgba(22, 101, 52, 0.1);
}

.stat-item.verified {
    background: linear-gradient(135deg, #1f2937 0%, #fef3c7 100%);
    border: 2px solid #166534;
    box-shadow: 
        0 4px 15px rgba(31, 41, 55, 0.2),
        inset 0 0 15px rgba(251, 191, 36, 0.1);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 1;
}

.stat-number.total {
    color: #166534;
    text-shadow: 
        2px 2px 4px rgba(0, 0, 0, 0.3),
        0 0 15px rgba(22, 101, 52, 0.6);
}

.stat-number.admins {
    color: #fbbf24;
    text-shadow: 
        2px 2px 4px rgba(0, 0, 0, 0.3),
        0 0 15px rgba(251, 191, 36, 0.6);
}

.stat-number.users {
    color: #1f2937;
    text-shadow: 
        2px 2px 4px rgba(0, 0, 0, 0.3),
        0 0 15px rgba(31, 41, 55, 0.6);
}

.stat-number.verified {
    color: #166534;
    text-shadow: 
        2px 2px 4px rgba(0, 0, 0, 0.3),
        0 0 15px rgba(22, 101, 52, 0.6);
}

.stat-label {
    color: #374151;
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0.5rem 0 0 0;
    position: relative;
    z-index: 1;
    text-shadow: 0 0 5px rgba(22, 101, 52, 0.2);
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: #6c757d;
}

.empty-state i {
    font-size: 4rem;
    color: #166534;
    margin-bottom: 1rem;
    opacity: 0.7;
    text-shadow: 0 0 20px rgba(22, 101, 52, 0.4);
}

@media (max-width: 768px) {
    .users-header {
        padding: 1.5rem;
        text-align: center;
    }
    
    .users-header h1 {
        font-size: 2rem;
    }
    
    .stat-item {
        margin-bottom: 1rem;
    }
}
</style>
<div class="users-container">
    <div class="container">
        <!-- Users Header -->
        <div class="users-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-users me-3"></i>All Users</h1>
                    <p class="lead">Manage and monitor all registered users in the system</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Users Table -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="users-card">
                    <div class="card-header">
                        <h5><i class="fas fa-database me-2"></i>User Database ({{ $users->count() }} users)</h5>
                    </div>
                    <div class="card-body">
                        @if($users->count() > 0)
                            <div class="table-responsive">
                                <table class="table users-table">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                            <th><i class="fas fa-user me-1"></i>Name</th>
                                            <th><i class="fas fa-envelope me-1"></i>Email</th>
                                            <th><i class="fas fa-user-tag me-1"></i>Role</th>
                                            <th><i class="fas fa-check-circle me-1"></i>Status</th>
                                            <th><i class="fas fa-calendar me-1"></i>Registered</th>
                                            <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td><strong>{{ $user->id }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <strong>{{ $user->name }}</strong>
                                                        @if($user->id === auth()->id())
                                                            <span class="badge-role badge-you ms-1">You</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role === 'admin')
                                                    <span class="badge-role badge-admin">Administrator</span>
                                                @else
                                                    <span class="badge-role badge-user">User</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->email_verified_at)
                                                    <span class="badge-verified">Verified</span>
                                                    <small class="d-block text-muted">{{ $user->email_verified_at->format('M d, Y') }}</small>
                                                @else
                                                    <span class="badge-unverified">Not Verified</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>{{ $user->created_at->format('M d, Y') }}</div>
                                                <small class="text-muted">{{ $user->created_at->format('h:i A') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.users.show', $user) }}" class="action-btn view">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </a>
                                                    @if($user->id !== auth()->id())
                                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="action-btn delete" 
                                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                                <i class="fas fa-trash me-1"></i>Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h4>No Users Found</h4>
                                <p>No users are registered in the database yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- User Statistics -->
        <div class="row">
            <div class="col-12">
                <div class="stats-card">
                    <div class="card-header">
                        <h5><i class="fas fa-chart-bar me-2"></i>User Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="stat-item total">
                                    <h3 class="stat-number total">{{ $users->count() }}</h3>
                                    <p class="stat-label">Total Users</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item admins">
                                    <h3 class="stat-number admins">{{ $users->where('role', 'admin')->count() }}</h3>
                                    <p class="stat-label">Administrators</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item users">
                                    <h3 class="stat-number users">{{ $users->where('role', 'user')->count() }}</h3>
                                    <p class="stat-label">Regular Users</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item verified">
                                    <h3 class="stat-number verified">{{ $users->whereNotNull('email_verified_at')->count() }}</h3>
                                    <p class="stat-label">Verified Emails</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection