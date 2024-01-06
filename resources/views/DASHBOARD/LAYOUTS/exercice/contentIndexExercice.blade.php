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
            <div class="d-flex">
                <h5 class="card-title">Liste des exercices</h5>
                <span class="">
                </span>
            </div>
            <div class="col-md-3 mb-3">
                <a class="btn btn-primary" href="{{route('exercices.create')}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Ajouter">
                    <i class="ri-add-box-fill fs-5" style="" ></i>
                    Nouveau</a>
            </div>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Matière</th>
                  <th scope="col">Complexité</th>
                  <th scope="col">Prix</th>
                  <th scope="col">Source</th>
                  <th scope="col">Classe/Filière</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($exercices as $exercice)
					<tr>
							{{-- @dd($cour->matiere)	<!-- Table data --> --}}
						<td>{{$exercice->id}}</td>
						<td>{{$exercice->devoir->matiere->nommat}}</td>
						<td>{{$exercice->devoir->complexite}}</td>
						<td>{{$exercice->devoir->tarif}}&nbsp;fcfa</td>
						<td>@if ($exercice->source!=null)
                            {{$exercice->source}}
                        @else
                            Aucune épreuve associée
                        @endif</td>

						<td>@if ($exercice->devoir->filiere!=null)
                            {{$exercice->devoir->filiere}}
                        @else
                            Pas de filière
                        @endif</td>
						<td class="d-flex">
							<a onclick="Modifier();" class="btn btn-success rounded-circle me-1" href="{{route('exercices.edit', $exercice->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"><i class="ri-edit-circle-fill fs-5"></i></a>
							<a onclick="Supprimer();" class="btn btn-danger rounded-circle me-1" href="{{route('exercices.destroy', $exercice->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="ri-delete-bin-fill fs-5"></i></a>
                            <button type="button" class="btn btn-primary rounded-circle" title="Détail"
                                data-bs-toggle="modal" data-bs-target="#myModal"
                                data-exercices-id="{{ $exercice->id }}"
                                data-exercices-matiere="{{$exercice->devoir->matiere->nommat}}"
                                data-exercices-classe="{{$exercice->devoir->filiere}}"
                                data-exercices-taille="{{$exercice->devoir->taille }}"
                                data-exercices-fichier="{{asset('storage/'. $exercice->devoir->fichierdev)}}"
                                data-exercices-type="{{$exercice->devoir->type }}"
                                data-exercices-complexite="{{$exercice->devoir->complexite }}"
                                data-exercices-autre="{{$exercice->devoir->autre}}"
                                data-exercices-source="@if ($exercice->source !=null)
                                {{$exercice->source}}
                            @else
                                Aucune épreuve associée
                            @endif"
                                data-exercices-prix="{{$exercice->devoir->tarif}}"
                                data-exercices-description="{{$exercice->devoir->description }}">
                                 <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
							<a class="btn btn-secondary rounded-circle me-1" href="{{route('corrections.create2', $exercice->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter la correction"><i class="ri-add-box-fill fs-5"></i></a>
						</td>
					</tr>
                @endforeach

              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="label" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
        <div class="modal-content" >
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="label">Détail de l'épreuve N°<span id="exerciceId"></span></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <embed id="exerciceFichier" src="http://infolab.stanford.edu/pub/papers/google.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" frameBorder="0" scrolling="auto" height="75%" width="100%">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <span class="card-title">Matière : &nbsp;</span><span class="card-title" id="exerciceMatiere"></span>
                            <p class="card-text fw-bold" style="color: #191970;">Description :&nbsp;<span class="fw-normal" id="exerciceDescription"></span></p>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text mr-3 fw-bold" style="color: #191970;">Filière :&nbsp;<small id="exerciceFilière" class="text-body-secondary fw-bold"></small></p>
                                    <span class="d-flex">
                                        <p class="card-text mr-3 fw-bold" style="color: #191970;">Année : &nbsp;<small id="exerciceAnnee" class="text-body-secondary fw-bold">Niveaux</small></p>
                                        <p class="card-text fw-bold mr-3" style="color: #191970;">Session : &nbsp;<small id="exerciceSession" class="text-body-secondary fw-bold">Domaine</small></p>
                                        <p class="card-text fw-bold" style="color: #191970;" >Type : &nbsp;<small id="exerciceType" class="text-body-secondary fw-bold">Matière</small></p>
                                    </span>
                                    <p class="card-text fw-bold" style="color: #191970;" >Complexité : &nbsp;<small id="exerciceComplexite" class="text-body-secondary fw-bold">Matière</small></p>
                                    <p class="card-text fw-bold" style="color: #191970;" >Prix : &nbsp;<small id="exercicePrix" class="text-body-secondary fw-bold">Prix</small>&nbsp;fcfa</p>
                                    <p class="card-text fw-bold" style="color: #191970;" >Autres matièrs : &nbsp;<small id="autreMatExercice" class="text-body-secondary fw-bold">Prix</small></p>
                                    <p class="card-text fw-bold text-end" style="color: #191970;" >Taille : &nbsp;<small id="exerciceTaille" class="text-body-secondary fw-bold">Taille</small></p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            <button hidden type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>

</section>

  <script>
    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // bouton qui a déclenché le modal

      var exerciceId = button.data('exercices-id'); // récupérer la valeur de l'attribut data-exercices-id
      var exerciceMatiere = button.data('exercices-matiere'); // récupérer la valeur de l'attribut data-exercices-matiere
      var exerciceDescription = button.data('exercices-description'); // récupérer la valeur de l'attribut data-exercices-description
      var exerciceFilière = button.data('exercices-classe'); // récupérer la valeur de l'attribut data-exercices-classe
      var exerciceAnnee = button.data('exercices-annee'); // récupérer la valeur de l'attribut data-exercices-annee
      var exerciceSession = button.data('exercices-source'); // récupérer la valeur de l'attribut data-exercices-source
      var exerciceType = button.data('exercices-type'); // récupérer la valeur de l'attribut data-exercices-type
      var autreMatExercice = button.data('exercices-autre'); // récupérer la valeur de l'attribut data-exercices-autre
      var exerciceComplexite = button.data('exercices-complexite'); // récupérer la valeur de l'attribut data-exercices-complexite
      var exerciceTaille = button.data('exercices-taille'); // récupérer la valeur de l'attribut data-exercices-taille
      var exerciceFichier = button.data('exercices-fichier'); // récupérer la valeur de l'attribut data-exercices-fichier
      var exercicePrix = button.data('exercices-prix'); // récupérer la valeur de l'attribut data-exercices-prix

      // Mettez à jour le contenu du modal avec les informations récupérées
      var modal = $(this);
      modal.find('#exerciceId').text(exerciceId);
      modal.find('#exerciceMatiere').text(exerciceMatiere);
      modal.find('#exerciceDescription').text(exerciceDescription);
      modal.find('#exerciceFilière').text(exerciceFilière);
      modal.find('#exerciceAnnee').text(exerciceAnnee);
      modal.find('#exerciceSession').text(exerciceSession);
      modal.find('#exerciceType').text(exerciceType);
      modal.find('#exerciceComplexite').text(exerciceComplexite);
      modal.find('#autreMatExercice').text(autreMatExercice);
      modal.find('#exerciceTaille').text(exerciceTaille);
      modal.find('#exercicePrix').text(exercicePrix);
      modal.find('#exerciceFichier').attr('src',exerciceFichier);
      //$('#coursFichier').attr('src', coursFichier);
    });
</script>


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
