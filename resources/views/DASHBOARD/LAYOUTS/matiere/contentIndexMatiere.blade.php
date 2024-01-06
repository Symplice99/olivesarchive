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
                <h5 class="card-title">Liste des matieres</h5>
                <span class="">
                </span>
            </div>
            <div class="col-md-3 mb-3">
                <a class="btn btn-primary" href="{{route('matieres.create')}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Ajouter">
                    <i class="ri-add-box-fill fs-5" style="" ></i>
                    Nouveau</a>
            </div>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom matière</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($matieres as $matiere)
					<tr>
										<!-- Table data -->
						<td>{{$matiere->id}}</td>
						<td>{{$matiere->nommat}}</td>
						<td class="d-flex">
							<a onclick="Modifier();" class="btn btn-success rounded-circle me-1" href="{{route('matieres.edit', $matiere->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"><i class="ri-edit-circle-fill fs-5"></i></a>
							<a onclick="Supprimer();" class="btn btn-danger rounded-circle" href="{{route('matieres.destroy', $matiere->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="ri-delete-bin-fill fs-5"></i></a>
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


    // Fermer la boîte d'alerte après 5 secondes (5000 millisecondes)
    // setTimeout(function() {
    //     document.getElementById('success-alert').style.display = 'none';
    //     document.getElementById('error-alert').style.display = 'none';
    // }, 5000);

</script>

