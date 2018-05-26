<?php 
	use Illuminate\Support\Facades\Storage;
	$products = session()->get('cashbox');
?>

@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection


@section('content')

<h1><i class="fas fa-desktop"></i> Kasuj produkty</h1>

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
						<form>
						<tr>
							<td>{{$i++}}</td>
							<td>{{$product['item']['name']}}</td>
							<td>{{$product['qty']}}</td>
							<td>{{$price}} zł</td>
							<td>{{$t}} zł</td>	
						</tr>
						</form>

						<?php $sum += $t; ?>
					@endforeach
					<?php echo '<h2>Łączna cena: '. $sum .' zł</h2>'; ?>
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



	<div class="col-sm-12">
	    <form action="{{route('transactionCashbox')}}" method="post">

			<div class="form-group">
				<select id="category" name="category" class="form-control">
			        <optgroup label = "Wybierz potwiedzenie">
			          <option value="1" selected>Paragon</option>
			          <option value="2">Faktura</option>
			        </optgroup>
				</select>
			</div>
			<div id="invoices-new">

			</div>

		  <button type="submit" class="btn btn-primary">Gotowe</button>
	      <button type="submit" class="btn btn-primary">Wyjdz z kasy</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	    <a href="#" class="menu-link">
			<div class="card menu-bg">
				<div class="card-body center">
					<i class="fas fa-dollar-sign"></i>
					<h5 class="card-title" data-toggle="modal" data-target="#myModal">Dodaj produkt</h5>
				</div>
			</div>
		</a>
	</div>


		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div class="card">
							<div class="form-group">
								<input type="text" class="form-control" id="search" name="search">
							</div>

							
								<div id="prod-list">
								</div>
							
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
					</div>

			</div>
		</div>

<script type="text/javascript">
	$('#search').on('keyup', function(){
		$value=$(this).val();
		$.ajax({
			type :  'get',
			url  :  '{{URL::to('searchcashbox')}}',
			data :  {'search': $value},
			success:function(data){
					$('#prod-list').html(data);
			}
		});
	})
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
//------------- ADD PRODUCTS -------------------

	$(document).ready(function(){
		$(".product-list").click(function(){
			$qty = $('#qty').val();
			$.ajax({
				type : 'get',
				url  : '',
				data : {'qty': $qty},
				success:function(data){
					console.log(data);
				}
			});
		});
	});

//------------- ADD INVOICES -------------------
	
$('#category').change(function(){
	if( $(this).val() == '2' )
	{
		$('#invoices-new').append('<div id="invoices-form"><div class="form-group invoices-type-select"><select name="invoices-type" id="invoices-type" class="form-control"><option value="0" selected></option><option value="1">Osoba prywatna</option><option value="2">Firma</option></select><div id="invoices-data"></div></div></div>');

		$('#invoices-type').change(function () {
			$('#invoices-data').html("");

			var invoicesPlace = '<div class="form-group"><input type="text" name="invoicesNIP" class="form-control" placeholder="NIP"></div><div class="form-row"><div class="form-group col-md-6"><input type="text" name="invoicesPostalCode" class="form-control" placeholder="Kod pocztowy"></div><div class="form-group col-md-6"><input type="text" name="invoicesPlace" class="form-control" placeholder="Miejscowość"></div></div><div class="form-row"><div class="form-group col-md-6"><input type="text" name="invoicesStreet" class="form-control" placeholder="Ulica"></div><div class="form-group col-md-6"><input type="text" name="invoicesHouseNumber" class="form-control" placeholder="Nr domu/lokalu"></div></div>'; 

			if ($(this).val() == '1'){
				$('#invoices-data').html('<h2>Osoba prywatna</h2><div class="form-row"><div class="form-group col-md-6"><input type="text" name="invoicesFirstname" class="form-control" placeholder="Imię"></div><div class="form-group col-md-6"><input type="text" name="invoicesLastname" class="form-control" placeholder="Nazwisko"></div></div>'+invoicesPlace);
			}
			else if ($(this).val() == '2'){
				$('#invoices-data').html('<h2>Firma</h2><div class="form-group"><input type="text" name="invoicesCompany" class="form-control" placeholder="Firma"></div>'+invoicesPlace);
			} 
			else {
				$('#invoices-data').html("");
			}
		})
		

	}
	else
	{
		$('#invoices-form').remove();
	}
})
	

</script>




@endsection