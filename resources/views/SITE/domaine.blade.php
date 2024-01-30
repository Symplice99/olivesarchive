{{-- Domaine --}}
@php
    $domaines=getDomaine();
@endphp
<div class="row me-1 ms-1 justify-content-sm-center mb-2">
    <h4 style="text-align: center" class="text-secondary">Nos domaines</h4>
</div>
@foreach ($domaines as $domaine)
    <div class="row me-1 ms-1 justify-content-sm-center mb-2">
        <div class="btn btn-primary mb-2 mt-0 mb-md-0 active">{{$domaine->nomdom}}</div>
    </div>
@endforeach
