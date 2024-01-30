<section class="py-0 py-xl-5">
	<div class="container">

        <div class="row">

            <div class="col-12">
                <div class="row g-4">

                    <div class="col-md-12 mt-n6 mb-0 mb-md-5">
						<div class="bg-body shadow text-start p-4">
							<!-- titre -->
							<div style="background: rgba(232, 235, 237, 1);" class="col-xl-12 w-auto  d-flex justify-content-start align-items-center">
                                <div class="avatar avatar-xl">
                                    <span class="display-6 text-primary"><i class="bx bxs-file-pdf"></i></span>
                                </div>
								<h4 class="text-secondary fw-bold  me-2">{{$cour->matiere->nommat.": ". $cour->titre}}
                                </h4>
                                {{-- <span class="text-secondary small">complexité</span> --}}
							</div>
							<!-- Content -->
							<blockquote>
								<p class="me-3">
                                    <label class="fw-bold" for="">Description:</label>
									<span class="small text-md">{{ $cour->description}}</span>

                                    <hr class="bg-secondary">
                                    <label style="padding-left: 60px;" class="fw-bold" for="">Niveau:</label>
									<span class="small">{{ $cour->niveau->nomniv}}</span>

                                    <hr class="bg-secondary">
                                    <label style="padding-left: 47px;" class="fw-bold" for="">Domaine:</label>
									<span class="small">{{ $cour->domaine->nomdom}}</span>

                                    <hr class="bg-secondary">
                                    <label   class="fw-bold" for="">Type de fichier:</label>
									<span class="small">PDF</span>

                                    <hr class="bg-secondary">
                                    <label style="padding-left: 46px;"   class="fw-bold" for="">Publié le:</label>
									<span class="small">Date</span>

                                    <hr class="bg-secondary">
                                    <label style="padding-left: 70px;"  class="fw-bold" for="">Taille:</label>
									<span class="small">{{ $cour->taile}}</span>
								</p>
                                <hr class="bg-secondary">
                                <div class="col-md-4">
                                    <canvas id="pdf-preview"></canvas>
                                </div>

							</blockquote>
                            <form action="{{route('fedapay.webhook')}}" method="POST">
                                @csrf
                                <input type="hidden" name="courID" value={{$cour->id}}>
                                <input type="hidden" name="clientID" value={{auth()->user()->id}}>
                                <a id="pay-btn" href="#"  class="btn btn-light justify-content-start align-items-center">
                                    <div class="avatar avatar-xl">
                                        <span class="display-6 text-primary"><i class="bx bxs-download"></i></span>
                                    </div>
                                    <span class="text-secondary fw-bold  me-2">Télécharger ce cours</span>
                                </a>
                            </form>
                            <div class="justify-content-end w-100 align-items-center">
                                <a class="btn btn-primary" href="{{route('accueils.indexAccueilCours')}}">Retour</a>
                            </div>
						</div>
					</div>

                </div>

            </div>

        </div>

	</div>
    <script type="text/javascript">
        FedaPay.init('#pay-btn', {
            public_key: 'pk_sandbox_v7vBPALVr_VIEglBcxEM9rzB',
            transaction: {
                amount: {{$cour->domaine->prix}},
                description: 'Achat de cours',
                currency: 'XOF',
                custom: {
                    // Ajoutez vos propres attributs personnalisés ici
                    cours_id: {{$cour->id}},
                    //user_id: {{auth()->user()->id}},
                },
            },
        });
    </script>

</section>

<script>

loadingTask.promise.then(
    function(pdfDocument) {
        document.addEventListener('DOMContentLoaded', function() {
        // URL du document PDF
        var pdfUrl = '/storage/app/public/cours/KxgZjnmu13EBvcnpiF2LRMMsaJbj7sC86Vi9RDGP.pdf';

        // Nombre de pages à afficher (par exemple, 3 pages)
        var numberOfPagesToShow = 3;

        // Fonction pour afficher l'aperçu du PDF
        function showPDFPreview() {
            // Créez une promesse pour charger le document PDF
            var loadingTask = pdfjsLib.getDocument(pdfUrl);

            loadingTask.promise.then(function (pdfDocument) {
                // Sélectionnez le conteneur canvas
                var canvasContainer = document.getElementById('pdf-preview');

                // Boucle pour afficher le nombre spécifié de pages
                for (var pageNumber = 1; pageNumber <= numberOfPagesToShow; pageNumber++) {
                    // Créez un élément canvas pour chaque page
                    var canvas = document.createElement('canvas');
                    canvasContainer.appendChild(canvas);

                    // Obtenez le contexte du canvas
                    var context = canvas.getContext('2d');

                    // Chargez la page PDF
                    pdfDocument.getPage(pageNumber).then(function (pdfPage) {
                        // Obtenez les dimensions de la page
                        var viewport = pdfPage.getViewport({ scale: 1.5 });

                        // Appliquez les dimensions au canvas
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        // Dessinez la page sur le canvas
                        pdfPage.render({ canvasContext: context, viewport: viewport });
                    });
                }
            });
        }

        // Appelez la fonction pour afficher l'aperçu
        showPDFPreview();
    });
    },
    function(reason) {
        console.error('Erreur lors du chargement du PDF', reason);
    }
);

</script>
