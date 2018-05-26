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
	    <form action="{{route('distributorsNew')}}" method="post">
	      <div class="form-group">
	        <label for="distributor_id">Numer dystrybutora</label>
	        <input type="number" class="form-control" name="distributor_id" id="distributor_id"/>
	      </div>
	      <div class="form-group">
			<h4>Paliwa</h4>
				@foreach($fuels as $i => $data)
					<label for="{{$data->type}}">{{$data->type}}</label>
					<input type="checkbox" name="fuel[]" value="{{$data->type}}">
					<br/>
				@endforeach
	      </div>

		  
	      <button type="submit" class="btn btn-primary">Dodaj</button>
	      <input type="hidden" name="_token" value="{{ Session::token() }}" />
	    </form>
	</div>
@endsection