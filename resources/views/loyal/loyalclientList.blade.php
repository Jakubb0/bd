@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')

	<h1><i class="fas fa-users"></i> Lista klientów</h1>

  <a href="{{route('loyalAdd')}}" class="btn btn-info">Dodaj klienta</a>

	<?php $loyal = DB::table('loyalclients')->get(); ?>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Imię</th>
        <th scope="col">Nazwisko</th>
        <th scope="col">Telefon</th>
        <th scope="col">Punkty</th>
        <th scope="col">Usuń</th>
      </tr>
    </thead>
	@foreach($loyal as $i => $data)
    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->id}}</td>
        <td>{{$data->firstname}}</td>
        <td>{{$data->lastname}}</td>
        <td>{{$data->phone}}</td>
        <td>{{$data->points}}</td>
        
        <td>

            <form action="{{route('loyalDelete')}}">
              <button type="submit" class="btn btn-danger" value="{{$data->id}}" name="delete">Usuń</button>
            </form>  

        </td> 

      </tr>
    </tbody>
	@endforeach
	</table>
@endsection