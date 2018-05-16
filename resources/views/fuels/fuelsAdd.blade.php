@extends('layouts.master')


@section('title')
    Stacja benzynowa
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<h1>Dodaj paliwo</h1>
	<div class="col-sm-12">
	    <form action="{{route('fuelspostAdd')}}" method="post">
	      <div class="form-group">
	        <label for="name">Typ</label>
	        <input type="text" class="form-control" name="type" id="type">
	      </div>
	      <div class="form-group">
	        <label for="price">Cena</label>
	        <input type="text" class="form-control" name="price" id="price">
	      </div>
	      <div class="form-group">
	        <label for="amount">Ilość</label>
	        <input type="text" class="form-control" name="amount" id="amount">
	      </div>
	      
		  
	      <button type="submit" class="btn btn-primary">Zarejestruj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection