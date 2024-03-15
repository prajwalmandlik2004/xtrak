<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Détail du candidat',
        'breadcrumbItems' => [
            ['text' => 'Candidats', 'url' => '#'],
            ['text' => 'Liste', 'url' => Route('candidates.index')],
            ['text' => 'Détail', 'url' => '#', 'active' => true],
        ],
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4">
                <div class="bg-secondary-subtle">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-auto">
                                        <div class="avatar-md">
                                            <div class="avatar-title bg-white rounded-circle">
                                                <img src="{{ asset('assets/images/brands/slack.png') }}" alt=""
                                                    class="avatar-xs">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold">{{ $candidate->first_name ?? 'Non renseigné' }}
                                                {{ $candidate->last_name ?? 'Non renseigné' }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i>
                                                    {{ $candidate->compagny->name  ?? "Non renseigné" }}</div>
                                                <div class="vr"></div>
                                                <div>Date de création : <span
                                                        class="fw-medium">{{ $candidate->created_at->format('d/m/Y') ?? 'Non renseigné' }}
                                                    </span></div>
                                                <div class="vr"></div>
                                                <div>Statut : <span
                                                        class="fw-medium badge rounded-pill bg-primary fs-12">{{ $candidate->cdt_status ?? 'Non renseigné' }}</span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-auto">
                                <div class="hstack gap-1 flex-wrap">
                                    <a class="btn btn-secondary" href="{{ Route('candidates.edit', $candidate) }}"
                                        type="button" class="btn py-0 fs-16 text-body">
                                        Modifier
                                    </a>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary ms-5"><i
                                        class="mdi mdi-arrow-left me-1"></i>Retour</a>
                                </div>
                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-8 col-lg-6">
                                <div class="card mt-4">
                                    <div class="card-header align-items-center d-flex border-bottom-dashed">
                                        <h4 class="card-title mb-0 flex-grow-1">Informations</h4>
                                        
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="text-muted">
                                            <div class=" ">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Auteur :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->auteur->first_name  ?? 'Non renseigné' }}  {{ $candidate->auteur->last_name  ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Source :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->origine  ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">CodeCDT :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->code_cdt ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Civ :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->civ->name ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Prénom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->first_name ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Nom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->last_name ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Disponibilité :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->disponibility->name ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-sm-3 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Statut CDT :
                                                            </p>
                                                            <div class="badge bg-primary fs-12">
                                                                {{ $candidate->cdt_status ?? 'Non renseigné' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Certificat :
                                                            </p>
                                                            <span class="badge rounded-pill bg-success"
                                                            id="certificate-{{ 0 }}"
                                                            onclick="toggleCertificate({{ 0 }})">
                                                            <span id="hidden-certificate-{{ 0 }}">••••••••</span>
                                                            <span id="visible-certificate-{{ 0 }}"
                                                                style="display: none;">{{ $candidate->certificate }}</span>
                                                        </span>
                                                        <div id="message-{{ 0 }}" style="display: none;"></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                   
                                            </div>
                                        </div>
                                        
                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Poste
                                                                (Fonction1) :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ optional($candidate->position)->name ?? 'Non renseigné' }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Spécialité
                                                                :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ optional($candidate->specialities->first())->name ?? 'Non renseigné' }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Domaine
                                                                :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ optional($candidate->fields->first())->name ?? 'Non renseigné' }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Société :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->compagny->name ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">

                                                    
                                                    
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Mail :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->email ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Téléphone 1 :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->phone ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Téléphone 2 :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->phone_2 ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">CP/Dpt :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->postal_code ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Pays :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->country ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3  mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Région :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->region ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3  mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Ville :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->city ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-3 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">UrlCTC :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->url_ctc ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">

                                                    <div class="col-sm-12 mt-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Commentaire :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->commentaire ?? 'Non renseigné' }}</h5>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                   
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                                <!-- end card -->
                            </div>
                            <!-- ene col -->
                            <div class="col-xl-4 col-lg-4">
                                @livewire('back.files.candidate-file', ['candidate' => $candidate])
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
</div>

@push('page-script')
<script>
    function toggleCertificate(index) {
        var hiddenCertificate = document.getElementById('hidden-certificate-' + index);
        var visibleCertificate = document.getElementById('visible-certificate-' + index);
        var messageDiv = document.getElementById('message-' + index);

        if (hiddenCertificate.style.display === "none") {
            hiddenCertificate.style.display = "inline";
            visibleCertificate.style.display = "none";
            messageDiv.style.display = "none";
        } else {
            hiddenCertificate.style.display = "none";
            visibleCertificate.style.display = "inline";


            navigator.clipboard.writeText(visibleCertificate.textContent).then(function() {
                messageDiv.textContent = 'Copie réussie !';
                messageDiv.style.display = "block";
                setTimeout(function() {
                    messageDiv.style.display = "none";
                }, 1000);
            }, function(err) {
                messageDiv.textContent = 'Erreur lors de la copie : ' + err;
                messageDiv.style.display = "block";
                setTimeout(function() {
                    messageDiv.style.display = "none";
                }, 1000);
            });
        }
    }
</script>
@endpush