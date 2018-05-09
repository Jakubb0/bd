@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')
 
	<h1><i class="fas fa-box"></i>Magazyny</h1>

  <a href="{{route('depotsAdd')}}" class="btn btn-info">Nowy magazyn</a>

	<?php $depots = DB::table('depots')->get(); ?>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Opis</th>
        <th scope="col">Usuń</th>
      </tr>
    </thead>
	@foreach($depots as $i => $data)
    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->id}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->description}}</td>     
        <td>
          <form action="{{route('depotsDelete')}}">
                <button type="submit" class="btn btn-danger" value="{{$data->id}}" name="delete">Usuń</button>
          </form>  
        </td>         
      </tr>
    </tbody>
	@endforeach
	</table>
@endsection