@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')


<h1><i class="fas fa-truck"></i>Dostawcy</h1>

<a href="{{route('providersAdd')}}" class="btn btn-info">Nowy dostawca</a>

<?php $providers = \App\providers::get(); ?>

	<table class="table table-hover">
	    <thead class="table-th">
	      <tr>
	        <th scope="col">#</th>
	        <th scope="col">Nazwa</th>
	        <th scope="col">NIP</th>
	      </tr>
	    </thead>
		@foreach($providers as $i => $data)

		    <tbody class="table-bordered">
		      <tr>    
		        <td>{{$data->id}}</td>
		        <td>{{$data->name}}</td>
		        <td>{{$data->NIP}}</td>             
		      </tr>
		    </tbody>

		@endforeach
	</table>

@endsection