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
                    @if (session()->has('success'))
                        <div class="d-flex justify-content-center mt-3">
                            <div class="alert alert-success alert-dismissible fade show " role="alert" id="successAlert">
                                {{ session()->get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
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
                                            <h4 class="fw-bold">{{ $candidate->first_name ?? '--' }}
                                                {{ $candidate->last_name ?? '--' }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i>
                                                    {{ $candidate->compagny->name ?? '--' }}</div>
                                                <div class="vr"></div>
                                                <div>Date de création : <span
                                                        class="fw-medium">{{ $candidate->created_at->format('d/m/Y') ?? '--' }}
                                                    </span></div>
                                                <div class="vr"></div>
                                                <div>Statut : <span
                                                        class="fw-medium badge rounded-pill bg-primary fs-12">{{ $candidate->candidateStatut->name ?? '--' }}</span>
                                                </div>
                                                <div class="vr"></div>
                                                <div>Etat : <span
                                                        class="fw-medium badge rounded-pill bg-primary fs-12">{{ $candidate->candidateState->name ?? '--' }}</span>
                                                </div>
                                                <div class="vr"></div>
                                                <div>Certificat : @if ($candidate->certificate)
                                                        <span class="badge rounded-pill bg-success"
                                                            id="certificate-{{ 0 }}"
                                                            onclick="toggleCertificate({{ 0 }})">
                                                            <span
                                                                id="hidden-certificate-{{ 0 }}">••••••••</span>
                                                            <span id="visible-certificate-{{ 0 }}"
                                                                style="display: none;">{{ $candidate->certificate }}</span>
                                                        </span>
                                                    @else
                                                        ---
                                                    @endif

                                                    <div id="message-{{ 0 }}" style="display: none;"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-auto">


                                <div class="hstack gap-1 flex-wrap">
                                    @if (auth()->user()->hasRole('Administrateur'))
                                        <div class="p-2">
                                            <span>Modifier l'état :</span>
                                            <select class="form-control   w-md" wire:model.live="candidate_state_id">
                                                <option value="">Selectionner</option>
                                                @foreach ($candidateStates as $candidateState)
                                                    <option value="{{ $candidateState->id }}"
                                                        @if ($candidateState->id == $candidate_state_id) selected @endif>
                                                        {{ $candidateState->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    @endif
                                    <button class="btn btn-danger mt-3"
                                        wire:click="confirmDelete('{{ $candidate->name }}', '{{ $candidate->id }}')"
                                        type="button" class="btn py-0 fs-16 text-body">
                                        Supprimer
                                    </button>
                                    {{-- <a class="btn btn-info mt-3" href="{{ Route('candidates.edit', $candidate) }}"
                                        type="button" class="btn py-0 fs-16 text-body">
                                        Modifier
                                    </a> --}}

                                    {{-- <a href="{{ url()->previous() }}" class="btn btn-secondary ms-5 mt-3"><i
                                            class="mdi mdi-arrow-left me-1"></i>Retour</a> --}}
                                    <a href="#" onclick="goBack()" class="btn btn-secondary me-1 ms-5"><i
                                            class="mdi mdi-arrow-left me-1"></i>Retour</a>
                                </div>

                            </div>
                        </div>
                        <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#info" role="tab">
                                    Informations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#documents" role="tab">
                                    Documents
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" data-bs-toggle="tab" href="#cre" role="tab">
                                    C.R.E
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content text-muted">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card mt-4">
                                            <div class="card-header align-items-center d-flex border-bottom-dashed">
                                                <h4 class="card-title mb-0 flex-grow-1">Informations</h4>
                                            </div>
                                            <div class="card-body">
                                                {{-- <div class="text-muted">
                                                    <div class=" ">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Auteur :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                
                                                                        {{ $candidate->auteur->trigramme ?? '--' }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Source :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->origine ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        CodeCDT :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->code_cdt ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">Civ :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->civ->name ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Prénom :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->first_name ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">Nom :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->last_name ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Disponibilité
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->disponibility->name ?? '--' }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">Etape
                                                                        suivante :
                                                                    </p>

                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->nextStep->name ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        NSDATE :
                                                                    </p>

                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->ns_date ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Statut :
                                                                    </p>
                                                                    <div class="badge bg-primary fs-12">
                                                                        {{ $candidate->candidate_statut_id ?? '--' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Etat :
                                                                    </p>
                                                                    <div class="badge bg-primary fs-12">
                                                                        {{ $candidate->state ?? '--' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Certificat :
                                                                    </p>
                                                                    @if ($candidate->certificate)
                                                                        <span class="badge rounded-pill bg-success"
                                                                            id="certificate-{{ 0 }}"
                                                                            onclick="toggleCertificate({{ 0 }})">
                                                                            <span
                                                                                id="hidden-certificate-{{ 0 }}">••••••••</span>
                                                                            <span
                                                                                id="visible-certificate-{{ 0 }}"
                                                                                style="display: none;">{{ $candidate->certificate }}</span>
                                                                        </span>
                                                                    @else
                                                                        ---
                                                                    @endif

                                                                    <div id="message-{{ 0 }}"
                                                                        style="display: none;"></div>
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
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Poste
                                                                        (Fonction1) :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ optional($candidate->position)->name ?? '--' }}
                                                                    </h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Spécialité
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ optional($candidate->specialities->first())->name ?? '--' }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Domaine
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ optional($candidate->fields->first())->name ?? '--' }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Société :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->compagny->name ?? '--' }}</h5>
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
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">Mail
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->email ?? '--' }}</h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Téléphone 1
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->phone ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Téléphone 2
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->phone_2 ?? '--' }}</h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        CP/Dpt :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->postal_code ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">Pays
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->country ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3  mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Région :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->region ?? '--' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3  mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Ville :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->city ?? '--' }}</h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 mt-4">
                                                                <div>
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        UrlCTC :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->url_ctc ?? '--' }}</h5>
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
                                                                    <p class="mb-2 text-uppercase fw-medium fs-13">
                                                                        Commentaire
                                                                        :
                                                                    </p>
                                                                    <h5 class="fs-15 mb-0">
                                                                        {{ $candidate->commentaire ?? '--' }}</h5>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <form wire:submit.prevent="storeData()">
                                                    @csrf

                                                    <div class="card-body">

                                                        <div class="row g-4">

                                                            <div class="card mt-4">
                                                                <div class="card-header">
                                                                    <h5
                                                                        class="card-title
                                                                    mb-0">
                                                                        Informations
                                                                        personnelles</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-2">
                                                                            <div>
                                                                                <label for="origine"
                                                                                    class="form-label">Auteur </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('origine') is-invalid @enderror "
                                                                                    value=" {{ $candidate->auteur->trigramme ?? '--' }}"
                                                                                    placeholder="auteur" disabled />
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div>
                                                                                <label for="origine"
                                                                                    class="form-label">Source </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('origine') is-invalid @enderror "
                                                                                    wire:model='origine'
                                                                                    placeholder="Veuillez entrer la source" />
                                                                                @error('origine')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div>
                                                                                <label for="job-category-Input"
                                                                                    class="form-label">Civilité</label>
                                                                                <select
                                                                                    class="form-control form-control-custom  @error('civ_id') is-invalid @enderror "
                                                                                    wire:model='civ_id'>
                                                                                    <option value="" selected>
                                                                                        Selectionner</option>
                                                                                    @foreach ($civs as $civ)
                                                                                        <option
                                                                                            value="{{ $civ->id }}">
                                                                                            {{ $civ->name }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                                @error('civ_id')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div>
                                                                                <label for="first_name"
                                                                                    class="form-label">Prénom <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('first_name') is-invalid @enderror "
                                                                                    wire:model.live='first_name'
                                                                                    placeholder="Veuillez entrer le prénom" />
                                                                                @error('first_name')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div>
                                                                                <label for="last_name"
                                                                                    class="form-label">Nom <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('last_name') is-invalid @enderror"
                                                                                    wire:model.live='last_name'
                                                                                    placeholder="Veuillez entrer le nom" />

                                                                                @error('last_name')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2 mt-4">
                                                                            <div>
                                                                                <label for="disponibility"
                                                                                    class="form-label">Disponibilité
                                                                                </label>
                                                                                <select
                                                                                    class="form-control form-control-custom  @error('disponibility_id') is-invalid @enderror "
                                                                                    wire:model='disponibility_id'>
                                                                                    <option value="" selected>
                                                                                        Selectionner</option>
                                                                                    @foreach ($disponibilities as $disponibility)
                                                                                        <option
                                                                                            value="{{ $disponibility->id }}">
                                                                                            {{ $disponibility->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('disponibility_id')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 mt-4">
                                                                            <div>
                                                                                <label for="next_step_id"
                                                                                    class="form-label">Next step
                                                                                </label>
                                                                                <select
                                                                                    class="form-control form-control-custom  @error('next_step_id') is-invalid @enderror "
                                                                                    wire:model='next_step_id'>
                                                                                    <option value="" selected>
                                                                                        Selectionner</option>
                                                                                    @foreach ($nextSteps as $nextStep)
                                                                                        <option
                                                                                            value="{{ $nextStep->id }}">
                                                                                            {{ $nextStep->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('next_step_id')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 mt-4">
                                                                            <div>

                                                                                <label for="ns_date"
                                                                                    class="form-label">NSDATE </label>
                                                                                <input type="date"
                                                                                    class="form-control form-control-custom  @error('ns_date') is-invalid @enderror"
                                                                                    wire:model='ns_date'
                                                                                    placeholder="Veuillez entrer ns_date" />
                                                                                @error('ns_date')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 mt-4">
                                                                            <div>
                                                                                <label for="candidate_statut_id"
                                                                                    class="form-label">Statut <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select
                                                                                    class="form-control form-control-custom  @error('candidate_statut_id') is-invalid @enderror"
                                                                                    wire:model='candidate_statut_id'>
                                                                                    <option value="" selected>
                                                                                        Selectionner</option>
                                                                                    @foreach ($candidateStatuses as $statu)
                                                                                        <option
                                                                                            value="{{ $statu->id }}"
                                                                                            @if ($statu->id == $candidate_statut_id) selected @endif>
                                                                                            {{ $statu->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('candidate_statut_id')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 mt-4">
                                                                            <div>
                                                                                <label for="candidate_statut_id"
                                                                                    class="form-label">codeCDT</label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  "
                                                                                    value="{{ $candidate->code_cdt }}"
                                                                                    wire:model='code_cdt' disabled />

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card ">
                                                                <div class="card-header">
                                                                    <h5
                                                                        class="card-title
                                                                    mb-0">
                                                                        Addresse</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">


                                                                        <div class="col-md-2 ">
                                                                            <div>
                                                                                <label for="email"
                                                                                    class="form-label">Email <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="email"
                                                                                    class="form-control form-control-custom  @error('email') is-invalid @enderror "
                                                                                    wire:model.live='email'
                                                                                    placeholder="Veuillez entrer l'address email" />
                                                                                @error('email')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 ">
                                                                            <div>
                                                                                <label for="phone"
                                                                                    class="form-label">Téléphone 1
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('phone') is-invalid @enderror "
                                                                                    wire:model='phone'
                                                                                    placeholder="Veuillez entrer le numéro de télépone 1" />

                                                                                @error('phone')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 ">
                                                                            <div>
                                                                                <label for="phone_2"
                                                                                    class="form-label">Téléphone
                                                                                    2</label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('phone_2') is-invalid @enderror "
                                                                                    wire:model='phone_2'
                                                                                    placeholder="Veuillez entrer le numéro de télépone 2" />

                                                                                @error('phone_2')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 ">
                                                                            <div>
                                                                                <label for="vancancy-Input"
                                                                                    class="form-label">CP/Dpt </label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-custom  @error('postal_code') is-invalid @enderror "
                                                                                    min="0"
                                                                                    wire:model='postal_code'
                                                                                    placeholder="Veuillez entrer la boîte postal" />
                                                                                @error('postal_code')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 ">
                                                                            <div>
                                                                                <label for="country"
                                                                                    class="form-label">Pays </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('country') is-invalid @enderror "
                                                                                    min="0"
                                                                                    wire:model='country'
                                                                                    placeholder="Veuillez entrer le pays" />
                                                                                @error('country')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 mt-4">
                                                                            <div>
                                                                                <label for="region"
                                                                                    class="form-label">Région </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('region') is-invalid @enderror "
                                                                                    min="0" wire:model='region'
                                                                                    placeholder="Veuillez  entrer la région" />
                                                                                @error('region')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 mt-4">
                                                                            <div>
                                                                                <label for="city"
                                                                                    class="form-label">Ville </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('city') is-invalid @enderror "
                                                                                    min="0" wire:model='city'
                                                                                    placeholder="Veuillez  entrer la ville" />
                                                                                @error('city')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 mt-4">
                                                                            <div>
                                                                                <label for="city"
                                                                                    class="form-label">UrlCTC </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-custom  @error('url_ctc') is-invalid @enderror "
                                                                                    min="0"
                                                                                    wire:model='url_ctc'
                                                                                    placeholder="Veuillez entrer l'UrlCTC" />
                                                                                @error('url_ctc')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card mt-4">
                                                                <div class="card-header">
                                                                    <h5
                                                                        class="card-title
                                                                    mb-0">
                                                                        Cursus</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-3">
                                                                            <div>
                                                                                <label for="compagny_id"
                                                                                    class="form-label">Societé </label>
                                                                                <select
                                                                                    class="form-control form-control-custom  @error('compagny_id') is-invalid @enderror "
                                                                                    wire:model='compagny_id'>
                                                                                    <option value="" selected>
                                                                                        Selectionner</option>
                                                                                    @foreach ($compagnies as $compagny)
                                                                                        <option
                                                                                            value="{{ $compagny->id }}"
                                                                                            @if ($compagny->id == $compagny_id) selected @endif>
                                                                                            {{ $compagny->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('compagny_id')
                                                                                    <span
                                                                                        class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div>
                                                                                <label for="position_id" class="form-label">Poste (Fonction1) </label>
                                                                                <select
                                                                                    class="form-control  
                                form-control-custom  @error('position_id') is-invalid @enderror "
                                                                                    wire:model.live='position_id'>
                                                                                    <option value="" selected>Selectionner</option>
                                                                                    @foreach ($positions as $position)
                                                                                        <option value="{{ $position->id }}"
                                                                                            @if ( $position->id == $position_id) selected @endif>
                                                                                            {{ $position->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('position_id')
                                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div>
                                                                                <label for="speciality_id" class="form-label">Spécialité
                                                                                    (Fonction2)</label>
                                                                                <select
                                                                                    class="form-control  
                                form-control-custom  @error('speciality_id') is-invalid @enderror "
                                                                                    wire:model.live='speciality_id'>
                                                                                    @if ($specialities)
                                                                                        @if ($specialities->count() > 0)
                                
                                                                                            <option value="" selected>Selectionner
                                                                                            </option>
                                                                                            @foreach ($specialities as $speciality)
                                                                                                <option value="{{ $speciality->id }}"
                                                                                                    @if ($speciality->id == $speciality_id) selected @endif>
                                                                                                    {{ $speciality->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @else
                                                                                            <option value="">Aucune donnée</option>
                                
                                                                                        @endif
                                                                                    @else
                                                                                        <option value="">Veuillez choisir un poste</option>
                                                                                    @endif
                                                                                </select>
                                                                                @error('speciality_id')
                                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 ">
                                                                            <div>
                                                                                <label for="field_id" class="form-label">Domaine
                                                                                    (Fonction3)</label>
                                                                                <select
                                                                                    class="form-control  
                                form-control-custom  @error('field_id') is-invalid @enderror "
                                                                                    wire:model.live='field_id'>
                                                                                    @if ($fields)
                                                                                        @if ($fields->count() > 0)
                                
                                                                                            <option value="" selected>Selectionner une spécialité
                                                                                            </option>
                                                                                            @foreach ($fields as $field)
                                                                                                <option value="{{ $field->id }}"
                                                                                                    @if ($field->id == $field_id) selected @endif>
                                                                                                    {{ $field->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @else
                                                                                            <option value="">Aucune donnée</option>
                                
                                                                                        @endif
                                                                                    @else
                                                                                        <option value="">Veuillez choisir une spécialité</option>
                                                                                    @endif
                                                                                </select>
                                                                                @error('field_id')
                                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card mt-4">

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <!-- Example Textarea -->
                                                                            <div>
                                                                                <label for="commentaire"
                                                                                    class="form-label">Commentaire
                                                                                </label>
                                                                                <textarea wire:model='commentaire' class="form-control form-control-custom " rows="3"></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="d-flex justify-content-end">
                                                            <button wire:loading.remove wire:target="storeData"
                                                                type="submit" class="btn btn-primary">
                                                                Enregistrer
                                                            </button>
                                                            <button wire:loading wire:target="storeData"
                                                                type="button" class="btn btn-primary" disabled>
                                                                <span class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                Enregistrement...
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form>














                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                        <!-- end card -->
                                    </div>
                                    <!-- ene col -->

                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end tab pane -->
                            <div class="tab-pane fade" id="documents" role="tabpanel">
                                <div class="col-sm-12">

                                    @livewire('back.files.candidate-file', ['candidate' => $candidate])
                                    <!-- end card -->
                                </div>
                            </div>
                            <!-- end tab pane -->
                            <div class="tab-pane fade" id="cre" role="tabpanel">
                                <div class="col-sm-12">
                                    @livewire('back.cres.index', ['candidate' => $candidate])
                                    <!-- end card -->
                                </div>
                                <!--end card-->
                            </div>
                            <!-- end tab pane -->

                            <!-- end tab pane -->
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
    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('successAlert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 3000);
    </script>
@endpush
