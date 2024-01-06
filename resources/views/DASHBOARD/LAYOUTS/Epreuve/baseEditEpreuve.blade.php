<!DOCTYPE html>
<html lang="fr">

<head>
    @include('DASHBOARD.INCLUDES.importhead')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    @section('header')<!--nom section-->
        @include('DASHBOARD.header')
    @show

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    @section('sidebar')<!--nom section-->
        @include('DASHBOARD.sideBar')
    @show

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
        {{-- <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div> --}}
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    @section('contenu')<!--nom section-->
        @include('DASHBOARD.LAYOUTS.epreuve.contentEditEpreuve')
    @show

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    @section('footer')<!--nom section-->
        @include('DASHBOARD.footer')
    @show
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  {{-- script --}}
  @include('DASHBOARD.INCLUDES.importscript')

</body>

</html>
