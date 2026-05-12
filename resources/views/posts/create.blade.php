@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<style>
.posts-container{background:#f8f9fa;min-height:100vh;padding:2rem 0}
.posts-header{background:linear-gradient(135deg,#8b0000 0%,#000080 100%);color:white;padding:2rem;border-radius:15px;margin-bottom:2rem;box-shadow:0 10px 30px rgba(0,0,0,0.2)}
.posts-header h1{font-size:2rem;font-weight:800;margin:0}
.posts-header .lead{font-size:1rem;opacity:.9;margin:.5rem 0 0}
.post-card{background:white;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,0.08);overflow:hidden}
.post-card-body{padding:1.5rem}
.btn-create{background:linear-gradient(135deg,#8b0000,#000080);color:white;border:none;padding:.75rem 1.5rem;border-radius:10px;font-weight:600;text-decoration:none;display:inline-block;cursor:pointer;transition:all .2s}
.btn-create:hover{opacity:.85;color:white;text-decoration:none}
.back-btn{background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;padding:.75rem 1.5rem;border-radius:10px;font-weight:600;text-decoration:none;display:inline-block;transition:all .2s}
.back-btn:hover{background:#475569;color:white;text-decoration:none}
.action-btn{padding:.5rem 1rem;border-radius:8px;font-size:.85rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-block}
.action-btn.view{background:#dbeafe;color:#1e40af;border:1px solid #bfdbfe}
.action-btn.view:hover{background:#1e40af;color:white;text-decoration:none}
.action-btn.delete{background:#fee2e2;color:#dc2626;border:1px solid #fecaca}
.action-btn.delete:hover{background:#dc2626;color:white;text-decoration:none}
</style>
<div class="posts-container">
    <div class="container">
        <div class="posts-header">
            <h1><i class="fas fa-plus-circle me-3"></i>Create New Post</h1>
            <p class="lead">Share your thoughts with the community</p>
        </div>

        <div class="post-card">
            <div class="post-card-body">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Post Content</label>
                        <textarea class="form-control" id="content" name="content" 
                                  rows="10" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-create">
                            <i class="fas fa-save me-2"></i>Create Post
                        </button>
                        <a href="{{ route('posts.index') }}" class="back-btn">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
