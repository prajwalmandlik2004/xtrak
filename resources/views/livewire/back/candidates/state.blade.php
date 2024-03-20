<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Listes des candidats',
        'breadcrumbItems' => [
            ['text' => 'Candidats', 'url' => '#'],
            ['text' => 'Listes', 'url' => Route('candidates.index')],
        ],
    ])
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex">
                <div class="p-2 flex-grow-1">
                    <a href="{{ route('candidates.create') }}" class="btn btn-primary"><i
                            class="ri-add-line align-bottom me-1"></i>
                        Nouveau</a>
                </div>
                <div class="p-2">

                    <select class="form-control w-md" wire:model.live='cdtStatus'>
                        <option value="" selected>Trier par Statut</option>
                        <option value="Close">Close</option>
                        <option value="Open">Open</option>
                        <option value="In Progress">In Progress</option>

                    </select>
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

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control w-md" wire:model.live='filterName'>
                                            <option value="" class="bg-secondary text-white" selected>
                                                Selectionner
                                            </option>
                                            <option value="asc">A -> Z</option>
                                            <option value="desc">Z -> A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control w-md" wire:model.live='filterDate'>
                                            <option value="" class="bg-secondary text-white" selected>
                                                Selectionner
                                            </option>
                                            <option value="asc">Plus récent en haut</option>
                                            <option value="desc">Plus ancien en haut</option>
                                        </select>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- end page title -->

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                            <thead class="bg-primary text-white">
                                <tr>

                                    <th scope="col">Auteur</th>
                                    <th scope="col">Civilité</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col">Poste</th>
                                    <th scope="col">Certification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($candidates as $candidate)
                                    <tr>


                                        <td> <a class="text-body" href="{{ Route('candidates.show', $candidate) }}">
                                                {{ $candidate->auteur->first_name ?? '--' }}
                                                {{ $candidate->auteur->last_name ?? '--' }}</h5>
                                            </a></td>
                                        <td> <a class="text-body"
                                                href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->civ->name ?? '--' }}
                                            </a></td>
                                        <td> <a
                                                class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->last_name ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->first_name ?? '--' }}
                                            </a></td>
                                        <td> <a
                                                class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->email ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->phone ?? '--' }}
                                            </a></td>
                                        <td> <a class="text-body"
                                                href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->cdt_status ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body"
                                                href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->position->name ?? '--' }}</a>
                                        </td>

                                        <td>
                                            @if ($candidate->certificate)
                                                <span class="badge rounded-pill bg-success"
                                                    id="certificate-{{ 0 }}"
                                                    onclick="toggleCertificate({{ 0 }})">
                                                    <span id="hidden-certificate-{{ 0 }}">••••••••</span>
                                                    <span id="visible-certificate-{{ 0 }}"
                                                        style="display: none;">{{ $candidate->certificate }}</span>
                                                </span>
                                            @else
                                                ---
                                            @endif
                                            <div id="message-{{ $loop->index }}" style="display: none;"></div>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
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

        <!-- end row -->
        <div class="row g-0 text-center text-sm-start align-items-center mb-4">
            <!-- end col -->
            {{ $candidates->links() }}
        </div><!-- end row -->
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
</div>
