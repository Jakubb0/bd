@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection


@section('content')
<h1><i class="fas fa-desktop"></i> Kasuj produkty</h1>


<?php 

echo $_POST['cashbox_number']; ?>

@endsection