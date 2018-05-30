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

	<h1>Dodaj pracownika</h1>
	<div class="col-sm-12">
	    <form action="{{route('add')}}" method="post">
	      <div class="form-group">
	        <label for="login">Login</label>
	        <input type="text" class="form-control" name="login" id="login">
	      </div>
	      <div class="form-group">
	        <label for="pass">Hasło</label>
	        <input type="password" class="form-control" name="pass" id="pass">
	      </div>
	      <div class="form-group">
	        <label for="name">Imię</label>
	        <input type="text" class="form-control" name="name" id="name">
	      </div>
	      <div class="form-group">
	        <label for="surn">Nazwisko</label>
	        <input type="text" class="form-control" name="surn" id="surn">
	      </div>
	      <div class="form-group">
	        <label for="tel">Telefon</label>
	        <input type="text" class="form-control" name="tel" id="tel">
	      </div>
	      <div class="form-group">
	        <label for="kierownik">Kierownik</label>
	        <input type="checkbox" value="kierownik" class="form-control" name="status" id="status">
	      </div>
		  
	      <button type="submit" class="btn btn-primary">Zarejestruj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection