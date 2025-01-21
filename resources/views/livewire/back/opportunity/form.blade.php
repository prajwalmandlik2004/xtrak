<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
    'title' => 'Nouvelle saisie',
    'breadcrumbItems' => [
    ['text' => 'BaseCDT', 'url' => '#']
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
                                            {{ $action == 'create' ? "FormOPP" : "FormOPP" }}
                                        </h5>


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
                            <a wire:click="goToDoc" class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 2 ? '#' : '#management' }}" role="tab">
                                Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToCre" class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#invoicement' }}" role="tab">
                                Invoicement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToForm" class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 4 ? '#' : '#evts' }}" role="tab">
                                EVTS Records
                            </a>
                        </li>
                    </ul>
                    <div class="card-body">

                        <div class="row g-4">

                            <div class="mt-2 card">
                                <div class="card-header">
                                    <!-- <h5 class="mb-0 card-title">
                                                Informations
                                                personnelles</h5> -->
                                    <div class="col-lg-8" style="margin-left:3%">
                                        <div style="display: flex; align-items:center">
                                            <!-- <label for="origine" class="form-label" style="margin-right:5%">Date</label> -->
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
                                    </div>
                                </div>
                                <div class="card-body" style="margin-left:3%; margin-top: -1%;">

                                    <h5 class="mb-0 card-title">
                                        Source and Employeur</h5>
                                    <hr>

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
                                        <div class="card-header" style="margin-top:0%;">
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
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" style="margin-top:-5%;">
                                    <h5 class="mb-0 card-title" style="margin-left:3%">
                                        Poste and Location</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%;margin-left:3%">
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
                                                    min="0" wire:model='country'
                                                    placeholder="Country" />
                                                @error('country')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 card">
                                <div class="card-header" style="margin-top:-4%;">
                                    <h5 class="mb-0 card-title" style="margin-left:3%">
                                        Attendus</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%; margin-left:3%">
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
                            <div class="mt-4 card">
                                <div class="card-header" style="margin-top:-5%;">
                                    <h5 class="mb-0 card-title" style="margin-left:3%">
                                        Compétences</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%; margin-left:3%">
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
                                    </div>
                                </div>
                            </div>


                            <div class="mt-4 card">
                                <div class="card-header" style="margin-top:-5%;">
                                    <h5 class="mb-0 card-title" style="margin-left:3%">Package</h5>
                                </div>
                                <div class="card-body" style="margin-top:-1%; margin-left:3%">
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
                                        <div class="col-md-2">
                                            <div>
                                                <label for="remarks_two" class="form-label">Remarque(s)</label>
                                                <input type="text"
                                                    class="form-control form-control-custom-1 @error('remarks_two') is-invalid @enderror"
                                                    wire:model='remarks_two'
                                                    placeholder="Remarque(s)" />
                                                @error('remarks_two')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer" style="margin-top: -3%;">
                        <div class="d-flex justify-content-end">

                            <button style="background:#3D3BF3; border:none;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                                class="btn btn-success btn-label right ms-auto nexttab"><i
                                    class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                                {{ $action == 'create' ? 'Link CST' : 'Link CST' }}</button>

                            <button style="background:#FFB534; border:none;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                                class="btn btn-success btn-label right ms-auto nexttab"><i
                                    class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                                {{ $action == 'create' ? 'Gestion CDT' : 'Gestion CDT' }}</button>

                            <button style="background:#FF77B7; border:none;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                                class="btn btn-success btn-label right ms-auto nexttab"><i
                                    class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                                {{ $action == 'create' ? 'New EVT' : 'New EVT' }}</button>

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
                            <a wire:click="goToDoc" class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 2 ? '#' : '#management' }}" role="tab">
                                Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToCre" class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#invoicement' }}" role="tab">
                                Invoicement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToForm" class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 4 ? '#' : '#evts' }}" role="tab">
                                EVTS Records
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
                                        <button class="unlink-btn" id="unlinkBtn">UNLINK</button>
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
                            <a wire:click="goToDoc" class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 2 ? '#' : '#management' }}" role="tab">
                                Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToCre" class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 3 ? '#' : '#invoicement' }}" role="tab">
                                Invoicement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="goToForm" class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="{{ $step != 4 ? '#' : '#evts' }}" role="tab">
                                EVTS Records
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
<style>
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
        font-size: 15px;
    }

    .cdt-ok-btn {
        background: #118B50;
        border: 1px solid #999;
        padding: 2px 8px;
        cursor: pointer;
        font-size: 15px;
        color: white;
    }

    .cdt-message {
        font-size: 15px;
        color: #666;
        padding: 2px 0;
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

    document.addEventListener("DOMContentLoaded", function() {

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
