@extends('layouts.app')
@section('title', 'Contact Messages')
@section('content')
<style>
.contacts-page { background: #f8fafc; min-height: 100vh; padding: 2rem 0; }
.page-header {
    background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%);
    color: white; padding: 1.75rem 2rem; border-radius: 16px;
    margin-bottom: 2rem; box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}
.page-header h1 { font-size: 1.6rem; font-weight: 800; margin: 0; }
.page-header p  { margin: 0.25rem 0 0; opacity: 0.85; font-size: 0.9rem; }
.contacts-card {
    background: white; border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07); overflow: hidden;
}
.contacts-card .card-header {
    background: #f8fafc; padding: 1rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; justify-content: space-between;
}
.contacts-card .card-header h5 { margin: 0; font-weight: 700; color: #1e293b; font-size: 1rem; }
.ctable th {
    background: #f1f5f9; color: #475569; font-weight: 700;
    font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.06em;
    padding: 0.875rem 1rem; border: none;
}
.ctable td {
    padding: 1rem; vertical-align: middle;
    border: none; border-bottom: 1px solid #f1f5f9; font-size: 0.88rem;
}
.ctable tr:last-child td { border-bottom: none; }
.ctable tr.unread td { background: #fffbeb; }
.ctable tr:hover td { background: #f8fafc; }
.badge-unread { background: #fef3c7; color: #92400e; padding: 0.3rem 0.7rem; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display:inline-flex; align-items:center; gap:0.3rem; white-space:nowrap; }
.badge-read   { background: #d1fae5; color: #065f46; padding: 0.3rem 0.7rem; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display:inline-flex; align-items:center; gap:0.3rem; white-space:nowrap; }
.badge-unread i, .badge-read i { font-size: 0.6rem; }
.msg-preview  { color: #64748b; max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.btn-sm-action {
    padding: 0.3rem 0.7rem; border-radius: 8px; font-size: 0.78rem;
    font-weight: 600; border: none; cursor: pointer; transition: all 0.2s;
    text-decoration: none; display: inline-block;
}
.btn-read   { background: #dbeafe; color: #1e40af; }
.btn-read:hover { background: #1e40af; color: white; }
.btn-del    { background: #fee2e2; color: #dc2626; }
.btn-del:hover { background: #dc2626; color: white; }
.stat-pill {
    display: inline-flex; align-items: center; gap: 0.4rem;
    padding: 0.4rem 1rem; border-radius: 30px; font-size: 0.82rem; font-weight: 600;
}
.stat-pill.total  { background: #eff6ff; color: #1e40af; }
.stat-pill.unread { background: #fef3c7; color: #92400e; }
</style>

<div class="contacts-page">
<div class="container">

    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h1><i class="fas fa-envelope me-2"></i>Contact Messages</h1>
                <p>Messages submitted through the website contact form</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <span class="stat-pill total"><i class="fas fa-inbox"></i> {{ $contacts->total() }} Total</span>
                <span class="stat-pill unread">&#8226; {{ \App\Models\Contact::where('is_read', false)->count() }} Unread</span>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="contacts-card">
        <div class="card-header">
            <h5><i class="fas fa-list me-2"></i>All Messages</h5>
            <a href="{{ route('admin.dashboard') }}" class="btn-sm-action btn-read">
                <i class="fas fa-arrow-left me-1"></i>Dashboard
            </a>
        </div>
        @if($contacts->count() > 0)
        <div class="table-responsive">
            <table class="table ctable mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Address</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr class="{{ !$contact->is_read ? 'unread' : '' }}">
                        <td class="text-muted">{{ $contact->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $contact->name }}</div>
                        </td>
                        <td>
                            <div><i class="fas fa-envelope me-1 text-muted"></i>{{ $contact->email }}</div>
                            <div><i class="fas fa-phone me-1 text-muted"></i>{{ $contact->phone }}</div>
                        </td>
                        <td class="text-muted">{{ $contact->address ?? '—' }}</td>
                        <td>
                            <div class="msg-preview" title="{{ $contact->message }}">{{ $contact->message }}</div>
                        </td>
                        <td>
                            @if($contact->is_read)
                                <span class="badge-read">&#10003; Read</span>
                            @else
                                <span class="badge-unread">&#8226; Unread</span>
                            @endif
                        </td>
                        <td class="text-muted" style="white-space:nowrap">
                            {{ $contact->created_at->format('M d, Y') }}<br>
                            <small>{{ $contact->created_at->diffForHumans() }}</small>
                        </td>
                        <td style="white-space:nowrap">
                            @if(!$contact->is_read)
                            <form method="POST" action="{{ route('admin.contacts.read', $contact) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-sm-action btn-read me-1">
                                    <i class="fas fa-check"></i> Read
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-action btn-del"
                                    onclick="return confirm('Delete this message?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $contacts->links() }}
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
            <p>No contact messages yet.</p>
        </div>
        @endif
    </div>

</div>
</div>
@endsection
