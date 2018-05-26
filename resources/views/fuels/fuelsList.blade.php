@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')

	<h1><i class="fas fa-users"></i> Lista paliw</h1>

  <a href="{{route('fuelsAdd')}}" class="btn btn-info">Dodaj paliwo</a>
  <a href="{{route('distributorsView')}}" class="btn btn-info">Zarządzaj dystrybutorami</a>

	<?php $loyal = DB::table('fuels')->get(); ?>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Typ</th>
        <th scope="col">Cena</th>
        <th scope="col">Ilość (litry)</th>
        <th scope="col"></th>        
      </tr>
    </thead>
	@foreach($loyal as $i => $data)
    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->id}}</td>
        <td>{{$data->type}}</td>
        <td>{{$data->price}}</td>
        <td>{{$data->amount}}</td>
        
        <td>

            <form action="{{route('fuelsDelete')}}">
              <button type="submit" class="btn btn-danger" value="{{$data->id}}" name="delete">Usuń</button>
            </form>  

        </td> 

      </tr>
    </tbody>
	@endforeach
	</table>
@endsection