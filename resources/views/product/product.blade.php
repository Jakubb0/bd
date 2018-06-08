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

	<?php $i = 0; $x = 0; ?>
	

<div class="divTable">
	<div class="divTableBody">
	@foreach($products as $product => $data)

		<?php
			if( $data->vat == "8" ) { $p = ($data->price * 0.08) + $data->price; }
			else { $p = ($data->price * 0.23) + $data->price; }
			
			if( $data->image == '' ) $data->image = 'no-product-image-available.png'; 

			list($wi,$he)=getimagesize(__DIR__.'/../../../public/images/product/'.($data->image));
				if( $wi>$he ) { $he *= 300/$wi; $wi = 300; }
				else { $wi *= 300/$he; $he = 300; }
		?>
			
			
			<div class="divTableRow">
				
				<div class="divTableCell"><?php echo ++$i ?></div>
				<div class="divTableCell"><a href="#" class="edit" data-toggle="modal" data-target="#myModal{{$data->id}}">{{$data->name}}</a></div>
				<div class="divTableCell"><img src="/images/product/{{ $data->image }}" class="small-icon-product"></div>
				<div class="divTableCell">{{$data->price}} zł</div>
				<div class="divTableCell">{{$data->vat}}%</div>
				<div class="divTableCell">{{round($p,2)}} zł</div>
				<div class="divTableCell">{{$data->category}}</div>
				<div class="divTableCell"><form action="{{ route('product.addToCart', ['id' => $data->id]) }}" method="GET"><input type="number" name="qty" id="qty" value="1"><button class="btn btn-success" role="button">Zamów</button></form></div>
				
			</div>
			

	@endforeach
	</div>
</div>
		
 
@foreach($products as $product => $data)

<?php
			if( $data->vat == "8" ) { $p = ($data->price * 0.08) + $data->price; }
			else { $p = ($data->price * 0.23) + $data->price; }
			
			if( $data->image == '' ) $data->image = 'no-product-image-available.png'; 

			list($wi,$he)=getimagesize(__DIR__.'/../../../public/images/product/'.($data->image));
				if( $wi>$he ) { $he *= 300/$wi; $wi = 300; }
				else { $wi *= 300/$he; $he = 300; }
		?>
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
						  <img width="{{$wi}}" height="{{$he}}" style="margin: auto;" src="/images/product/{{ $data->image }}">
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


@endsection