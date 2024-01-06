<section class="section">
    <div class="row">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Formulaire de modification de l'épreuve N°{{$epreuves->id}}</h5>

            <form class="row g-3" action="{{route('epreuves.update', $epreuves->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Nom matière</label>
                    <select id="inputState" name="nomMatiereEpreuve" class="form-select @error('nomMatiereEpreuve') is-invalid @enderror" value="{{old('nomMatiereEpreuve')?? ''}}">
                        <option selected value="{{$epreuves->devoir->matiere->id}}">{{$epreuves->devoir->matiere->nommat}}</option>
                        @foreach ($matieres as $matiere)
                            <option value="{{$matiere->id}}">{{$matiere->nommat}}</option>
                        @endforeach
                    </select>
                    @error('nomMatiereEpreuve')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Type</label>
                    <select id="inputState" name="typeEpreuve" class="form-select @error('typeEpreuve') is-invalid @enderror" value="{{old('typeEpreuve')?? ''}}">
                        <option selected value="{{$epreuves->devoir->type}}">{{$epreuves->devoir->type}}</option>
                        <option value="Ecrite">Ecrite</option>
                        <option value="Pratique">Pratique</option>
                        <option value="Orale">Orale</option>
                        <option value="QCM">QCM</option>
                    </select>
                    @error('typeEpreuve')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-4 col-form-label">Autres matières</label>
                    <input type="text" name="autreMat" class="form-control @error('autreMat') is-invalid @enderror" value="{{$epreuves->devoir->autre}}" placeholder="Ex: UML, Base de données">
                    @error('autreMat')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Année</label>
                    <input type="number" name="anneEpreuve" class="form-control @error('anneEpreuve') is-invalid @enderror" value="{{$epreuves->annee}}" placeholder="Ex: 2010">
                    @error('anneEpreuve')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Session</label>
                    <select id="inputState" name="sessionEpreuve" class="form-select @error('sessionEpreuve') is-invalid @enderror" value="{{old('sessionEpreuve')?? ''}}">
                        <option selected value="{{$epreuves->session}}">{{$epreuves->session}}</option>
                        <option value="Session normale">Session normale</option>
                        <option value="Session des malades">Session des malades</option>
                    </select>
                    @error('sessionEpreuve')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Complexité</label>
                    <select id="inputState" name="complexiteEpreuve" class="form-select @error('complexiteEpreuve') is-invalid @enderror" value="{{old('complexiteEpreuve')?? ''}}">
                        <option selected value="{{$epreuves->devoir->complexite}}">{{$epreuves->devoir->complexite}}</option>
                        <option value="Difficile">Difficile</option>
                        <option value="Moyen">Moyen</option>
                        <option value="Facile">Facile</option>
                    </select>
                    @error('complexiteEpreuve')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputText" class="col-sm-4 col-form-label">Prix</label>
                    <input type="number" name="prixEpreuve" class="form-control @error('prixEpreuve') is-invalid @enderror" value="{{$epreuves->devoir->tarif}}" placeholder="Ex: 2010">
                    @error('prixEpreuve')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                        <!-- Image -->

                        <div>
                            <h6 class="my-2">Charger l'épreuve ici</h6>
                            <label style="cursor:pointer;">
                                <span>
                                    <input class="form-control @error('fichierEpreuve') is-invalid @enderror" value="{{old('fichierEpreuve')?? ''}} stretched-link" type="file" name="fichierEpreuve" id="image" accept="*./pdf" />
                                    @error('fichierEpreuve')
                                        <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </span>
                            </label>
                                <p class="small mb-0 mt-2"><b>Note:</b> Seulement PDF.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-4 col-form-label">Filière</label>
                    <input type="text" name="filiereEpreuve" class="form-control @error('filiereEpreuve') is-invalid @enderror" value="{{$epreuves->devoir->filiere}}" placeholder="Classe">
                    @error('filiereEpreuve')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                    <textarea id="monTextarea" oninput="compterCaracteres()" class="form-control @error('descriptionEpreuve') is-invalid @enderror" name="descriptionEpreuve" value="{{old('descriptionEpreuve')?? ''}}" id="floatingTextarea" style="height: 100px;">{{$epreuves->devoir->description}}</textarea>
                    <p id="paraCompteur" style="text-align: end;">Nombre de caractères : <span class="" id="compteur">0</span>/1000</p>
                    @error('descriptionEpreuve')
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
