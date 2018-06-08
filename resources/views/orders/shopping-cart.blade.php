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

			<div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3">
				<table class="table table-hover">
					<thead class="table-th">
						<tr>	
							<th>#</th>
							<th>Nazwa produktu</th>
							<th>Ilość</th>
							<th>Cena</th>
							<th>Łączna cena</th>
							<th></th>
						</tr>
					</thead>
					<?php $i = 1;  $ttl = 0; ?>
					@foreach($products as $product)
						<tr>
							<td>{{$i++}}</td>
							<td>{{$product['item']['name']}}</td>
							<td>{{$product['qty']}}</td>
							<td>{{$product['item']['price']}} zł</td>
							<td>{{$product['price']}} zł</td>
						</tr>

						<?php $ttl += $product['item']['price']*$product['qty']; ?>
					@endforeach
				</table>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<strong>Cena łącznie: {{ $ttl }} zł</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">

				

				<form action="{{route('product.order')}}" method="get">
					<button type="submit" name="test" value="1" class="btn btn-success">Zamów</button>
				</form>

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