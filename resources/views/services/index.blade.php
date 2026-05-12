@extends('layouts.app')
@section('title', 'Salon Prime - Services')
@section('content')
<style>
*,*::before,*::after{box-sizing:border-box}
.uc-page{background:#f7f7f7;min-height:100vh;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}
.uc-hero{background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);padding:3rem 0 2rem;position:relative;overflow:hidden}
.uc-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 70% 50%,rgba(220,38,38,.15) 0%,transparent 60%)}
.uc-hero-inner{position:relative;z-index:1}
.uc-hero h1{color:white;font-size:2.2rem;font-weight:800;margin:0 0 .4rem}
.uc-hero p{color:rgba(255,255,255,.7);margin:0 0 1.5rem;font-size:1rem}
.uc-hero-meta{display:flex;gap:1.5rem;flex-wrap:wrap}
.uc-hero-meta span{color:rgba(255,255,255,.85);font-size:.85rem;display:flex;align-items:center;gap:.4rem}
.uc-hero-meta .star{color:#fbbf24}
.gender-tabs{background:white;border-bottom:1px solid #e5e5e5;position:sticky;top:0;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,.06)}
.gender-tabs-inner{display:flex;max-width:1200px;margin:0 auto;padding:0 1.5rem}
.gender-tab{padding:1rem 2rem;font-size:1rem;font-weight:600;color:#888;cursor:pointer;border-bottom:3px solid transparent;transition:all .2s;display:flex;align-items:center;gap:.5rem;background:none;border-top:none;border-left:none;border-right:none;outline:none}
.gender-tab:hover{color:#333}
.gender-tab.active.men{color:#1e40af;border-bottom-color:#1e40af}
.gender-tab.active.women{color:#be185d;border-bottom-color:#be185d}
.category-scroll{background:white;padding:1rem 0;border-bottom:1px solid #f0f0f0}
.category-scroll-inner{display:flex;gap:.75rem;overflow-x:auto;padding:0 1.5rem;scrollbar-width:none;max-width:1200px;margin:0 auto}
.category-scroll-inner::-webkit-scrollbar{display:none}
.cat-pill{display:flex;flex-direction:column;align-items:center;gap:.4rem;padding:.6rem 1rem;border-radius:12px;background:#f7f7f7;border:1.5px solid #e5e5e5;cursor:pointer;transition:all .2s;white-space:nowrap;min-width:80px;font-size:.78rem;font-weight:600;color:#555}
.cat-pill .cp-icon{font-size:1.5rem}
.cat-pill:hover{border-color:#aaa;background:#f0f0f0}
.cat-pill.active.men{border-color:#1e40af;background:#eff6ff;color:#1e40af}
.cat-pill.active.women{border-color:#be185d;background:#fdf2f8;color:#be185d}
.uc-main{max-width:1200px;margin:0 auto;padding:2rem 1.5rem;display:grid;grid-template-columns:1fr 340px;gap:2rem;align-items:start}
@media(max-width:900px){.uc-main{grid-template-columns:1fr}.uc-sidebar{display:none}}
.section-heading{font-size:1.3rem;font-weight:800;color:#1a1a1a;margin:0 0 1.25rem;display:flex;align-items:center;gap:.5rem}
.sh-dot{width:10px;height:10px;border-radius:50%}
.sh-dot.men{background:#1e40af}.sh-dot.women{background:#be185d}
.svc-card{background:white;border-radius:16px;padding:1.5rem;margin-bottom:1rem;box-shadow:0 1px 4px rgba(0,0,0,.06);transition:box-shadow .2s,transform .2s;display:flex;gap:1.25rem;align-items:flex-start}
.svc-card:hover{box-shadow:0 6px 20px rgba(0,0,0,.1);transform:translateY(-2px)}
.svc-img{width:100px;height:100px;border-radius:14px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:2.5rem;flex-shrink:0;overflow:hidden}
.svc-img img{width:100%;height:100%;object-fit:cover;border-radius:14px;display:block}
.svc-body{flex:1;min-width:0}
.svc-tag{font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.3rem;display:inline-block;padding:.15rem .5rem;border-radius:4px}
.svc-tag.men{background:#dbeafe;color:#1e40af}.svc-tag.women{background:#fce7f3;color:#be185d}
.svc-name{font-size:1.05rem;font-weight:700;color:#1a1a1a;margin:0 0 .3rem}
.svc-rating{display:flex;align-items:center;gap:.3rem;font-size:.82rem;color:#555;margin-bottom:.4rem}
.svc-rating .star{color:#fbbf24;font-size:.75rem}.svc-rating .reviews{color:#999}
.svc-desc{font-size:.85rem;color:#666;margin:0 0 .75rem;line-height:1.5}
.svc-meta{display:flex;align-items:center;gap:1rem;font-size:.82rem;color:#888}
.svc-meta i{color:#aaa}
.svc-price-col{display:flex;flex-direction:column;align-items:flex-end;gap:.75rem;flex-shrink:0}
.svc-price{font-size:1.2rem;font-weight:800;color:#1a1a1a}
.add-btn{padding:.5rem 1.4rem;border-radius:8px;font-size:.88rem;font-weight:700;border:2px solid;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-block;text-align:center;white-space:nowrap}
.add-btn.men{border-color:#1e40af;color:#1e40af;background:white}.add-btn.men:hover{background:#1e40af;color:white}
.add-btn.women{border-color:#be185d;color:#be185d;background:white}.add-btn.women:hover{background:#be185d;color:white}
.uc-sidebar{position:sticky;top:80px}
.sidebar-card{background:white;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.08);overflow:hidden;margin-bottom:1.25rem}
.sidebar-card-header{padding:1.25rem 1.5rem;font-weight:700;font-size:1rem;color:#1a1a1a;border-bottom:1px solid #f0f0f0;display:flex;align-items:center;gap:.5rem}
.sidebar-card-body{padding:1.25rem 1.5rem}
.why-item{display:flex;align-items:flex-start;gap:.75rem;margin-bottom:1rem;font-size:.88rem}
.why-item:last-child{margin-bottom:0}
.why-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
.why-icon.blue{background:#dbeafe}.why-icon.green{background:#d1fae5}.why-icon.yellow{background:#fef3c7}.why-icon.pink{background:#fce7f3}
.why-title{font-weight:600;color:#1a1a1a;margin-bottom:.1rem}.why-desc{color:#888;font-size:.8rem}
.coupon-banner{background:linear-gradient(135deg,#065f46,#059669);border-radius:12px;padding:1rem 1.25rem;display:flex;align-items:center;gap:.75rem;color:white;font-size:.88rem}
.coupon-banner .coupon-icon{font-size:1.5rem}
.coupon-banner strong{display:block;font-size:1rem}
.empty-state{text-align:center;padding:4rem 2rem;color:#aaa}
.empty-state i{font-size:3rem;margin-bottom:1rem;display:block}
.uc-alert{background:#d1fae5;border:1px solid #6ee7b7;border-radius:12px;padding:.875rem 1.25rem;color:#065f46;font-size:.9rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem}
.tf-btn{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.5);border-radius:8px;padding:.35rem .9rem;font-size:.78rem;font-weight:600;cursor:pointer;transition:all .2s}
</style>

<div class="uc-page">
<div class="uc-hero">
<div class="container uc-hero-inner">
<h1>Salon Prime</h1>
<p>Professional grooming services at your doorstep</p>
<div class="uc-hero-meta">
<span><i class="fas fa-star star"></i> 4.87 Rating</span>
<span><i class="fas fa-users"></i> 2M+ Bookings</span>
<span><i class="fas fa-shield-alt"></i> Verified Professionals</span>
<span><i class="fas fa-clock"></i> On-time Guarantee</span>
</div></div></div>

<div class="gender-tabs">
<div class="gender-tabs-inner">
<button class="gender-tab active men" id="tab-men" onclick="switchGender(`men`)"><span class="tab-icon">Male</span> For Men</button>
<button class="gender-tab women" id="tab-women" onclick="switchGender(`women`)"><span class="tab-icon">Female</span> For Women</button>
</div></div>

<div class="category-scroll">
<div class="category-scroll-inner" id="catPills">
<div class="cat-pill active men" data-gender="men" data-cat="all" onclick="filterCat(`all`,this)"><span class="cp-icon">All</span></div>
<div class="cat-pill men" data-gender="men" data-cat="haircut" onclick="filterCat(`haircut`,this)"><span class="cp-icon">Cut</span>Haircut</div>
<div class="cat-pill men" data-gender="men" data-cat="beard" onclick="filterCat(`beard`,this)"><span class="cp-icon">Beard</span></div>
<div class="cat-pill men" data-gender="men" data-cat="facial" onclick="filterCat(`facial`,this)"><span class="cp-icon">Facial</span></div>
<div class="cat-pill men" data-gender="men" data-cat="massage" onclick="filterCat(`massage`,this)"><span class="cp-icon">Massage</span></div>
<div class="cat-pill men" data-gender="men" data-cat="color" onclick="filterCat(`color`,this)"><span class="cp-icon">Color</span></div>
<div class="cat-pill women" data-gender="women" data-cat="all" onclick="filterCat(`all`,this)" style="display:none"><span class="cp-icon">All</span></div>
<div class="cat-pill women" data-gender="women" data-cat="haircut" onclick="filterCat(`haircut`,this)" style="display:none"><span class="cp-icon">Cut</span>Haircut</div>
<div class="cat-pill women" data-gender="women" data-cat="spa" onclick="filterCat(`spa`,this)" style="display:none"><span class="cp-icon">Spa</span></div>
<div class="cat-pill women" data-gender="women" data-cat="facial" onclick="filterCat(`facial`,this)" style="display:none"><span class="cp-icon">Facial</span></div>
<div class="cat-pill women" data-gender="women" data-cat="waxing" onclick="filterCat(`waxing`,this)" style="display:none"><span class="cp-icon">Wax</span></div>
<div class="cat-pill women" data-gender="women" data-cat="color" onclick="filterCat(`color`,this)" style="display:none"><span class="cp-icon">Color</span></div>
</div></div>

<div class="uc-main">
<div class="uc-content">

@if(session('success'))
<div class="uc-alert"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

<div id="section-men">
    <div class="section-heading"><span class="sh-dot men"></span>Men's Services</div>
    @if($menServices->count() > 0)
    <div id="men-list">
        @foreach($menServices as $service)
        @php
            $c = strtolower($service->name.' '.$service->description);
            $dc = 'all';
            if(str_contains($c,'beard')) $dc='beard';
            elseif(str_contains($c,'facial')||str_contains($c,'cleanup')||str_contains($c,'tan')) $dc='facial';
            elseif(str_contains($c,'massage')) $dc='massage';
            elseif(str_contains($c,'color')) $dc='color';
            elseif(str_contains($c,'haircut')||str_contains($c,'cut')||str_contains($c,'shave')) $dc='haircut';
        @endphp
        @php
            $menIcons = [
                'haircut' => 'fa-cut',
                'beard'   => 'fa-user',
                'facial'  => 'fa-smile',
                'massage' => 'fa-hand-paper-o',
                'color'   => 'fa-paint-brush',
                'all'     => 'fa-scissors',
            ];
            $icon = $menIcons[$dc] ?? 'fa-scissors';
        @endphp
        <div class="svc-card" data-cat="{{ $dc }}">
            <div class="svc-img" style="background:linear-gradient(135deg,#1e40af,#3b82f6)">
                <i class="fa {{ $icon }}" style="color:white;font-size:2rem"></i>
            </div>
            <div class="svc-body">
                <span class="svc-tag men">Men</span>
                <div class="svc-name">{{ $service->name }}</div>
                <div class="svc-rating">
                    <i class="fas fa-star star"></i>
                    <strong>{{ number_format($service->rating,2) }}</strong>
                    <span class="reviews">({{ number_format($service->review_count) }} reviews)</span>
                </div>
                <div class="svc-desc">{{ $service->description }}</div>
                <div class="svc-meta">
                    <span><i class="fas fa-clock me-1"></i>{{ $service->duration }} mins</span>
                    <span><i class="fas fa-home me-1"></i>At your doorstep</span>
                </div>
            </div>
            <div class="svc-price-col">
                <div class="svc-price">${{ number_format($service->price,2) }}</div>
                @auth
                <a href="{{ route('services.book',$service) }}" class="add-btn men">Book</a>
                @else
                <a href="{{ route('login') }}" class="add-btn men">Login</a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state"><i class="fas fa-cut"></i>No men's services yet.</div>
    @endif
</div>

<div id="section-women" style="display:none">
    <div class="section-heading"><span class="sh-dot women"></span>Women's Services</div>
    @if($womenServices->count() > 0)
    <div id="women-list">
        @foreach($womenServices as $service)
        @php
            $c = strtolower($service->name.' '.$service->description);
            $dc = 'all';
            if(str_contains($c,'spa')) $dc='spa';
            elseif(str_contains($c,'facial')||str_contains($c,'cleanup')||str_contains($c,'tan')) $dc='facial';
            elseif(str_contains($c,'wax')) $dc='waxing';
            elseif(str_contains($c,'color')) $dc='color';
            elseif(str_contains($c,'haircut')||str_contains($c,'cut')||str_contains($c,'styling')) $dc='haircut';
        @endphp
        @php
            $womenIcons = [
                'haircut' => 'fa-female',
                'spa'     => 'fa-leaf',
                'facial'  => 'fa-smile-o',
                'waxing'  => 'fa-star',
                'color'   => 'fa-paint-brush',
                'all'     => 'fa-female',
            ];
            $icon = $womenIcons[$dc] ?? 'fa-female';
        @endphp
        <div class="svc-card" data-cat="{{ $dc }}">
            <div class="svc-img" style="background:linear-gradient(135deg,#be185d,#f472b6)">
                <i class="fa {{ $icon }}" style="color:white;font-size:2rem"></i>
            </div>
            <div class="svc-body">
                <span class="svc-tag women">Women</span>
                <div class="svc-name">{{ $service->name }}</div>
                <div class="svc-rating">
                    <i class="fas fa-star star"></i>
                    <strong>{{ number_format($service->rating,2) }}</strong>
                    <span class="reviews">({{ number_format($service->review_count) }} reviews)</span>
                </div>
                <div class="svc-desc">{{ $service->description }}</div>
                <div class="svc-meta">
                    <span><i class="fas fa-clock me-1"></i>{{ $service->duration }} mins</span>
                    <span><i class="fas fa-home me-1"></i>At your doorstep</span>
                </div>
            </div>
            <div class="svc-price-col">
                <div class="svc-price">${{ number_format($service->price,2) }}</div>
                @auth
                <a href="{{ route('services.book',$service) }}" class="add-btn women">Book</a>
                @else
                <a href="{{ route('login') }}" class="add-btn women">Login</a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state"><i class="fas fa-spa"></i>No women's services yet.</div>
    @endif
</div>

</div>{{-- uc-content --}}

<aside class="uc-sidebar">
    <div class="sidebar-card">
        <div class="sidebar-card-header"><i class="fas fa-calendar-check" style="color:#1e40af"></i> My Bookings</div>
        <div class="sidebar-card-body">
            <a href="{{ route('my.bookings') }}" style="display:block;background:linear-gradient(135deg,#1e40af,#3b82f6);color:white;text-align:center;padding:.875rem;border-radius:10px;font-weight:700;text-decoration:none">
                <i class="fas fa-list me-2"></i>View All Bookings
            </a>
        </div>
    </div>
    <div class="sidebar-card">
        <div class="sidebar-card-header"><i class="fas fa-shield-alt" style="color:#059669"></i> Why Salon Prime?</div>
        <div class="sidebar-card-body">
            <div class="why-item">
                <div class="why-icon blue"><i class="fas fa-user-check" style="color:#1e40af"></i></div>
                <div><div class="why-title">Verified Professionals</div><div class="why-desc">Background-checked experts only</div></div>
            </div>
            <div class="why-item">
                <div class="why-icon green"><i class="fas fa-clock" style="color:#059669"></i></div>
                <div><div class="why-title">On-Time Guarantee</div><div class="why-desc">We show up on time, every time</div></div>
            </div>
            <div class="why-item">
                <div class="why-icon yellow"><i class="fas fa-star" style="color:#d97706"></i></div>
                <div><div class="why-title">4.87 Avg Rating</div><div class="why-desc">Rated by 2M+ happy customers</div></div>
            </div>
            <div class="why-item">
                <div class="why-icon pink"><i class="fas fa-undo" style="color:#be185d"></i></div>
                <div><div class="why-title">Easy Cancellation</div><div class="why-desc">Cancel anytime before appointment</div></div>
            </div>
        </div>
    </div>

</aside>

</div>{{-- uc-main --}}
</div>{{-- uc-page --}}

<script>
let currentGender='men';
function switchGender(g){
    currentGender=g;
    document.getElementById('tab-men').className='gender-tab'+(g==='men'?' active men':'');
    document.getElementById('tab-women').className='gender-tab'+(g==='women'?' active women':'');
    document.getElementById('section-men').style.display=g==='men'?'':'none';
    document.getElementById('section-women').style.display=g==='women'?'':'none';
    document.querySelectorAll('.cat-pill').forEach(p=>{
        p.style.display=p.dataset.gender===g?'':'none';
        p.classList.remove('active','men','women');
    });
    const ap=document.querySelector(`.cat-pill[data-gender="${g}"][data-cat="all"]`);
    if(ap){ap.classList.add('active',g);}
    const list=document.getElementById(g+'-list');
    if(list)list.querySelectorAll('.svc-card').forEach(c=>c.style.display='');
}
function filterCat(cat,el){
    document.querySelectorAll(`.cat-pill[data-gender="${currentGender}"]`).forEach(p=>p.classList.remove('active','men','women'));
    el.classList.add('active',currentGender);
    const list=document.getElementById(currentGender+'-list');
    if(!list)return;
    list.querySelectorAll('.svc-card').forEach(card=>{
        card.style.display=(cat==='all'||card.dataset.cat===cat)?'':'none';
    });
}
</script>
@endsection
