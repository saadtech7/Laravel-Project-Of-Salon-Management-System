<!DOCTYPE html>
<html>
<head>
	<title>Salon Prime — Grafreez</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!-- bootstrap Style CSS File -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<!-- Custom Style CSS File -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom-style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/loaders.css') }}"/>
<!-- Font-Awesome Style CSS File -->
<link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
<body>

<!-- Page loading animation -->
<div class="loader loader-bg">
	<div class="loader-inner ball-pulse">
		<div></div>
		<div></div>
		<div></div>
	</div>
</div>

<!-- Top navigation -->
<nav class="navbar navbar-expand-md fixed-top top-nav">
	<div class="container-fluid">
		  <a class="navbar-brand" href="/"><strong>Grafreez</strong></a>
		  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"><img src="img/icons/menu.png"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav m-auto text-sm-center text-md-center">
		      <li class="nav-item">
		        <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#services">Services</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#about">About</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#price">Prices</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#testimonial">Testimonials</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#contact">Contact</a>
		      </li>
		    </ul>
		  </div>	
		  <ul class="navbar-nav ml-auto search-box">
		    @auth
		    <li class="nav-item">
		      <span class="nav-link text-white">Welcome, {{ auth()->user()->name }}</span>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="/dashboard"><i class="fa fa-tachometer text-white" title="Dashboard"></i></a>
		    </li>
		    <li class="nav-item">
		      <form method="POST" action="{{ route('logout') }}" class="d-inline">
		        @csrf
		        <button type="submit" class="btn btn-link nav-link text-white p-0" style="border: none; background: none;">
		          <i class="fa fa-sign-out" title="Sign Out"></i>
		        </button>
		      </form>
		    </li>
		    @endauth
		  </ul>
	</div>
</nav>

<!-- Intro Three -->
<section id="home" class="intro intro-bg bg-overlay parallax">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 caption-two-panel ml-auto pt-5">
				<div class="intro-caption mt-5">
				@auth
				<div class="user-info mb-3">
					<h3 class="text-white">Welcome back, {{ auth()->user()->name }}!</h3>
					<p class="text-white-50">Role: {{ ucfirst(auth()->user()->role) }}</p>
				</div>
				@endauth
				<h1 class="text-white mb-2">Look Sharp. Feel Confident. Every Time.</h1>
				<p class="text-white mb-4">Step into our barbershop and experience grooming the way it should be — precise, professional, and tailored just for you.</p>
				@auth
				<a href="/dashboard" class="btn btn-primary text-white mr-3">Go to Dashboard</a>
				<form method="POST" action="{{ route('logout') }}" class="d-inline">
					@csrf
					<button type="submit" class="btn btn-outline-light text-white">Sign Out</button>
				</form>
				@else
				<a href="{{ route('services.index') }}" class="btn btn-primary text-white mr-3">Explore More</a>
				@endauth
			</div>
		</div>
	</div>
</section>

