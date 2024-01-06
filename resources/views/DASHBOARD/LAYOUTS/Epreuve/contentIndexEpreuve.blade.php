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
                <h5 class="card-title">Liste des épreuves</h5>
                <span class="">
                </span>
            </div>
            <div class="col-md-3 mb-3">
                <a class="btn btn-primary" href="{{route('epreuves.create')}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Ajouter">
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
                  <th scope="col">Session</th>
                  <th scope="col">Année</th>
                  <th scope="col">Classe/Filière</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($epreuves as $epreuve)
					<tr>
							{{-- @dd($cour->matiere)	<!-- Table data --> --}}
						<td>{{$epreuve->id}}</td>
						<td>{{$epreuve->devoir->matiere->nommat}}</td>
						<td>{{$epreuve->devoir->complexite}}</td>
						<td>{{$epreuve->devoir->tarif}}&nbsp;fcfa</td>
						<td>@if ($epreuve->session!=null)
                            {{$epreuve->session}}
                        @else
                            Aucune épreuve associée
                        @endif</td>
						<td>@if ($epreuve->annee!=null)
                            {{$epreuve->annee}}
                        @else
                            N/A
                        @endif</td>
						<td>@if ($epreuve->devoir->filiere!=null)
                            {{$epreuve->devoir->filiere}}
                        @else
                            Pas de filière
                        @endif</td>
						<td class="d-flex">
							<a onclick="Modifier();" class="btn btn-success rounded-circle me-1" href="{{route('epreuves.edit', $epreuve->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"><i class="ri-edit-circle-fill fs-5"></i></a>
							<a onclick="Supprimer();" class="btn btn-danger rounded-circle me-1" href="{{route('epreuves.destroy', $epreuve->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="ri-delete-bin-fill fs-5"></i></a>
                            <button type="button" class="btn btn-primary rounded-circle me-1" title="Détail"
                                data-bs-toggle="modal" data-bs-target="#myModal"
                                data-epreuves-id="{{ $epreuve->id }}"
                                data-epreuves-matiere="{{$epreuve->devoir->matiere->nommat}}"
                                data-epreuves-classe="{{$epreuve->devoir->filiere}}"
                                data-epreuves-taille="{{$epreuve->devoir->taille }}"
                                data-epreuves-fichier="{{asset('storage/'. $epreuve->devoir->fichierdev)}}"
                                data-epreuves-type="{{$epreuve->devoir->type }}"
                                data-epreuves-complexite="{{$epreuve->devoir->complexite }}"
                                data-epreuves-autre="{{$epreuve->devoir->autre}}"
                                data-epreuves-annee="@if ($epreuve->annee !=null)
                                {{$epreuve->annee}}
                            @else
                                N/A
                            @endif"
                                data-epreuves-session="@if ($epreuve->session !=null)
                                {{$epreuve->session}}
                            @else
                                Aucune épreuve associée
                            @endif"
                                data-epreuves-prix="{{$epreuve->devoir->tarif}}"
                                data-epreuves-description="{{$epreuve->devoir->description }}">
                                 <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
							<a class="btn btn-secondary rounded-circle me-1" href="{{route('corrections.create', $epreuve->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter la correction"><i class="ri-add-box-fill fs-5"></i></a>
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
            <h1 class="modal-title fs-5" id="label">Détail de l'épreuve N°<span id="epreuveId"></span></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <embed id="epreuveFichier" src="http://infolab.stanford.edu/pub/papers/google.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" frameBorder="0" scrolling="auto" height="75%" width="100%">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <span class="card-title">Matière : &nbsp;</span><span class="card-title" id="epreuveMatiere"></span>
                            <p class="card-text fw-bold" style="color: #191970;">Description :&nbsp;<span class="fw-normal" id="epreuveDescription"></span></p>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text mr-3 fw-bold" style="color: #191970;">Filière :&nbsp;<small id="epreuveFilière" class="text-body-secondary fw-bold"></small></p>
                                    <span class="d-flex">
                                        <p class="card-text mr-3 fw-bold" style="color: #191970;">Année : &nbsp;<small id="epreuveAnnee" class="text-body-secondary fw-bold">Niveaux</small></p>
                                        <p class="card-text fw-bold mr-3" style="color: #191970;">Session : &nbsp;<small id="epreuveSession" class="text-body-secondary fw-bold">Domaine</small></p>
                                        <p class="card-text fw-bold" style="color: #191970;" >Type : &nbsp;<small id="epreuveType" class="text-body-secondary fw-bold">Matière</small></p>
                                    </span>
                                    <p class="card-text fw-bold" style="color: #191970;" >Complexité : &nbsp;<small id="epreuveComplexite" class="text-body-secondary fw-bold">Matière</small></p>
                                    <p class="card-text fw-bold" style="color: #191970;" >Prix : &nbsp;<small id="epreuvePrix" class="text-body-secondary fw-bold">Prix</small>&nbsp;fcfa</p>
                                    <p class="card-text fw-bold" style="color: #191970;" >Autres matièrs : &nbsp;<small id="autreMatEpreuve" class="text-body-secondary fw-bold">Prix</small></p>
                                    <p class="card-text fw-bold text-end" style="color: #191970;" >Taille : &nbsp;<small id="epreuveTaille" class="text-body-secondary fw-bold">Taille</small></p>
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

      var epreuveId = button.data('epreuves-id'); // récupérer la valeur de l'attribut data-epreuves-id
      var epreuveMatiere = button.data('epreuves-matiere'); // récupérer la valeur de l'attribut data-epreuves-matiere
      var epreuveDescription = button.data('epreuves-description'); // récupérer la valeur de l'attribut data-epreuves-description
      var epreuveFilière = button.data('epreuves-classe'); // récupérer la valeur de l'attribut data-epreuves-classe
      var epreuveAnnee = button.data('epreuves-annee'); // récupérer la valeur de l'attribut data-epreuves-annee
      var epreuveSession = button.data('epreuves-session'); // récupérer la valeur de l'attribut data-epreuves-session
      var epreuveType = button.data('epreuves-type'); // récupérer la valeur de l'attribut data-epreuves-type
      var autreMatEpreuve = button.data('epreuves-autre'); // récupérer la valeur de l'attribut data-epreuves-autre
      var epreuveComplexite = button.data('epreuves-complexite'); // récupérer la valeur de l'attribut data-epreuves-complexite
      var epreuveTaille = button.data('epreuves-taille'); // récupérer la valeur de l'attribut data-epreuves-taille
      var epreuveFichier = button.data('epreuves-fichier'); // récupérer la valeur de l'attribut data-epreuves-fichier
      var epreuvePrix = button.data('epreuves-prix'); // récupérer la valeur de l'attribut data-epreuves-prix

      // Mettez à jour le contenu du modal avec les informations récupérées
      var modal = $(this);
      modal.find('#epreuveId').text(epreuveId);
      modal.find('#epreuveMatiere').text(epreuveMatiere);
      modal.find('#epreuveDescription').text(epreuveDescription);
      modal.find('#epreuveFilière').text(epreuveFilière);
      modal.find('#epreuveAnnee').text(epreuveAnnee);
      modal.find('#epreuveSession').text(epreuveSession);
      modal.find('#epreuveType').text(epreuveType);
      modal.find('#epreuveComplexite').text(epreuveComplexite);
      modal.find('#autreMatEpreuve').text(autreMatEpreuve);
      modal.find('#epreuveTaille').text(epreuveTaille);
      modal.find('#epreuvePrix').text(epreuvePrix);
      modal.find('#epreuveFichier').attr('src',epreuveFichier);
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
