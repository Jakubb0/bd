@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')
 
	<h1><i class="fas fa-users"></i> Lista pracowników</h1>

  <a href="{{route('employeeAdd')}}" class="btn btn-info">Dodaj pracownika</a>

	<?php $pracownicy = DB::table('pracownicy')->get(); ?>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Status</th>
        <th scope="col">Imie</th>
        <th scope="col">Nazwisko</th>
        <th scope="col">Telefon</th>
        <th scope="col">Data dołączenia</th>
        <th scope="col">Ostatnio aktywny</th>
        <th scope="col">Usuń</th>
      </tr>
    </thead>
	@foreach($pracownicy as $i => $data)
    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->id}}</td>
        <td>{{$data->status}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->surname}}</td>
        <td>{{$data->phone}}</td>
        <td>{{$data->join_date}}</td>   
        <td>{{$data->login_date}}</td>
        
        <td>
          @if($data->id != 1)
            <form action="{{route('employeeDelete')}}">
              <button type="submit" class="btn btn-danger" value="{{$data->id}}" name="delete">Usuń</button>
            </form>  
          @endif  
        </td>                 
      </tr>
    </tbody>
	@endforeach
	</table>
@endsection