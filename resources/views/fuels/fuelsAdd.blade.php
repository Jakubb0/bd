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

	<h1>Dodaj paliwo</h1>
	<div class="col-sm-12">
	    <form action="{{route('fuelspostAdd')}}" method="post">
	      <div class="form-group">
	        <label for="type">Typ</label>
				<select id="type" name="type" class="form-control">
					<option value="Pb98" selected>Pb98</option>
					<option value="Pb95">Pb95</option>
					<option value="ON">ON</option>
					<option value="LPG">LPG</option>
				</select>
	      </div>
	      <div class="form-group">
	        <label for="price">Cena</label>
	        <input type="text" class="form-control" name="price" id="price"/>
	      </div>
	      <div class="form-group">
	        <label for="amount">Ilość (litry)</label>
	        <input type="text" class="form-control" name="amount" id="amount"/>
	      </div>
	      
		  
	      <button type="submit" class="btn btn-primary">Dodaj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection