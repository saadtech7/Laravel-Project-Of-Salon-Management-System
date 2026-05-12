
@extends('layouts.app')
@section('title', 'Book — ' . $service->name)
@section('content')
<style>
*,*::before,*::after{box-sizing:border-box}
.book-page{
    min-height:100vh;
    background:radial-gradient(ellipse at top left,#1a0a0a 0%,#0d0d0d 40%,#0a0a1a 100%);
    display:flex;align-items:center;justify-content:center;
    padding:2rem 1rem;position:relative;overflow:hidden;
}
.book-page::before{
    content:'';position:fixed;inset:0;pointer-events:none;
    background:radial-gradient(circle at 15% 50%,rgba(220,38,38,.12) 0%,transparent 45%),
               radial-gradient(circle at 85% 20%,rgba(30,64,175,.1) 0%,transparent 45%);
}
.particle{position:fixed;border-radius:50%;pointer-events:none;animation:floatUp linear infinite;opacity:0}
@keyframes floatUp{0%{transform:translateY(100vh) scale(0);opacity:0}10%{opacity:.6}90%{opacity:.3}100%{transform:translateY(-10vh) scale(1);opacity:0}}
.book-wrapper{width:100%;max-width:900px;position:relative;z-index:10}

/* Header */
.svc-header{
    background:linear-gradient(135deg,#dc2626 0%,#991b1b 50%,#1e40af 100%);
    border-radius:20px 20px 0 0;padding:2rem 2.5rem;
    position:relative;overflow:hidden;text-align:center;
}
.svc-header::before{
    content:'';position:absolute;inset:0;
    background:radial-gradient(circle at 20% 50%,rgba(255,255,255,.08) 0%,transparent 50%),
               radial-gradient(circle at 80% 50%,rgba(255,255,255,.05) 0%,transparent 50%);
    animation:shimmer 6s ease-in-out infinite;
}
@keyframes shimmer{0%,100%{opacity:.5}50%{opacity:1}}
.svc-header .s-icon{font-size:3rem;display:block;margin-bottom:.5rem;position:relative;z-index:1;filter:drop-shadow(0 0 12px rgba(255,255,255,.4))}
.svc-header h2{color:#fff;font-size:1.9rem;font-weight:800;margin:0 0 .75rem;position:relative;z-index:1;text-shadow:0 2px 10px rgba(0,0,0,.5);letter-spacing:1px}
.svc-pills{display:flex;justify-content:center;gap:.75rem;flex-wrap:wrap;position:relative;z-index:1}
.svc-pill{background:rgba(255,255,255,.15);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.25);color:#fff;padding:.4rem 1rem;border-radius:30px;font-size:.85rem;font-weight:600;display:flex;align-items:center;gap:.4rem}

/* Card */
.book-card{background:rgba(18,18,18,.97);border-radius:0 0 20px 20px;border:1px solid rgba(220,38,38,.2);border-top:none;backdrop-filter:blur(20px);overflow:hidden}

/* Steps */
.steps-bar{display:flex;align-items:center;padding:1.5rem 2.5rem;border-bottom:1px solid rgba(255,255,255,.06)}
.step-item{display:flex;align-items:center;flex:1}
.step-circle{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:700;flex-shrink:0;transition:all .3s;border:2px solid rgba(255,255,255,.15);color:rgba(255,255,255,.4);background:rgba(255,255,255,.05)}
.step-circle.active{background:linear-gradient(135deg,#dc2626,#b91c1c);border-color:#dc2626;color:#fff;box-shadow:0 0 20px rgba(220,38,38,.5)}
.step-circle.done{background:linear-gradient(135deg,#059669,#047857);border-color:#059669;color:#fff}
.step-label{font-size:.75rem;color:rgba(255,255,255,.4);margin-left:.5rem;font-weight:500;white-space:nowrap}
.step-label.active{color:#f87171}.step-label.done{color:#34d399}
.step-line{flex:1;height:2px;background:rgba(255,255,255,.08);margin:0 .75rem;border-radius:2px;position:relative;overflow:hidden}
.step-line.done::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,#059669,#34d399);border-radius:2px}

/* Two-col layout */
.book-cols{display:grid;grid-template-columns:1fr 280px;gap:0}
@media(max-width:700px){.book-cols{grid-template-columns:1fr}.book-sidebar{border-left:none!important;border-top:1px solid rgba(255,255,255,.06)}}
.book-main{padding:2rem 2rem 2rem 2.5rem}
.book-sidebar{padding:2rem 1.5rem 2rem 1.5rem;border-left:1px solid rgba(255,255,255,.06);background:rgba(255,255,255,.02)}

/* Section labels */
.sec-label{font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:#dc2626;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.sec-label::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,rgba(220,38,38,.4),transparent)}

/* Inputs */
.field-wrap{position:relative;margin-bottom:1.25rem}
.field-wrap label{display:block;font-size:.75rem;font-weight:600;color:rgba(255,255,255,.45);margin-bottom:.4rem;letter-spacing:.05em;text-transform:uppercase}
.field-wrap .f-icon{position:absolute;left:1rem;bottom:.9rem;color:rgba(220,38,38,.7);font-size:.9rem;pointer-events:none;transition:color .2s}
.field-wrap input,.field-wrap textarea{width:100%;background:rgba(255,255,255,.04);border:1.5px solid rgba(255,255,255,.1);border-radius:12px;color:#fff;padding:.875rem 1rem .875rem 2.75rem;font-size:.95rem;transition:all .25s;outline:none;-webkit-appearance:none;appearance:none}
.field-wrap textarea{padding-left:2.75rem;resize:vertical;min-height:90px}
.field-wrap input:focus,.field-wrap textarea:focus{border-color:#dc2626;background:rgba(220,38,38,.06);box-shadow:0 0 0 3px rgba(220,38,38,.12)}
.field-wrap input::placeholder,.field-wrap textarea::placeholder{color:rgba(255,255,255,.25)}
input[type="date"]::-webkit-calendar-picker-indicator{filter:invert(.7);cursor:pointer}

/* Day info */
.day-info{background:rgba(30,64,175,.1);border:1px solid rgba(30,64,175,.25);border-radius:10px;padding:.6rem 1rem;margin-bottom:1.25rem;font-size:.85rem;color:#93c5fd;display:none}

/* Time filter */
.time-filters{display:flex;gap:.5rem;margin-bottom:.75rem;flex-wrap:wrap}
.tf-btn{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.5);border-radius:8px;padding:.35rem .9rem;font-size:.78rem;font-weight:600;cursor:pointer;transition:all .2s}
.tf-btn.active,.tf-btn:hover{background:rgba(220,38,38,.15);border-color:rgba(220,38,38,.4);color:#f87171}

/* Time grid */
.time-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(85px,1fr));gap:.5rem;margin-bottom:1.25rem}
.t-slot{background:rgba(255,255,255,.04);border:1.5px solid rgba(255,255,255,.1);border-radius:10px;padding:.6rem .4rem;text-align:center;cursor:pointer;transition:all .2s;color:rgba(255,255,255,.7);font-size:.82rem;font-weight:500;user-select:none}
.t-slot:hover{border-color:rgba(220,38,38,.5);background:rgba(220,38,38,.08);color:#fff}
.t-slot.selected{background:linear-gradient(135deg,#dc2626,#b91c1c);border-color:#dc2626;color:#fff;font-weight:700;box-shadow:0 4px 15px rgba(220,38,38,.4);transform:scale(1.04)}

/* Summary sidebar */
.summary-box{background:rgba(220,38,38,.06);border:1px solid rgba(220,38,38,.2);border-radius:14px;padding:1.25rem;margin-bottom:1.25rem}
.s-row{display:flex;justify-content:space-between;align-items:center;padding:.45rem 0;font-size:.85rem;border-bottom:1px solid rgba(255,255,255,.05)}
.s-row:last-child{border-bottom:none}
.s-row .sk{color:rgba(255,255,255,.45)}.s-row .sv{color:#fff;font-weight:600}
.s-row.total .sk{color:rgba(255,255,255,.7);font-weight:600}.s-row.total .sv{color:#f87171;font-size:1.1rem}

/* Confirm btn */
.confirm-btn{width:100%;padding:1rem;background:linear-gradient(135deg,#dc2626 0%,#b91c1c 50%,#991b1b 100%);color:#fff;border:none;border-radius:14px;font-size:1rem;font-weight:700;letter-spacing:.05em;cursor:pointer;transition:all .3s;position:relative;overflow:hidden;box-shadow:0 8px 25px rgba(220,38,38,.35)}
.confirm-btn::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.15),transparent);transition:left .5s}
.confirm-btn:hover::before{left:100%}
.confirm-btn:hover{transform:translateY(-2px);box-shadow:0 14px 35px rgba(220,38,38,.5)}
.confirm-btn:disabled{opacity:.5;cursor:not-allowed;transform:none}

/* Trust badges */
.trust-badges{display:flex;flex-direction:column;gap:.6rem;margin-top:1.25rem}
.trust-badge{display:flex;align-items:center;gap:.6rem;font-size:.78rem;color:rgba(255,255,255,.45)}
.trust-badge i{color:#34d399;font-size:.8rem}

/* Back link */
.back-link{display:block;text-align:center;margin-top:1rem;color:rgba(255,255,255,.3);font-size:.85rem;text-decoration:none;transition:color .2s}
.back-link:hover{color:#f87171;text-decoration:none}

/* Error */
.err-box{background:rgba(220,38,38,.1);border:1px solid rgba(220,38,38,.3);border-radius:12px;padding:1rem 1.25rem;color:#fca5a5;font-size:.88rem;margin-bottom:1.5rem}

@media(max-width:600px){
    .svc-header{padding:1.5rem 1.25rem}.svc-header h2{font-size:1.4rem}
    .book-main{padding:1.5rem 1.25rem}.steps-bar{padding:1.25rem}
    .time-grid{grid-template-columns:repeat(auto-fill,minmax(72px,1fr))}
}
</style>

<div class="book-page" id="bookPage">
<div id="pcont"></div>
<div class="book-wrapper">

    <!-- Header -->
    <div class="svc-header">
        @php
            $sc = strtolower($service->name.' '.$service->description);
            $faIcon = 'fa-scissors';
            if(str_contains($sc,'beard')) $faIcon='fa-user';
            elseif(str_contains($sc,'facial')||str_contains($sc,'cleanup')) $faIcon='fa-smile';
            elseif(str_contains($sc,'massage')) $faIcon='fa-hand-paper-o';
            elseif(str_contains($sc,'color')) $faIcon='fa-paint-brush';
            elseif(str_contains($sc,'manicure')||str_contains($sc,'pedicure')) $faIcon='fa-hand-o-up';
            elseif(str_contains($sc,'spa')) $faIcon='fa-leaf';
            elseif(str_contains($sc,'wax')) $faIcon='fa-star';
            elseif(str_contains($sc,'tan')) $faIcon='fa-sun-o';
        @endphp
        <div style="position:relative;z-index:1;margin-bottom:1rem">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,0.15);border:3px solid rgba(255,255,255,0.4);box-shadow:0 0 20px rgba(0,0,0,0.3)">
                <i class="fa {{ $faIcon }}" style="color:white;font-size:2.2rem"></i>
            </span>
        </div>
        <h2><i class="fas fa-calendar-plus me-2"></i>Book Appointment</h2>
        <div class="svc-pills">
            <span class="svc-pill"><i class="fas fa-tag"></i>{{ $service->name }}</span>
            <span class="svc-pill"><i class="fas fa-dollar-sign"></i>${{ number_format($service->price,2) }}</span>
            <span class="svc-pill"><i class="fas fa-clock"></i>{{ $service->duration }} min</span>
            @if($service->rating ?? false)
            <span class="svc-pill"><i class="fas fa-star" style="color:#fbbf24"></i>{{ number_format($service->rating,2) }}</span>
            @endif
        </div>
    </div>

    <!-- Card -->
    <div class="book-card">

        <!-- Steps -->
        <div class="steps-bar">
            <div class="step-item">
                <div class="step-circle active" id="s1c">1</div>
                <span class="step-label active" id="s1l">Date</span>
            </div>
            <div class="step-line" id="l1"></div>
            <div class="step-item">
                <div class="step-circle" id="s2c">2</div>
                <span class="step-label" id="s2l">Time</span>
            </div>
            <div class="step-line" id="l2"></div>
            <div class="step-item">
                <div class="step-circle" id="s3c">3</div>
                <span class="step-label" id="s3l">Notes</span>
            </div>
            <div class="step-line" id="l3"></div>
            <div class="step-item">
                <div class="step-circle" id="s4c">4</div>
                <span class="step-label" id="s4l">Confirm</span>
            </div>
        </div>

        <!-- Two columns -->
        <div class="book-cols">

            <!-- Left: form -->
            <div class="book-main">

                @if($errors->any())
                <div class="err-box"><i class="fas fa-exclamation-circle me-2"></i>
                    @foreach($errors->all() as $e){{ $e }}<br>@endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('services.store-booking', $service) }}" id="bookForm">
                @csrf

                <!-- Date -->
                <div class="sec-label"><i class="fas fa-calendar-alt"></i>Choose Date</div>
                <div class="field-wrap">
                    <label for="booking_date">Appointment Date</label>
                    <input type="date" id="booking_date" name="booking_date"
                           min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}"
                           required onchange="onDate(this.value)">
                    <i class="fas fa-calendar f-icon"></i>
                </div>
                <div class="day-info" id="dayInfo">
                    <i class="fas fa-info-circle me-2"></i><span id="dayText"></span>
                </div>

                <!-- Time -->
                <div class="sec-label"><i class="fas fa-clock"></i>Pick a Time</div>
                <div class="time-filters">
                    <button type="button" class="tf-btn active" onclick="filterT('all',this)">All</button>
                    <button type="button" class="tf-btn" onclick="filterT('am',this)">Morning</button>
                    <button type="button" class="tf-btn" onclick="filterT('pm',this)">Afternoon</button>
                </div>
                <div class="time-grid" id="tGrid">
                    @php $times=['09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00']; @endphp
                    @foreach($times as $t)
                    @php $pm=(int)explode(':',$t)[0]>=12; @endphp
                    <div class="t-slot {{ old('booking_time')==$t?'selected':'' }}"
                         data-time="{{ $t }}" data-period="{{ $pm?'pm':'am' }}"
                         onclick="pickTime('{{ $t }}',this)">
                        {{ date('h:i A',strtotime($t)) }}
                    </div>
                    @endforeach
                </div>
                <input type="hidden" name="booking_time" id="btime" value="{{ old('booking_time') }}">

                <!-- Address -->
                <div class="sec-label"><i class="fas fa-map-marker-alt"></i>Service Address</div>
                <div class="field-wrap">
                    <label for="address">Your Address <span style="color:#f87171">*</span></label>
                    <input type="text" id="address" name="address"
                           placeholder="Enter your full address for the visit"
                           value="{{ old('address') }}" required>
                    <i class="fas fa-map-marker-alt f-icon"></i>
                </div>

                <!-- Phone -->
                <div class="sec-label"><i class="fas fa-phone"></i>Phone Number</div>
                <div class="field-wrap">
                    <label for="phone">Contact Number <span style="color:#f87171">*</span></label>
                    <input type="tel" id="phone" name="phone"
                           placeholder="e.g. 0300-1234567"
                           value="{{ old('phone') }}"
                           maxlength="10"
                           pattern="\d{10}"
                           title="Enter exactly 10 digits"
                           oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                           required>
                    <i class="fas fa-phone f-icon"></i>
                </div>

                <!-- Notes -->
                <div class="sec-label"><i class="fas fa-sticky-note"></i>Special Notes</div>
                <div class="field-wrap">
                    <label for="notes">Notes (optional)</label>
                    <textarea id="notes" name="notes" placeholder="Any special requests, allergies, or preferences...">{{ old('notes') }}</textarea>
                    <i class="fas fa-pen f-icon" style="bottom:auto;top:2.6rem"></i>
                </div>

                </form>
            </div>

            <!-- Right: summary -->
            <div class="book-sidebar">
                <div class="sec-label"><i class="fas fa-receipt"></i>Summary</div>
                <div class="summary-box">
                    <div class="s-row"><span class="sk">Service</span><span class="sv">{{ $service->name }}</span></div>
                    <div class="s-row"><span class="sk">Duration</span><span class="sv">{{ $service->duration }} min</span></div>
                    <div class="s-row"><span class="sk">Date</span><span class="sv" id="sum-date">—</span></div>
                    <div class="s-row"><span class="sk">Time</span><span class="sv" id="sum-time">—</span></div>
                    <div class="s-row"><span class="sk">Address</span><span class="sv" id="sum-address" style="font-size:0.78rem;text-align:right;max-width:140px">—</span></div>
                    <div class="s-row"><span class="sk">Phone</span><span class="sv" id="sum-phone">—</span></div>
                    <div class="s-row total"><span class="sk">Total</span><span class="sv">${{ number_format($service->price,2) }}</span></div>
                </div>

                <button type="submit" form="bookForm" class="confirm-btn" id="confirmBtn" disabled>
                    <i class="fas fa-check-circle me-2"></i>Confirm Booking
                </button>

                <div class="trust-badges">
                    <div class="trust-badge"><i class="fas fa-shield-alt"></i>Verified professional</div>
                    <div class="trust-badge"><i class="fas fa-clock"></i>On-time guarantee</div>
                    <div class="trust-badge"><i class="fas fa-undo"></i>Free cancellation</div>
                    <div class="trust-badge"><i class="fas fa-star"></i>4.87 avg rating</div>
                </div>

                <a href="{{ route('services.index') }}" class="back-link mt-3">
                    <i class="fas fa-arrow-left me-1"></i>Back to Services
                </a>
            </div>
        </div>
    </div>
</div>
</div>

<script>
// Particles
(function(){
    const c=document.getElementById('pcont');
    const cols=['rgba(220,38,38,.6)','rgba(185,28,28,.4)','rgba(30,64,175,.4)','rgba(255,255,255,.2)'];
    for(let i=0;i<18;i++){
        const p=document.createElement('div');p.className='particle';
        const s=Math.random()*4+2;
        p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}%;background:${cols[Math.floor(Math.random()*cols.length)]};animation-duration:${Math.random()*12+8}s;animation-delay:${Math.random()*8}s`;
        c.appendChild(p);
    }
})();

function steps(d,t){
    const s1=!!d,s2=!!t;
    const set=(id,cls,html)=>{document.getElementById(id).className='step-circle '+cls;if(html)document.getElementById(id).innerHTML=html};
    const lbl=(id,cls)=>document.getElementById(id).className='step-label '+cls;
    const ln=(id,cls)=>document.getElementById(id).className='step-line '+cls;
    set('s1c',s1?'done':'active',s1?'<i class="fas fa-check"></i>':'1'); lbl('s1l',s1?'done':'active');
    ln('l1',s1?'done':'');
    set('s2c',s2?'done':s1?'active':'',s2?'<i class="fas fa-check"></i>':'2'); lbl('s2l',s2?'done':s1?'active':'');
    ln('l2',s2?'done':'');
    set('s3c',s2?'active':'','3'); lbl('s3l',s2?'active':'');
    ln('l3',s1&&s2?'done':'');
    set('s4c',s1&&s2?'active':'','4'); lbl('s4l',s1&&s2?'active':'');
    document.getElementById('confirmBtn').disabled=!(s1&&s2);
}

function onDate(v){
    const di=document.getElementById('dayInfo'),dt=document.getElementById('dayText');
    if(v){
        const d=new Date(v+'T00:00:00');
        const days=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        const months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const fmt=`${days[d.getDay()]}, ${months[d.getMonth()]} ${d.getDate()}, ${d.getFullYear()}`;
        document.getElementById('sum-date').textContent=fmt;
        di.style.display='block';
        dt.textContent=d.getDay()===0?'⚠️ Sunday — please confirm availability.':'Selected: '+fmt;
    } else { di.style.display='none'; document.getElementById('sum-date').textContent='—'; }
    steps(v,document.getElementById('btime').value);
}

function pickTime(t,el){
    document.querySelectorAll('.t-slot').forEach(s=>s.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('btime').value=t;
    const d=new Date('1970-01-01T'+t+':00');
    document.getElementById('sum-time').textContent=d.toLocaleTimeString('en-US',{hour:'2-digit',minute:'2-digit',hour12:true});
    steps(document.getElementById('booking_date').value,t);
}

function filterT(p,btn){
    document.querySelectorAll('.tf-btn').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.t-slot').forEach(s=>s.style.display=(p==='all'||s.dataset.period===p)?'':'none');
}

(function(){
    const d=document.getElementById('booking_date').value;
    const t=document.getElementById('btime').value;
    if(d)onDate(d);
    if(t){const s=document.querySelector(`.t-slot[data-time="${t}"]`);if(s)pickTime(t,s);}
    steps(d,t);
})();

document.getElementById('address').addEventListener('input', function(){
    const v = this.value.trim();
    document.getElementById('sum-address').textContent = v || '—';
});

document.getElementById('phone').addEventListener('input', function(){
    const v = this.value.trim();
    document.getElementById('sum-phone').textContent = v || '—';
});

document.getElementById('bookForm').addEventListener('submit',function(e){
    if(!document.getElementById('booking_date').value||!document.getElementById('btime').value){
        e.preventDefault();alert('Please select a date and time.');
    }
});
</script>
@endsection
