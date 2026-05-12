@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
.dashboard-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}
.dashboard-header {
    background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #dc2626 100%);
    color: white;
    padding: 2.5rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    position: relative;
    overflow: hidden;
}
.dashboard-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 80%, rgba(124,58,237,0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(220,38,38,0.3) 0%, transparent 50%);
}
.dashboard-header h1 {
    font-size: 2.5rem;
    font-weight: 900;
    margin: 0;
    position: relative;
    z-index: 1;
    letter-spacing: 2px;
}
.dashboard-header .lead {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0.75rem 0 0;
    position: relative;
    z-index: 1;
}
/* Stat Cards */
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}
.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
    margin-bottom: 1rem;
}
.stat-icon.blue   { background: linear-gradient(135deg, #1e40af, #3b82f6); }
.stat-icon.purple { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
.stat-icon.green  { background: linear-gradient(135deg, #059669, #34d399); }
.stat-icon.orange { background: linear-gradient(135deg, #d97706, #fbbf24); }
.stat-icon.red    { background: linear-gradient(135deg, #dc2626, #f87171); }
.stat-icon.teal   { background: linear-gradient(135deg, #0891b2, #22d3ee); }
.stat-icon.indigo { background: linear-gradient(135deg, #4338ca, #818cf8); }
.stat-icon.pink   { background: linear-gradient(135deg, #be185d, #f472b6); }
.stat-number { font-size: 2rem; font-weight: 700; color: #1e293b; margin: 0; }
.stat-label  { color: #64748b; font-size: 0.9rem; font-weight: 500; margin: 0.25rem 0 0; }
.stat-sub    { font-size: 0.8rem; color: #94a3b8; margin: 0.25rem 0 0; }
/* Content Cards */
.content-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: none;
    overflow: hidden;
}
.content-card .card-header {
    background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%);
    color: white;
    padding: 1.25rem 1.5rem;
    border: none;
}
.content-card .card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
.content-card .card-body { padding: 0; }
/* Tables */
.dash-table th {
    background: #f8fafc;
    color: #475569;
    font-weight: 600;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 0.875rem 1rem;
    border: none;
}
.dash-table td {
    padding: 0.875rem 1rem;
    vertical-align: middle;
    border: none;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.9rem;
}
.dash-table tr:last-child td { border-bottom: none; }
.dash-table tr:hover td { background: #f8fafc; }
/* Avatars */
.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af, #7c3aed);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.85rem;
    flex-shrink: 0;
}
/* Badges */
.status-badge {
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    display: inline-block;
}
.status-pending   { background: #fef3c7; color: #92400e; }
.status-confirmed { background: #d1fae5; color: #065f46; }
.status-cancelled { background: #fee2e2; color: #991b1b; }
.status-completed { background: #dbeafe; color: #1e40af; }
.role-admin { background: linear-gradient(135deg,#fbbf24,#92400e); color: white; }
.role-user  { background: linear-gradient(135deg,#1e40af,#6b7280); color: white; }
/* Action buttons */
.btn-action {
    padding: 0.35rem 0.75rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    border: none;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}
.btn-action.view   { background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; }
.btn-action.view:hover { background: #1e40af; color: white; }
.btn-action.delete { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.btn-action.delete:hover { background: #dc2626; color: white; }
/* Quick actions */
.quick-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.2s;
    margin-bottom: 0.5rem;
    border: 1px solid transparent;
}
.quick-btn:last-child { margin-bottom: 0; }
.quick-btn .q-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}
.quick-btn.users  { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }
.quick-btn.users:hover  { background: #1e40af; color: white; }
.quick-btn.users .q-icon  { background: #dbeafe; color: #1e40af; }
.quick-btn.users:hover .q-icon  { background: rgba(255,255,255,0.2); color: white; }
.quick-btn.bookings { background: #f0fdf4; color: #065f46; border-color: #bbf7d0; }
.quick-btn.bookings:hover { background: #059669; color: white; }
.quick-btn.bookings .q-icon { background: #dcfce7; color: #059669; }
.quick-btn.bookings:hover .q-icon { background: rgba(255,255,255,0.2); color: white; }
.quick-btn.services { background: #fdf4ff; color: #7c3aed; border-color: #e9d5ff; }
.quick-btn.services:hover { background: #7c3aed; color: white; }
.quick-btn.services .q-icon { background: #f3e8ff; color: #7c3aed; }
.quick-btn.services:hover .q-icon { background: rgba(255,255,255,0.2); color: white; }
.quick-btn.posts { background: #fff7ed; color: #c2410c; border-color: #fed7aa; }
.quick-btn.posts:hover { background: #c2410c; color: white; }
.quick-btn.posts .q-icon { background: #ffedd5; color: #c2410c; }
.quick-btn.posts:hover .q-icon { background: rgba(255,255,255,0.2); color: white; }
/* Booking status summary */
.booking-status-row {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}
.booking-status-pill {
    flex: 1;
    min-width: 80px;
    text-align: center;
    padding: 0.75rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
}
.booking-status-pill .pill-num { font-size: 1.4rem; font-weight: 700; display: block; }
</style>

<div class="dashboard-container">
    <div class="container">

        <!-- Header -->
        <div class="dashboard-header mb-4">
            <h1><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</h1>
            <p class="lead">Welcome back, {{ auth()->user()->name }}! Here's your business overview.</p>
        </div>

        <!-- Stats Row 1: Users & Bookings -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-users"></i></div>
                    <p class="stat-number">{{ $totalUsers }}</p>
                    <p class="stat-label">Regular Users</p>
                    <p class="stat-sub"><i class="fas fa-user-shield me-1"></i>{{ $totalAdmins }} admin(s)</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-calendar-check"></i></div>
                    <p class="stat-number">{{ $totalBookings }}</p>
                    <p class="stat-label">Total Bookings</p>
                    <p class="stat-sub"><i class="fas fa-clock me-1"></i>{{ $todayBookings }} today</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-hourglass-half"></i></div>
                    <p class="stat-number">{{ $pendingBookings }}</p>
                    <p class="stat-label">Pending Bookings</p>
                    <p class="stat-sub"><i class="fas fa-check-circle me-1"></i>{{ $confirmedBookings }} confirmed</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon purple"><i class="fas fa-cut"></i></div>
                    <p class="stat-number">{{ $totalServices }}</p>
                    <p class="stat-label">Active Services</p>
                    <p class="stat-sub"><i class="fas fa-calendar-week me-1"></i>{{ $weeklyBookings }} bookings this week</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Recent Bookings -->
            <div class="col-lg-8">
                <div class="content-card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-calendar-alt me-2"></i>Recent Bookings</h5>
                        <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-light text-primary fw-semibold">View All</a>
                    </div>
                    <!-- Status summary pills -->
                    <div class="booking-status-row">
                        <div class="booking-status-pill status-pending">
                            <span class="pill-num">{{ $bookingsByStatus['pending'] }}</span>Pending
                        </div>
                        <div class="booking-status-pill status-confirmed">
                            <span class="pill-num">{{ $bookingsByStatus['confirmed'] }}</span>Confirmed
                        </div>
                        <div class="booking-status-pill status-completed">
                            <span class="pill-num">{{ $bookingsByStatus['completed'] }}</span>Completed
                        </div>
                        <div class="booking-status-pill status-cancelled">
                            <span class="pill-num">{{ $bookingsByStatus['cancelled'] }}</span>Cancelled
                        </div>
                    </div>
                    <div class="card-body">
                        @if($recentBookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table dash-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="user-avatar">{{ strtoupper(substr($booking->user->name ?? 'U', 0, 1)) }}</div>
                                                <div>
                                                    <div class="fw-semibold">{{ $booking->user->name ?? 'N/A' }}</div>
                                                    <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $booking->service->name ?? 'N/A' }}</div>
                                            @if($booking->service)
                                            <small class="text-muted">${{ number_format($booking->service->price, 2) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ $booking->booking_time }}</small>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $booking->status }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bookings') }}" class="btn-action view">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3 d-block"></i>
                            No bookings yet.
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="content-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-users me-2"></i>Recent Users</h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light text-primary fw-semibold">View All</a>
                    </div>
                    <div class="card-body">
                        @if($recentUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table dash-table mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                                <div>
                                                    <div class="fw-semibold">{{ $user->name }}</div>
                                                    <small class="text-muted">{{ $user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                                        </td>
                                        <td>
                                            <div>{{ $user->created_at->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn-action view me-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action delete"
                                                    onclick="return confirm('Delete {{ $user->name }}?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-users fa-3x mb-3 d-block"></i>
                            No users registered yet.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="content-card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body p-3">
                        <a href="{{ route('admin.users.index') }}" class="quick-btn users">
                            <div class="q-icon"><i class="fas fa-users"></i></div>
                            <div>
                                <div class="fw-semibold">Manage Users</div>
                                <small>{{ $totalUsers }} registered users</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.bookings') }}" class="quick-btn bookings">
                            <div class="q-icon"><i class="fas fa-calendar-check"></i></div>
                            <div>
                                <div class="fw-semibold">All Bookings</div>
                                <small>{{ $pendingBookings }} pending review</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="quick-btn services">
                            <div class="q-icon"><i class="fas fa-cut"></i></div>
                            <div>
                                <div class="fw-semibold">Services</div>
                                <small>{{ $totalServices }} services available</small>
                            </div>
                        </a>
                        <a href="{{ route('posts.index') }}" class="quick-btn posts">
                            <div class="q-icon"><i class="fas fa-newspaper"></i></div>
                            <div>
                                <div class="fw-semibold">Posts</div>
                                <small>{{ $totalPosts }} total posts</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.contacts.index') }}" class="quick-btn" style="background:#f0fdf4;color:#065f46;border:1px solid #bbf7d0">
                            <div class="q-icon" style="background:#dcfce7;color:#059669"><i class="fas fa-envelope"></i></div>
                            <div>
                                <div class="fw-semibold">Contact Messages</div>
                                <small>{{ \App\Models\Contact::where('is_read',false)->count() }} unread</small>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Booking Status Breakdown -->
                <div class="content-card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-chart-pie me-2"></i>Booking Overview</h5>
                    </div>
                    <div class="card-body p-3">
                        @php
                            $total = max($totalBookings, 1);
                        @endphp
                        @foreach([
                            ['label' => 'Pending',   'key' => 'pending',   'color' => '#f59e0b', 'bg' => '#fef3c7'],
                            ['label' => 'Confirmed', 'key' => 'confirmed', 'color' => '#059669', 'bg' => '#d1fae5'],
                            ['label' => 'Completed', 'key' => 'completed', 'color' => '#1e40af', 'bg' => '#dbeafe'],
                            ['label' => 'Cancelled', 'key' => 'cancelled', 'color' => '#dc2626', 'bg' => '#fee2e2'],
                        ] as $item)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold" style="font-size:0.85rem">{{ $item['label'] }}</span>
                                <span style="font-size:0.85rem;color:#64748b">{{ $bookingsByStatus[$item['key']] }}</span>
                            </div>
                            <div style="background:#f1f5f9;border-radius:8px;height:8px;overflow:hidden">
                                <div style="width:{{ round($bookingsByStatus[$item['key']] / $total * 100) }}%;background:{{ $item['color'] }};height:100%;border-radius:8px;transition:width 0.5s"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Account -->
                <div class="content-card">
                    <div class="card-header">
                        <h5><i class="fas fa-user-cog me-2"></i>Account</h5>
                    </div>
                    <div class="card-body p-3">
                        <a href="{{ route('password.change') }}" class="quick-btn posts" style="background:#f8fafc;color:#475569;border-color:#e2e8f0">
                            <div class="q-icon" style="background:#e2e8f0;color:#475569"><i class="fas fa-key"></i></div>
                            <div><div class="fw-semibold">Change Password</div></div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="quick-btn w-100 text-start" style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;cursor:pointer">
                                <div class="q-icon" style="background:#fee2e2;color:#dc2626"><i class="fas fa-sign-out-alt"></i></div>
                                <div><div class="fw-semibold">Logout</div></div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
