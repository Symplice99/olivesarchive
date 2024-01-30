<!-- Header START -->
<!-- Logo Nav START -->
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<!-- Logo START -->
			<a class="navbar-brand me-0" href="{{route('accueils.indexAccueil')}}">
				<img class="light-mode-item navbar-brand-item" src="{{asset('assets/img/logo.png')}}" alt="logo">
			</a>
			<!-- Logo END -->

			<!-- Responsive navbar toggler -->
			<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>

			<!-- Main navbar START -->
			<div class="navbar-collapse collapse" id="navbarCollapse">

				<!-- Nav Search END -->
				<ul class="navbar-nav navbar-nav-scroll mx-auto">

					<!-- Nav item 1 Demos -->
					{{-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle active" href="#" id="demoMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Demos</a>
                        <ul class="dropdown-menu" aria-labelledby="demoMenu">

						</ul>
					</li> --}}

					<!-- Nav item 2 Pages -->
					{{-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="pagesMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
						<ul class="dropdown-menu" aria-labelledby="pagesMenu">
							<!-- Dropdown submenu -->


							<!-- Dropdown submenu -->


							<!-- Dropdown submenu -->








							<li> <a class="dropdown-item" href="instructor-list.html">Instructor List</a></li>
							<li> <a class="dropdown-item" href="instructor-single.html">Instructor Single</a></li>
							<li> <a class="dropdown-item" href="become-instructor.html">Become an Instructor</a></li>
							<li> <a class="dropdown-item" href="abroad-single.html">Abroad Single</a></li>
							<li> <a class="dropdown-item" href="workshop-detail.html">Workshop Detail</a></li>
							<li> <a class="dropdown-item" href="event-detail.html">Event Detail <span class="badge bg-success ms-2 smaller">New</span></a></li>

							<!-- Dropdown submenu -->


							<!-- Dropdown submenu -->


							<!-- Dropdown submenu -->


							<!-- Dropdown submenu -->


							<!-- Dropdown submenu -->

						</ul>
					</li> --}}

					<!-- Nav item 3 Pages -->
					<li class="nav-item dropdown"><a class="nav-link" href="{{route('accueils.indexAccueilCours')}}">Cours</a></li>

					<!-- Nav item 4 link-->
					<li class="nav-item"><a class="nav-link" href="{{route('accueils.indexAccueilDevoir')}}">Exercice</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
				</ul>
			</div>
			<!-- Main navbar END -->
			<div class="navbar-nav ms-2">
				<a href="{{ route('login') }}" style="background: rgba(34, 69, 131, 1)" class="btn btn-sm text-light mb-0"><i class="bi bi-power me-2"></i>Sign In</a>
			</div>

		</div>
	</nav>

