<section class="section">
    <div class="row">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Formulaire d'ajout de matière</h5>

            <!-- General Form Elements -->
            <form action="{{route('matieres.store')}}" method="POST">
                @csrf
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nom matière</label>
                <div class="col-sm-10">
                  <input type="text" name="nomMatiere" class="form-control @error('nomMatiere') is-invalid @enderror" value="{{old('nomMatiere')?? ''}}">
                  @error('nomMatiere')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
              </div>




              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" hidden>Submit Button</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>

    </div>
  </section>

<br><br><br><br><br><br><br>
