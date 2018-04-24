<?php 
	use Illuminate\Support\Facades\Storage;
?>

@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')

<?php $products = DB::table('products')->get(); ?>

<a href="{{ route('getNewProduct') }}" class="btn btn-info">Nowy produkt</a>

<table class="table">
	<thead class="table-th">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nazwa produktu</th>
			<th scope="col">Zdjęcie</th>
			<th scope="col">Cena</th>
			<th scope="col">Kategoria</th>
		</tr>
	</thead>
	<?php $i = 0; ?>
	@foreach($products as $product => $data)
		
		<tr>
			<td><?php echo ++$i ?></td>
			<td><a href="#" class="edit" data-toggle="modal" data-target="#myModal{{$data->id}}">{{$data->name}}</a></td>
			<td><img src="images/product/{{ $data->image }}" class="small-icon-product"></td>
			<td>{{$data->price}} zł</td>
			<td>{{$data->category}}</td>
		</tr>


		<div class="modal fade" id="myModal{{$data->id}}">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">{{ $data->name }}</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div class="card">
						  <img class="card-img-top image-product-desc" src="{{ $data->image }}" alt="Card image cap">
						  <div class="card-body">
						    <h5 class="card-title">{{ $data->name }}</h5>
						    <p class="card-text">{{ $data->description }}</p>
						  </div>
						  <ul class="list-group list-group-flush">
						  	<li class="list-group-item"><b>Kategoria: </b> {{ $data->category }}</li>
						    <li class="list-group-item"><b>Cena: </b>{{ $data->price }}</li>
						    <li class="list-group-item"><b>Ilość w magazynie: </b> ...</li>
						  </ul>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
					</div>

			</div>
		</div>

	@endforeach
</table>

@endsection