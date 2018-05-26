<?php 
	use Illuminate\Support\Facades\Storage;
	$products = session()->get('cashbox');
?>

@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection


@section('content')

<h1><i class="fas fa-desktop"></i> Faktura</h1>

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
	@endif

	<div class="col-sm-12 print-hidden">
	   
		  <button onclick="printReceipt()" class="btn btn-primary">Drukuj fakturę</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />

	      <script>
	      	function printReceipt() {
			    window.print();
			}
	      </script>
	    
	</div>


	<div class="myPrint print-show ">
		<div class="invoice">
			<div class="invoice-view">
				<div class="invoice-data">
					<b>Miejsce wystawienia: Nowy Sącz</b><br>
					<b>Data wystawienia: <?=date("Y-m-d");?></b>
				</div>
				<h2 class="invoice-center">Faktura nr <?=date("YmdHis");?></h2>
				<div class="invoice-date">
					<div class="invoice-left-bar">
						<h3 class="invoice-center">Sprzedawca</h3>
						<hr>
						STACJA BENZYNOWA "CBG" <br>
						33-300 NOWY SĄCZ <br>
						UL. NAWOJOWSKA 25
					</div>
					<div class="invoice-right-bar">
						<h3 class="invoice-center">Nabywca</h3>
						<hr>
						<?php 
						if( isset($_POST['invoicesCompany']) ) {
							$invoicesName = $_POST['invoiceCompany'];
						}
						elseif( (isset($_POST['invoicesFirstname'])) AND (isset($_POST['invoicesLastname'])) )
						{
							$invoicesName = $_POST['invoicesFirstname'] .' '. $_POST['invoicesLastname'];
						}

						$invoicesPostalCode = $_POST['invoicesPostalCode'];
						$invoicesPlace = $_POST['invoicesPlace'];
						$invoicesStreet = $_POST['invoicesStreet'];
						$invoicesHouseNumber = $_POST['invoicesHouseNumber'];
						$invoicesNIP = $_POST['invoicesNIP'];


						?>

						<?=$invoicesName;?> <br>
						<?=$invoicesPostalCode;?> <?=$invoicesPlace;?> <br>
						<?=$invoicesStreet;?> <?=$invoicesHouseNumber;?> <br>
						NIP <?=$invoicesNIP;?>



					</div>
				</div>
				
				<div class="invoice-product-list">
					<table class="table">
								
						<thead>
							<tr>
								<th>#</th>
								<th>Towar / Usługa</th>
								<th>Ilość</th>
								<th>J.m.</th>
								<th>Rabat %</th>
								<th>Cena Netto</th>
								<th>VAT %</th>
								<th>Wartość VAT</th>
								<th>Cena Brutto</th>
							</tr>
						</thead>
						<tbody>
							<?php $invoiceTotalPrice = $invoiceTotalVat = $invoiceTotalPriceNOVAT = 0; $i = 1;?>
							@foreach( $products->items as $product )

							<?php
								if( $product['item']['vat'] == "8" ) { $price = ($product['item']['price'] * 0.08) + $product['item']['price']; }
									else { $price = ($product['item']['price'] * 0.23) + $product['item']['price']; }

								$invoiceTotalPrice = $price*$product['qty'];

								$vatPrice = $price-$product['item']['price'];
								$invoiceTotalVat += $vatPrice;


								$invoiceTotalPriceNOVAT += $product['item']['price']*$product['qty'];

							?>


								<tr>
									<td>{{$i++}}</td>
									<td>{{$product['item']['name']}}</td>
									<td>{{$product['qty']}}</td>
									<td>szt.</td>
									<td>0,00%</td>
									<td>{{$product['item']['price']}} zł</td>
									<td>{{$product['item']['vat']}}%</td>
									<td>{{$vatPrice}} zł</td>
									<td>{{$price}} zł</td>
								</tr>
								<?php $invoiceTotalPrice += $t; ?>
							@endforeach
								<tr>
									<td colspan="5" class="td-right"><b>Razem: </b></td>
									<td>{{$invoiceTotalPriceNOVAT}} zł</td>
									<td>{{$product['item']['vat']}}%</td>
									<td>{{$vatPrice}} zł</td>
									<td>{{$invoiceTotalPrice}} zł</td>
								</tr>

								<tr>
									<td colspan="5"></td>
									<td>{{$invoiceTotalPriceNOVAT}} zł</td>
									<td>{{$product['item']['vat']}}%</td>
									<td>{{$vatPrice}} zł</td>
									<td>{{$invoiceTotalPrice}} zł</td>
								</tr>

								<tr>
									<td colspan="5" class="td-right"><b>Ogółem: </b></td>
									<td>{{$invoiceTotalPriceNOVAT}} zł</td>
									<td>XX</td>
									<td>{{$vatPrice}} zł</td>
									<td>{{$invoiceTotalPrice}} zł</td>
								</tr>
						</tbody>

					</table>
				</div>

				<div class="invoice-date signature">
					<div class="invoice-left-bar">
						<hr>
						<h3 class="invoice-center">Podpis Sprzedawcy</h3>
					</div>

					<div class="invoice-right-bar">
						<hr>
						<h3 class="invoice-center">Podpis Kupującego</h3>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection