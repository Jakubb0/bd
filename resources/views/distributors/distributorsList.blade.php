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
        <th scope="col">Numer dystrybutora</th>
        <th scope="col">Paliwo</th>
      </tr>
    </thead>


	@foreach($distributors as $i => $data)

  <?php  $x = 0 ?>

    @if($i>0)
      <?php 
        $t=$i-1;
        $x = $distributors[$t]["station"];  
      ?>
    @endif

    @if($data->station != $x)

    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->station}}</td>
        <td>{{App\fuels::where("id", $data->fuels_id)->pluck("type")->first()}}</td>           
      </tr>
    </tbody>

    @else

      <tbody class="table-bordered">
      <tr>    
        <td></td>
        <td>{{App\fuels::where("id", $data->fuels_id)->pluck("type")->first()}}</td>           
      </tr>
    </tbody>

    @endif


	@endforeach
	</table>
@endsection