<!-- Info block 1 -->
<section id="services" class="info-section text-white bg-right bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="head-box">
					<h2 class="font-abril">Services We offered!</h2>
				</div>
				<div class="three-panel-block mt-5">
					<div class="row">
						@foreach(\App\Models\Service::where('is_active', true)->get() as $service)
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
							$isWomen = $service->category === 'women';
							$iconBg = $isWomen ? 'linear-gradient(135deg,#be185d,#f472b6)' : 'linear-gradient(135deg,#1e40af,#3b82f6)';
						@endphp
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="service-block mb-5">
								<i class="icon-box mb-3 float-left w-100">
									<span style="display:inline-flex;align-items:center;justify-content:center;width:70px;height:70px;border-radius:16px;background:{{ $iconBg }}">
										<i class="fa {{ $faIcon }}" style="color:white;font-size:1.8rem"></i>
									</span>
								</i>
								<h3 class="text-primary">{{ $service->name }}</h3>
								<p>{{ $service->description }}</p>
								<p class="text-primary"><strong>${{ number_format($service->price,2) }} &bull; {{ $service->duration }} min</strong></p>
								@auth
									<a href="{{ route('services.book', $service) }}" class="btn btn-primary btn-sm">Book Now</a>
								@else
									<a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login to Book</a>
								@endauth
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Content block 1 -->
<section id="about" class="copy-content-sec sec-bg-02 h-100">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-12 copy-container ml-auto">
				<div class="copy-content pr-4">
					<h2 class="font-abril text-primary">
						Who We Are
					</h2>
					<p class="lead ml-2">
						We are a premium barbershop dedicated to delivering top-quality grooming experiences for every client who walks through our doors.
					</p>
					<p class="ml-2">
						With years of expertise and a passion for the craft, our skilled barbers combine traditional techniques with modern styles to give you a look that's uniquely yours. Whether you're after a sharp haircut, a clean shave, or a full grooming session, we take pride in making you feel confident and refreshed every single visit.
					</p>
					<p class="mt-4 ml-2">
						<a href="#contact" class="text-primary">Get In Touch</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Info block 2 -->
<section id="price" class="info-section sec-bg-03 bg-overlay">
	<div class="container text-white">
		<div class="head-box text-center mb-5">
			<h2 class="font-abril">Our Jaw Drop Prices</h2>
		</div>
		<div class="three-panel-block my-4">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 pl-md-5 mb-4">
					<div class="service-block-bg text-center p-3">
						<div class="price-count font-abril"><span>$</span>39</div>
						<h3>Haircut</h3>
						<p class="px-4">A clean, precise cut styled to suit your face shape and personal taste.</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 pr-md-5 mb-4">
					<div class="service-block-bg text-center p-3">
						<div class="price-count font-abril"><span>$</span>27</div>
						<h3>Shave</h3>
						<p class="px-4">A smooth, traditional straight-razor shave for a fresh and polished finish.</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 pl-md-5 mb-4">
					<div class="service-block-bg text-center p-3">
						<div class="price-count font-abril"><span>$</span>20</div>
						<h3>Moustache</h3>
						<p class="px-4">Expert shaping and trimming to keep your moustache neat and well-defined.</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 pr-md-5">
					<div class="service-block-bg text-center p-3">
						<div class="price-count font-abril"><span>$</span>15</div>
						<h3>Beard Trim</h3>
						<p class="px-4">Sculpted beard grooming to keep your look sharp, clean, and on point.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- Testimonial Block 01-->
<section id="testimonial" class="testimonial-section sec-bg-04 py-5 h-100">
	<div class="container">
		<div class="row">
			<div class="head-box text-center mb-3 col-md-12 mt-5">
				<h2 class="font-abril">What Our Clients Says About Us</h2>
			</div>
		</div>
		<div class="single-testimonial">
		  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		    <div class="carousel-inner pt-5" role="listbox">
		      <div class="carousel-item active">
		        <div class="testimonial-box text-center">
					<div class="testimonial-content w-100 bg-faded">
						<p class="mb-0"><i class="fa fa-quote-left fa-3x" aria-hidden="true"></i></p>
						<p class="lead font-abril">"Hands down the best barbershop I've ever been to. The attention to detail is incredible and the atmosphere is top notch. I leave feeling like a new man every single time."</p>
						<div class="testimonial-footer">
							<h4 class="mt-2 mb-0 text-primary">Gerald Montgomery</h4>
							<p>- New York, United States</p>
						</div>
					</div>
				</div>
		      </div>
		      <div class="carousel-item">
		        <div class="testimonial-box text-center">
					<div class="testimonial-content w-100 bg-faded">
						<p class="mb-0"><i class="fa fa-quote-left fa-3x" aria-hidden="true"></i></p>
						<p class="lead font-abril">"I've been coming here for over a year and I wouldn't go anywhere else. The barbers really listen to what you want and always deliver. Highly recommend to anyone who takes their grooming seriously."</p>
						<div class="testimonial-footer">
							<h4 class="mt-2 mb-0 text-primary">Harper Robertson</h4>
							<p>- California, United States</p>
						</div>
					</div>
				</div>
		      </div>
		    </div>
		    <div class="navigator-box">
		    	<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
			      <span class="fa fa-angle-left" aria-hidden="true"></span>
			      <span class="sr-only">Previous</span>
			    </a>
			    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
			      <span class="fa fa-angle-right" aria-hidden="true"></span>
			      <span class="sr-only">Next</span>
			    </a>
		    </div>
		  </div>
		</div>
	</div>
