<?php 
	use Illuminate\Support\Facades\Storage;
?>

@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')

<?php $products = DB::table('products')->get(); ?>

<h2><i class="fas fa-shopping-basket"></i> Produkty</h2>
<a href="{{ route('getNewProduct') }}" class="btn btn-info">Nowy produkt</a>
<table class="table">
	<thead class="table-th">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nazwa produktu</th>
			<th scope="col">Zdjęcie</th>
			<th scope="col">Cena netto</th>
			<th scope="col">Stawka VAT</th>
			<th scope="col">Cena brutto</th>
			<th scope="col">Kategoria</th>
		</tr>
	</thead>
	<?php $i = 0; ?>
	@foreach($products as $product => $data)

		<?php
			if( $data->vat == "8" ) { $p = ($data->price * 0.8) + $data->price; }
			else { $p = ($data->price * 0.23) + $data->price; }
			//echo __DIR__ ;
			list($wi,$he)=getimagesize(__DIR__.'/../../../public/images/product/'.($data->image));
			if( $wi>$he ) { $he *= 300/$wi; $wi = 300; }
			else { $wi *= 300/$he; $he = 300; }
		?>
		<tr>
			<td><?php echo ++$i ?></td>
			<td><a href="#" class="edit" data-toggle="modal" data-target="#myModal{{$data->id}}">{{$data->name}}</a></td>
			<td><img src="/images/product/{{ $data->image }}" class="small-icon-product"></td>
			<td>{{$data->price}} zł</td>
			<td>{{$data->vat}}%</td>
			<td>{{round($p,2)}} zł</td>
			<td>{{$data->category}}</td>
			<td><a href="{{ route('product.addToCart', ['id' => $data->id]) }}" class="btn btn-success" role="button">Zamów</a></td>
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
						  <img width="{{$wi}}" height="{{$he}}" style="margin: auto;" src="/images/product/{{ $data->image }}" alt="Card image cap">
						  <div class="card-body">
						    <h5 class="card-title">{{ $data->name }}</h5>
						    <p class="card-text">{{ $data->description }}</p>
						  </div>
						  <ul class="list-group list-group-flush">
						  	<li class="list-group-item"><b>Kategoria: </b> {{ $data->category }}</li>
						    <li class="list-group-item"><b>Cena: </b>{{ round($p,2) }}</li>
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