<?php 
	use Illuminate\Support\Facades\Storage;
	use App\NumberInWords;
	$products = session()->get('cashbox');
?>
 
@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')

<h1><i class="fas fa-desktop"></i> Faktura</h1>

<?php $i=1; $sum = 0;?>

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

@if(Session::has('cashbox'))
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
			<td>{{number_format(round($price, 2),2)}} zł</td>
			<td>{{number_format(round($t, 2),2)}} zł</td>	
		</tr>

		<?php $sum += $t; ?>
	@endforeach	
@endif					
			<?php
				if( isset($_POST['fuelPrice']) )
				{
					$fPrice = number_format(round($_POST['fuelQtySelect'] * (($_POST['fuelPriceSelect'] * 0.23) + $_POST['fuelPriceSelect']), 2),2);
					$fPriceVat = ($_POST['fuelQtySelect'] * $_POST['fuelPriceSelect']) + $_POST['fuelPriceSelect'];
					echo '
						<tr>
							<td>'. $i++ .'</td>
							<td>Paliwo: '. $_POST['fuelTypeSelect'] .'</td>
							<td>'. number_format(round($_POST['fuelQtySelect'], 2),2) .' l</td>
							<td>'. $_POST['fuelPriceSelect'] .' zł</td>
							<td>'. $fPrice .' zł</td>
						</tr>
					';
				}
				else $fPrice = 0;

				$allPrice = number_format(round($sum + $fPrice, 2),2);
				echo '<h2 class="totalPrice">Łączna cena: '. $allPrice .' zł</h2>'; 

				?>
		</table>
	</div>
</div>

<div class="col-sm-12 print-hidden">
	  <button onclick="printReceipt()" class="btn btn-primary">Drukuj fakturę</button>
      <input type="hidden" name="_token" value="{{ Session::token() }}" />

      <a href="{{ route('cashbox.back') }}" class="btn btn-primary">Powrót do kasy</a>

@if(isset($_POST['clientCode'] ))
	<div class="clientCode"><?=$_POST['clientCode'];?></div>
	<button onclick="printClientCode()" id="printCode" class="btn btn-primary">Drukuj kod klienta</button>
