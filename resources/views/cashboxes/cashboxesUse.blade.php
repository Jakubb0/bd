<?php 
	use Illuminate\Support\Facades\Storage;
	$products = session()->get('cashbox');
	$fuelsList = DB::table('fuels')->get();
?>

@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection


@section('content')

<h1><i class="fas fa-desktop"></i> Kasuj produkty</h1>
<hr>
<div class="col-sm-12">
	    <a href="#" class="menu-link">
			<div class="card menu-bg">
				<div class="card-body center">
					<i class="fas fa-dollar-sign"></i>
					<h5 class="card-title" data-toggle="modal" data-target="#myModal">Dodaj produkt</h5>
				</div>
			</div>
		</a>
</div>
<?php $sum = 0; ?>
<hr>
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
							<td class="productQty">{{$product['qty']}}</td>
							<td>{{number_format($price, 2)}} zł</td>
							<td>{{number_format($t, 2)}} zł</td>	
						</tr>
						</form>

						<?php $sum += $t; ?>
					@endforeach
					<?php echo '<div id="totalValue"><h2>Łączna cena: '. number_format($sum,2) .' zł</h2></div>'; ?>
				</table>
			</div>
		</div>
		<hr>

<script>
	var $this;
	$(document).on("click", ".productQty", function() {
		var currentElementModelAttr = $(this).attr('data-model-attr');
		$this = $(this);
		var input = $('<input>', {
			'type': 'text',
			'name': 'totalQ',
			'class': 'form-control',
			'value': $(this).text()
		});
		$(this).replaceWith(input);
		input.datepicker({
			onSelect: function (date) {
				$this.text(date);
				input.replaceWith($this);
			}
		}).focus()
		$(document).on("blur change", "input", function () {
	        setTimeout(function () {
	            var value = input.val();
	            $this.text(value);
	            input.replaceWith($this);
	        }, 100);
		});
	});
</script>
		
	@else
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<h2>Nie ma żadnego zamówienia</h2>
			</div>
		</div>
	@endif

	<form action="{{route('transactionCashbox')}}" method="post">

			<div class="form-group">
				<h2><i class="fas fa-thermometer-three-quarters"></i> Tankowanie</h2>
				<select id="refueling" name="refueling" class="form-control">
					<optgroup label = "Tankowanie">
			          <option value="1">&#xf00c; Tak</option>
			          <option value="2" selected>&#xf00d; Nie</option>
			        </optgroup>
				</select>
			</div>

			<div id="clientRefueling"></div>

			<hr>
			<div class="form-group">
				<h2><i class="fas fa-address-card"></i> Numer stałego klienta</h2>
				<select id="clientNumber" name="clientNumber" class="form-control">
					<optgroup label = "Numer stałego klienta">
			          <option value="1">&#xf00c; Tak</option>
			          <option value="2" selected>&#xf00d; Nie</option>
			        </optgroup>
				</select>
			</div>

			<div id="clientFormNumber"></div>

			<hr>
			<div class="form-group">
				<h2><i class="fas fa-check-square"></i> Potwierdzenie</h2>
				<select id="category" name="category" class="form-control">
			        <optgroup label = " Wybierz potwiedzenie">
			          <option value="1" selected>&#xf15b; Paragon</option>
			          <option value="2">&#xf15c; Faktura</option>
			        </optgroup>
				</select>
			</div>
			<div id="invoices-new"></div>

		  <button type="submit" class="btn btn-primary">Gotowe</button>
	      <button type="submit" class="btn btn-primary">Wyjdz z kasy</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}">
	      <input type="hidden" name="datatoken" value="<?=date('YmdHis');?>">
	    </form>


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
<?php $fuelType = array(); ?>
@foreach( $fuelsList as $fuel )	
	<?php $fuelType[] = array($fuel); ?>
@endforeach	



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

totalValue = document.getElementById("totalValue"); 

 
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
//------------- REFUELING ----------------------
$('#refueling').change(function() {
	if( $(this).val() == '1' )
	{
		$('#clientRefueling').append('<div id="client-refueling"><h2><i class="fas fa-thermometer-three-quarters"></i> Wybierz dystrybutor</h2><div class="form-group"><select name="distributor" id="distributor" class="form-control"><option value="0" selected></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select><div id="select-distributor"></div></div></div>');
		$('#distributor').change(function () {
			$('#select-distributor').html("");
			<?php 
			for($i = 1; $i < 5; $i ++)
			{
				$s = array_rand($fuelType, 1); 
				$fuelT = $fuelType[$s][0]->type; $fuelP = $fuelType[$s][0]->price; 
			?>
				if( $(this).val() == <?=$i;?> )
				{
					<?php $rand = rand(0,100)/10; ?>
					$('#select-distributor').html('<br><div class="form-group"><input type="text" name="fuelQty" class="form-control fuelQty" placeholder="Ilość paliwa" value="<?php echo $rand .' L, Typ: '. $fuelT .' Cena za litr: '. $fuelP;?>" disabled>Cena łączna: <?php echo number_format(round($rand*$fuelP, 2),2); ?><input type="hidden" name="fuelPrice" value="<?php echo number_format(round($rand*$fuelP, 2),2); ?>"><input type="hidden" name="fuelTypeSelect" value="<?php echo $fuelT; ?>"><input type="hidden" name="fuelPriceSelect" value="<?php echo $fuelP; ?>"><input type="hidden" name="fuelQtySelect" value="<?php echo $rand; ?>"></div>');
					$('#totalValue').html('<h2>Łączna cena: <?=number_format(round($rand*$fuelP, 2),2) + number_format($sum,2);?> zł</h2>');
				}
			<?php
			}
			?>
			else if( $(this).val() == 0 )
			{
				$('#totalValue').html('<h2>Łączna cena: <?=number_format($sum,2);?> zł</h2>');
			}
			
			else
			{
				$('#client-number-select').html("");
			}
		})
	}
	else
	{
		$('#client-refueling').remove();
	}
})
//------------- ADD CLIENT NUMBER --------------
$('#clientNumber').change(function(){
	if( $(this).val() == '1' )
	{
		$('#clientFormNumber').append('<div id="client-number-form"><h2><i class="fas fa-user-plus"></i> Dodaj</h2><div class="form-group invoices-type-select"><select name="clientType" id="clientType" class="form-control"><option value="0" selected></option><option value="1">Nowy klient</option><option value="2">Istniejący klient</option></select><div id="client-number-select"></div></div></div>');
		$('#clientType').change(function () {
			$('#client-number-select').html("");
			if( $(this).val() == "1" )
			{
				$('#client-number-select').html('<br><div class="form-group"><input type="text" name="clientFirstname" class="form-control" placeholder="Imię"></div><div class="form-group"><input type="text" name="clientLastname" class="form-control" placeholder="Nazwisko"></div><div class="form-group"><input type="text" name="clientPhone" class="form-control" placeholder="Numer telefonu"></div><input type="hidden" name="clientCode" value="<?php $d = "12". date('YmdHis'); echo $d;?>">');
			}
			else if ( $(this).val() == "2" )
			{
				$('#client-number-select').html('<br><div class="form-group"><input type="text" id="searchClient" name="searchClient" class="form-control" placeholder="Szukaj klienta"><div id="suggestion-box"></div></div>');
				$("#searchClient").keyup(function(){
					$value=$(this).val();
					$.ajax({
						type :  'get',
						url  :  '{{URL::to('searchNumberClient')}}',
						data :  {'search': $value},
						success:function(data){
								$('#suggestion-box').show();
								$('#suggestion-box').html(data);
						}
					});
				});
				function selectNumberClient(val) {
					$("#searchClient").val(val);
					$("#suggesstion-box").hide();
				}
			}
			else
			{
				$('#client-number-select').html("");
			}
		})
	}
	else
	{
		$('#client-number-form').remove();
	}
})
//------------- ADD INVOICES -------------------
	
$('#category').change(function(){
	if( $(this).val() == '2' )
	{
		$('#invoices-new').append('<div id="invoices-form"><h2><i class="fas fa-user-plus"></i> Dodaj</h2><div class="form-group invoices-type-select"><select name="invoices-type" id="invoices-type" class="form-control"><option value="0" selected></option><option value="1">Osoba prywatna</option><option value="2">Firma</option></select><div id="invoices-data"></div></div></div>');
		$('#invoices-type').change(function () {
			$('#invoices-data').html("");
			var invoicesPlace = '<div class="form-group"><input type="text" name="invoicesNIP" class="form-control" placeholder="NIP"></div><div class="form-row"><div class="form-group col-md-6"><input type="text" name="invoicesPostalCode" class="form-control" placeholder="Kod pocztowy"></div><div class="form-group col-md-6"><input type="text" name="invoicesPlace" class="form-control autocomplete" placeholder="Miejscowość"></div></div><div class="form-row"><div class="form-group col-md-6"><input type="text" name="invoicesStreet" class="form-control" placeholder="Ulica"></div><div class="form-group col-md-6"><input type="text" name="invoicesHouseNumber" class="form-control" placeholder="Nr domu/lokalu"></div></div>'; 
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