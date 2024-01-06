<section class="section">
    <div class="row">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Formulaire de modification du cours N°{{$cours->id}}</h5>

            <form class="row g-3" action="{{route('cours.update', $cours->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-2 col-form-label">Titre du cours</label>
                    <input type="text" name="nomCours" class="form-control @error('nomCours') is-invalid @enderror" value="{{$cours->titre}}" placeholder="Titre">
                    @error('nomCours')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Matière</label>
                    <select id="inputState" name="nomMatiereCours" class="form-select @error('nomMatiereCours') is-invalid @enderror" value="{{old('nomMatiereCours')?? ''}}">
                        <option selected value="{{$cours->matiere->id}}">{{$cours->matiere->nommat}}</option>
                        @foreach ($matieres as $matiere)
                            <option value="{{$matiere->id}}">{{$matiere->nommat}}</option>
                        @endforeach
                    </select>
                    @error('nomMatiereCours')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Classe/Filière</label>
                  <input type="text" name="classeCours" class="form-control @error('classeCours') is-invalid @enderror" value="{{$cours->classe}}" placeholder="classe/filière">
                    @error('classeCours')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                    <textarea id="monTextarea" oninput="compterCaracteres()" class="form-control  @error('descriptionCours') is-invalid @enderror" name="descriptionCours" id="floatingTextarea" style="height: 100px;">{{$cours->description}}</textarea>
                    <p style="text-align: end;">Nombre de caractères : <span class="" id="compteur">0</span>/255</p>
                    @error('descriptionCours')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Domaine</label>
                    <select id="inputState" name="nomDomaineCours" class="form-select @error('nomDomaineCours') is-invalid @enderror" value="{{old('nomDomaineCours')?? ''}}">
                        <option selected value="{{$cours->domaine->id}}">{{$cours->domaine->nomdom}}</option>
                        @foreach ($domaines as $domaine)
                            <option value="{{$domaine->id}}">{{$domaine->nomdom}}</option>
                        @endforeach
                    </select>
                    @error('nomDomaineCours')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Niveau</label>
                    <select id="inputState" name="nomNiveauCours" class="form-select @error('nomNiveauCours') is-invalid @enderror" value="{{old('nomNiveauCours')?? ''}}">
                        <option selected value="{{$cours->niveau->id}}">{{$cours->niveau->nomniv}}</option>
                        @foreach ($niveaux as $niveau)
                            <option value="{{$niveau->id}}">{{$niveau->nomniv}}</option>
                        @endforeach
                    </select>
                    @error('nomNiveauCours')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                        <!-- Image -->

                        <div>
                            <h6 class="my-2">Charger le cours ici</h6>
                            <label style="cursor:pointer;">
                                <span>
                                    <input class="form-control @error('fichierCours') is-invalid @enderror" value="{{old('fichierCours')?? ''}} stretched-link" type="file" name="fichierCours" id="image" accept="*./pdf" />
                                    @error('fichierCours')
                                        <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </span>
                            </label>
                                <p class="small mb-0 mt-2"><b>Note:</b> Seulement PDF.</p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-success">Modifier</button>
                  <button type="reset" class="btn btn-secondary" hidden>Reset</button>
                </div>
              </form>

          </div>
        </div>
    </div>


</section>
<script>
    //compter le nombre de caractère au clavier
    function compterCaracteres() {
        // Récupérer la valeur du textarea
        var texte = document.getElementById('monTextarea').value;

        // Compter le nombre de caractères
        var nombreDeCaracteres = texte.length;

        // Mettre à jour le compteur
        document.getElementById('compteur').textContent = nombreDeCaracteres;
    }
</script>
