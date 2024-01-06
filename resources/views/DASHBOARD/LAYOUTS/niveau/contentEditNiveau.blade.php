<section class="section">
    <div class="row">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Formulaire de modification du niveau N°{{$niveaux->id}}</h5>

            <!-- General Form Elements -->
            <form action="{{route('niveaux.update', $niveaux->id)}}" method="POST">
                @csrf
                @method('put')
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nom domaine</label>
                <div class="col-sm-10">
                  <input type="text" name="nomNiveau" class="form-control @error('nomNiveau') is-invalid @enderror" value="{{$niveaux->nomniv}}">
                    @error('nomNiveau')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" hidden>Submit Button</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-success">Modifier</button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>

    </div>
  </section>

<br><br><br><br><br>
