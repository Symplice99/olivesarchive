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
                <h5 class="card-title">Liste des cours</h5>
                <span class="">
                </span>
            </div>
            <div class="col-md-3 mb-3">
                <a class="btn btn-primary" href="{{route('cours.create')}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Ajouter">
                    <i class="ri-add-box-fill fs-5" style="" ></i>
                    Nouveau</a>
            </div>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Cours</th>
                  <th scope="col">Matière</th>
                  <th scope="col">Domaine</th>
                  <th scope="col">Niveau</th>
                  <th scope="col">Classe/Filière</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($cours as $cour)
					<tr>
							{{-- @dd($cour->matiere)	<!-- Table data --> --}}
						<td>{{$cour->id}}</td>
						<td>{{$cour->titre}}</td>
						<td>{{$cour->matiere->nommat}}</td>
						<td>{{$cour->domaine->nomdom}}</td>
						<td>{{$cour->niveau->nomniv}}</td>
						<td>{{$cour->classe}}</td>
						<td class="d-flex">
							<a onclick="Modifier();" class="btn btn-success rounded-circle me-1" href="{{route('cours.edit', $cour->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"><i class="ri-edit-circle-fill fs-5"></i></a>
							<a onclick="Supprimer();" class="btn btn-danger rounded-circle me-1" href="{{route('cours.destroy', $cour->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="ri-delete-bin-fill fs-5"></i></a>

                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
                             data-cours-id="{{ $cour->id }}" data-cours-titre="{{$cour->titre}}" data-cours-classe="{{ $cour->classe }}">
                                O
                              </button> --}}
                            <button type="button" class="btn btn-primary rounded-circle" title="Détail"
                                data-bs-toggle="modal" data-bs-target="#myModal"
                                data-cours-id="{{ $cour->id }}"
                                data-cours-titre="{{ $cour->titre }}"
                                data-cours-classe="{{ $cour->classe }}"
                                data-cours-taille="{{ $cour->taile }}"
                                data-cours-fichier="{{asset('storage/'. $cour->fichier)}}"
                                data-cours-matiere="{{ $cour->matiere->nommat }}"
                                data-cours-domaine="{{ $cour->domaine->nomdom }}"
                                data-cours-niveau="{{ $cour->niveau->nomniv }}"
                                data-cours-prix="{{ $cour->domaine->prix }}"
                                data-cours-description="{{ $cour->description }}">
                                 <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
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
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="label">Détail du cours N°<span id="coursId"></span></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <embed id="coursFichier" src="http://infolab.stanford.edu/pub/papers/google.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" frameBorder="0" scrolling="no" height="100%" width="100%">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <span class="card-title">Titre : &nbsp;</span><span class="card-title" id="coursTitre"></span>
                            <p class="card-text fw-bold" style="color: #191970;">Description :&nbsp;<span class="fw-normal" id="coursDescription"></span></p>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text mr-3 fw-bold" style="color: #191970;">Filière :&nbsp;<small id="coursClasse" class="text-body-secondary fw-bold"></small></p>
                                    <span class="d-flex">
                                        <p class="card-text mr-3 fw-bold" style="color: #191970;">Niveau : &nbsp;<small id="coursNiveau" class="text-body-secondary fw-bold">Niveaux</small></p>
                                        <p class="card-text fw-bold" style="color: #191970;">Domaine : &nbsp;<small id="coursDomaine" class="text-body-secondary fw-bold">Domaine</small></p>
                                    </span>
                                    <p class="card-text fw-bold" style="color: #191970;" >Matière : &nbsp;<small id="coursMatiere" class="text-body-secondary fw-bold">Matière</small></p>
                                    <p class="card-text fw-bold" style="color: #191970;" >Prix : &nbsp;<small id="coursPrix" class="text-body-secondary fw-bold">Prix</small></p>
                                    <p class="card-text fw-bold text-end" style="color: #191970;" >Taille : &nbsp;<small id="coursTaille" class="text-body-secondary fw-bold">Taille</small></p>
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

      var coursId = button.data('cours-id'); // récupérer la valeur de l'attribut data-cours-id
      var coursTitre = button.data('cours-titre'); // récupérer la valeur de l'attribut data-cours-titre
      var coursDescription = button.data('cours-description'); // récupérer la valeur de l'attribut data-cours-description
      var coursClasse = button.data('cours-classe'); // récupérer la valeur de l'attribut data-cours-classe
      var coursNiveau = button.data('cours-niveau'); // récupérer la valeur de l'attribut data-cours-niveau
      var coursDomaine = button.data('cours-domaine'); // récupérer la valeur de l'attribut data-cours-domaine
      var coursMatiere = button.data('cours-matiere'); // récupérer la valeur de l'attribut data-cours-matiere
      var coursPrix = button.data('cours-prix'); // récupérer la valeur de l'attribut data-cours-prix
      var coursTaille = button.data('cours-taille'); // récupérer la valeur de l'attribut data-cours-taille
      var coursFichier = button.data('cours-fichier'); // récupérer la valeur de l'attribut data-cours-fichier

      // Mettez à jour le contenu du modal avec les informations récupérées
      var modal = $(this);
      modal.find('#coursId').text(coursId);
      modal.find('#coursTitre').text(coursTitre);
      modal.find('#coursDescription').text(coursDescription);
      modal.find('#coursClasse').text(coursClasse);
      modal.find('#coursNiveau').text(coursNiveau);
      modal.find('#coursDomaine').text(coursDomaine);
      modal.find('#coursMatiere').text(coursMatiere);
      modal.find('#coursPrix').text(coursPrix);
      modal.find('#coursTaille').text(coursTaille);
      modal.find('#coursFichier').attr('src',coursFichier);
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
