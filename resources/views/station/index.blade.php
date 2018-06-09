@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')


@if(DB::table('pracownicy')->where('id', Auth::id())->pluck('status')[0]=='kierownik')

<?php $loyal = DB::table('fuels')->get(); ?>

@foreach ($loyal as $i => $data) 
<h2>{{$data->type}}</h2>
<div class="progress" style="width:300px;">
@if ($data->amount > 2500)
<div class="progress-bar progress-bar-animated bg-success" style="width:{{$data->amount/50}}%"></div>
</div>
@elseif ($data->amount < 500)
<div class="progress-bar progress-bar-animated bg-danger" style="width:{{$data->amount/50}}%"></div>
</div>
@else
<div class="progress-bar progress-bar-animated bg-warning" style="width:{{$data->amount/50}}%"></div>
</div>
@endif
@endforeach
	
	@else
	<div class="row">
		<div class="col-sm-12 small-card-menu">
			<a href="{{route('selectCashbox')}}" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-cart-arrow-down"></i>
						<h5 class="card-title">Kasa</h5>
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 small-card-menu">
			<a href="{{ route('getProductCash') }}" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-shopping-basket"></i>
						<h5 class="card-title">Produkty</h5>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-6 small-card-menu">
			<a href="#" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-dollar-sign"></i>
						<h5 class="card-title" data-toggle="modal" data-target="#myModal">Sprawdź cenę</h5>
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 small-card-menu">
			<a href="{{route('loyalView')}}" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-id-card"></i>
						<h5 class="card-title">Numer stałego klienta</h5>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-6 small-card-menu">
			<a href="{{route('viewInvoices')}}" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-file-alt"></i>
						<h5 class="card-title">Faktury</h5>
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="row">


		<div class="col-sm-12 small-card-menu">
			<a href="#" class="menu-link" id="call">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-male"></i>
						<h5 class="card-title">Wezwij kierownika</h5>
					</div>
				</div>
			</a>
		</div>

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
									</tr>
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
			url  :  '{{URL::to('search')}}',
			data :  {'search': $value},
			success:function(data){
					$('tbody').html(data);
			}
		});
	})

	$('#call').on('click', function(){
		$value=1;
		$.ajax({
			type :  'get',
			url  :  '{{URL::to('call')}}',
			data :  {'call': $value},
			success:function(data){
					$('#call').html(data);
			}
		});
	})

 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>
	@endif
@endsection