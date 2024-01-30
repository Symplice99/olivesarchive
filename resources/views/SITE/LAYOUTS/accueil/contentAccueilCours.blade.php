                    @foreach ($cours as $cour)
                        <div class="col-md-12 mb-3">
                            <div class="bg-body shadow text-start p-4">
                                <!-- Titre -->
                                <div style="background: rgba(232, 235, 237, 1);" class="col-xl-12 w-auto d-flex justify-content-start align-items-center">
                                    <div class="avatar avatar-xl">
                                        <span class="display-6 text-primary"><i class="bx bxs-file-pdf"></i></span>
                                    </div>
                                    <h4 class="text-secondary fw-bold me-2 pt-3">{{$cour->matiere->nommat.": ". $cour->titre}}</h4>
                                </div>
                                <!-- Contenu -->
                                <blockquote>
                                    <p class="me-3">
                                        <label class="fw-bold" for="">Description:</label>
                                        <span class="small text-md-truncate" style="max-width: 80%;">&nbsp;{{$cour->description}}</span><br>
                                        <label class="fw-bold" for="">Taille:</label>
                                        <span class="small">{{$cour->taile}}</span>
                                    </p>
                                </blockquote>
                                <!-- Évaluation -->
                                <div class="row d-flex">
                                    <div class="col-10">
                                        <ul class="list-inline mb-2">
                                            <!-- Étoiles ici -->
                                            <h6 class="mb-0">Étoiles ici</h6>
                                        </ul>
                                    </div>
                                    <div class="col-2">
                                        <a class="btn btn-primary rounded-circle" href="{{route('accueils.indexAccueilCoursDetail', $cour->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Détail"><i class="bi bi-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
