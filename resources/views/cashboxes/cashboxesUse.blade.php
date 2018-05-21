<?php 
	use Illuminate\Support\Facades\Storage;
	$products = session()->get('cashbox');
	//dd($products['item']['name']);
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
					<?php $i=0; ?>
					@foreach($products as $product)

						<tr>
							<td>{{$i++}}</td>
							<td>{{$product[$i]['item']['name']}}</td>
							<td>{{$product[$i]['qty']}}</td>
							<td>{{$product[$i]['item']['price']}} zł</td>
							<td>{{$product[$i]['price']}} zł</td>
							
						</tr>
					@endforeach
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
	        <label for="product">Produkty</label>
	        <input type="text" class="form-control" name="product" id="product">
	      </div>

			<select id="category" name="category" class="myCategory select-s">
		        <optgroup label = "Wybierz potwiedzenie">
		          <option value="receipt" selected>Paragon</option>
		          <option value="invoice">Faktura</option>
		        </optgroup>
			</select>

		  <button type="submit" class="btn btn-primary">Gotowe</button>
	      <button type="submit" class="btn btn-primary">Wyjdz z kasy</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	    <a href="#" class="menu-link">
			<div class="card menu-bg">
				<div class="card-body center">
					<i class="fas fa-dollar-sign"></i>
					<h5 class="card-title" data-toggle="modal" data-target="#myModal">Sprawdź cenę</h5>
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

							<table>
								<thead>
									<tr>
										<th>ID</th>
										<th>Nazwa</th>
										<th>Cena</th>
										<th>Ilość</th>
									</tr>

						  </div>
								</thead>
								<tbody>
								</tbody>
							</table>
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
					$('tbody').html(data);
			}
		});
	})
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>







@endsection