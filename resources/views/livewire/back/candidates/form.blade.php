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
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">
                                <h5 class="card-title mb-0 ">
                                    {{ $action == 'create' ? "Formulaire de creation d'un candidat" : "Formulaire de modification d'un candidat" }}
                                </h5>

                            </div>
                            <div class="p-2">
                                <a href="{{ Route('import.candidat') }}" class="btn btn-primary">Importer</a>
                            </div>
                            <div class="p-2">
                                <a href="{{ url()->previous() }}" class="btn btn-primary"><i
                                        class="mdi mdi-arrow-left me-1"></i>Retour</a>
                            </div>
                        </div>


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
                                                <label for="origine" class="form-label">Source </label>
                                                <input type="text"
                                                    class="form-control @error('origine') is-invalid @enderror "
                                                    wire:model='origine' placeholder="Veuillez entrer la source" />
                                                @error('origine')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <label for="job-category-Input" class="form-label">Civilité</label>
                                                <select class="form-control @error('civ_id') is-invalid @enderror "
                                                    wire:model='civ_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($civs as $civ)
                                                        <option value="{{ $civ->id }}">{{ $civ->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('civ_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
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
                                        <div class="col-lg-3">
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
                                        <div class="col-lg-2 ">
                                            <div>
                                                <label for="disponibility" class="form-label">Disponibilité </label>
                                                <select
                                                    class="form-control @error('disponibility_id') is-invalid @enderror "
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
                                        <div class="col-lg-3 mt-4">
                                            <div>
                                                <label for="next_step_id" class="form-label">Next step </label>
                                                <select
                                                    class="form-control @error('next_step_id') is-invalid @enderror "
                                                    wire:model='next_step_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($nextSteps as $nextStep)
                                                        <option value="{{ $nextStep->id }}">
                                                            {{ $nextStep->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('next_step_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <div>

                                                <label for="ns_date" class="form-label">NSDATE </label>
                                                <input type="date"
                                                    class="form-control @error('ns_date') is-invalid @enderror"
                                                    wire:model='ns_date' placeholder="Veuillez entrer ns_date" />
                                                @error('ns_date')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <div>
                                                <label for="cdt_status" class="form-label">Statut <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control @error('cdt_status') is-invalid @enderror"
                                                    wire:model='cdt_status'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($candidateStatuses as $statu)
                                                        <option value="{{ $statu }}"
                                                            @if ($action == 'update' && $statu == $cdt_status) selected @endif>
                                                            {{ $statu }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('cdt_status')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card ">
                                <div class="card-header">
                                    <h5 class="card-title
                                    mb-0">Addresse</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">


                                        <div class="col-md-2 ">
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
                                        <div class="col-lg-3 ">
                                            <div>
                                                <label for="phone" class="form-label">Téléphone 1 </label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror "
                                                    wire:model='phone'
                                                    placeholder="Veuillez entrer le numéro de télépone 1" />

                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div>
                                                <label for="phone_2" class="form-label">Téléphone 2</label>
                                                <input type="text"
                                                    class="form-control @error('phone_2') is-invalid @enderror "
                                                    wire:model='phone_2'
                                                    placeholder="Veuillez entrer le numéro de télépone 2" />

                                                @error('phone_2')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div>
                                                <label for="vancancy-Input" class="form-label">CP/Dpt </label>
                                                <input type="number"
                                                    class="form-control @error('postal_code') is-invalid @enderror "
                                                    min="0" wire:model='postal_code'
                                                    placeholder="Veuillez entrer la boîte postal" />
                                                @error('postal_code')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div>
                                                <label for="country" class="form-label">Pays </label>
                                                <input type="text"
                                                    class="form-control @error('country') is-invalid @enderror "
                                                    min="0" wire:model='country'
                                                    placeholder="Veuillez entrer le pays" />
                                                @error('country')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <div>
                                                <label for="region" class="form-label">Région </label>
                                                <input type="text"
                                                    class="form-control @error('region') is-invalid @enderror "
                                                    min="0" wire:model='region'
                                                    placeholder="Veuillez  entrer la région" />
                                                @error('region')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <div>
                                                <label for="city" class="form-label">Ville </label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror "
                                                    min="0" wire:model='city'
                                                    placeholder="Veuillez  entrer la ville" />
                                                @error('city')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <div>
                                                <label for="city" class="form-label">UrlCTC </label>
                                                <input type="text"
                                                    class="form-control @error('url_ctc') is-invalid @enderror "
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
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title
                                    mb-0">Cursus</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div>
                                                <label for="compagny_id" class="form-label">Societé </label>
                                                <select
                                                    class="form-control @error('compagny_id') is-invalid @enderror "
                                                    wire:model='compagny_id'>
                                                    <option value="" selected>Selectionner</option>
                                                    @foreach ($compagnies as $compagny)
                                                        <option value="{{ $compagny->id }}"
                                                            @if ($action == 'update' && $compagny->id == $compagny_id) selected @endif>
                                                            {{ $compagny->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('compagny_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <label for="position_id" class="form-label">Poste (Fonction1) </label>
                                                <select
                                                    class="form-control @error('position_id') is-invalid @enderror "
                                                    wire:model='position_id'>
                                                    <option value="" selected>Selectionner</option>
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
                                        <div class="col-lg-3">
                                            <div>
                                                <label for="specialitiesSelected" class="form-label">Spécialité
                                                    (Fonction2)</label>
                                                <select
                                                    class="form-control @error('specialitiesSelected') is-invalid @enderror "
                                                    wire:model='specialitiesSelected'>
                                                    <option value="" selected>Selectionner 
                                                    </option>
                                                    @foreach ($specialities as $speciality)
                                                        <option value="{{ $speciality->id }}"
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
                                        <div class="col-lg-3 ">
                                            <div>
                                                <label for="fieldsSelected" class="form-label">Domaine
                                                    (Fonction3)</label>
                                                <select
                                                    class="form-control @error('fieldsSelected') is-invalid @enderror "
                                                    wire:model='fieldsSelected'>
                                                    <option value="" selected>Selectionner une spécialité
                                                    </option>
                                                    @foreach ($fields as $field)
                                                        <option value="{{ $field->id }}"
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

                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title
                                    mb-0">Commentaire et
                                        Documents</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Example Textarea -->
                                            <div>
                                                <label for="commentaire" class="form-label">Commentaire
                                                </label>
                                                <textarea wire:model='commentaire' class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- Multiple Files Input Example -->
                                            <div>
                                                <label for="files" class="form-label">Documents</label>
                                                <input wire:model="files"
                                                    class="form-control @error('files') is-invalid @enderror"
                                                    type="file" multiple>
                                            </div>
                                            @error('files')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"
                                @if (!$this->autorizeAddCandidate) disabled @endif>{{ $action == 'create' ? 'Enregistrer' : 'Modifier' }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
