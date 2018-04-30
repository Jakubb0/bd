@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')

<h1>Dodaj nowy produkt</h1>

<form action="{{ route('postNewProduct') }}" method="POST" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="name">Nazwa produktu: </label>
		<input type="text" name="name" id="name" class="form-control" placeholder="Nazwa produktu" required>
	</div>

	<div class="form-group">
		<label for="price">Cena: </label>
		<input type="text" name="price" id="price" class="form-control" placeholder="Cena produktu" required>
	</div>

	<div class="form-group">
		<label for="category">Kategoria: </label>
		<select name="category" id="category" class="form-control">
			<option value="Napój">Napój</option>
			<option value="Czekolada">Czekolada</option>
			<option value="Inne">Inne</option>
		</select>
	</div>
	
	<div class="form-group">
		<label for="description">Opis produktu: </label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
	</div>

	<div class="form-group">
		<label for="image">Zdjęcie produktu: </label>
		<input type="file" name="file" id="image" class="form-control">
	</div>

	

	<div class="form-group">
		<button type="submit" class="btn btn-success">Dodaj produkt!</button>
	</div>
	


	<input type="hidden" value="{{ Session::token() }}" name="_token">
</form>

@endsection