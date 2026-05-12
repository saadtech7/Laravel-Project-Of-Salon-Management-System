@extends('layouts.app')
@section('title', 'All Bookings')
@section('content')
<style>
.admin-header {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    color: white; padding: 2rem; border-radius: 15px; margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.status-pending  { background: #fef3c7; color: #92400e; }
.status-confirmed { background: #d1fae5; color: #065f46; }
.status-completed { background: #dbeafe; color: #1e40af; }
.status-cancelled { background: #fee2e2; color: #991b1b; }
</style>

<div class="container py-4">
    <div class="admin-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-calendar-alt me-2"></i>All Bookings</h1>
                <p class="mb-0 opacity-75">Manage customer appointments</p>
            </div>
            <a href="{{ route('admin.services.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Back to Services
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Service</th>
                        <th class="p-3">Date & Time</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Notes</th>
                        <th class="p-3">Address</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="p-3">
                            <strong>{{ $booking->user->name }}</strong><br>
                            <small class="text-muted">{{ $booking->user->email }}</small>
                        </td>
                        <td class="p-3">{{ $booking->service->name }}</td>
                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}<br>
                            <small>{{ date('h:i A', strtotime($booking->booking_time)) }}</small>
                        </td>
                        <td class="p-3"><strong class="text-danger">${{ number_format($booking->service->price,2) }}</strong></td>
                        <td class="p-3"><small>{{ $booking->notes ?? '-' }}</small></td>
                        <td class="p-3"><small>{{ $booking->address ?? '-' }}</small></td>
                        <td class="p-3"><small>{{ $booking->phone ?? '-' }}</small></td>
                        <td class="p-3">
                            <span class="badge status-{{ $booking->status }} p-2">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                @csrf
                                <select name="status" class="form-select form-select-sm d-inline-block w-auto"
                                        onchange="this.form.submit()" style="font-size:0.8rem;">
                                    @foreach(['pending','confirmed','completed','cancelled'] as $s)
                                        <option value="{{ $s }}" {{ $booking->status == $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center p-4 text-muted">No bookings yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
