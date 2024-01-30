<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduport.webestica.com/index-9.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Mar 2023 13:48:31 GMT -->
<head>
    @include('SITE.INCLUDES.importhead')
</head>

<body style="background: rgba(233, 236, 239, 1);">

<!-- Header START -->
<header class="navbar-light navbar-sticky">
    @section('header')<!--nom section-->
            @include('SITE.header')
    @show
</header>
<!-- Header END -->

<section class="py-0 py-xl-5">
    <div class="container">
        <div class="row">
            {{-- les compteurs --}}
            <div class="col-lg-9">
                @section('compteur')
                    <div class="w-100">
                        @include('SITE.compteur')
                    </div>
                @show

                <hr class="bg-secondary">
                {{-- Cours --}}
                <div class="row g-4">
                    @section('contenu')
                        <div class="w-100">
                            @include('SITE.LAYOUTS.accueil.contentAccueilDevoir')
                        </div>
                    @show
                </div>
            </div>

        </div>
        {{-- Domaine --}}
        <div class="col-lg-3">
            @section('domaine')
                <div class="w-100">
                    @include('SITE.domaine')
                </div>
            @show
        </div>
    </div>
</section>


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