@endif
<script>
	function printReceipt() {
	    window.print();
	}

	$("#printCode").click(function() {
		printcontent($(".clientCode").html());
	});

	function printcontent(content)
	{
		var mywindow = window.open('', '', '');
	    mywindow.document.write('<html><title>Print</title><body><div style="text-align: center;><img src="https:////www.barcoding.com//wp-content//uploads//2016//09//Picture-111.png" alt="kod kreskowy"><br>');
	    mywindow.document.write(content);
	    mywindow.document.write('</body></html>');
	    mywindow.document.close();
	    mywindow.print();
	    return true;
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
			<h2 class="invoice-center">FAKTURA VAT nr <br><?=date("YmdHis");?></h2>
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
						$invoicesName = $_POST['invoicesCompany'];
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

					<?=$invoicesName;?><br>
					<?=$invoicesPostalCode;?> <?=$invoicesPlace;?><br>
					<?=$invoicesStreet;?> <?=$invoicesHouseNumber;?><br>
					NIP <?=$invoicesNIP;?>

				</div>
			</div>
			
			<div class="invoice-product-list">
				<table class="table invoice-print">
							
					<thead>
						<tr>
							<th>#</th>
							<th>Nazwa towary</th>
							<th>Ilość</th>
							<th>J.m.</th>
							<th>Rabat %</th>
							<th>Cena Netto</th>
							<th>Wartość netto</th>
							<th>Stawka VAT</th>
							<th>Wartość VAT</th>
							<th>Wartość Brutto</th>
						</tr>
					</thead>
					<tbody>
					<?php $invoiceNetto = $vatPrice = $invoiceBrutto = 0; $i = 1;?>
						@if(Session::has('cashbox'))	
							@foreach( $products->items as $product )

							<?php
								if( $product['item']['vat'] == "8" ) { $price = ($product['item']['price'] * 0.08) + $product['item']['price'];}
								else { $price = ($product['item']['price'] * 0.23) + $product['item']['price']; }

								$productNetto = $product['item']['price'] * $product['qty'];

								if( $product['item']['vat'] == "8" ) { $productVAT = $productNetto * 0.08;}
								else { $productVAT = $productNetto * 0.23; }

								$productBrutto = $price * $product['qty'];

								$invoiceNetto += $productNetto;
								$vatPrice += $productVAT;
								$invoiceBrutto += $productBrutto;
								
							?>
								<tr>
									<td>{{$i++}}</td>
									<td class="td-left">{{$product['item']['name']}}</td>
									<td>{{$product['qty']}}</td>
									<td>szt.</td>
									<td>0,00%</td>
									<td>{{$product['item']['price']}} zł</td>
									<td>{{number_format(round($productNetto, 2),2)}} zł</td>
									<td>{{$product['item']['vat']}}%</td>
									<td>{{number_format(round($productVAT, 2),2)}} zł</td>
									<td>{{number_format(round($productBrutto, 2),2)}} zł</td>
								</tr>
							@endforeach
						@endif
						<?php
							if( isset($_POST['fuelPrice']) )
							{
						
								$tPrice = number_format(round(($_POST['fuelPriceSelect'] * 0.23) +  $_POST['fuelPriceSelect'], 2),2);
								$fuelPriceNetto = number_format(round($_POST['fuelQtySelect']*$_POST['fuelPriceSelect'], 2),2);
								$fuelPriceBrutto = number_format(round($_POST['fuelQtySelect'] * ( ($_POST['fuelPriceSelect'] * 0.23) + $_POST['fuelPriceSelect']), 2),2);
								$fuelVAT = $fuelPriceNetto * 0.23;
								echo '
									<tr>
										<td class="td-center">'. $i++ .'</td>
										<td class="td-left">Paliwo: '. $_POST['fuelTypeSelect'] .'</td>
										<td>'. number_format(round($_POST['fuelQtySelect'], 2),2) .'</td>
										<td>l</td>
										<td>0,00%</td>
										<td>'. $_POST['fuelPriceSelect'] .' zł</td>
										<td>'. $fuelPriceNetto .' zł</td>
										<td>23%</td>
										<td>'. number_format(round($fuelVAT, 2),2) .' zł</td>
										<td>'. $fuelPriceBrutto .' zł</td>
									</tr>
								';
							}
							else { $fuelPriceBrutto = 0; $fuelVAT = 0; $fuelPriceNetto = 0; }

						?>
						<?php 
							$allBrutto = number_format(round($invoiceBrutto + $fuelPriceBrutto, 2),2);
							if( $products != null ) $pVAT = $product['item']['vat']; else $pVAT = "23";
							$vatPrice = number_format(round($vatPrice + $fuelVAT, 2),2);
							$allNetto = number_format(round($invoiceNetto + $fuelPriceNetto, 2), 2);
						?>
							<tr>
								<td colspan="6" class="td-right"><b>Razem: </b></td>
								<td>{{$allNetto}} zł</td>
								<td>{{$pVAT}}%</td>
								<td>{{$vatPrice}} zł</td>
								<td>{{$allBrutto}} zł</td>
							</tr>

							<tr>
								<td colspan="6"></td>
								<td>{{$allNetto}} zł</td>
								<td>{{$pVAT}}%</td>
								<td>{{$vatPrice}} zł</td>
								<td>{{$allBrutto}} zł</td>
							</tr>

							<tr>
								<td colspan="6" class="td-right"><b>Ogółem: </b></td>
								<td>{{$allNetto}} zł</td>
								<td>XX</td>
								<td>{{$vatPrice}} zł</td>
								<td>{{$allBrutto}} zł</td>
							</tr>
					</tbody>

				</table>
			</div>

<?php
echo '<b>Sposób zapłaty: </b> gotówka <br>
	  <b>Należność ogółem: </b>'. $allBrutto .' zł <br>
	  <b>Słownie: </b>'. NumberInWords::amountToWords($allBrutto) . PHP_EOL;
?>
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