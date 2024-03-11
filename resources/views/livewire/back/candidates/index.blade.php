<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Listes des candidats',
        'breadcrumbItems' => [
            ['text' => 'Candidats', 'url' => '#'],
            ['text' => 'Listes', 'url' => Route('candidates.index')],
        ],
    ])
    <!-- end page title -->
    <div class="d-flex">
        <div class="p-2 flex-grow-1">
            <a href="{{ route('candidates.create') }}" class="btn btn-primary"><i
                    class="ri-add-line align-bottom me-1"></i>
                Nouveau</a>
        </div>
        <div class="p-2">

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

            <select class="form-control w-md" wire:model.live='cdtStatus'>
                <option value="" selected>Selectioner</option>
                <option value="Close">Close</option>
                <option value="Open">Open</option>
                <option value="In Progress">In Progress</option>

            </select>
        </div>
        <div class="p-2">
            <div class="search-box ms-2">
                <input type="text" class="form-control" placeholder="Rechercher..." wire:model.live='search'>
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
    </div>
    {{-- end filter --}}
    <div class="row mt-5">
        @forelse ($candidates as $candidate)
            <div class="col-xxl-4 col-sm-6 project-card">
                <div class="card mecustom-card">
                    <div class="card-body">
                        <div class="p-3 mt-n3 mx-n3 bg-primary rounded-top">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="mb-0 fs-15 "><a href=""
                                            class="text-white">{{ $candidate->first_name }}
                                            {{ $candidate->last_name }}</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="d-flex gap-1 align-items-center my-n2">

                                        <div class="dropdown">
                                            <button
                                                class="btn btn-link text-white p-1 mt-n1 py-0 text-decoration-none fs-15"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="=false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ Route('candidates.edit', $candidate) }}"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Modifier</a>
                                                <div class="dropdown-divider"></div>
                                                <button class="dropdown-item"
                                                    wire:click="confirmDelete('{{ $candidate->first_name . ' ' . $candidate->last_name }}', '{{ $candidate->id }}')"
                                                    data-bs-target="#removeProjectModal"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Supprimer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dl mt-2">
                            <dt>Poste: </dt>
                            <dd>{{ optional($candidate->position)->name ?? 'non definie' }}
                            </dd>
                            <dt>Société: </dt>
                            <dd>{{ $candidate->company ?? 'non definie' }} </dd>
                            <dt>Mail: </dt>
                            <dd>{{ $candidate->email ?? 'non definie' }} </dd>
                            <dt>Téléphone: </dt>
                            <dd>{{ $candidate->phone ?? 'non definie' }} </dd>
                            <dt>Téléphone 2: </dt>
                            <dd>{{ $candidate->phone_2 ?? 'non definie' }} </dd>
                            <dt>CP/Dpt: </dt>
                            <dd>{{ $candidate->postal_code ?? 'non definie' }} </dd>
                            <dt>Statut CDT: </dt>
                            <dd>
                                <div class="badge bg-warning-subtle text-warning fs-12">
                                    {{ $candidate->cdt_status }} </div>
                            </dd>
                        </div>


                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        @empty
            <div class="py-4 mt-4 text-center" id="noresult">
                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                    colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px"></lord-icon>
                <h5 class="mt-4">Aucun résultat trouvé</h5>
            </div>
        @endforelse
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row g-0 text-center text-sm-start align-items-center mb-4">
        <!-- end col -->
        {{ $candidates->links() }}
    </div><!-- end row -->


</div>
