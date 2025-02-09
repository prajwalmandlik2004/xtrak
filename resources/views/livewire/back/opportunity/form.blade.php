<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
    'title' => 'Nouvelle saisie',
    'breadcrumbItems' => [
    ['text' => 'FormOPP', 'url' => '#']
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
                                        <h2 class="mb-0 card-head">
                                            {{ $action == 'create' ? "FormOPP" : "FormOPP" }}
                                        </h2>


                                    </div>
                                    {{-- @if (!$action == 'update')
                                        <div class="p-2">
                                            <a href="{{ Route('import.candidat') }}" class="btn btn-primary">Uplodad</a>
                                </div>
                                @endif --}}
                                <div class="p-2">
                                    <a style="background:#33BBC5; border:none;" wire:click='resetForm' class="btn btn-danger"></i>+ Nouveau</a>
                                </div>
                                <div class="p-2">
                                    <button wire:click.prevent="storeCandidateData2" wire:loading.remove wire:target="storeCandidateData2" type="button"
                                        class="btn btn-danger">
                                        {{ $action == 'create' ? 'Supprimer' : 'Supprimer' }}</button>

                                    <button wire:loading wire:target="storeCandidateData2" type="button"
                                        class="btn btn-primary" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Supprimer
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
                                            class="mdi mdi-arrow-left me-1"></i>{{ $action == 'create' ? 'Vue' : 'Vue' }}</a>
                                </div>

                            </div>


                    </div>
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 1 ? '#info' : '' }}" role="tab">
                                Description
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'enabled' : '' }}"
                                href="/management">
                                CDT mgt
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                href="/evts">
                                Hiring Process
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToCre" class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#invoicement' }}" role="tab">
                                Facturation
                            </a>
                        </li>

                    </ul>
                    <div class="card-body">

                        <div class="row g-4">

                            <div class="mt-2 card">
                                <!-- <div class="card-header"> -->
                                <!-- <h5 class="mb-0 card-title">
                                                Informations
                                                personnelles</h5> -->
                                <!-- <div class="col-lg-8" style="margin-left:3%">
                                        <div style="display: flex; align-items:center">
                                            <input style="background:#D4EBF8;border:none;" type="text" class="form-control"
                                                value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" disabled
                                                style="text-align:center" />
                                            <input style="margin-left:3%; background:#D4EBF8;border:none;" type="text" class="form-control"
                                                value="Ref. 874452" disabled
                                                style="text-align:center" />
                                            <input style="margin-left:3%; width:250%; background:#D4EBF8;border:none;" type="text" class="form-control"
                                                value="RESPONSABLE SECURITE NUCLEAIRE" disabled
                                                style="text-align:center" />
                                            <input style="margin-left:3%; width:140%; background:#D4EBF8;border:none;" type="text" class="form-control"
                                                value="EIFFAGE CLEMESSY" disabled
                                                style="text-align:center" />
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                                <div class="card-body" style="margin-top: 1%;">
                                    <div class="row g-2">
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="source_date" class="form-label">Date</label>
                                                <input
                                                    type="date"
                                                    class="form-control form-control-custom-1 @error('source_date') is-invalid @enderror"
                                                    name="source_date"
                                                    value="{{ old('source_date') ?? now()->format('Y-m-d') }}"
                                                    placeholder="Select a date" />
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="oppcode" class="form-label">OPPCode</label>
                                                <input type="number"
                                                    class="form-control form-control-custom-1  @error('oppcode') is-invalid @enderror "
                                                    wire:model='oppcode'
                                                    placeholder="OPPCode" />
                                                @error('oppcode')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="origine" class="form-label">Aut.</label>
                                                <input type="text" class="form-control form-control-custom-1  @error('origine') is-invalid @enderror "
                                                    value="{{ Auth::user()->trigramme ?? '--' }}"
                                                    placeholder="auteur" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="trgcode" class="form-label">TRGCode</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('trgcode') is-invalid @enderror "
                                                    wire:model='trgcode'
                                                    placeholder="TRGCode" />
                                                @error('trgcode')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-auto">
                                            <div>
                                                <label for="company_name" class="form-label">Dénomination sociale<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('company_name') is-invalid @enderror "
                                                    wire:model.live='company_name'
                                                    placeholder="Dénomination sociale" />
                                                @error('company_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="cp" class="form-label">CP<span
                                                        class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control form-control-custom-1  @error('cp') is-invalid @enderror "
                                                    wire:model='cp'
                                                    placeholder="CP" />
                                                @error('cp')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="city_name" class="form-label">Ville<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('city_name') is-invalid @enderror"
                                                    wire:model.live='city_name'
                                                    placeholder="Ville" />

                                                @error('city_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card-header" style="margin-top:1%;">
                                            <h5 class="mb-0 card-title">
                                                Contact de référence</h5>
                                        </div>
                                        <div class="mt-2 col-md-2">
                                            <div>
                                                <label for="ctc_code" class="form-label">CTC Code</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('ctc_code') is-invalid @enderror "
                                                    wire:model.live='ctc_code'
                                                    placeholder="CTCcode" />
                                                @error('ctc_code')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="mt-2 col-md-2 ">
                                            <div>
                                                <label for="job-category-Input" class="form-label">Civ.
                                                    <span class="text-danger">*</span></label>
                                                <select
                                                    class="form-control form-control-custom-1  @error('civ_id') is-invalid @enderror "
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

                                        <div class="mt-2 col-lg-2 ">
                                            <div>
                                                <label for="first_name" class="form-label">Prénom<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('first_name') is-invalid @enderror "
                                                    wire:model='first_name'
                                                    placeholder="Prénom" />

                                                @error('first_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-2 col-lg-2 ">
                                            <div>
                                                <label for="last_name" class="form-label">Nom<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('last_name') is-invalid @enderror "
                                                    wire:model='last_name'
                                                    placeholder="Nom" />

                                                @error('last_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-2 col-lg-2 ">
                                            <div>
                                                <label for="function" class="form-label">Fonction<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('function') is-invalid @enderror "
                                                    wire:model='function'
                                                    placeholder="Fonction" />

                                                @error('function')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-2 col-lg-2 ">
                                            <div>
                                                <label for="remarkque" class="form-label">Remarque(s)</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1  @error('remarkque') is-invalid @enderror "
                                                    wire:model='remarkque'
                                                    placeholder="Remarkque(s)" />

                                                @error('remarkque')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" style="margin-top:-3%;">
                                    <h5 class="mb-0 card-title">
                                        Poste and Location</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%;">
                                    <div class="row">
                                        <div class="col-lg-2 ">
                                            <div>
                                                <label for="job_title" class="form-label">Job title<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom-1  @error('job_title') is-invalid @enderror "
                                                    min="0" wire:model='job_title'
                                                    placeholder="Job title" />
                                                @error('job_title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="speciality" class="form-label">Speciality</label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom-1  @error('speciality') is-invalid @enderror "
                                                    min="0" wire:model='speciality'
                                                    placeholder="Speciality" />
                                                @error('speciality')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="domain" class="form-label">Domain</label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom-1  @error('domain') is-invalid @enderror "
                                                    min="0" wire:model='domain'
                                                    placeholder="Domain" />
                                                @error('domain')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="cp_dpt" class="form-label">CP/DPT<span
                                                        class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control
                                    form-control-custom-1  @error('cp_dpt') is-invalid @enderror "
                                                    min="0" wire:model='cp_dpt'
                                                    placeholder="CP/DPT" />
                                                @error('cp_dpt')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="town" class="form-label">Town<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom-1  @error('town') is-invalid @enderror "
                                                    min="0" wire:model='town'
                                                    placeholder="Town" />
                                                @error('town')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="country" class="form-label">Country<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom-1  @error('country') is-invalid @enderror "
                                                    min="0" wire:model='France'
                                                    value="France" readonly />
                                                @error('country')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 card">
                                <div class="card-header" style="margin-top:-2%;">
                                    <h5 class="mb-0 card-title">
                                        Attendus</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%;">
                                    <div class="row">
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="experience" class="form-label">Expérience<span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control
                                    form-control-custom-1  @error('experience') is-invalid @enderror "
                                                    wire:model='experience'
                                                    placeholder="Exp" />

                                                @error('experience')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="schooling" class="form-label">Scolarité</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('schooling') is-invalid @enderror"
                                                    wire:model='schooling'
                                                    placeholder="Scolarité" />
                                                @error('schooling')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="schedules" class="form-label">Horaires</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('schedules') is-invalid @enderror"
                                                    wire:model='schedules'
                                                    placeholder="Hor" />
                                                @error('schedules')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="mobility" class="form-label">Mobilité</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('mobility') is-invalid @enderror"
                                                    wire:model='mobility'
                                                    placeholder="Mobilité" />
                                                @error('mobility')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="permit" class="form-label">Permis</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('permit') is-invalid @enderror"
                                                    wire:model='permit'
                                                    placeholder="Per" />
                                                @error('permit')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div>
                                                <label for="type" class="form-label">Type</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('type') is-invalid @enderror"
                                                    wire:model='type'
                                                    placeholder="Type" />
                                                @error('type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="vehicle" class="form-label">Véhiculé</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('vehicle') is-invalid @enderror"
                                                    wire:model='vehicle'
                                                    placeholder="Véhiculé" />
                                                @error('vehicle')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div>
                                                <label for="date_emb" class="form-label">Job offer letter
                                                </label>
                                                <input
                                                    type="date"
                                                    class="form-control form-control-custom-1 @error('date_emb') is-invalid @enderror"
                                                    name="date_emb"
                                                    value="{{ old('date_emb') ?? now()->format('Y-m-d') }}"
                                                    placeholder="Select a date" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 card">
                                <div class="card-header" style="margin-top:-3%;">
                                    <h5 class="mb-0 card-title">
                                        Compétences</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div>
                                                <label for="skill_one" class="form-label">Skill 1</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('skill_one') is-invalid @enderror"
                                                    wire:model='skill_one'
                                                    placeholder="Skill 1" />
                                                @error('skill_one')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="skill_two" class="form-label">Skill 2</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('skill_two') is-invalid @enderror"
                                                    wire:model='skill_two'
                                                    placeholder="Skill 2" />
                                                @error('skill_two')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="skill_three" class="form-label">Skill 3</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('skill_three') is-invalid @enderror"
                                                    wire:model='skill_three'
                                                    placeholder="Skill 3" />
                                                @error('skill_three')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="others_one" class="form-label">Autres</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('others_one') is-invalid @enderror"
                                                    wire:model='others_one'
                                                    placeholder="Autres" />
                                                @error('others_one')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="remarks_one" class="form-label">Remarque(s)</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('remarks_one') is-invalid @enderror"
                                                    wire:model='remarks_one'
                                                    placeholder="Remarque(s)" />
                                                @error('remarks_one')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="onboarding_term" class="form-label">Onboarding term</label>
                                                <input type="date"
                                                    class="form-control form-control-custom-1 @error('onboarding_term') is-invalid @enderror"
                                                    wire:model='onboarding_term'
                                                    placeholder="Onboarding term" />
                                                @error('onboarding_term')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="invo">
                                                <label for="invoicement_date" class="mt-3 form-label">Invoicement date</label>
                                                <input type="date"
                                                    class="form-control form-control-custom-1 @error('invoicement_date') is-invalid @enderror"
                                                    wire:model='invoicement_date'
                                                    placeholder="Invoicement date" />
                                                @error('invoicement_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-4 card">
                                <div class="card-header" style="margin-top:-3%;">
                                    <h5 class="mb-0 card-title">Package</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div>
                                                <label for="cc" class="form-label">Brut annuel<span class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control form-control-custom-1 @error('annual_gross_two') is-invalid @enderror"
                                                    wire:model='annual_gross_two'
                                                    placeholder="Brut annuel" />
                                                @error('annual_gross_two')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="advantage_one" class="form-label">Avantage 1</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('advantage_one') is-invalid @enderror"
                                                    wire:model='advantage_one'
                                                    placeholder="Avantage 1" />
                                                @error('advantage_one')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="advantage_two" class="form-label">Avantage 2</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('advantage_two') is-invalid @enderror"
                                                    wire:model='advantage_two'
                                                    placeholder="Avantage 2" />
                                                @error('advantage_two')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="advantage_three" class="form-label">Avantage 3</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('advantage_three') is-invalid @enderror"
                                                    wire:model='advantage_three'
                                                    placeholder="Avantage 3" />
                                                @error('advantage_three')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="others_two" class="form-label">Autres</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('others_two') is-invalid @enderror"
                                                    wire:model='others_two'
                                                    placeholder="Autres" />
                                                @error('others_two')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="date_emb" class="form-label">Date emb.
                                                </label>
                                                <input
                                                    type="date"
                                                    class="form-control form-control-custom-1 @error('date_emb') is-invalid @enderror"
                                                    name="date_emb"
                                                    value="{{ old('date_emb') ?? now()->format('Y-m-d') }}"
                                                    placeholder="Select a date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="cdtModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered cdt-modal-dialog">
                            <div class="modal-content cdt-modal-content">
                                <div class="cdt-modal-header">
                                    <span>Enter CDT code:</span>
                                    <button type="button" class="cdt-close-btn" data-bs-dismiss="modal">×</button>
                                </div>
                                <div class="cdt-modal-body">
                                    <div class="cdt-input-group">
                                        <input type="text" class="cdt-input" id="cdtCode" value="ADTGFHU">
                                        <button class="cdt-ok-btn" id="okButton">OK</button>
                                    </div>
                                    <div class="cdt-message">("message")</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer" style="margin-top: -3%;">
                        <div class="d-flex justify-content-end">
                            <button style="background:green; border:none;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                                class="btn btn-success btn-label right ms-auto nexttab"><i
                                    class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                                {{ $action == 'create' ? 'Facturation' : 'Facturation' }}</button>

                            <button wire:loading wire:target="storeCandidateData" type="button"
                                class="btn btn-primary" disabled>
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                                Enregistrement...
                            </button>
                        </div>

                    </div>

                    </form>

                    <div style="margin-right:30%; margin-top:-4%; margin-bottom:10px;" class="d-flex justify-content-end">
                        <button id="linkNewCDT" style="background:#3D3BF3; border:none;" type="submit"
                            class="btn btn-success btn-label right ms-auto nexttab"><i
                                class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                            {{ $action == '' ? 'Link CST' : 'Link CST' }}</button>

                        <button style="background:#FFB534; border:none;" type="submit"
                            class="btn btn-success btn-label right ms-auto nexttab"><i
                                class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                            {{ $action == '' ? 'Gestion CDT' : 'Gestion CDT' }}</button>

                        <button style="background:#FF77B7; border:none;" type="submit"
                            class="btn btn-success btn-label right ms-auto nexttab"><i
                                class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                            {{ $action == '' ? 'New EVT' : 'New EVT' }}</button>
                    </div>
                </div>


                <!-- end tab pane -->



                <div class="tab-pane fade {{ $step == 2 ? 'show active' : '' }}" id="management" role="tabpanel">
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 1 ? '#info' : '' }}" role="tab">
                                Description
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'enabled' : '' }}"
                                href="/management">
                                CDT mgt
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                href="/evts">
                                Hiring Process
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToCre" class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#invoicement' }}" role="tab">
                                Facturation
                            </a>
                        </li>

                    </ul>
                    <div class="col-sm-12">

                        <div>

                            <div class="card-header align-items-center d-flex border-bottom-dashed">
                                <div class="recruitment-container">
                                    <div class="table-container">
                                        <table class="recruitment-table">
                                            <thead>
                                                <tr>
                                                    <th class="with-border">Date</th>
                                                    <th class="with-border">CodeCDT</th>
                                                    <th class="with-border">Civ.</th>
                                                    <th class="with-border">Prénom</th>
                                                    <th class="with-border">Nom</th>
                                                    <th class="with-border">Fonction</th>
                                                    <th class="with-border">Dispo.</th>
                                                    <th class="with-border">Délai</th>
                                                    <th class="with-border">Statut</th>
                                                    <th class="with-border">Next step</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="with-border">10/10/24</td>
                                                    <td class="with-border">GRTHKUX</td>
                                                    <td class="with-border">MME</td>
                                                    <td class="with-border">Aurélie</td>
                                                    <td class="with-border">MONFION</td>
                                                    <td class="with-border">Resp. Sureté Nucléaire</td>
                                                    <td class="with-border">Préavis négo.</td>
                                                    <td class="with-border">3 mois</td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <option>Linké</option>
                                                            <option>Validé</option>
                                                            <option>Présenté</option>
                                                            <option>RV tél OK</option>
                                                            <option>RV phys. prévu</option>
                                                            <option>Prom. acceptée</option>
                                                        </select>
                                                    </td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <option>A valider</option>
                                                            <option>Présenter</option>
                                                            <option>RV tél prévu</option>
                                                            <option>RV phy prévu</option>
                                                            <option>Non retenu</option>
                                                            <option>Promesse emb.</option>
                                                            <option>Non retenu</option>
                                                            <option>Embauché</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="with-border">09/10/24</td>
                                                    <td class="with-border">ADTGFHU</td>
                                                    <td class="with-border">M</td>
                                                    <td class="with-border">Chboub</td>
                                                    <td class="with-border">SCHBOUBA</td>
                                                    <td class="with-border">Chef d'équipe</td>
                                                    <td class="with-border">Immédiate</td>
                                                    <td class="with-border">1 mois</td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <option>Validé</option>
                                                            <option>Linké</option>
                                                            <option>Présenté</option>
                                                            <option>RV tél OK</option>
                                                            <option>RV phys. prévu</option>
                                                            <option>Prom. acceptée</option>
                                                        </select>
                                                    </td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <option>Présenter</option>
                                                            <option>A valider</option>
                                                            <option>RV tél prévu</option>
                                                            <option>RV phy prévu</option>
                                                            <option>Non retenu</option>
                                                            <option>Promesse emb.</option>
                                                            <option>Non retenu</option>
                                                            <option>Embauché</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <!-- <option>Select</option>  -->
                                                        </select>
                                                    </td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <!-- <option>Select</option> -->
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border"></td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <!-- <option>Select</option> -->
                                                        </select>
                                                    </td>
                                                    <td class="with-border">
                                                        <select class="status-select">
                                                            <!-- <option>Select</option> -->
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="button-container">
                                        <button class="link-btn" id="linkNewCDT">LINK NEW CDT</button>
                                        <button class="unlink-btn" id="unlinkBtn" style="display:none;">UNLINK</button>
                                    </div>
                                </div>


                                <div id="editModal" class="modal-row">
                                    <div class="modal-content-row">
                                        <span class="close-row">&times;</span>
                                        <h3>Edit Row</h3>
                                        <form id="editForm">
                                            <label>Date :</label>
                                            <input type="text" id="editDate"><br>
                                            <label>CodeCDT :</label>
                                            <input type="text" id="editCode"><br>
                                            <label>Civ :</label>
                                            <input type="email" id="editCiv"><br>
                                            <label>Prénom :</label>
                                            <input type="text" id="editfirst"><br>
                                            <label>Nom :</label>
                                            <input type="text" id="editlast"><br>
                                            <label>Fonction :</label>
                                            <input type="text" id="editfunc"><br>
                                            <label>Dispo :</label>
                                            <input type="text" id="editdispo"><br>
                                            <label>Délai :</label>
                                            <input type="text" id="editdetail"><br>
                                            <!-- <label>Statut :</label>
                                            <input type="text" id="editstatut"><br>
                                            <label>Next Step :</label>
                                            <input type="text" id="editnext"><br> -->
                                            <button type="button" id="saveBtn">Save</button>
                                            <button type="button" id="cancelBtn">Cancel</button>
                                        </form>
                                    </div>
                                </div>


                                <div class="modal fade" id="cdtModal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered cdt-modal-dialog">
                                        <div class="modal-content cdt-modal-content">
                                            <div class="cdt-modal-header">
                                                <span>Enter CDT code:</span>
                                                <button type="button" class="cdt-close-btn" data-bs-dismiss="modal">×</button>
                                            </div>
                                            <div class="cdt-modal-body">
                                                <div class="cdt-input-group">
                                                    <input type="text" class="cdt-input" id="cdtCode" value="ADTGFHU">
                                                    <button class="cdt-ok-btn" id="okButton">OK</button>
                                                </div>
                                                <div class="cdt-message">("message")</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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
                <div class="tab-pane fade {{ $step == 3 ? 'show active' : '' }}" id="invoicement" role="tabpanel">
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 1 ? '#info' : '' }}" role="tab">
                                Description
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'enabled' : '' }}"
                                href="/management">
                                CDT mgt
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                href="/evts">
                                Hiring Process
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToCre" class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#invoicement' }}" role="tab">
                                Facturation
                            </a>
                        </li>

                    </ul>
                    <div class="col-sm-12">
                        <form wire:submit.prevent="storeCre()">
                            @csrf
                            <div class="card-header">
                                <div class="form-container">
                                    <!-- Contact Section -->
                                    <div class="section">
                                        <div class="section-title">Accountancy Contact</div>
                                        <div class="contact-grid">
                                            <div class="field-group">
                                                <label class="field-label">CTCcode</label>
                                                <input type="text" class="field-input field-readonly" value="EFDGTHY" readonly>
                                            </div>
                                            <div class="field-group">
                                                <label class="field-label">Title</label>
                                                <select class="field-select">
                                                    <option>Mme</option>
                                                    <option>Mlle</option>
                                                    <option>M.</option>
                                                </select>
                                            </div>
                                            <div class="field-group">
                                                <label class="field-label">First name</label>
                                                <input type="text" class="field-input" value="Laura">
                                            </div>
                                            <div class="field-group">
                                                <label class="field-label">Last name</label>
                                                <input type="text" class="field-input" value="Faure">
                                            </div>
                                            <div class="field-group">
                                                <label class="field-label">Position</label>
                                                <input type="text" class="field-input" value="Accountant">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-layout">
                                        <!-- Left Column -->
                                        <div class="left-column">
                                            <!-- Calculation Section -->
                                            <div class="section">
                                                <div class="section-title">Calc. Reference Base</div>
                                                <div class="calc-grid">
                                                    <div class="field-group">
                                                        <label class="field-label">Gross sal.</label>
                                                        <input type="text" class="field-input currency-input" value="150.236" id="grossSal">
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Advant. 1</label>
                                                        <input type="text" class="field-input currency-input" value="12.000" id="advant1">
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Advant. 2</label>
                                                        <input type="text" class="field-input currency-input" value="15.500" id="advant2">
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Advant. 3</label>
                                                        <input type="text" class="field-input currency-input" value="7.500" id="advant3">
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Total base<span class="required">*</span></label>
                                                        <input type="text" class="field-input currency-input field-readonly" id="totalBase" readonly>
                                                    </div>
                                                </div>

                                                <div class="calc-grid">
                                                    <div class="field-group">
                                                        <label class="field-label">Base hono.</label>
                                                        <input type="text" class="field-input field-readonly" id="baseHono" readonly>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Warant. ext.</label>
                                                        <input type="text" class="field-input field-readonly" id="warantExt" readonly>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Total HT</label>
                                                        <input type="text" class="field-input field-readonly" id="totalHT" readonly>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">VAT</label>
                                                        <select class="field-select vat-select">
                                                            <option>20%</option>
                                                        </select>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Total TTC<span class="required">*</span></label>
                                                        <input type="text" class="field-input field-readonly" id="totalTTC" readonly>
                                                    </div>
                                                </div>

                                                <!-- Invoice Details -->
                                                <div class="payment-schedule">
                                                    <div class="calc-grid">
                                                        <div class="field-group">
                                                            <label class="field-label">Inv. date</label>
                                                            <input type="text" class="field-input" value="31/08/24">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Inv. ref.</label>
                                                            <input type="text" class="field-input" value="874452">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Sent on:</label>
                                                            <input type="text" class="field-input" value="31/08/24">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Remark(s)</label>
                                                            <input type="text" class="field-input" value="---">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Payment Schedule -->
                                                <div class="payment-schedule">
                                                    <div class="payment-row">
                                                        <div class="field-group">
                                                            <label class="field-label">Due date 1</label>
                                                            <input type="text" class="field-input" value="10/09/24">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Amount 1</label>
                                                            <input type="text" class="field-input currency-input" value="xxx">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Paid 1</label>
                                                            <input type="text" class="field-input currency-input" value="xxx">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">PayDate 1</label>
                                                            <input type="text" class="field-input" value="10/09/24">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Balance 1</label>
                                                            <input type="text" class="field-input currency-input field-readonly" value="0" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="payment-row">
                                                        <div class="field-group">
                                                            <label class="field-label">Due date 2</label>
                                                            <input type="text" class="field-input" value="12/11/24">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Amount 2</label>
                                                            <input type="text" class="field-input currency-input" value="xxx">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Paid 2</label>
                                                            <input type="text" class="field-input currency-input" value="xxx">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">PayDate 2</label>
                                                            <input type="text" class="field-input" value="12/11/24">
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Balance 2</label>
                                                            <input type="text" class="field-input currency-input field-readonly" value="0" readonly>
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Total bal.:</label>
                                                            <input type="text" class="field-input currency-input field-readonly" value="0" readonly>
                                                        </div>
                                                        <div class="field-group">
                                                            <label class="field-label">Paym. status</label>
                                                            <input type="text" class="field-input field-readonly status-paid" value="PAID" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="right-column">
                                            <div class="section">
                                                <div class="section-title">Fees</div>
                                                <div class="fees-grid">
                                                    <div class="field-group">
                                                        <label class="field-label">Type</label>
                                                        <select class="field-select" id="feeType" onchange="handleFeeTypeChange()">
                                                            <option value="%">%</option>
                                                            <option value="Fee">Fee</option>
                                                        </select>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Exec.</label>
                                                        <input type="text" class="field-input" value="25.0" id="execFee">
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Non-exec.</label>
                                                        <input type="text" class="field-input field-readonly" value="---" readonly>
                                                    </div>
                                                </div>

                                                <div class="fees-grid">
                                                    <div class="field-group">
                                                        <label class="field-label">Warant ext.</label>
                                                        <select class="field-select">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">%</label>
                                                        <input type="text" class="field-input" value="5.0">
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">VAT</label>
                                                        <select class="field-select">
                                                            <option>20%</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="fees-grid">
                                                    <div class="field-group">
                                                        <label class="field-label">CST</label>
                                                        <input type="text" class="field-input field-readonly" value="(TXT)" readonly>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">%</label>
                                                        <input type="text" class="field-input" value="5.0">
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Total HT</label>
                                                        <input type="text" class="field-input currency-input field-readonly" value="2.779" readonly>
                                                    </div>
                                                </div>

                                                <div class="right-grid">
                                                    <div class="field-group">
                                                        <label class="field-label">Invoicement term</label>
                                                        <select class="field-select">
                                                            <option>Promesse d'emb.</option>
                                                        </select>
                                                    </div>
                                                    <div class="field-group">
                                                        <label class="field-label">Payment term</label>
                                                        <select class="field-select">
                                                            <option>10 JN DF, DF=DPE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="right-grid">
                                                    <div class="field-group">
                                                        <label class="field-label">Note(s)</label>
                                                        <textarea class="field-input notes-field">---</textarea>
                                                    </div>
                                                </div>
                                            </div>
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
<style>
    .card-head {
        font-size: 1.8rem;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }


    :root {
        --primary-color: #2563eb;
        --primary-light: #e0e7ff;
        /* --border-color: #e2e8f0; */
        --border-color: #98D8EF;
        --text-color: #334155;
        --text-light: #64748b;
        --background-light: #f8fafc;
        --success-color: #22c55e;
        --input-focus: #e0e7ff;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }

    body {
        color: var(--text-color);
        background-color: #f9fafb;
        line-height: 1.5;
    }

    .form-container {
        max-width: 1200px;
        padding: 0 1rem;
    }

    .main-layout {
        display: grid;
        grid-template-columns: 70% 30%;
        gap: 1.5rem;
    }

    .section {
        background: white;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
        transition: box-shadow 0.3s ease;
    }

    .section:hover {
        box-shadow: var(--shadow-md);
    }

    .section-title {
        color: var(--text-color);
        font-size: 0.925rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-color);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 0.8fr 0.6fr 1fr 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 0.5rem;
        background-color: var(--background-light);
    }

    .calc-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 0.5rem;
        background-color: var(--background-light);
    }


    .field-group {
        margin-bottom: 0.75rem;
    }

    .field-label {
        display: block;
        color: var(--text-light);
        font-size: 0.813rem;
        font-weight: 500;
        margin-bottom: 0.375rem;
    }


    .field-input {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-color);
        background-color: white;
        transition: all 0.2s ease;
    }

    .field-input:hover {
        border-color: var(--primary-color);
    }

    .field-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--input-focus);
    }


    .field-select {
        width: 100%;
        padding: 0.625rem 2rem 0.625rem 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        background-color: white;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.25rem;
        appearance: none;
        transition: all 0.2s ease;
    }

    .field-select:hover {
        border-color: var(--primary-color);
    }

    .field-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--input-focus);
    }

    .field-readonly {
        /* background-color: var(--background-light); */
        cursor: not-allowed;
        color: var(--text-light);
    }

    .field-readonly:hover {
        border-color: var(--border-color);
    }

    .currency-input {
        position: relative;
    }

    .currency-input::after {
        content: '€';
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 0.875rem;
    }

    .payment-schedule {
        display: grid;
        gap: 1rem;
    }

    .payment-row {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        padding: 0.75rem;
        border-radius: 0.5rem;
        background-color: var(--background-light);
    }


    .fees-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 0.5rem;
        background-color: var(--background-light);
    }

    .right-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 0.5rem;
        background-color: var(--background-light);
    }

    .status-paid {
        color: var(--success-color);
        font-weight: 600;
    }

    .required {
        color: #ef4444;
        margin-left: 0.25rem;
    }

    .notes-field {
        min-width: 17rem;
        min-height: 5rem;
        resize: vertical;

    }

    .manual-note {
        font-size: 0.75rem;
        color: var(--text-light);
        margin-top: 0.25rem;
    }

    .field-group:hover .field-label {
        color: var(--primary-color);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section {
        animation: fadeIn 0.3s ease-out;
    }

    @media (max-width: 1024px) {
        .main-layout {
            grid-template-columns: 1fr;
        }

        .contact-grid,
        .calc-grid,
        .payment-row {
            grid-template-columns: repeat(2, 1fr);
        }

        .fees-grid,
        .right-grid {
            grid-template-columns: 1fr;
        }
    }

    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--background-light);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--text-light);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-color);
    }

    :focus-visible {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }


    ::placeholder {
        color: var(--text-light);
        opacity: 0.7;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* input[type="number"] {
        -moz-appearance: textfield;
    } */

    .field-input:disabled,
    .field-select:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .field-input.error {
        border-color: #ef4444;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    .field-input.success {
        border-color: var(--success-color);
    }

    .form-control-custom-1 {
        background-color: #f8fafc !important;
        border: 1px solid #37afe1;
        border-radius: none;
    }

    .recruitment-container {
        width: 100%;
        padding: 15px;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
        margin-bottom: 15px;
    }

    .recruitment-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
    }

    .recruitment-table th {
        padding: 12px 15px;
        text-align: left;
        background: #D8D9DA;
        color: #495057;
        font-weight: 500;
        font-size: 14px;
        border-bottom: 1px solid #dee2e6;
    }

    .recruitment-table td {
        padding: 12px 15px;
        font-size: 14px;
        color: #495057;
        background: white;
    }

    .with-border {
        border-right: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    .recruitment-table tr:nth-child(even) td {
        background: #f8f9fa;
    }

    .recruitment-table tr:hover td {
        background-color: #f1f3f5;
    }

    .status-select {
        width: 100%;
        padding: 4px 8px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        font-size: 14px;
        color: #495057;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-top: 15px;
    }

    .link-btn {
        background-color: #ffc107;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        color: #000;
        font-weight: 500;
        cursor: pointer;
    }

    .unlink-btn {
        background-color: #dc3545;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        color: white;
        font-weight: 500;
        cursor: pointer;
    }

    .cdt-modal-dialog {
        max-width: 300px;
    }

    .cdt-modal-content {
        border: 1px solid #999;
        border-radius: 0;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        background: #f0f0f0;
    }

    .cdt-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 8px;
        background: linear-gradient(to bottom, #fff, #e4e4e4);
        /* border-bottom: 1px solid #999; */
    }

    .cdt-modal-header span {
        font-size: 15px;
        color: #000;
    }

    .cdt-close-btn {
        background: red;
        border: none;
        font-size: 18px;
        line-height: 1;
        padding: 0 4px;
        cursor: pointer;
        color: white;
    }

    .cdt-modal-body {
        padding: 10px;
        background: #f0f0f0;
    }

    .cdt-input-group {
        display: flex;
        gap: 4px;
        margin-bottom: 6px;
    }

    .cdt-input {
        flex-grow: 1;
        padding: 3px 6px;
        border: 1px solid #999;
        font-size: 13px;
    }

    .cdt-ok-btn {
        background: #118B50;
        border: 1px solid #999;
        padding: 2px 8px;
        cursor: pointer;
        font-size: 13px;
        color: white;
    }

    .cdt-message {
        font-size: 15px;
        color: #666;
        padding: 2px 0;
    }

    .recruitment-table tbody tr.selected {
        background-color: lightblue;
        cursor: pointer;
    }

    .recruitment-table tbody tr {
        background-color: lightblue;
        cursor: pointer;
    }

    .unlink-btn {
        margin-top: 10px;
        background-color: red;
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
    }

    .modal-row {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content-row {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 40%;
        max-width: 500px;
        max-height: 70vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .close-row {
        color: #aaa;
        float: right;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
    }

    .close-row:hover,
    .close-row:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-content-row form label {
        display: block;
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .modal-content-row form input[type="text"],
    .modal-content-row form input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .modal-content-row form input[type="text"]:focus,
    .modal-content-row form input[type="email"]:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
    }

    #saveBtn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        margin-right: 10px;
    }

    #saveBtn:hover {
        background-color: #45a049;
    }

    #cancelBtn {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    #cancelBtn:hover {
        background-color: #d32f2f;
    }

    @media (max-width: 768px) {
        .modal-content-row {
            width: 90%;
            padding: 15px;
        }

        .modal-content-row form input[type="text"],
        .modal-content-row form input[type="email"] {
            font-size: 13px;
        }

        #saveBtn,
        #cancelBtn {
            font-size: 13px;
            padding: 8px 15px;
        }
    }
