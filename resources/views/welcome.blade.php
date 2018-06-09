<?php 

$selectAllFuels = DB::table('fuels')->get();
$today = date("Y-m-d");
$i = 0;
foreach($selectAllFuels as $id => $data)
{
    $i++;
    $old = $data->price;
    $change = rand( $data->price-0.15, $data->price+0.15 )/50;
    $newPrice = $old-$change;
    
    $updateData = explode(" ", $data->updated_at);

    
    if($updateData[0] != $today)
    {
        DB::table('fuels')
            ->where('id', $data->id)
            ->update(['price' => $newPrice]);
    }

}




?>

@extends('layouts.master')

@section('title')
    Stacja benzynowa | Logowanie
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')


<div class="login-center">    

  <div class="form-bg">
    <div class="row">

        <div class="col-md-12">
            <h2>Zaloguj się!</h2>
            <form action="{{route('signin')}}" method="POST">
                <div class="form-group  {{ $errors->has('login')? 'has-error' : '' }}">
                    <label for="login">Login: </label>
                    <input type="text" class="form-control" name="login" id="login" value="{{ Request::old('login') }}">
                </div>
                <div class="form-group  {{ $errors->has('password')? 'has-error' : '' }}">
                    <label for="pass">Hasło: </label>
                    <input type="password" class="form-control" name="pass" id="pass" value="{{ Request::old('password') }}">
                </div>
                <button type="submit" class="btn btn-primary">Zaloguj się!</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
  </div>
</div>
    
@endsection