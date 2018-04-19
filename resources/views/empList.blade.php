@extends('layouts.master')


@section('title')
    Stacja benzynowa
@endsection

@section('content')
	<h1>Lista pracowników</h1>

	<?php
		$pracownicy = DB::table('pracownicy')->get(); ?>

	<table class="table">
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Imie</th>
      <th scope="col">Nazwisko</th>
      <th scope="col">Telefon</th>
      <th scope="col">Data dołączenia</th>
      <th scope="col">Ostatnio aktywny</th>
      <th scope="col">Usuń</th>
	@foreach($pracownicy as $i => $data)
    <tr>    
      <td>{{$data->id}}</td>
      <td>{{$data->status}}</td>
      <td>{{$data->name}}</td>
      <td>{{$data->surname}}</td>
      <td>{{$data->phone}}</td>
      <td>{{$data->join_date}}</td>   
      <td>{{$data->login_date}}</td>
      @if($data->id != 1)
      <td><form action="{{route('empDelete')}}"><button type="submit" class="btn btn-primary" value="{{$data->id}}" name="delete">Usuń</button></form></td>  
      @endif                 
    </tr>
	@endforeach
	</table>
@endsection