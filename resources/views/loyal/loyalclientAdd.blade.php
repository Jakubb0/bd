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
	        <label for="firstname">Imię</label>
	        <input type="text" class="form-control" name="firstname" id="firstname">
	      </div>
	      <div class="form-group">
	        <label for="lastname">Nazwisko</label>
	        <input type="text" class="form-control" name="lastname" id="lastname">
	      </div>
	      <div class="form-group">
	        <label for="phone">Numer telefonu</label>
	        <input type="number" class="form-control" name="phone" id="phone">
	      </div>
	      <input type="hidden" name="clientCode" value="<?php $d = "12". date('YmdHis'); echo $d;?>">
		  
	      <button type="submit" class="btn btn-primary">Zarejestruj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection