@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')
 
	<h1><i class="fas fa-file-alt"></i>Dystrybutory</h1>

  <a href="{{route('distributorsAdd')}}" class="btn btn-info">Dodaj dystrybutor</a>

	<?php $distributors = App\distributors::get(); 
        $last = App\distributors::orderBy('station', 'desc')->pluck("station")->first();
  ?>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">Station</th>
        <th scope="col">Id paliwa</th>
      </tr>
    </thead>


	@foreach($distributors as $i => $data)


    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->station}}</td>
        <td>{{$data->fuels_id}}</td>           
      </tr>
    </tbody>


	@endforeach
	</table>
@endsection