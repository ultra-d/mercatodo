@extends('layout')

@section('title', 'Landing')

@section('content')

@if (session('message'))
	<div>{{ session('message') }}</div>
@endif

<div class="container py-3">

	<div class="form-outline">
			
			<form class="form-inline my-2 my-lg-0 d-flex justify-content-between flex-nowrap" 
			type="get" action="{{ url('/search') }}">
				<input 
					type="search" 
					id="search"
					name="title"
					class="form-control mr-sm-2
					@error('title')
					is-invalid @else border-1
					@enderror" 
					placeholder="{{__('form.products.search_p')}}" 
					aria-label="Search" />
					@error('title')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message}}</strong>
					</span>
					@enderror

					<select class="form-control border-0 bg-light shadow-sm"
					name="category_id" type="search" id="category_id">
						<option value=""> Categoria </option>
						@foreach ($categories as $id => $name)
						<option value="{{ $id }}"> {{ $name }}</option>	
						@endforeach
					</select>
	
			</form>
	</div>
	
	<div class="d-flex justify-content-between align-items-center">
		<h1 class="display-4 mb-0">Products</h1>
	</div>
	
	<div class="d-flex flex-wrap justify-content-between align-items-start ">
		@forelse($products as $product)
		<div class="card border-0 shadow-sm mt-4 mx-auto p-0" style="width: 18rem;">
			@if($product->images->isNotEmpty())
			<div id="carouselExampleControls-{{ $loop->iteration }}" class="carousel slide card-img-top" data-bs-ride="carousel">
				<div class="carousel-inner">
					@foreach($product->images as $image )
						<div @class(['carousel-item', 'landing-img', 'active' => $loop->first])>
							<img src="{{ $image->url() }}" class="d-block w-100" alt="{{ $product->title }}">
						</div>
					@endforeach
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls-{{ $loop->iteration }}" data-bs-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls-{{ $loop->iteration }}" data-bs-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="visually-hidden">Next</span>
				</button>
			  </div>
			@endif

			<div class="card-body">
				<h5 class="card-title">{{ $product->title }}</h5>
				<p class="card-text text-truncate"> {{ $product->description }} </p>
				<h6 class="card-subtitle"> $ {{ $product->price}} </h6>
				<br>
				@if($product->status == false)
				<p>*OUT OF STOCK*</p>
				@endif
				<div class="d-flex justify-content-between align-items-center">
					<span class="badge bg-secondary">
						{{ $product->category ? $product->category->name : '' }}
					</span>
					
					{{-- ADD TO CART ACTION / CART BUTTON--}}
					{{-- <form action="{{ route('shop.cart.store')}} " method="POST">
						@csrf
						<input type="hidden" name="product_id" value="{{ $product->id}}">
						<input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}"
								class="text-sm sm:text-base px-2 pr-2 rounded-lg border 
								border-gray-400 py-1 focus:outline-none focus:border-blue-300"
								style="width: 50px">

						<button type="submit" class="btn border btn-sm fa fa-shopping-cart"> Agregar</button>
					</form> --}}
					{{--ADD CART BUTTON END--}}
					<add-product-button :product='@json($product)'></add-product-button>
				</div>
			</div>
		</div>
		
		@empty
		<div class="card">
			<div class="card-body">
				No hay productos para mostrar
			</div>
		</div>
		@endforelse
	</div>
	<div class="mt-4">
		{{ $products->links() }}
	</div>
</div>
@endsection
