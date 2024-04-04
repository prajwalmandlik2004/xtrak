<div>
    <div class="row">
        <div class="col-md-12">
            <div class="page-title d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Votre base globale </h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex mt-4">
                <div class="p-2 flex-grow-1">
                    <a href="{{ route('candidates.create') }}" class="btn "><i class="ri-add-line align-bottom me-1"></i>
                        Saisir des candidats via formulaire</a>

                    <a href="{{ route('import.candidat') }}" class="btn ms-5"><i
                            class="ri-add-line align-bottom me-1"></i>
                        Uploader une base de candidats</a>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex mt-4">
                <div class="p-2 ml-auto">
                    <select class="form-control w-md" wire:model.live='nbPaginate'>
                        <option value="6" selected>6</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="p-2">
                    <div class="search-box ms-2">
                        <input type="text" class="form-control" placeholder="Rechercher..." wire:model.live='search'>
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="float-md-end ">
                <div class="p-2">
                    <h5 class="mb-0">Paramètres de tri des candidats</h5>
                </div>
                <div class="p-2">
                    <div class="table-responsive">
                        <table class="table table-bordered border-secondary table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Alphabétique</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Etat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control w-md" wire:model.live='filterName'>
                                            <option value="" class="bg-secondary text-white" selected>Selectionner
                                            </option>
                                            <option value="asc">A -> Z</option>
                                            <option value="desc">Z -> A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control w-md" wire:model.live='filterDate'>
                                            <option value="" class="bg-secondary text-white" selected>Selectionner
                                            </option>
                                            <option value="asc">Plus récent en haut</option>
                                            <option value="desc">Plus ancien en haut</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control w-md" wire:model.live='candidate_state_id'>
                                            <option value="" class="bg-secondary text-white" selected>Selectionner
                                            </option>
                                            <option value="">Tous</option>
                                            @foreach ($candidateStates as $state)
                                                <option value="{{ $state->id }}" selected> {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                            <thead class="bg-secondary text-white">
                                <tr>

                                    <th scope="col">Date</th>
                                    <th scope="col">Civilité</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Poste actuel</th>
                                    <th scope="col">Statut </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($candidates as $index => $candidate)
                                    <tr wire:key="{{ $candidate->id }}"
                                        class="{{ $selectedCandidateId == $candidate->id ? 'table-info' : ($index % 2 == 0 ? 'table-secondary' : '') }}">

                                        <td> <a class="text-body" href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">
                                                {{ $candidate->created_at->format('d/m/Y') ?? 'Non renseigné' }}
                                                </h5>
                                            </a></td>
                                        <td> <a class="text-body" href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->civ->name ?? '-' }}
                                            </a></td>
                                        <td> <a class="text-body" href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->last_name ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body" href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->first_name ?? '--' }}
                                            </a></td>
                                        <td> <a class="text-body" href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->position->name ?? '-' }}</a>
                                        </td>
                                        <td> <a class="text-body" href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->state ?? '' }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c"
                                                style="width:72px;height:72px">
                                            </lord-icon>
                                            <h5 class="mt-4">Aucun résultat trouvé</h5>
                                        </td>

                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row g-0 text-center text-sm-start align-items-center mb-4">
        <!-- end col -->
        {{ $candidates->links() }}
    </div><!-- end row -->
    @push('page-script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let selectedRow = document.querySelector('.table-info');
                if (selectedRow) {
                    selectedRow.scrollIntoView({
                        block: 'nearest'
                    });
                }
            });
        </script>
    @endpush
</div>
