@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<style>
.posts-container {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 2rem 0;
}

.posts-header {
    background: linear-gradient(135deg, #8b0000 0%, #000080 100%);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.posts-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
}

.posts-header .lead {
    font-size: 1.2rem;
    opacity: 0.95;
    margin: 0.5rem 0 0 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
}

.post-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 1.5rem;
    transition: all 0.2s ease;
    overflow: hidden;
}

.post-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.post-card-header {
    background: linear-gradient(135deg, #8b0000 0%, #000080 100%);
    color: white;
    padding: 1.5rem;
}

.post-card-body {
    padding: 1.5rem;
}

.post-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.post-meta {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-top: 0.5rem;
}

.post-content {
    color: #495057;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.btn-create {
    background: linear-gradient(135deg, #8b0000 0%, #000080 100%);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    color: white;
    text-decoration: none;
}
.action-btn {
    padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.85rem;
    font-weight: 600; border: none; cursor: pointer; transition: all 0.2s;
    text-decoration: none; display: inline-block;
}
.action-btn.view { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
.action-btn.view:hover { background: #1e40af; color: white; text-decoration: none; }
.action-btn.delete { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
.action-btn.delete:hover { background: #dc2626; color: white; }

</style>

<div class="posts-container">
    <div class="container">
        <div class="posts-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-newspaper me-3"></i>All Posts</h1>
                    <p class="lead">Manage and view all blog posts</p>
                </div>
                <a href="{{ route('posts.create') }}" class="btn-create">
                    <i class="fas fa-plus me-2"></i>Create New Post
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($posts->count() > 0)
            @foreach($posts as $post)
                <div class="post-card">
                    <div class="post-card-header">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <div class="post-meta">
                            <i class="fas fa-user me-1"></i>{{ $post->user->name }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-calendar me-1"></i>{{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="post-card-body">
                        <p class="post-content">{{ Str::limit($post->content, 200) }}</p>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('posts.show', $post) }}" class="action-btn view">
                                <i class="fas fa-eye me-1"></i>View
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
            @endforeach

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h4>No Posts Yet</h4>
                <p>Be the first to create a post!</p>
                <a href="{{ route('posts.create') }}" class="btn-create">
                    <i class="fas fa-plus me-2"></i>Create Your First Post
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
