@if(Auth::check())

  @if(DB::table('pracownicy')->where('id', Auth::id())->pluck('status')[0]=='kierownik')

   	<?php $witaj = DB::table('pracownicy')->where('id', Auth::id())->pluck('name');  ?>

   	<?php 
   		$witaj = DB::table('pracownicy')->where('id', Auth::id())->pluck('name'); 
   		$test = App\logs::where('category', 'call')->orderBy('time', 'desc')->first();
   	?>



	<div class="left-bar">
		<div class="name-welcome">
			<h3>Witaj</h3>
			<div class="user-image-round">
				<img src="/images/users/Person-icon-grey.jpg">
			</div>
			<div class="user-info">
				<?=$witaj[0]?>
			</div>
			<div class="user-info">
				<a href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i> Wyloguj się!</a>
			</div>
		</div>
		<hr class="medium-hr">

		<div class="left-menu">
			<ul>
				<li>
					<a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
				</li>
				<li>
					<a href="{{ route('employeeList') }}"><i class="fas fa-users"></i> Pracownicy</a>
				</li>
				<li>
					<a href="{{ route('getProduct') }}"><i class="fas fa-shopping-basket"></i> Produkty</a>
				</li>
				<li>
					<a href="{{ route('product.getCart') }}"><i class="fas fa-file-alt"></i> Zamówienia</a>
				</li>
				<li>
					<a href="{{ route('loyalView') }}"><i class="fas fa-address-card"></i> Numer stałego klienta</a>
				</li>
				<li>
					<a href="{{ route('logs') }}"><i class="fas fa-chart-bar"></i> Statystyki</a>
				</li>
				<li>
					<a href="{{ route('cashboxes') }}"><i class="fas fa-desktop"></i> Kasa</a>
				</li>
				<li>
					<a href="{{ route('depots') }}"><i class="fas fa-box"></i> Magazyn</a>
				</li>
				<li>
					<a href="{{ route('fuelsView') }}"><i class="fas fa-thermometer-full"></i> Paliwo</a>
				</li>
			</ul>
		</div>

	</div>


	<script id="test" type="text/javascript">
		@if($test['value']=='bad')
			alert("Wezwano do kasy")
			<?php App\logs::where('category', 'call')->where('value', 'bad')->update(['value' => 'good']); ?>
		@endif
	</script>


	<div class="admin-content">


  @else
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="{{ route('dashboard') }}">Stacja paliw</a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

          <li class={{ DB::table('pracownicy')->where('id', Auth::id())->pluck('status')[0]=='kierownik' ? "nav-item dropdown" : "d-none" }}>
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pracownicy</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{route('employeeAdd')}}">Dodaj pracownika</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('employeeList')}}">Lista pracowników</a>
            </div>
          </li>
        </ul>


    <?php
     $witaj = DB::table('pracownicy')->where('id', Auth::id())->pluck('name'); 
    ?>

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?=$witaj[0]?> <span class="caret"></span></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i> Panel Użytkownika</a>
              <a class="dropdown-item" href="#"><i class="fa fa-history"></i> Historia</a></a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fa fa-sign-out-alt"></i> Wyloguj się</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  @endif

@endif





<script type="text/javascript">

	setInterval(function(){
	      $("#test").load("#test");
	 },10000);

</script>
<script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
