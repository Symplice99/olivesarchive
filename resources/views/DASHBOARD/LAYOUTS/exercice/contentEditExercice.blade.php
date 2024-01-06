<section class="section">
    <div class="row">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Formulaire de modification de l'exercice N°{{$exercices->id}}</h5>

            <form class="row g-3" action="{{route('exercices.update',$exercices->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-5 col-form-label">Nom matière<span class="text-danger fw-bold fs-5">*</span>  </label>
                    <select id="inputState" name="nomMatiereExercice" class="form-select
                    @error('nomMatiereExercice') is-invalid @enderror">
                        <option value="{{$exercices->devoir->matiere->id}}">{{$exercices->devoir->matiere->nommat}}</option>
                        @foreach ($matieres as $matiere)
                            <option value="{{$matiere->id}}">{{$matiere->nommat}}</option>
                        @endforeach
                    </select>
                    @error('nomMatiereExercice')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Type<span class="text-danger fw-bold fs-5">*</span>  </label>
                    <select id="inputState" name="typeExercice" class="form-select @error('typeExercice') is-invalid @enderror" value="{{old('typeExercice')?? ''}}">
                        <option value="{{$exercices->devoir->type}}">{{$exercices->devoir->type}}</option>
                        <option value="Ecrite">Ecrite</option>
                        <option value="Pratique">Pratique</option>
                        <option value="Orale">Orale</option>
                        <option value="QCM">QCM</option>
                    </select>
                    @error('typeExercice')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-4 col-form-label">Autres matières</label>
                    <input type="text" name="autreMat" class="form-control" value="{{$exercices->devoir->autre}}" placeholder="Ex: UML, Base de données">

                </div>

                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Complexité<span class="text-danger fw-bold fs-5">*</span>  </label>
                    <select id="inputState" name="complexiteExercice" class="form-select @error('complexiteExercice') is-invalid @enderror" value="{{old('complexiteExercice')?? ''}}">
                        <option value="{{$exercices->devoir->complexite}}">{{$exercices->devoir->complexite}}</option>
                        <option value="Difficile">Difficile</option>
                        <option value="Moyen">Moyen</option>
                        <option value="Facile">Facile</option>
                    </select>
                    @error('complexiteExercice')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Prix<span class="text-danger fw-bold fs-5">*</span>  </label>
                    <input type="numberpositif" name="prixExercice" class="form-control @error('prixExercice') is-invalid @enderror" value="{{$exercices->devoir->tarif}}" placeholder="Ex: 200">
                    @error('prixExercice')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-4 col-form-label">Source<span class="text-danger fw-bold fs-5">*</span></label>
                    <input type="text" name="sourceExercice" class="form-control @error('sourceExercice') is-invalid @enderror"  value="{{$exercices->source}}" placeholder="La source de l'exercice">
                    @error('sourceExercice')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                        <!-- Image -->

                        <div>
                            <h6 class="my-2">Charger l'exercice ici<span class="text-danger fw-bold fs-5">*</span></h6>
                            <label style="cursor:pointer;">
                                <span>
                                    <input class="form-control @error('fichierExercice') is-invalid @enderror" value="{{old('fichierExercice')?? ''}} stretched-link" type="file" name="fichierExercice" id="image" accept="*./pdf" />
                                    @error('fichierExercice')
                                        <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </span>
                            </label>
                                <p class="small mb-0 mt-2"><b>Note:</b> Seulement PDF.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-4 col-form-label">Filière<span class="text-danger fw-bold fs-5">*</span></label>
                    <input type="text" name="filiereExercice" class="form-control @error('filiereExercice') is-invalid @enderror" value="{{$exercices->devoir->filiere}}" placeholder="Classe">
                    @error('filiereExercice')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="inputText" class="col-sm-2 col-form-label">Description<span class="text-danger fw-bold fs-5">*</span></label>
                    <textarea id="monTextarea" oninput="compterCaracteres()" class="form-control @error('descriptionExercice') is-invalid @enderror" name="descriptionExercice" placeholder="Décrivez l'exercice" id="floatingTextarea" style="height: 100px;">{{$exercices->devoir->description}}</textarea>
                    <p id="paraCompteur" style="text-align: end;">Nombre de caractères : <span class="" id="compteur">0</span>/1000</p>
                    @error('descriptionExercice')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
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

        // Définir la limite de caractères
        var limiteCaracteres = 1000;

        // Vérifier si le nombre de caractères dépasse la limite
        if (texte.length > limiteCaracteres) {
            // Tronquer le texte à la limite
            texte = texte.substring(0, limiteCaracteres);

            /// Mettre à jour la valeur du champ de texte avec le texte tronqué
            document.getElementById('monTextarea').value = texte;

            // Changer la couleur du paragraphe en rouge
            document.getElementById('paraCompteur').style.color = 'red';
        }else{
            // Changer la couleur du paragraphe en rouge
            document.getElementById('paraCompteur').style.color = '';
        }


        // Mettre à jour le compteur
        document.getElementById('compteur').textContent = nombreDeCaracteres;
    }
</script>
