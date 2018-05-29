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
<?php $fuels = App\fuels::get(); ?>

	<h1>Nowy dystrybutor</h1>

	<div class="col-sm-12">
	    <form action="{{route('providersNew')}}" method="post">
	      <div class="form-group">
	        <label for="name">Nazwa</label>
	        <input type="text" class="form-control" name="name" id="name"/>
	      </div>	
  	      <div class="form-group">
	        <label for="nip">NIP</label>
	        <input type="number" class="form-control" name="nip" id="nip"/>
	      </div>  
	      <button type="submit" class="btn btn-primary">Dodaj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection