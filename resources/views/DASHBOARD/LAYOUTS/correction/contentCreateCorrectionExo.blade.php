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
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Formulaire d'ajout de correction de l'exercice N°{{$exercice->id}}</h5>

            <form class="row g-3" action="{{route('corrections.store2',$exercice->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                    <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                        <!-- Image -->

                        <div>
                            <h6 class="my-2">Charger la correction ici<span class="text-danger fw-bold fs-5">*</span></h6>
                            <label style="cursor:pointer;">
                                <span>
                                    <input class="form-control @error('fichierCorrection') is-invalid @enderror" value="{{old('fichierCorrection')?? ''}} stretched-link" type="file" name="fichierCorrection" id="image" accept="*./pdf" />
                                    @error('fichierCorrection')
                                        <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </span>
                            </label>
                                <p class="small mb-0 mt-2"><b>Note:</b> Seulement PDF.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Montant<span class="text-danger fw-bold fs-5">*</span>  </label>
                    <input type="numberpositif" name="montantCorrection" class="form-control @error('montantCorrection') is-invalid @enderror" value="{{old('montantCorrection')?? ''}}" placeholder="Ex: 200">
                    @error('montantCorrection')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>


                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                  <button type="reset" class="btn btn-secondary" hidden>Reset</button>
                </div>
              </form>

          </div>
        </div>
    </div>


</section>


