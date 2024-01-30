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
								<h4 class="text-secondary fw-bold  me-2">{{$epreuve->devoir->matiere->nommat." : "}}</h4>
                                <span class="text-secondary small">{{$epreuve->devoir->complexite}}</span>
							</div>
							<!-- Content -->
							<blockquote>
								<p class="me-3">
                                    <label class="fw-bold" for="">Description:</label>
									<span class="small text-md">{{$epreuve->devoir->description}}</span>
                                    @if ($epreuve->devoir->autre==null)
                                        <hr class="bg-secondary" hidden >
                                        <label hidden style="padding-left: 12px;" class="fw-bold" for="">Autre matière:</label>
                                        <span hidden class="small">{{$epreuve->devoir->autre}}</span>
                                    @else
                                        <hr class="bg-secondary">
                                        <label style="padding-left: 12px;" class="fw-bold" for="">Autre matière:</label>
                                        <span class="small">{{$epreuve->devoir->autre}}</span>

                                    @endif


                                    <hr class="bg-secondary">
                                    <label style="padding-left: 67px;" class="fw-bold" for="">Filière:</label>
									<span class="small">{{$epreuve->devoir->filiere}}</span>

                                    <hr class="bg-secondary">
                                    <label style="padding-left: 76px;" class="fw-bold" for="">Type:</label>
									<span class="small">épreuve &nbsp;{{$epreuve->devoir->type}}</span>

                                    <hr class="bg-secondary">
                                    <label   class="fw-bold" for="">Type de fichier:</label>
									<span class="small">PDF</span>

                                    <hr class="bg-secondary">
                                    <label style="padding-left: 46px;"   class="fw-bold" for="">Publié le:</label>
									<span class="small">Date</span>

                                    <hr class="bg-secondary">
                                    <label style="padding-left: 70px;"  class="fw-bold" for="">Taille:</label>
									<span class="small">{{$epreuve->devoir->taille}}</span>
								</p>
                                <hr class="bg-secondary">
                                <div class="col-md-4">
                                    <canvas id="pdf-preview"></canvas>
                                </div>

							</blockquote>


							<form action="{{route('fedapay.webhook')}}" method="POST">
                                @csrf
                                <input type="hidden" name="devoirID" value={{$epreuve->id}}>
                                <input type="hidden" name="clientID" value={{auth()->user()->id}}>
                                <button id="pay-btn1" type="submit"  class="btn btn-light justify-content-start align-items-center">
                                    <div class="avatar avatar-xl">
                                        <span class="display-6 text-primary"><i class="bx bxs-download"></i></span>
                                    </div>
                                    <span class="text-secondary fw-bold  me-2">Télécharger cette épreuve</span>
                                </button>
                            </form>

                            {{-- pay-btn c'est un id javascript in ca agit sur une  classe va dedans je vais voir  --}}
                            {{--Oui je sais bien, ça devrait pas poser de problème non--}}
						</div>
					</div>

                </div>

            </div>

        </div>

	</div>
        {{-- essaie voir --}}
    <script type="text/javascript">
        FedaPay.init('#pay-btn1', {
            public_key: 'pk_sandbox_v7vBPALVr_VIEglBcxEM9rzB',
            transaction: {
                amount: {{$epreuve->tarif}},
                description: 'Achat de cours',
                currency: 'XOF',
                custom: {
                    // Ajoutez vos propres attributs personnalisés ici
                    cours_id: {{$epreuve->id}},
                    //user_id: {{auth()->user()->id}},
                },

            },
        });
    </script>
    {{-- le script est là --}}
</section>
