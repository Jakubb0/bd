@extends('layouts.master')


@section('title')
    Stacja benzynowa
@endsection

@section('content')

@if ($errors->any())
    <div class="validate">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<h1>Dodaj stałego klienta</h1>
	<div class="col-sm-12">
	    <form action="{{route('loyalpostAdd')}}" method="post">
	      <div class="form-group">
	        <label for="name">Imię</label>
	        <input type="text" class="form-control" name="name" id="name">
	      </div>
	      <div class="form-group">
	        <label for="surn">Nazwisko</label>
	        <input type="text" class="form-control" name="surn" id="surn">
	      </div>
	      <div class="form-group">
	        <label for="city">Miejscowość</label>
	        <input type="text" class="form-control" name="city" id="city">
	      </div>
	      <div class="form-group">
	        <label for="tel">Numer telefonu</label>
	        <input type="number" class="form-control" name="tel" id="tel">
	      </div>
		  
	      <button type="submit" class="btn btn-primary">Zarejestruj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection