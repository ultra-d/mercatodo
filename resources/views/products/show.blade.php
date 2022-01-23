@extends('layout')

@section('title', 'Portfolio' . $product->title)

@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-8 mx-auto">
			@if($product->image)
				<img class="card-img-top" src="/storage/{{ $product->image }}" alt="{{ $product->title }}">
			@endif
			
			<div class="bg-white p-5 shadow rounded">
				<h1>{{ $product->title }}</h1>
				<p>{{ $product->description }}</p>
				<p>{{ $product->created_at->diffForHumans() }}</p>
				
				<div class="d-flex justify-content-between align-items-center">
					<a href="{{ route('products.index') }}">Regresar</a>
					
					<div class="btn-group btn-group-sm">
						<a class="btn btn-primary" href="{{ route('products.edit', $product) }}">Editar</a>
						<a class="btn btn-danger"
						href="#"
						onclick="document.getElementById('delete-product').submit()"> Eliminar </a>
						
					</div>
					<form id="delete-product" class="d-none" method="POST" action="{{ route('products.destroy', $product) }}">
						@csrf @method('DELETE')
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>

@endsection