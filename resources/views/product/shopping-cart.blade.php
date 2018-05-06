<?php 
	use Illuminate\Support\Facades\Storage;
?>

@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')

	@if(Session::has('cart'))
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<ul class="list-group">

					@foreach($products as $product)
						<li class="list-group-item">
							<span class="badge badge-secondary">{{ $product['qty'] }}</span>
							<strong>{{ $product['item']['name'] }}</strong>
							<span class="label label-success">{{ $product['price'] }}</span>
							
							<a href="#" class="btn btn-info">Usuń 1 szukę</a>
							<a href="#" class="btn btn-info">Usuń wszystko</a>

								
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<strong>Cena łącznie: {{ $totalPrice }}</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<button type="button" class="btn btn-success">Zamów</button>
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<h2>Nie ma żadnego zamówienia</h2>
			</div>
		</div>
	@endif

@endsection