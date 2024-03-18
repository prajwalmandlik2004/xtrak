<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title 
                d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Bienvenue dans votre espace</h2>
            </div>
        </div>
    </div>
    <div class="d-flex mt-4">
        <div class="p-2 flex-grow-1">
            <a href="{{ route('candidates.create') }}" class="btn "><i class="ri-add-line align-bottom me-1"></i>
                Saisir des candidats via formulaire</a>

            <a href="{{ route('import.candidat') }}" class="btn ms-5"><i class="ri-add-line align-bottom me-1"></i>
                Uploader une base de candidats</a>
        </div>
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
    <div class="d-flex mt-4">
        <div class="p-2 flex-grow-1">
            <a href="{{ route('candidates.create') }}" class="btn "><i class="ri-add-line align-bottom me-1"></i>
                Saisir un C.R.E</a>
        </div>
        <div class="p-2">

            <select class="form-control w-md" wire:model.live='filterName'>
                <option value="" class="bg-secondary text-white" selected>Tri</option>
                <option value="asc">A -> Z</option>
                <option value="desc">Z -> A</option>

            </select>
        </div>
        <div class="p-2">

            <select class="form-control w-md" wire:model.live='filterDate'>
                <option value="" class="bg-secondary text-white" selected>Date</option>
                <option value="asc">Plus récent en haut</option>
                <option value="desc">Plus ancien en haut</option>

            </select>
        </div>
        <div class="p-2">

            <select class="form-control w-md" wire:model.live='state'>
                <option value="" class="bg-secondary text-white" selected>Etat</option>
                <option value="Certifié">Certifié
                </option>
                <option value="Attente">Attente</option>
                <option value="Doublon">Doublon</option>
                <option value="">Tous</option>
            </select>
        </div>

    </div>
    <div class="card mt-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Civilité</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Poste actuel</th>
                            <th scope="col">Statut </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($candidates as $candidate)
                            <tr>
                                <td> <a class="text-body"
                                        href="{{ Route('candidates.show', $candidate) }}">{{ $loop->iteration }}
                                    </a></td>
                                <td> <a class="text-body" href="{{ Route('candidates.show', $candidate) }}">
                                        {{ $candidate->created_at->format('d/m/Y') ?? 'Non renseigné' }}
                                        </h5>
                                    </a></td>
                                <td> <a class="text-body"
                                        href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->civ->name ?? '-' }}
                                    </a></td>
                                <td> <a
                                        class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->last_name ?? '' }}</a>
                                </td>
                                <td> <a
                                        class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->first_name ?? '' }}</a>
                                </td>
                                <td> <a class="text-body"
                                        href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->position->name ?? '-' }}</a>
                                </td>
                                <td> <a class="text-body"
                                        href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->state ?? '' }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px">
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
    <!-- end row -->
    <div class="row g-0 text-center text-sm-start align-items-center mb-4">
        <!-- end col -->
        {{ $candidates->links() }}
    </div><!-- end row -->


</div>
