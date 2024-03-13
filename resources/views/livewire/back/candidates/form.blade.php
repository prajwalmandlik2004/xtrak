<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Nouveau candidat',
        'breadcrumbItems' => [
            ['text' => 'Candidats', 'url' => '#'],
            ['text' => 'Liste', 'url' => Route('candidates.index')],
            ['text' => 'Nouveau', 'url' => '#', 'active' => true],
        ],
    ])
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form wire:submit.prevent="storeData()">
                    @csrf
                    <div class="card-header">
                        <h5 class="card-title mb-0 ">
                            {{ $action == 'create' ? "Formulaire de creation d'un candidat" : "Formulaire de modification d'un candidat" }}
                        </h5>
                        <h5 class="card-title text-muted mb-0 fs-15 mt-2">les champs avec <span
                                class="text-danger">*</span> sont obligatoires</h5>
                    </div>
                    <div class="card-body">

                        <div class="row g-4">

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title
                                    mb-0">Informations
                                        personnelles</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="job-category-Input" class="form-label">Civ <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control @error('title') is-invalid @enderror "
                                                    wire:model.live='title'>
                                                    <option value="" selected>Selectionner un Civ</option>
                                                    @foreach ($candidateTitles as $candidateTitle)
                                                        <option value="{{ $candidateTitle }}">{{ $candidateTitle }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('title')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="first_name" class="form-label">Prénom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror "
                                                    wire:model.live='first_name'
                                                    placeholder="Veuillez entrer le prénom" />
                                                @error('first_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="last_name" class="form-label">Nom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    wire:model.live='last_name' placeholder="Veuillez entrer le nom" />

                                                @error('last_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="availability" class="form-label">Disponibilité <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    class="form-control @error('availability') is-invalid @enderror "
                                                    wire:model.live='availability'>
                                                    <option value="" selected>Selectionner un poste</option>
                                                    @foreach ($availabilities as $availability)
                                                        <option value="{{ $availability }}">{{ $availability }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('availability')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title
                                    mb-0">Address</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">


                                        <div class="col-md-3 mt-4">
                                            <div>
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror "
                                                    wire:model.live='email'
                                                    placeholder="Veuillez entrer l'address email" />
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mt-4">
                                            <div>
                                                <label for="phone" class="form-label">Téléphone 1 <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror "
                                                    wire:model.live='phone'
                                                    placeholder="Veuillez entrer le numéro de télépone" />

                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mt-4">
                                            <div>
                                                <label for="phone_2" class="form-label">Téléphone 2</label>
                                                <input type="text"
                                                    class="form-control @error('phone_2') is-invalid @enderror "
                                                    wire:model.live='phone_2'
                                                    placeholder="Veuillez entrer la société" />

                                                @error('phone_2')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <div>
                                                <label for="vancancy-Input" class="form-label">CP/Dpt <span
                                                        class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control @error('postal_code') is-invalid @enderror "
                                                    min="0" wire:model.live='postal_code'
                                                    placeholder="Veuillez entrer la boîte postal" />
                                                @error('postal_code')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <div>
                                                <label for="country" class="form-label">Pays <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('country') is-invalid @enderror "
                                                    min="0" wire:model.live='country'
                                                    placeholder="Veuillez entrer le pays" />
                                                @error('country')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <div>
                                                <label for="region" class="form-label">Région <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('region') is-invalid @enderror "
                                                    min="0" wire:model.live='region'
                                                    placeholder="Veuillez  entrer la région" />
                                                @error('region')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <div>
                                                <label for="city" class="form-label">Ville <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror "
                                                    min="0" wire:model.live='city'
                                                    placeholder="Veuillez  entrer la ville" />
                                                @error('city')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <div>
                                                <label for="city" class="form-label">UrlCTC <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('url_ctc') is-invalid @enderror "
                                                    min="0" wire:model.live='url_ctc'
                                                    placeholder="Veuillez entrer l'UrlCTC" />
                                                @error('url_ctc')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title
                                    mb-0">Expertise</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="position_id" class="form-label">Poste (Fonction1) <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    class="form-control @error('position_id') is-invalid @enderror "
                                                    wire:model.live='position_id'>
                                                    <option value="" selected>Selectionner un poste</option>
                                                    @foreach ($positions as $position)
                                                        <option value="{{ $position->id }}"
                                                            @if ($action == 'update' && $position->id == $position_id) selected @endif>
                                                            {{ $position->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('position_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="specialitiesSelected" class="form-label">Spécialité (Fonction2)</label>
                                                <select
                                                    class="form-control @error('specialitiesSelected') is-invalid @enderror "
                                                    wire:model.live='specialitiesSelected'>
                                                    <option value="" selected>Selectionner une spécialité
                                                    </option>
                                                    @foreach ($specialities as $speciality)
                                                        <option value="{{ $position->id }}"
                                                            @if ($action == 'update' && $specialitiesSelected > 0 && in_array($speciality->id, $specialitiesSelected)) selected @endif>
                                                            {{ $speciality->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('specialitiesSelected')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-4">
                                            <div>
                                                <label for="fieldsSelected" class="form-label">Domaine (Fonction3)</label>
                                                <select
                                                    class="form-control @error('fieldsSelected') is-invalid @enderror "
                                                    wire:model.live='fieldsSelected'>
                                                    <option value="" selected>Selectionner une spécialité
                                                    </option>
                                                    @foreach ($fields as $field)
                                                        <option value="{{ $position->id }}"
                                                            @if ($action == 'update' && $fieldsSelected > 0 && in_array($field->id, $fieldsSelected)) selected @endif>
                                                            {{ $field->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('fieldsSelected')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mt-4">
                                            <div>
                                                <label for="company" class="form-label">Sociéte <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('company') is-invalid @enderror "
                                                    wire:model.live='company'
                                                    placeholder="Veuillez entrer le nom de la société" />

                                                @error('company')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>




                            <div class="col-md-6">
                                <!-- Multiple Files Input Example -->
                                <div>
                                    <label for="files" class="form-label">Documents</label>
                                    <input wire:model="files"
                                        class="form-control @error('files') is-invalid @enderror" type="file"
                                        multiple>
                                </div>
                                @error('files')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2 mt-4">
                                <div>
                                    <label for="cdt_status" class="form-label">Statut CDT <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control @error('cdt_status') is-invalid @enderror "
                                        wire:model.live='cdt_status'>
                                        <option value=""selected>Selectionner le statut</option>
                                        <option value="Open">Open</option>
                                        <option value="Close">Close</option>
                                        <option value="In Progress">In Progress</option>
                                    </select>

                                    @error('cdt_status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a type="{{ Route('candidates.index') }}" class="btn btn-primary"
                                >Annuler</a>
                            <button type="submit" class="btn btn-primary"
                                @if (!$this->autorizeAddCandidate) disabled @endif>{{ $action == 'create' ? 'Enregistrer' : 'Modifier' }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
