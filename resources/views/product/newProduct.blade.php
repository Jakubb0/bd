@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')

<form action="{{ route('postNewProduct') }}" method="POST">
	
	<div class="form-group">
		<label for="name">Nazwa produktu: </label>
		<input type="text" name="name" id="name" class="form-control" placeholder="Nazwa produktu">
	</div>

	<div class="form-group">
		<label for="price">Cena: </label>
		<input type="text" name="price" id="price" class="form-control" placeholder="Cena produktu">
	</div>

	<div class="form-group">
		<label for="category">Kategoria: </label>
		<input type="text" name="category" id="category" class="form-control" placeholder="Cena produktu">
	</div>

	<div class="form-group">
		<label for="description">Opis produktu: </label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<label for="image">Zdjęcie produktu: </label>
		<input type="text" name="image" id="image" class="form-control" placeholder="Zdjęcie produktu">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success">Dodaj produkt!</button>
	</div>
	<input type="hidden" value="{{ Session::token() }}" name="_token">
</form>

@endsection