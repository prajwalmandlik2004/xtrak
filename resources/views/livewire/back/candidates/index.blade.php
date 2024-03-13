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
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#list_view" role="tab">
                        Vue en liste
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link " data-bs-toggle="tab" href="#grid_view" role="tab">
                        Vue en grille
                    </a>
                </li>
            </ul>
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
                <option value="" selected>Trier par Statut CDT</option>
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
    <div class="tab-content text-muted">
        <div class="tab-pane active" id="list_view" role="tabpanel">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Civilité</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Statut CDN</th>
                                    <th scope="col">Certification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($candidates as $candidate)
                                   
                                        <tr>
                                           
                                            <th scope="row"> <a class="text-body"  href="{{ Route('candidates.show', $candidate) }}">{{ $loop->iteration }} </a></th>
                                            <td> <a  class="text-body" href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->title }} </a></td>
                                            <td> <a  class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->last_name }}</a> </td>
                                            <td> <a  class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->first_name }} </a></td>
                                            <td> <a  class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->email }}</a> </td>
                                            <td> <a  class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->phone }} </a></td>
                                            <td> <a class="text-body" href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->cdt_status }}</a> </td>
                                           
                                            <td>
                                                <span class="badge rounded-pill bg-success"
                                                    id="certificate-{{ $loop->index }}"
                                                    onclick="toggleCertificate({{ $loop->index }})">
                                                    <span id="hidden-certificate-{{ $loop->index }}">••••••••</span>
                                                    <span id="visible-certificate-{{ $loop->index }}"
                                                        style="display: none;">{{ $candidate->certificate }}</span>
                                                </span>
                                                <div id="message-{{ $loop->index }}" style="display: none;"></div>
                                        </tr>
                                    
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
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
        <div class="tab-pane" id="grid_view" role="tabpanel">
            <div class="row mt-5">
                @forelse ($candidates as $candidate)
                    <div class="col-xxl-4 col-sm-6 project-card">
                        <div class="card mecustom-card">
                            <div class="card-body">
                                <div class="p-3 mt-n3 mx-n3 bg-primary rounded-top">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-0 fs-15 ">
                                                <a href="{{ Route('candidates.show', $candidate) }}"
                                                    class="text-white">
                                                    {{ $candidate->first_name }}
                                                    {{ $candidate->last_name }}</a>
                                            </h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="d-flex gap-1 align-items-center my-n2">

                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-link text-white p-1 mt-n1 py-0 text-decoration-none fs-15"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="=false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @can('Modifier un candidat')
                                                            <a class="dropdown-item"
                                                                href="{{ Route('candidates.edit', $candidate) }}"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Modifier</a>
                                                        @endcan
                                                        @can('Supprimer un candidat')
                                                            <div class="dropdown-divider"></div>
                                                            <button class="dropdown-item"
                                                                wire:click="confirmDelete('{{ $candidate->first_name . ' ' . $candidate->last_name }}', '{{ $candidate->id }}')"
                                                                data-bs-target="#removeProjectModal"><i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Supprimer</button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ Route('candidates.show', $candidate) }}">
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
                                            <div class="badge bg-info-subtle text-info fs-12">
                                                {{ $candidate->cdt_status ?? 'non definie' }} </div>
                                        </dd>
                                        <dt>Certificat: </dt>
                                        <dd>
                                            <span class="badge rounded-pill bg-success"
                                                id="certificate-{{ $loop->index }}"
                                                onclick="toggleCertificate({{ $loop->index }})">
                                                <span id="hidden-certificate-{{ $loop->index }}">••••••••</span>
                                                <span id="visible-certificate-{{ $loop->index }}"
                                                    style="display: none;">{{ $candidate->certificate }}</span>
                                            </span>
                                            <div id="message-{{ $loop->index }}" style="display: none;"></div>


                                        </dd>
                                    </div>
                                </a>
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
            </div>
            <!-- end col -->
        </div>
    </div>
    <!-- end row -->
    <div class="row g-0 text-center text-sm-start align-items-center mb-4">
        <!-- end col -->
        {{ $candidates->links() }}
    </div><!-- end row -->

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
