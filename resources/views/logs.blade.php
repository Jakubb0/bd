@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')

	<h1><i class="fas fa-newspaper"></i> Dziennik wydarzeń </h1>

	<?php $logs = DB::table('logs')->get(); 
  
    ?>
	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">IP</th>
        <th scope="col">Login</th>
        <th scope="col">Wiadomość</th>
        <th scope="col">Czas</th>
      </tr>
    </thead>
	@foreach($logs as $i => $data)
    <tbody class="table-bordered">
     <?php $val = DB::table('logs')->where('id', $i+1)->pluck('value')->first(); ?>
      <tr class= "{{$val=='good'?'bggoodlog':'bgbadlog'}}">    
        <td>{{$data->id}}</td>
        <td>{{$data->ip}}</td>
        <td>{{$data->login}}</td>
        <td>{{$data->message}}</td>
        <td>{{$data->time}}</td>  
      </tr>
    </tbody>
	@endforeach
	</table>
@endsection