<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    </head>
    <body>
        <nav class="navbar navbar-default navbar-dark bg-dark">
          <a class="navbar-brand" href="{{route('home')}}">Sytem zarządzania stacją paliw</a>
        </nav>
        <h1>Zaloguj się</h1>
        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('signin')}}" method="post">
                  <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login" name="login">
                  </div>
                  <div class="form-group">
                    <label for="pass">Hasło</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                  </div>
                  <button type="submit" class="btn btn-primary">Zaloguj</button>
                  <input type="hidden" name="_token" value="{{ Session::token() }}" />
                </form>
            </div>   
        </div>
</html>