</style>
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


    function handleFeeTypeChange() {
        const feeType = document.getElementById('feeType').value;
        const execFeeInput = document.getElementById('execFee');

        if (feeType === '%') {
            execFeeInput.type = 'text';
            execFeeInput.value = parseFloat(execFeeInput.value).toFixed(1);
        } else if (feeType === 'Fee') {
            execFeeInput.type = 'number';
            execFeeInput.value = parseInt(execFeeInput.value) || 0;
        }
    }


    document.addEventListener("DOMContentLoaded", function() {

        const rows = document.querySelectorAll(".recruitment-table tbody tr");
        const unlinkBtn = document.getElementById("unlinkBtn");
        const modal = document.getElementById("editModal");
        const closeBtn = document.querySelector(".close-row");
        const saveBtn = document.getElementById("saveBtn");
        const cancelBtn = document.getElementById("cancelBtn");

        const editDate = document.getElementById("editDate");
        const editCode = document.getElementById("editCode");
        const editCiv = document.getElementById("editCiv");
        const editfirst = document.getElementById("editfirst");
        const editlast = document.getElementById("editlast");
        const editfunc = document.getElementById("editfunc");
        const editdispo = document.getElementById("editdispo");
        const editdetail = document.getElementById("editdetail");
        // const editstatut = document.getElementById("editstatut");
        // const editnext = document.getElementById("editnext");


        let selectedRow = null;

        rows.forEach(row => {
            row.addEventListener("dblclick", () => {
                selectedRow = row;
                const cells = row.querySelectorAll("td");
                editDate.value = cells[0].innerText;
                editCode.value = cells[1].innerText;
                editCiv.value = cells[2].innerText;
                editfirst.value = cells[3].innerText;
                editlast.value = cells[4].innerText;
                editfunc.value = cells[5].innerText;
                editdispo.value = cells[6].innerText;
                editdetail.value = cells[7].innerText;
                // editstatut.value = cells[8].innerText;
                // editnext.value = cells[9].innerText;

                modal.style.display = "block";
            });
        });

        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        cancelBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        saveBtn.addEventListener("click", () => {
            if (selectedRow) {
                const cells = selectedRow.querySelectorAll("td");
                cells[1].innerText = editName.value;
                cells[2].innerText = editEmail.value;
                cells[3].innerText = editRole.value;
            }

            modal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        rows.forEach((row) => {
            row.addEventListener("click", () => {

                if (selectedRow) {
                    selectedRow.classList.remove("selected");
                }
                if (selectedRow === row) {
                    selectedRow = null;
                    unlinkBtn.style.display = "none";
                } else {
                    row.classList.add("selected");
                    selectedRow = row;
                    unlinkBtn.style.display = "block";
                }
            });
        });

        const linkNewCDT = document.getElementById('linkNewCDT');
        const cdtModal = new bootstrap.Modal(document.getElementById('cdtModal'));
        const okButton = document.getElementById('okButton');
        const cdtCodeInput = document.getElementById('cdtCode');

        linkNewCDT.addEventListener('click', function() {
            cdtModal.show();
        });

        okButton.addEventListener('click', function() {
            const code = cdtCodeInput.value.trim();
            if (code) {
                console.log('CDT Code submitted:', code);
                cdtModal.hide();
                cdtCodeInput.value = '';
            }
        });

        const tableRows = document.querySelectorAll('.recruitment-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('dblclick', function() {
                console.log('Row double-clicked:', this);
            });
        });


        document.querySelectorAll('.auto-resize').forEach(function(textarea) {
            autoResize(textarea);
        });

        var triggerTabList = [].slice.call(document.querySelectorAll('a[data-bs-toggle="tab"]'))
        triggerTabList.forEach(function(triggerEl) {
            new bootstrap.Tab(triggerEl)
        })

        var tabEl = document.querySelector('a[data-bs-toggle="tab"]')
        tabEl.addEventListener('shown.bs.tab', function(event) {
            event.target
            event.relatedTarget
        })
    });
</script>
@endpush
