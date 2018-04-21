@extends('layouts.master')


@section('title')
    Stacja benzynowa
@endsection

@section('content')

	<div class="alert alert-danger">
  		<strong>Uwaga!</strong> Zaktualizuj swoje dane
	</div>
	<h1>Zmień dane</h1>
	<div class="col-sm-6">
	    <form action="{{route('employeeUpdate')}}" method="post">
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
	        <input type="number" class="form-control" name="tel" id="tel">
	      </div>
	      <button type="submit" class="btn btn-primary">Zajerestruj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection




