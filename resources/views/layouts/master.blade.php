<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::to('css/login.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
        <script defer src="{{ URL::to('js/fontawesome-all.js') }}" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
        <script src="{{ URL::to('js/jquery.min.js') }}"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <link href="{{ URL::to('css/select2.min.css') }}" rel="stylesheet" />
        <script src="{{ URL::to('js/select2.min.js') }}"></script>
        <link href='https://fonts.googleapis.com/css?family=Anonymous Pro' rel='stylesheet'>

        <title>@yield('title')</title>
    </head>
    <body class="{{ !Auth::check() ? 'login' : '' }}">

    @include('includes.header')
   
    	<div class="{{ !Auth::check() ? 'login-center' : 'container' }}">
    		@yield('content')
    	</div>

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="{{ URL::to('js/app.js') }}"></script>

    </body>
</html>
