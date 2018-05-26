<?php 
	use Illuminate\Support\Facades\Storage;
	$products = session()->get('cashbox');
?>

@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection


@section('content')

<h1><i class="fas fa-desktop"></i> Paragon</h1>

@if(Session::has('cashbox'))


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
					<?php $i=1; 


					$sum = 0;
					?>
					@foreach( $products->items as $product )
						

					<?php
					
					if( $product['item']['vat'] == "8" ) { $price = ($product['item']['price'] * 0.08) + $product['item']['price']; }
					else { $price = ($product['item']['price'] * 0.23) + $product['item']['price']; }

					$t = $price*$product['qty'];

					?>
						<tr>
							<td>{{$i++}}</td>
							<td>{{$product['item']['name']}}</td>
							<td>{{$product['qty']}}</td>
							<td>{{$price}} zł</td>
							<td>{{$t}} zł</td>	
						</tr>

						<?php 
						$sum += $t; 

						?>
					@endforeach
					<?php echo '<h2 class="totalPrice">Łączna cena: '. $sum .' zł</h2>'; ?>
				</table>
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<h2>Nie ma żadnego zamówienia</h2>
			</div>
		</div>
	@endif

	<div class="col-sm-12 print-hidden">
	   
		  <button onclick="printReceipt()" class="btn btn-primary">Drukuj paragon</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />

	      <script>
	      	function printReceipt() {
			    window.print();
			}
	      </script>
	    
	</div>


	<div class="myPrint print-show ">
		<div class="receipt">
			<div class="receipt-center">
				Stacja Benzynowa "CBG" <br>
				33-300 NOWY SĄCZ, <br>
				UL. NAWOJOWSKA 25
			</div>
			<div>
				<?=date("d-m-Y");?>
			</div>
			<hr class="receipt-line">
			<h3 class="receipt-center">PARAGON FISKALNY</h3>
			<hr class="receipt-line">
			<div class="receipt-product">
				<?php $sum = 0; ?>
				@foreach( $products->items as $product )
				
				<?php
				if( $product['item']['vat'] == "8" ) { $price = ($product['item']['price'] * 0.08) + $product['item']['price']; }
					else { $price = ($product['item']['price'] * 0.23) + $product['item']['price']; }

				$t = $price*$product['qty'];
				?>
				

					<div class="receipt-product-list">
						<div class="receipt-product-name">{{$product['item']['name']}}</div>
						<div class="receipt-product-qty">*{{$product['qty']}}</div>
						<div class="receipt-product-price">{{$t}}</div>
					</div>
					<?php $sum += $t; ?>

				@endforeach
			</div>
			<br>
			<hr class="receipt-line">
			<div class="receipt-summary">
				<div class="receipt-sum">Suma PLN</div>
				<div class="totalPrice"><?=$sum;?></div>
			</div>

			<div class="receipt-other">
				<div class="left">Zapłacono</div>
				<div class="right"><?=$sum;?></div>
			</div>

			<div class="receipt-other">
				<div class="left">Sposób zapłaty:</div>
				<div class="right">Gotówka</div>
			</div>

			<div class="receipt-other">
				<div class="left">Obsługujący</div>
				<div class="right"></div>
			</div>
		</div>
	</div>

@endsection