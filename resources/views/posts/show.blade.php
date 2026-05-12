@extends('layouts.app')

@section('title', $post->title)

@section('content')
<style>
.posts-container{background:#f8f9fa;min-height:100vh;padding:2rem 0}
.posts-header{background:linear-gradient(135deg,#8b0000 0%,#000080 100%);color:white;padding:2rem;border-radius:15px;margin-bottom:2rem;box-shadow:0 10px 30px rgba(0,0,0,0.2)}
.posts-header h1{font-size:1.8rem;font-weight:800;margin:0}
.post-meta{font-size:.9rem;opacity:.9;margin-top:.5rem}
.post-card{background:white;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,0.08);overflow:hidden}
.post-card-body{padding:1.5rem}
.post-content{color:#495057;line-height:1.7}
.back-btn{background:linear-gradient(135deg,#8b0000,#000080);color:white;border:none;padding:.6rem 1.25rem;border-radius:8px;font-weight:600;text-decoration:none;display:inline-block;transition:all .2s}
.back-btn:hover{opacity:.85;color:white;text-decoration:none}
.action-btn{padding:.5rem 1rem;border-radius:8px;font-size:.85rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-block}
.action-btn.view{background:#dbeafe;color:#1e40af;border:1px solid #bfdbfe}
.action-btn.view:hover{background:#1e40af;color:white;text-decoration:none}
.action-btn.delete{background:#fee2e2;color:#dc2626;border:1px solid #fecaca}
.action-btn.delete:hover{background:#dc2626;color:white;text-decoration:none}
</style>
<div class="posts-container">
    <div class="container">
        <div class="posts-header">
            <h1><i class="fas fa-newspaper me-3"></i>{{ $post->title }}</h1>
            <div class="post-meta">
                <i class="fas fa-user me-1"></i>{{ $post->user->name }}
                <span class="mx-2">•</span>
                <i class="fas fa-calendar me-1"></i>{{ $post->created_at->format('F d, Y') }}
                <span class="mx-2">•</span>
                <i class="fas fa-clock me-1"></i>{{ $post->created_at->diffForHumans() }}
            </div>
        </div>

        <div class="post-card">
            <div class="post-card-body">
                <div class="post-content" style="white-space: pre-wrap;">{{ $post->content }}</div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('posts.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Back to Posts
                    </a>
                    
                    @if($post->user_id === auth()->id() || auth()->user()->role === 'admin')
                        <a href="{{ route('posts.edit', $post) }}" class="action-btn view">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete" 
                                    onclick="return confirm('Delete this post?')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
