@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
        </button>
    </div>
@endif

<section class="section">
    <div class="d-flex">
        <h5 class="card-title">Liste des corrections des devoirs</h5>
        <span class="">
        </span>
    </div>

    <div class="row g-4">
        @foreach ($corrections as $correction)
            @if ($correction->epreuve_id !== null)
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="card p-2 shadow h-100">
                        <div class="rounded-top overflow-hidden">
                            <div class="card-overlay-hover">
                                <embed src="{{asset('storage/'.$correction->fichiercor)}}" type="application/pdf" frameBorder="0" scrolling="auto" height="75%" width="100%">
                            </div>
                        </div>
                        <div class="card-body px-2">
                            <hr>
                            <h6 class="card-title">Epreuve de {{$correction->epreuve->devoir->matiere->nommat." ".$correction->epreuve->annee}}</h6>
                            <span class="text-secondary fw-bold">{{$correction->epreuve->session." phase ".$correction->epreuve->devoir->type}}</span>
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <div><a href="#" class="badge bg-opacity-10 text-info me-2"><i class="fas fa-circle small fw-bold"></i>{{" ".$correction->montant." " }}FCFA</a></div>
                                <div class="">
                                    <a onclick="Modifier();" class="btn btn-success rounded-circle me-1" href="{{route('corrections.edit', $correction->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier"><i class="ri-edit-circle-fill"></i></a>
							        <a onclick="Supprimer();" class="btn btn-danger rounded-circle me-1" href="{{route('corrections.destroy', $correction->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer"><i class="ri-delete-bin-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="card p-2 shadow h-100">
                        <div class="rounded-top overflow-hidden">
                            <div class="card-overlay-hover">
                                <embed src="{{asset('storage/'.$correction->fichiercor)}}" type="application/pdf" frameBorder="0" scrolling="auto" height="75%" width="100%">
                            </div>
                        </div>
                        <div class="card-body px-2">
                            <hr>
                            <h6 class="card-title"><a href="#">Exercice de {{$correction->exercice->devoir->matiere->nommat}}</a></h6>
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <div><a href="#" class="badge bg-opacity-10 text-info me-2"><i class="fas fa-circle small fw-bold"></i>{{" ".$correction->montant." " }}FCFA</a></div>
                                <div class="">
                                    <a onclick="Modifier();" class="btn btn-success rounded-circle me-1" href="{{route('corrections.edit', $correction->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier"><i class="ri-edit-circle-fill"></i></a>
							        <a onclick="Supprimer();" class="btn btn-danger rounded-circle me-1" href="{{route('corrections.destroy', $correction->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer"><i class="ri-delete-bin-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @endforeach

    </div>

</section>

<script>
    function Supprimer(){
            if(confirm('Voulez-vous vraiment supprimer cet élément?')==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        }

        function Modifier(){
            if(confirm('Voulez-vous vraiment supprimer cet élément?')==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        }
</script>