</section>

<!-- Contact Block -->
<section id="contact" class="contact-section h-100 bg-dark">
	<div id="map" class="bg-overlay" style="background:linear-gradient(135deg,#1a1a2e,#16213e);min-height:300px;display:flex;align-items:center;justify-content:center;">
		<div style="text-align:center;color:rgba(255,255,255,0.4)">
			<i class="fa fa-map-marker fa-3x mb-2"></i>
			<p style="margin:0;font-size:0.9rem">123 Main Street, New York, NY 10001</p>
		</div>
	</div>
	<div class="container py-5">
		<div class="col-lg-8 col-md-6 col-sm-10 form-sec bg-white my-5 p-5 mx-auto">

			@if(session('contact_success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="fa fa-check-circle me-2"></i>{{ session('contact_success') }}
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				</div>
			@endif

			<form method="POST" action="{{ route('contact.store') }}">
			  @csrf
			  <h2 class="mb-4">Contact Us!</h2>

			  @if($errors->any())
				<div class="alert alert-danger">
					@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
				</div>
			  @endif

			  <div class="row">
			  	<div class="col-md-6">
					<div class="form-group">
						<label class="sr-only" for="contact_name">Full Name</label>
						<input class="form-control" id="contact_name" name="name"
							placeholder="Full Name" type="text"
							value="{{ old('name') }}"
							onfocus="this.placeholder=''" onblur="this.placeholder='Full Name'" required>
					</div>
			  	</div>
			  	<div class="col-md-6">
					<div class="form-group">
						<label class="sr-only" for="contact_phone">Phone Number</label>
						<input class="form-control" id="contact_phone" name="phone"
							placeholder="Phone Number" type="text"
							value="{{ old('phone') }}"
							onfocus="this.placeholder=''" onblur="this.placeholder='Phone Number'" required>
					</div>
			  	</div>
			  </div>
			  <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="sr-only" for="contact_email">Email Address</label>
						<input class="form-control" id="contact_email" name="email"
							placeholder="Email Address" type="email"
							value="{{ old('email') }}"
							onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="sr-only" for="contact_address">Address</label>
						<input class="form-control" id="contact_address" name="address"
							placeholder="Enter Address" type="text"
							value="{{ old('address') }}"
							onfocus="this.placeholder=''" onblur="this.placeholder='Enter Address'">
					</div>
				</div>
			  </div>
			  <div class="row">
			  	<div class="col-md-12">
					<div class="form-group">
						<label class="sr-only" for="contact_message">Message</label>
						<textarea class="form-control" id="contact_message" name="message"
							placeholder="Enter your message here!" rows="4"
							onfocus="this.placeholder=''" onblur="this.placeholder='Enter your message here!'" required>{{ old('message') }}</textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-capsul px-4">Submit</button>
					</div>
			  	</div>
			  </div>
		  </form>
		</div>
	</div>
</section>

<!-- footer Block -->
<div class="copy-footer bg-primary py-2">
	<div class="container text-center text-light">
		&copy; Salon Prime <span id="year"></span>. All rights reserved.
	</div>
</div>



<!-- Javascript Files  -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/core.js') }}"></script>
</body>
</html>
