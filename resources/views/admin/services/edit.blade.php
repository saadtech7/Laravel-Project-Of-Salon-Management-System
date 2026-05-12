@extends('layouts.app')
@section('title', 'Edit Service')
@section('content')
<style>
.svc-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #166534 0%, #fbbf24 50%, #1f2937 100%);
    display: flex; align-items: center; justify-content: center; padding: 2rem 1rem;
}
.svc-card {
    background: #1a1a1a; border-radius: 20px; width: 100%; max-width: 520px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.5); overflow: hidden;
}
.svc-card-header {
    background: linear-gradient(135deg, #166534 0%, #fbbf24 100%);
    padding: 1.75rem 2rem; text-align: center;
}
.svc-card-header h4 { color: white; font-weight: 800; margin: 0; font-size: 1.5rem; }
.svc-card-header p  { color: rgba(255,255,255,0.85); margin: 0.4rem 0 0; font-size: 0.9rem; }
.svc-card-body { padding: 2rem; }
.field-group { margin-bottom: 1.25rem; }
.field-group label {
    display: block; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.06em;
    color: #fbbf24; margin-bottom: 0.4rem;
}
.field-group input,
.field-group textarea,
.field-group select {
    width: 100%; background: rgba(255,255,255,0.06);
    border: 1.5px solid rgba(255,255,255,0.15);
    border-radius: 10px; color: white;
    padding: 0.8rem 1rem; font-size: 0.95rem;
    transition: all 0.2s; outline: none;
    -webkit-appearance: none; appearance: none;
}
.field-group textarea { resize: vertical; min-height: 90px; }
.field-group input:focus,
.field-group textarea:focus,
.field-group select:focus {
    border-color: #fbbf24;
    background: rgba(251,191,36,0.08);
    box-shadow: 0 0 0 3px rgba(251,191,36,0.15);
}
.field-group input::placeholder,
.field-group textarea::placeholder { color: rgba(255,255,255,0.3); }
.field-group select option { background: #1a1a1a; color: white; }
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.check-group {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.75rem 1rem; background: rgba(255,255,255,0.04);
    border: 1.5px solid rgba(255,255,255,0.1); border-radius: 10px;
    margin-bottom: 1.5rem; cursor: pointer;
}
.check-group input[type="checkbox"] { width: 18px; height: 18px; accent-color: #166534; flex-shrink: 0; }
.check-group label { color: rgba(255,255,255,0.8); font-size: 0.9rem; cursor: pointer; margin: 0; }
.submit-btn {
    width: 100%; padding: 0.9rem; border: none; border-radius: 12px;
    background: linear-gradient(135deg, #166534, #fbbf24);
    color: white; font-size: 1rem; font-weight: 700;
    cursor: pointer; transition: all 0.2s;
    box-shadow: 0 6px 20px rgba(22,101,52,0.4);
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(22,101,52,0.5); }
.back-link {
    display: block; text-align: center; margin-top: 1rem;
    color: #fbbf24; text-decoration: none; font-size: 0.88rem;
}
.back-link:hover { color: white; }
.err-box {
    background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4);
    border-radius: 10px; padding: 0.875rem 1rem; color: #fca5a5;
    font-size: 0.85rem; margin-bottom: 1.25rem;
}
</style>

<div class="svc-page">
    <div class="svc-card">
        <div class="svc-card-header">
            <h4><i class="fas fa-edit me-2"></i>Edit Service</h4>
            <p>Update service details</p>
        </div>
        <div class="svc-card-body">
            <form method="POST" action="{{ route('admin.services.update', $service) }}">
                @csrf @method('PUT')

                @if($errors->any())
                <div class="err-box">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    @foreach($errors->all() as $e){{ $e }}<br>@endforeach
                </div>
                @endif

                <div class="field-group">
                    <label>Service Name</label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}" required placeholder="e.g. Haircut & Beard Styling">
                </div>

                <div class="field-group">
                    <label>Description</label>
                    <textarea name="description" placeholder="Brief description of the service...">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="field-row">
                    <div class="field-group">
                        <label>Price ($)</label>
                        <input type="number" name="price" value="{{ old('price', $service->price) }}" step="0.01" min="0" required placeholder="0.00">
                    </div>
                    <div class="field-group">
                        <label>Duration (min)</label>
                        <input type="number" name="duration" value="{{ old('duration', $service->duration) }}" min="5" required placeholder="30">
                    </div>
                </div>

                <div class="field-row">
                    <div class="field-group">
                        <label>Icon (emoji)</label>
                        <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="✂️">
                    </div>
                    <div class="field-group">
                        <label>Category</label>
                        <select name="category" required>
                            <option value="men"   {{ old('category', $service->category) == 'men'   ? 'selected' : '' }}>Men</option>
                            <option value="women" {{ old('category', $service->category) == 'women' ? 'selected' : '' }}>Women</option>
                        </select>
                    </div>
                </div>

                <div class="check-group">
                    <input type="checkbox" name="is_active" value="1" id="is_active" {{ $service->is_active ? 'checked' : '' }}>
                    <label for="is_active">Active — visible to customers</label>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-2"></i>Update Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="back-link">
                    <i class="fas fa-arrow-left me-1"></i>Back to Services
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
