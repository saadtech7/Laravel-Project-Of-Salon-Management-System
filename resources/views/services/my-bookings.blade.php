@extends('layouts.app')
@section('title', 'My Bookings')
@section('content')
<style>
.bookings-header {
    background: linear-gradient(135deg, #dc2626 0%, #1e40af 100%);
    color: white; padding: 2rem; border-radius: 15px; margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.booking-card {
    background: white; border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    margin-bottom: 1rem; overflow: hidden;
    transition: all 0.2s ease;
}
.booking-card:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.12); }
.booking-card-header {
    background: linear-gradient(135deg, #dc2626 0%, #1e40af 100%);
    color: white; padding: 1rem 1.5rem;
    display: flex; justify-content: space-between; align-items: center;
}
.booking-card-body { padding: 1.5rem; }
.status-badge {
    padding: 0.35rem 0.85rem; border-radius: 20px;
    font-size: 0.8rem; font-weight: 600;
}
.status-pending  { background: #fef3c7; color: #92400e; border: 1px solid #f59e0b; }
.status-confirmed { background: #d1fae5; color: #065f46; border: 1px solid #10b981; }
.status-completed { background: #dbeafe; color: #1e40af; border: 1px solid #3b82f6; }
.status-cancelled { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
.cancel-btn {
    background: #fee2e2; color: #dc2626; border: 2px solid #dc2626;
    border-radius: 8px; padding: 0.4rem 1rem; font-size: 0.85rem;
    font-weight: 600; cursor: pointer; transition: all 0.2s ease;
}
.cancel-btn:hover { background: #dc2626; color: white; }
</style>

<div class="container py-4">
    <div class="bookings-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-calendar-check me-2"></i>My Bookings</h1>
                <p class="mb-0 opacity-75">Track all your appointments</p>
            </div>
            <a href="{{ route('services.index') }}" class="btn btn-light">
                <i class="fas fa-plus me-2"></i>Book New Service
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($bookings->count() > 0)
        @foreach($bookings as $booking)
        <div class="booking-card">
            <div class="booking-card-header">
                <div>
                    <strong>{{ $booking->service->name }}</strong>
                    <span class="ms-2 opacity-75" style="font-size:0.9rem;">
                        ${{ number_format($booking->service->price, 2) }}
                    </span>
                </div>
                <span class="status-badge status-{{ $booking->status }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
            <div class="booking-card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="mb-1"><i class="fas fa-calendar me-2 text-danger"></i>
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><i class="fas fa-clock me-2 text-danger"></i>
                            <strong>Time:</strong> {{ date('h:i A', strtotime($booking->booking_time)) }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><i class="fas fa-hourglass me-2 text-danger"></i>
                            <strong>Duration:</strong> {{ $booking->service->duration }} min
                        </p>
                    </div>
                </div>
                @if($booking->address)
                    <p class="mb-2 text-muted"><i class="fas fa-map-marker-alt me-2"></i>{{ $booking->address }}</p>
                @endif
                @if($booking->phone)
                    <p class="mb-2 text-muted"><i class="fas fa-phone me-2"></i>{{ $booking->phone }}</p>
                @endif
                @if($booking->notes)
                    <p class="mb-2 text-muted"><i class="fas fa-sticky-note me-2"></i>{{ $booking->notes }}</p>
                @endif
                @if(in_array($booking->status, ['pending', 'confirmed']))
                    <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="cancel-btn"
                                onclick="return confirm('Cancel this booking?')">
                            <i class="fas fa-times me-1"></i>Cancel Booking
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    @else
        <div class="text-center py-5">
            <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
            <h4>No bookings yet</h4>
            <p class="text-muted">Book your first appointment!</p>
            <a href="{{ route('services.index') }}" class="btn btn-danger">
                <i class="fas fa-cut me-2"></i>View Services
            </a>
        </div>
    @endif
</div>
@endsection
