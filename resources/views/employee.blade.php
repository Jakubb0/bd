@extends('includes.header')


@section('title')
    Stacja benzynowa
@endsection

@section('content')

	<?php 

	$witaj = DB::table('pracownicy')->where('id', Auth::id())->pluck('name'); 
	echo "<h3> Witaj " . $witaj[0] . "</h3>";


	?> 

@endsection