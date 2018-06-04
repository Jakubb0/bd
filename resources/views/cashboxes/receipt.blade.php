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
								<td>{{$price}} zł</td>
								<td>{{$t}} zł</td>	
							</tr>

							<?php 
							$sum += $t; 

							?>
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
					?>
					<?php 
						$allPrice = number_format(round($sum + $fPrice, 2),2);
						echo '<h2 class="totalPrice">Łączna cena: '. $allPrice .' zł</h2>'; 
					?>
				</table>
			</div>
		</div>
	
	

	<div class="col-sm-12 print-hidden">
	   
		  <button onclick="printReceipt()" class="btn btn-primary">Drukuj paragon</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
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
				@if(Session::has('cashbox'))
				@foreach( $products->items as $product )
				
				<?php
				if( $product['item']['vat'] == "8" ) { $price = ($product['item']['price'] * 0.08) + $product['item']['price']; }
					else { $price = ($product['item']['price'] * 0.23) + $product['item']['price']; }

				$t = $price*$product['qty'];
				?>
				

					<div class="receipt-product-list">
						<div class="receipt-product-name">{{$product['item']['name']}}</div>
						<div class="receipt-product-qty">*{{$product['qty']}}</div>
						<div class="receipt-product-price">{{number_format(round($t, 2),2)}}</div>
					</div>
					<?php $sum += $t; ?>

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
						<div class="receipt-product-list">
								<div class="receipt-product-name">Paliwo: '. $_POST['fuelTypeSelect'] .'</div>
								<div class="receipt-product-qty">*'. number_format(round($_POST['fuelQtySelect'], 2),2) .'</div>
								<div class="receipt-product-price">'. $fuelPriceBrutto .'</div>
							</tr>
						</div>
						';
					}
					else { $fuelPriceBrutto = 0; $fuelVAT = 0; $fuelPriceNetto = 0; }
				?>
				<?php $sum = number_format(round($sum + $fuelPriceBrutto, 2), 2); ?>
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