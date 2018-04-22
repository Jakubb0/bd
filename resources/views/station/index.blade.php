
@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')


@if(DB::table('pracownicy')->where('id', Auth::id())->pluck('status')[0]=='kierownik')

	
	@else
	<div class="row">
		<div class="col-sm-12 small-card-menu">
			<a href="#" class="menu-link">
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
			<a href="{{ route('getProduct') }}" class="menu-link">
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
						<h5 class="card-title">Sprawdź cenę</h5>
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 small-card-menu">
			<a href="#" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-id-card"></i>
						<h5 class="card-title">Numer stałego klienta</h5>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-6 small-card-menu">
			<a href="#" class="menu-link">
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

		<div class="col-sm-6 small-card-menu">
			<a href="#" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-shipping-fast"></i>
						<h5 class="card-title">Zamówienia</h5>
					</div>
				</div>
			</a>
		</div>


		<div class="col-sm-6 small-card-menu">
			<a href="#" class="menu-link">
				<div class="card menu-bg">
					<div class="card-body center">
						<i class="fas fa-male"></i>
						<h5 class="card-title">Wezwij kierownika</h5>
					</div>
				</div>
			</a>
		</div>

	</div>
	@endif
@endsection