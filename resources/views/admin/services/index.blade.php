@extends('layouts.app')
@section('title', 'Manage Services')
@section('content')
<style>
.admin-header {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    color: white; padding: 2rem; border-radius: 15px; margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.service-table th { background: #f8f9fa; font-weight: 600; }
.service-table td { vertical-align: middle; }
</style>

<div class="container py-4">
    <div class="admin-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-concierge-bell me-2"></i>Manage Services</h1>
                <p class="mb-0 opacity-75">Add, edit or remove barber services</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.bookings') }}" class="btn btn-light">
                    <i class="fas fa-calendar me-2"></i>All Bookings
                </a>
                <a href="{{ route('admin.services.create') }}" class="btn btn-warning">
                    <i class="fas fa-plus me-2"></i>Add Service
                </a>
            </div>
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
            <table class="table service-table mb-0">
                <thead>
                    <tr>
                        <th class="p-3">Icon</th>
                        <th class="p-3">Service Name</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Duration</th>
                        <th class="p-3">Bookings</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td class="p-3" style="font-size:1.5rem;">{{ $service->icon ?? '✂️' }}</td>
                        <td class="p-3"><strong>{{ $service->name }}</strong><br>
                            <small class="text-muted">{{ Str::limit($service->description, 50) }}</small>
                        </td>
                        <td class="p-3"><strong class="text-danger">${{ number_format($service->price,2) }}</strong></td>
                        <td class="p-3">{{ $service->duration }} min</td>
                        <td class="p-3"><span class="badge bg-primary">{{ $service->bookings_count }}</span></td>
                        <td class="p-3">
                            @if($service->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="p-3">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this service?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center p-4 text-muted">No services yet. Add one!</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
