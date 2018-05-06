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

	<h1>Dodaj dane do faktury</h1>
	<div class="col-sm-12">
	    <form action="{{route('newInvoices')}}" method="post">
	      <div class="form-group">
	        <label for="name">Nazwa</label>
	        <input type="text" class="form-control" name="name" id="name">
	      </div>
	      <div class="form-group">
	        <label for="nip">NIP</label>
	        <input type="text" class="form-control" name="nip" id="nip">
	      </div>
	      <div class="form-group">
		    <label for="category">Podatek: </label>
		    <select name="tax" class="custom-select">
		      <option value="8">8%</option>
		      <option value="23">23%</option>
		    </select>
	      </div>
		  
	      <button type="submit" class="btn btn-primary">Dodaj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection