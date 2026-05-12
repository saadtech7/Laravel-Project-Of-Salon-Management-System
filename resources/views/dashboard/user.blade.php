@extends('layouts.app')
@section('title', 'My Dashboard')
@section('content')
<style>
.dashboard-container { background: #f8fafc; min-height: 100vh; padding: 2rem 0; }
.dashboard-header {
    background: linear-gradient(135deg, #dc2626 0%, #1e40af 100%);
    color: white; padding: 2rem 2.5rem; border-radius: 20px;
    margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    position: relative; overflow: hidden;
}
.dashboard-header::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(30,64,175,0.3) 0%, transparent 50%);
}
.dashboard-header h1 { font-size: 2rem; font-weight: 800; margin: 0; position: relative; z-index: 1; }
.dashboard-header .lead { font-size: 1rem; opacity: 0.9; margin: 0.5rem 0 0; position: relative; z-index: 1; }
.stat-card {
    background: white; border-radius: 16px; padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    transition: transform 0.3s, box-shadow 0.3s; height: 100%;
}
.stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
.stat-icon {
    width: 48px; height: 48px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; color: white; margin-bottom: 1rem;
}
.stat-icon.red    { background: linear-gradient(135deg, #dc2626, #f87171); }
.stat-icon.blue   { background: linear-gradient(135deg, #1e40af, #3b82f6); }
.stat-icon.green  { background: linear-gradient(135deg, #059669, #34d399); }
.stat-icon.orange { background: linear-gradient(135deg, #d97706, #fbbf24); }
.stat-number { font-size: 1.8rem; font-weight: 700; color: #1e293b; margin: 0; }
.stat-label  { color: #64748b; font-size: 0.88rem; font-weight: 500; margin: 0.2rem 0 0; }
.content-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.07); overflow: hidden; }
.content-card .card-header {
    background: linear-gradient(135deg, #dc2626 0%, #1e40af 100%);
    color: white; padding: 1.25rem 1.5rem; border: none;
}
.content-card .card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
.profile-avatar {
    width: 72px; height: 72px; border-radius: 50%;
    background: linear-gradient(135deg, #dc2626, #1e40af);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.8rem; font-weight: 700; color: white;
    border: 3px solid white; box-shadow: 0 4px 15px rgba(220,38,38,0.4);
}
.profile-item {
    display: flex; justify-content: space-between; align-items: center;
    padding: 0.75rem 1.5rem; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem;
}
.profile-item:last-child { border-bottom: none; }
.profile-label { font-weight: 600; color: #475569; }
.profile-value { color: #64748b; }
.dash-table th {
    background: #f8fafc; color: #475569; font-weight: 600;
    font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;
    padding: 0.875rem 1rem; border: none;
}
.dash-table td {
    padding: 0.875rem 1rem; vertical-align: middle;
    border: none; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem;
}
.dash-table tr:last-child td { border-bottom: none; }
.dash-table tr:hover td { background: #f8fafc; }
.status-badge { padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.78rem; font-weight: 600; display: inline-block; }
.status-pending   { background: #fef3c7; color: #92400e; }
.status-confirmed { background: #d1fae5; color: #065f46; }
.status-cancelled { background: #fee2e2; color: #991b1b; }
.status-completed { background: #dbeafe; color: #1e40af; }
.action-btn {
    display: flex; align-items: center; gap: 0.75rem;
    width: 100%; padding: 0.875rem 1rem; border-radius: 12px;
    text-decoration: none; font-weight: 500; font-size: 0.9rem;
    transition: all 0.2s; margin-bottom: 0.5rem;
    border: 1px solid transparent; text-align: left;
}
.action-btn:last-child { margin-bottom: 0; }
.action-btn .a-icon {
    width: 34px; height: 34px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem; flex-shrink: 0;
}
.action-btn.book { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.action-btn.book:hover { background: #dc2626; color: white; }
.action-btn.book .a-icon { background: #fee2e2; color: #dc2626; }
.action-btn.book:hover .a-icon { background: rgba(255,255,255,0.2); color: white; }
.action-btn.mybookings { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }
.action-btn.mybookings:hover { background: #1e40af; color: white; }
.action-btn.mybookings .a-icon { background: #dbeafe; color: #1e40af; }
.action-btn.mybookings:hover .a-icon { background: rgba(255,255,255,0.2); color: white; }
.action-btn.posts { background: #f0fdf4; color: #065f46; border-color: #bbf7d0; }
.action-btn.posts:hover { background: #059669; color: white; }
.action-btn.posts .a-icon { background: #dcfce7; color: #059669; }
.action-btn.posts:hover .a-icon { background: rgba(255,255,255,0.2); color: white; }
.action-btn.password { background: #f8fafc; color: #475569; border-color: #e2e8f0; }
.action-btn.password:hover { background: #475569; color: white; }
.action-btn.password .a-icon { background: #e2e8f0; color: #475569; }
.action-btn.password:hover .a-icon { background: rgba(255,255,255,0.2); color: white; }
.upcoming-card {
    background: linear-gradient(135deg, #fef3c7 0%, #dbeafe 100%);
    border: 1px solid #fbbf24; border-radius: 14px;
    padding: 1.25rem 1.5rem; margin-bottom: 1.5rem;
}
</style>

<div class="dashboard-container">
    <div class="container">

        <div class="dashboard-header mb-4">
            <h1><i class="fas fa-home me-2"></i>My Dashboard</h1>
            <p class="lead">Welcome back, {{ auth()->user()->name }}! Manage your bookings and account.</p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-calendar-alt"></i></div>
                    <p class="stat-number">{{ $totalMyBookings }}</p>
                    <p class="stat-label">Total Bookings</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-hourglass-half"></i></div>
                    <p class="stat-number">{{ $pendingMyBookings }}</p>
                    <p class="stat-label">Pending</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
                    <p class="stat-number">{{ $confirmedMyBookings }}</p>
                    <p class="stat-label">Confirmed</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-user"></i></div>
                    <p class="stat-number">{{ ucfirst(auth()->user()->role) }}</p>
                    <p class="stat-label">Account Type</p>
                </div>
            </div>
        </div>

        @if($upcomingBooking)
        <div class="upcoming-card d-flex align-items-center gap-3">
            <div style="font-size:2rem">&#128197;</div>
            <div>
                <div class="fw-bold" style="color:#92400e">Upcoming Appointment</div>
                <div style="color:#78350f;font-size:0.9rem">
                    <strong>{{ $upcomingBooking->service->name ?? 'Service' }}</strong>
                    on {{ \Carbon\Carbon::parse($upcomingBooking->booking_date)->format('F d, Y') }}
                    at {{ $upcomingBooking->booking_time }}
                    &mdash;
                    <span class="status-badge status-{{ $upcomingBooking->status }}">{{ ucfirst($upcomingBooking->status) }}</span>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="content-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-calendar-check me-2"></i>My Recent Bookings</h5>
                        <a href="{{ route('my.bookings') }}" class="btn btn-sm btn-light text-danger fw-semibold">View All</a>
                    </div>
                    <div class="card-body p-0">
                        @if($myBookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table dash-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Date &amp; Time</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myBookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $booking->service->name ?? 'N/A' }}</div>
                                            @if($booking->service && $booking->service->duration)
                                            <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ $booking->service->duration }} min</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ $booking->booking_time }}</small>
                                        </td>
                                        <td>
                                            @if($booking->service)
                                            <span class="fw-semibold">${{ number_format($booking->service->price, 2) }}</span>
                                            @else
                                            <span class="text-muted">&mdash;</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3 d-block"></i>
                            <p>You haven't made any bookings yet.</p>
                            <a href="{{ route('services.index') }}" class="btn btn-danger">Book a Service</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="content-card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-user me-2"></i>My Profile</h5>
                    </div>
                    <div class="p-3 d-flex align-items-center gap-3" style="border-bottom:1px solid #f1f5f9">
                        <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div>
                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </div>
                    </div>
                    <div class="profile-item">
                        <span class="profile-label">Member Since</span>
                        <span class="profile-value">{{ auth()->user()->created_at->format('M Y') }}</span>
                    </div>
                    <div class="profile-item">
                        <span class="profile-label">Total Bookings</span>
                        <span class="fw-bold" style="color:#dc2626">{{ $totalMyBookings }}</span>
                    </div>
                </div>

                <div class="content-card">
                    <div class="card-header">
                        <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="p-3">
                        <a href="{{ route('services.index') }}" class="action-btn book">
                            <div class="a-icon"><i class="fas fa-cut"></i></div>
                            <div>
                                <div class="fw-semibold">Book a Service</div>
                                <small>Browse available services</small>
                            </div>
                        </a>
                        <a href="{{ route('my.bookings') }}" class="action-btn mybookings">
                            <div class="a-icon"><i class="fas fa-calendar-check"></i></div>
                            <div>
                                <div class="fw-semibold">My Bookings</div>
                                <small>{{ $totalMyBookings }} total bookings</small>
                            </div>
                        </a>
                        <a href="{{ route('posts.index') }}" class="action-btn posts">
                            <div class="a-icon"><i class="fas fa-newspaper"></i></div>
                            <div><div class="fw-semibold">View Posts</div></div>
                        </a>
                        <a href="{{ route('password.change') }}" class="action-btn password">
                            <div class="a-icon"><i class="fas fa-key"></i></div>
                            <div><div class="fw-semibold">Change Password</div></div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="action-btn w-100" style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;cursor:pointer">
                                <div class="a-icon" style="background:#fee2e2;color:#dc2626"><i class="fas fa-sign-out-alt"></i></div>
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
