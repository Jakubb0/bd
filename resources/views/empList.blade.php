<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
<body> 
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">System zarządzania stacją paliw</a>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Pracownicy
	    	</a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="{{route('empAdd')}}">Dodaj pracownika</a>
	          <div class="dropdown-divider"></div>
	          <a class="dropdown-item" href="{{route('empList')}}">Lista pracowników</a>
	          <div class="dropdown-divider"></div>
	        </div>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Menu
	    	</a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="{{route('empAdd')}}">Pracownicy</a>
	          <div class="dropdown-divider"></div>
	        </div>
	      </li>
	    </ul>
	    <a class="nav-link" href="{{route('home')}}">Wyloguj</a>
	  </div>
	</nav>

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



	<!--jquery/ bootstrap.js -->
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>