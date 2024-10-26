<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
    'title' => 'Nouvelle saisie',
    'breadcrumbItems' => [
    ['text' => 'Candidats', 'url' => '#'],
    ['text' => 'Liste', 'url' => Route('candidates.index')],
    ['text' => 'Nouveau', 'url' => '#', 'active' => true],
    ],
    ])
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <!-- <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 1 ? '#info' : '' }}" role="tab">
                            Informations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 2 ? '#' : '#documents' }}" role="tab">
                            Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#cre' }}" role="tab">
                            C.R.E
                        </a>
                    </li>
                </ul> -->


                <div class="tab-content text-muted">
                    <div class="tab-pane fade  {{ $step == 1 ? 'show active' : '' }}" id="info" role="tabpanel">
                        <form wire:submit.prevent="storeCandidateData()">
                            @csrf
                            <div class="card-header">
                                <div class="d-flex">
                                    <div class="p-2 flex-grow-1">
                                        <h5 class="mb-0 card-title ">
                                            {{ $action == 'create' ? "Formulaire de creation d'un candidat" : "Formulaire de modification d'un candidat" }}
                                        </h5>

                                    </div>
                                    {{-- @if (!$action == 'update')
                                        <div class="p-2">
                                            <a href="{{ Route('import.candidat') }}" class="btn btn-primary">Uplodad</a>
                                </div>
                                @endif --}}
                                <div class="p-2">
                                    <a wire:click='resetForm' class="btn btn-danger"></i>Effacer</a>
                                </div>
                                <div class="p-2">
                                    <button wire:click.prevent="storeCandidateData2" wire:loading.remove wire:target="storeCandidateData2" type="button"
                                        class="btn btn-success btn-label right ms-auto nexttab"><i
                                            class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                                        {{ $action == 'create' ? 'Enregistrer' : 'Modifier et suivant' }}</button>

                                    <button wire:loading wire:target="storeCandidateData2" type="button"
                                        class="btn btn-primary" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Enregistrement...
                                    </button>
                                </div>
                                <div class="p-2">
                                    {{-- <a href="{{ url()->previous() }}" class="btn btn-primary"><i
                                        class="mdi mdi-arrow-left me-1"></i>
                                    @if (!auth()->user()->hasRole('Administrateur'))
                                    Retour en arrirère
                                    @else
                                    Base
                                    @endif
                                    </a> --}}
                                    <a href="#" onclick="goBack()" class="btn btn-secondary me-1 ms-5"><i
                                            class="mdi mdi-arrow-left me-1"></i>{{ $action == 'create' ? 'Base' : 'Base et terminer' }}</a>
                                </div>

                            </div>


                    </div>
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'disabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 1 ? '#info' : '' }}" role="tab">
                                Informations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'disabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 2 ? '#' : '#documents' }}" role="tab">
                                Documents
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'disabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#cre' }}" role="tab">
                                C.R.E
                            </a>
                        </li>
                    </ul>
                    <div class="card-body">

                        <div class="row g-4">

                            <div class="mt-4 card">
                                <div class="card-header">
                                    <!-- <h5 class="mb-0 card-title">
                                                Informations
                                                personnelles</h5> -->
                                    <div class="col-lg-3" style="margin-left:3%">
                                        <div style="display: flex; align-items:center">
                                            <label for="origine" class="form-label" style="margin-right:5%">Date</label>
                                            <input type="text" class="form-control form-control-custom @error('origine') is-invalid @enderror"
                                                value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" disabled
                                                style="width:40%; text-align:center" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin-left:3%">
                                    <div class="row g-5">
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="origine" class="form-label">Aut.</label>
                                                <input type="text" class="form-control form-control-custom  @error('origine') is-invalid @enderror "
                                                    value="{{ Auth::user()->trigramme ?? '--' }}"
                                                    placeholder="auteur" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="origine" class="form-label">Source </label>
                                                <input type="text"
                                                    class="form-control form-control-custom  @error('origine') is-invalid @enderror "
                                                    wire:model='origine'
                                                    placeholder="Entrez la source" />
                                                @error('origine')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-auto">
                                            <div>
                                                <label for="job-category-Input" class="form-label">Civilité
                                                    <span class="text-danger">*</span></label>
                                                <select
                                                    class="form-control form-control-custom  @error('civ_id') is-invalid @enderror "
                                                    wire:model='civ_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($civs as $civ)
                                                    <option value="{{ $civ->id }}">
                                                        {{ $civ->name }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                                @error('civ_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-auto">
                                            <div>
                                                <label for="first_name" class="form-label">Prénom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom  @error('first_name') is-invalid @enderror "
                                                    wire:model.live='first_name'
                                                    placeholder="Entrez le prénom" />
                                                @error('first_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-auto me-5">
                                            <div>
                                                <label for="last_name" class="form-label">Nom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom  @error('last_name') is-invalid @enderror"
                                                    wire:model.live='last_name'
                                                    placeholder="Entrez le nom" />

                                                @error('last_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-auto">
                                            <div>
                                                <label for="cv_status" class="form-label">CV</label>
                                                @php
                                                $cvFile = $candidate->files()->where('file_type', 'cv')->first();
                                                $cvStatus = $cvFile ? ' OK ' : 'N/A';
                                                $cvColor = $cvFile ? 'limegreen' : 'red';
                                                @endphp
                                                <div id="cv_status" class="p-2 text-center" style="background-color: {{ $cvColor }}; color:#ffffff">
                                                    <strong>{{ $cvStatus }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-auto">
                                            <div>
                                                <label for="cre_status" class="form-label">CRE</label>
                                                @php
                                                $creExists = $candidate->cres()->exists();
                                                $creStatus = $creExists ? 'OK' : 'N/A';
                                                $creColor = $creExists ? 'limegreen' : 'red';
                                                @endphp
                                                <div id="cre_status" class="p-2 text-center" style=" background-color: {{ $creColor }};color:#ffffff">
                                                    <strong> {{ $creStatus }} </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mt-4 col-md-2 ">
                                            <div>
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control form-control-custom  @error('email') is-invalid @enderror "
                                                    wire:model.live='email'
                                                    placeholder="Entrez l'adresse email" />
                                                @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 col-lg-2 ">
                                            <div>
                                                <label for="phone" class="form-label">Téléphone 1 </label>
                                                <input type="text"
                                                    class="form-control form-control-custom  @error('phone') is-invalid @enderror "
                                                    wire:model='phone'
                                                    placeholder="Entrez le numéro de télépone 1" />

                                                @error('phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 col-lg-2">
                                            <div>
                                                <label for="disponibility" class="form-label">Disponibilité
                                                </label>
                                                <select
                                                    class="form-control form-control-custom  @error('disponibility_id') is-invalid @enderror "
                                                    wire:model='disponibility_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($disponibilities as $disponibility)
                                                    <option value="{{ $disponibility->id }}">
                                                        {{ $disponibility->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('disponibility_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 col-md-2">
                                            <div>
                                                <label for="candidate_statut_id" class="form-label">Statut
                                                </label>
                                                <select
                                                    class="form-control form-control-custom  @error('candidate_statut_id') is-invalid @enderror"
                                                    wire:model='candidate_statut_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($candidateStatuses as $statu)
                                                    <option value="{{ $statu->id }}"
                                                        @if ($action=='update' && $statu->id == $candidate_statut_id) selected @endif>
                                                        {{ $statu->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('candidate_statut_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 col-lg-2">
                                            <div>
                                                <label for="next_step_id" class="form-label">Next step </label>
                                                <select
                                                    class="form-control form-control-custom  @error('next_step_id') is-invalid @enderror "
                                                    wire:model='next_step_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($nextSteps as $nextStep)
                                                    <option value="{{ $nextStep->id }}"
                                                        @if ($nextStep->id == $next_step_id) selected @endif>
                                                        {{ $nextStep->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('next_step_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 col-lg-2">
                                            <div>
                                                <label for="ns_date_id" class="form-label">NsDate </label>
                                                <select
                                                    class="form-control form-control-custom  @error('ns_date_id') is-invalid @enderror "
                                                    wire:model='ns_date_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($nsDates as $nsDate)
                                                    <option value="{{ $nsDate->id }}"
                                                        @if ($nsDate->id == $ns_date_id) selected @endif>
                                                        {{ $nsDate->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('ns_date_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <!-- <div class="card-header">
                                            <h5 class="mb-0 card-title">
                                                Coordonnées</h5>
                                        </div> -->
                                <div class="card-body" style="margin-top:-2%;margin-left:3%">
                                    <div class="row">

                                        <div class="col-lg-2 ">
                                            <div>
                                                <label for="phone_2" class="form-label">Téléphone 2</label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom  @error('phone_2') is-invalid @enderror "
                                                    wire:model='phone_2'
                                                    placeholder="Entrez le numéro de télépone 2" />

                                                @error('phone_2')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div>
                                                <label for="vancancy-Input" class="form-label">CP/Dpt </label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom  @error('postal_code') is-invalid @enderror "
                                                    min="0" wire:model='postal_code'
                                                    placeholder="CP/DPt" />
                                                @error('postal_code')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="country" class="form-label">Pays </label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom  @error('country') is-invalid @enderror "
                                                    min="0" wire:model='country'
                                                    placeholder="Veuillez entrer le pays" />
                                                @error('country')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="region" class="form-label">Région </label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom  @error('region') is-invalid @enderror "
                                                    min="0" wire:model='region'
                                                    placeholder="Veuillez  entrer la région" />
                                                @error('region')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="city" class="form-label">Ville </label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom  @error('city') is-invalid @enderror "
                                                    min="0" wire:model='city'
                                                    placeholder="Entrez la ville" />
                                                @error('city')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="city" class="form-label">UrlCTC </label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom  @error('url_ctc') is-invalid @enderror "
                                                    min="0" wire:model='url_ctc'
                                                    placeholder="Veuillez entrer l'UrlCTC" />
                                                @error('url_ctc')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 card">
                                <div class="card-header" style="margin-top:-2%;">
                                    <h5 class="mb-0 card-title" style="margin-left:3%">
                                        Dernier poste occupé</h5>
                                </div>
                                <div class="card-body" style="margin-left:3%">
                                    <div class="row">
                                        <div class="col-lg-auto">
                                            <div>
                                                <label for="compagny_id" class="form-label">Societé </label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom  @error('compagny_id') is-invalid @enderror "
                                                    wire:model='compagny_id'
                                                    placeholder="Veuillez  entrer la société" />

                                                @error('compagny_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <label for="position_id" class="form-label">Poste (Fonction1) <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom @error('position_id') is-invalid @enderror"
                                                    wire:model='position_id'
                                                    placeholder="Veuillez entrer le poste" />
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
                                                    <option value="">Veuillez choisir un poste
                                                    </option>
                                                    @endif
                                                </select>
                                                @error('speciality_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 " style="width:330px">
                                            <div>
                                                <label for="field_id" class="form-label">Domaine
                                                    (Fonction3)</label>
                                                <select
                                                    class="form-control
                                    form-control-custom  @error('field_id') is-invalid @enderror "
                                                    wire:model.live='field_id'>
                                                    @if ($fields)
                                                    @if ($fields->count() > 0)

                                                    <option value="" selected>Selectionner une
                                                        spécialité
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
                                                    <option value="">Veuillez choisir une spécialité
                                                    </option>
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
                            <div class="mt-4 card">
                                <!-- <div class="card-header">
                                            <h5 class="mb-0 card-title">
                                                Commentaire et
                                                Documents</h5>
                                        </div> -->
                                <div class="card-body" style="margin-top:-3%;margin-left:3%">
                                    <div class="row">
                                        <div class="col-md-4" style="margin-right:3%">
                                            <!-- Example Textarea -->
                                            <div>
                                                <label for="commentaire" class="form-label">Commentaire
                                                </label>
                                                <textarea wire:model='commentaire' class="form-control form-control-custom " rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-right:3%">
                                            <!-- Example Textarea -->
                                            <div>
                                                <label for="description" class="form-label">Description
                                                </label>
                                                <textarea wire:model='description' class="form-control form-control-custom " rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Example Textarea -->
                                            <div>
                                                <label for="suivi" class="form-label">Suivi
                                                </label>
                                                <textarea wire:model='suivi' class="form-control form-control-custom " rows="3"></textarea>
                                            </div>
                                        </div>
                                        {{--
                                                <div class="col-md-4">

                                                    <div>
                                                        <label for="cv" class="form-label">Curriculum
                                                            Vitae</label>
                                                        <input wire:model="cv"
                                                            class="form-control form-control-custom  @error('cv') is-invalid @enderror"
                                                            type="file">
                                                    </div>
                                                    @error('cv')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label for="cover_letter" class="form-label">Lettre de
                                                motivation</label>
                                            <input wire:model="cover_letter"
                                                class="form-control form-control-custom  @error('cover_letter') is-invalid @enderror"
                                                type="file">
                                        </div>
                                        @error('cover_letter')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    --}}
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button wire:loading.remove wire:target="storeCandidateData" type="submit"
                            class="btn btn-success btn-label right ms-auto nexttab"><i
                                class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                            {{ $action == 'create' ? 'Enregistrer et suivant' : 'Modifier et suivant' }}</button>

                        <button wire:loading wire:target="storeCandidateData" type="button"
                            class="btn btn-primary" disabled>
                            <span class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                            Enregistrement...
                        </button>
                    </div>

                </div>

                </form>
            </div>
            <!-- end tab pane -->
            <div class="tab-pane fade {{ $step == 2 ? 'show active' : '' }}" id="documents" role="tabpanel">
                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 1 ? '#info' : '' }}" role="tab">
                            Informations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 2 ? '#' : '#documents' }}" role="tab">
                            Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#cre' }}" role="tab">
                            C.R.E
                        </a>
                    </li>
                </ul>
                <div class="col-sm-12">

                    <div>

                        <div class="card-header align-items-center d-flex border-bottom-dashed">
                            <h4 class="mb-0 card-title flex-grow-1">Documents</h4>

                            <div class="d-flex">
                                <div class="p-2 flex-grow-1">

                                    <button type="button" wire:click='goToForm'
                                        class="btn btn-sm btn-label">
                                        <i class="align-middle ri-arrow-left-line label-icon ms-2"></i>Aller
                                        vers le
                                        formulaire</button>
                                </div>
                                <div class="p-2 ">
                                    <button type="button" wire:click="openFileModal()"
                                        data-bs-toggle="modal" data-bs-target="#modal"
                                        class="btn btn-soft-info btn-sm"><i
                                            class="align-bottom ri-upload-2-fill me-1"></i>
                                        Nouveau</button>
                                </div>
                                <div class="p-2">
                                    <button type="button" wire:click='endCreate'
                                        class="btn btn-info btn-sm">
                                        Ignorer et Terminer</button>

                                </div>
                                <div class="p-2">
                                    <button type="button" wire:click='goToCre'
                                        class="btn btn-sm btn-label">
                                        <i class="align-middle ri-arrow-right-line label-icon ms-2"></i>Aller
                                        vers
                                        le CRE</button>

                                </div>
                            </div>
                        </div>


                        <div class="gap-2 vstack">
                            @if ($files)


                            @forelse ($files as $file)
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <div
                                                class="rounded avatar-title bg-light text-secondary fs-24">
                                                <i class="ri-file-ppt-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden flex-grow-1">
                                        <h5 class="mb-1 fs-15"><a href="#"
                                                class="text-body text-truncate d-block">{{ $file->name ?? '---' }}</a>
                                        </h5>
                                        <p
                                            class="mb-0 fw-medium badge rounded-pill bg-primary fs-10">
                                            @if ($file->file_type)
                                            @if ($file->file_type == 'cv')
                                            Curriculum Vitae
                                            @elseif($file->file_type == 'cover letter')
                                            Lettre de motivation
                                            @else
                                            Autre
                                            @endif
                                            @endif
                                        </p>

                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <div class="gap-1 d-flex">

                                            {{-- <a class=""
                                                                href="{{ asset('storage') . '/' . $file->path }}"
                                            download="{{ $file->name }}">
                                            <i class=""></i>
                                            </a> --}}
                                            {{-- <a class="btn btn-icon text-muted btn-sm fs-18"
                                                                wire:click="downloadFile('{{ $file->path }}','{{ $file->name }}')">
                                            <i class="ri-download-2-line"></i>
                                            </a> --}}
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                    type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">

                                                    <li>

                                                        <a class="dropdown-item"
                                                            wire:click="openFileModal('{{ $file->id }}')"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal"><i
                                                                class="align-bottom ri-pencil-fill me-2 text-muted"></i>
                                                            Renommer</a>
                                                    </li>
                                                    <li><a wire:click="confirmDeleteFile('{{ $file->name }}', '{{ $file->id }}')"
                                                            class="dropdown-item"><i
                                                                class="align-bottom ri-delete-bin-fill me-2 text-muted"></i>
                                                            Supprimer</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="py-4 mt-4 text-center" id="noresult">
                                <h5 class="mt-4">Aucun document trouvé</h5>
                            </div>
                            @endforelse
                            @else
                            <div class="py-4 mt-4 text-center" id="noresult">
                                <h5 class="mt-4">Aucun document trouvé</h5>
                            </div>
                            @endif

                        </div>


                        <x-modal>
                            <x-slot name="title">
                                {{ $isUpdateFile ? 'Modification du document' : 'Ajout de document' }}
                            </x-slot>
                            <x-slot name="body">
                                <form wire:submit.prevent="storeFile()">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            @if (!$isUpdateFile)
                                            <div class="col-md-12">
                                                <label for="fileType" class="form-label">Type</label>
                                                <select wire:model="fileType"
                                                    class="form-select mb-3  @error('fileType') is-invalid @enderror">
                                                    <option value="" selected>Selectionner</option>
                                                    <option value="cv">Curriculum Vitae</option>
                                                    <option value="cover letter">Lettre de motivation</option>
                                                    <option value="other">Autre</option>
                                                    @error('fileType')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror

                                            </div>
                                            @endif
                                            @if ($isUpdateFile)
                                            <div class="col-md-12">
                                                <label for="name" class="form-label">Nom du document
                                                    <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror "
                                                    wire:model.live='name'
                                                    placeholder="Veuillez entrer le nom du document" />

                                                        </div>
                                                    @endif
                                                    @if (!$isUpdateFile)
                                                        <div class="col-md-12 ">

                                                            <label for="newFile"
                                                                class="form-label ">Documents</label>
                                                            <input wire:model="newFile"
                                                                class="form-control mt-4 @error('newFile') is-invalid @enderror"
                                                                type="file">
                                                            @error('newFile')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit"
                                                    class="btn btn-primary ">{{ $isUpdateFile ? 'Modifier' : 'Ajouter' }}
                                                 </button>
                                                @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @endif
                                            @if (!$isUpdateFile)
                                            <div class="col-md-12 ">

                                                <label for="newFile"
                                                    class="form-label ">Documents</label>
                                                <input wire:model="newFile"
                                                    class="form-control mt-4 @error('newFile') is-invalid @enderror"
                                                    type="file">
                                                            <p style="color:red; margin-top:5px;">Téléchargez un fichier de moins de 2 Mo</p>
                                                <p style="color:red; margin-top:4px;">Téléchargez un fichier de moins de 2 Mo</p>
                                                <p style="color:red; margin-top:5px;">Téléchargez un fichier de moins de 2 Mo</p>
                                                @error('newFile')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit"
                                            class="btn btn-primary ">{{ $isUpdateFile ? 'Modifier' : 'Ajouter' }}</button>
                                    </div>
                                </form>
                            </x-slot>
                        </x-modal>

                    </div>


                    <!-- end card -->
                </div>
            </div>
            <!-- end tab pane -->
            <div class="tab-pane fade {{ $step == 3 ? 'show active' : '' }}" id="cre" role="tabpanel">
                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 1 ? '#info' : '' }}" role="tab">
                            Informations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 2 ? '#' : '#documents' }}" role="tab">
                            Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'disabled' : '' }}"
                            data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#cre' }}" role="tab">
                            C.R.E
                        </a>
                    </li>
                </ul>
                <div class="col-sm-12">
                    <form wire:submit.prevent="storeCre()">
                        @csrf
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2 flex-grow-1">
                                    <h5 class="mb-0 card-title ">
                                        Formulaire de creation d'un C.R.E
                                    </h5>
                                </div>
                                <div class="p-2">
                                    <a wire:click='goToDoc' class="btn btn-label"><i
                                            class="align-middle ri-arrow-left-line label-icon ms-2"></i>Aller
                                        vers les documents</a>
                                </div>
                                <div class="p-2">
                                    <button type="submit" class="btn btn-primary">Enregistrer et
                                        terminer</button>
                                </div>
                                <div class="p-2">
                                    <a wire:click='endCreate' class="btn btn-info"></i>Ignorer et Terminer</a>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">


                            <div class="row">
                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response1" class="form-label">1. Statut professionnel :</label>
                                        <textarea wire:model='response1' class="form-control auto-resize" id="response1"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response2" class="form-label">2. Statut personnel :</label>
                                        <textarea wire:model='response2' class="form-control auto-resize" id="response2"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>

                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response3" class="form-label">3. Situation professionnelle :</label>
                                        <textarea wire:model='response3' class="form-control auto-resize" id="response3"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response4" class="form-label">4. Points incontournables :
                                        </label>
                                        <textarea wire:model='response4' class="form-control auto-resize" id="response4"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>

                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response5" class="form-label">5. Savoir-être du candidat :
                                        </label>
                                        <textarea wire:model='response5' class="form-control auto-resize" id="response5"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response6" class="form-label">6. Prise de référence(s) :</label>
                                        <textarea wire:model='response6' class="form-control auto-resize" id="response6"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>

                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response7" class="form-label">7. Prétentions salariales :</label>
                                        <textarea wire:model='response7' class="form-control auto-resize" id="response7"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response8" class="form-label">8. Disponibilités candidat :</label>
                                        <textarea wire:model='response8' class="form-control auto-resize" id="response8"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3 col-md-12">
                                    <div>
                                        <label for="response7" class="form-label">9. Résumé du parcours professionnel :</label>
                                        <textarea wire:model='response9' class="form-control auto-resize" id="response9"
                                            style="resize: none; overflow-y: hidden;"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">

                            <div class="d-flex justify-content-between">
                                <button type="button" wire:click='goToForm'
                                    class="btn btn-secondary btn-label nexttab"><i
                                        class="align-middle ri-arrow-left-line label-icon fs-16 ms-2"></i>Aller
                                    vers les documents</button>
                                <button type="submit" wire:click='goToCre'
                                    class="btn btn-success btn-label right ms-auto nexttab">Enregistrer
                                    et Terminer</button>
                            </div>
                        </div>

                    </form>
                    <!-- end card -->
                </div>
                <!--end card-->
            </div>
            <!-- end tab pane -->

            <!-- end tab pane -->
        </div>
    </div>
</div>
</div>
</div>
@push('page-script')
<script>
    document.addEventListener("input", function(event) {
        if (event.target.tagName.toLowerCase() !== "textarea") return;
        autoResize(event.target);
    }, false);

    function autoResize(textarea) {
        textarea.style.height = "auto";
        textarea.style.height = (textarea.scrollHeight) + "px";
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.auto-resize').forEach(function(textarea) {
            autoResize(textarea);
        });
    });
</script>
@endpush