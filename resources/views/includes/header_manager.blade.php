<?php $witaj = DB::table('pracownicy')->where('id', Auth::id())->pluck('name'); ?>

<div class="left-bar">
		<div class="name-welcome">
			<h3>Witaj</h3>
			<div class="user-image-round">
				<img src="http://veraicon.pl/zaplecze/images/users/1/profil.jpg">
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
					<a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
				</li>
				<li>
					<a href="{{route('employeeList')}}"><i class="fas fa-users"></i> Pracownicy</a>
				</li>
				<li>
					<a href="#"><i class="fas fa-shopping-basket"></i> Produkty</a>
				</li>
				<li>
					<a href="#"><i class="fas fa-file-alt"></i> Zamówienia</a>
				</li>
				<li>
					<a href="#"><i class="fas fa-chart-bar"></i> Statystyki</a>
				</li>
			</ul>
		</div>

</div>