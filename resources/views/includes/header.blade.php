<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ route('dashboard') }}">Stacja paliw</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pracownicy</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('empAdd')}}">Dodaj pracownika</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('empList')}}">Lista pracowników</a>
        </div>
      </li>
    </ul>


    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Sebastian Cebula <span class="caret"></span></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i> Panel Użytkownika</a>
          <a class="dropdown-item" href="#"><i class="fa fa-history"></i> Historia</a></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('home') }}"><i class="fa fa-sign-out-alt"></i> Wyloguj się</a>
        </div>
      </li>
    </ul>

  </div>
</nav>





