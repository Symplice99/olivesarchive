<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduport.webestica.com/index-9.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Mar 2023 13:48:31 GMT -->
<head>
    @include('SITE.INCLUDES.importhead')
</head>

<body>

<!-- Header START -->
<header class="navbar-light navbar-sticky">
    @section('header')<!--nom section-->
            @include('SITE.header')
    @show
</header>
<!-- Header END -->

<main>
@section('contenu')<!--nom section-->
    @include('SITE.LAYOUTS.accueil.contentAccueil')
@show
</main>


<!-- =======================
Footer START -->
<footer id="footer" class="footer">
    @section('footer')<!--nom section-->
        @include('SITE.footer')
    @show
</footer><!-- End Footer -->


<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>


</body>
@include('SITE.INCLUDES.importscript')
<!-- Mirrored from eduport.webestica.com/index-9.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Mar 2023 13:48:53 GMT -->
</html>
