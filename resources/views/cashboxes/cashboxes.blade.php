@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')
 
	<h1><i class="fas fa-desktop"></i>Kasy</h1>
  
<form action="{{route('addCashbox')}}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-info">Dodaj kase</button>
</form>

	<?php $pracownicy = DB::table('cashboxes')->get(); ?>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Otwarta</th>
        <th scope="col">Zamknieta</th>
        <th scope="col">Pracownik</th>
      </tr>
    </thead>
	@foreach($pracownicy as $i => $data)
    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->id}}</td>
        <td>{{$data->openTime}}</td>
        <td>{{$data->closeTime}}</td>
        <td>{{$data->employee_id}}</td>               
      </tr>
    </tbody>
	@endforeach
	</table>
@endsection