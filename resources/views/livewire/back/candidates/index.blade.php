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
        @if (session()->has('success'))
        <div class="d-flex justify-content-center mt-3">
            <div class="alert alert-success alert-dismissible fade show " role="alert" id="successAlert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
        <div class="col-md-6">
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
                                <tr class="text-center">
                                    <th scope="col">Nom</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select  class="form-control w-md" wire:model.live='filterName'>
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
                                    <td>
                                        <select class="form-control w-md" wire:model.live='state'>
                                            <option value="" class="bg-secondary text-white" selected>
                                                Selectionner
                                            </option>
                                            <option value="">Tous</option>
                                            <option value="Certifié">Certifié</option>
                                            <option value="Attente">Attente</option>
                                            <option value="Doublon">Doublon</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control w-md" wire:model.live='candidate_statut_id'>
                                            <option value="" selected> Statut</option>
                                            @foreach ($candidateStatuses as $state)
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

        <!-- end page title -->

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table
                            class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th scope="col">Date</th>
                                    {{-- <th scope="col">Auteur</th> --}}
                                    <th scope="col">Civilité</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Fonction</th>
                                    <th scope="col">Société</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Code postal (ou dpt) </th>
                                    <th scope="col">Ville </th>
                                    <th scope="col">Disponibilité</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Next step</th>
                                    <th scope="col">NSdate</th>
                                    <th scope="col">CV</th>
                                    <th scope="col">CRE</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($candidates as $index => $candidate)
                                    <tr wire:key="{{ $candidate->id }}"
                                        class="{{ $selectedCandidateId == $candidate->id ? 'table-info' : ($index % 2 == 0 ? 'table-secondary' : '') }}">
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->created_at->format('d/m/Y') ?? '--' }}
                                            </a></td>

                                        {{-- <td> <a class="text-body " href="#"
                                            wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">
                                            {{ $candidate->auteur->trigramme ?? '--' }}
                                            </h5>
                                        </a></td> --}}
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->civ->name ?? '--' }}
                                            </a></td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->first_name ?? '--' }}
                                            </a></td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->last_name ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->position->name ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->compagny->name ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->phone ?? '--' }}
                                            </a></td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->email ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->postal_code ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->city ?? '--' }}
                                            </a></td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->disponibility->name ?? '--' }}
                                            </a></td>

                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->state ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->nextStep->name ?? '--' }}</a>
                                        </td>
                                        <td> <a class="text-body " href="#"
                                                wire:click.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->ns_date ?? '--' }}</a>
                                        </td>
                                        <td>
                                            @if ($candidate->files()->exists())
                                                @php
                                                    $cvFile = $candidate->files()->where('file_type', 'cv')->first();
                                                @endphp

                                                @if ($cvFile)
                                                    <a class="text-body" href="#"
                                                        wire:click.prevent="selectCandidateGoToCv('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">OK</a>
                                                @else
                                                    n/a
                                                @endif
                                            @else
                                                n/a
                                            @endif

                                        </td>
                                        <td>
                                            @if ($candidate->cres()->exists())
                                                <a class="text-body " href="#"
                                                    wire:click.prevent="selectCandidateGoToCre('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">{{ $candidate->cres()->exists() ? 'OK' : '--' }}</a>
                                            @else
                                                n/a
                                            @endif


                                        </td>
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
        <script>
            setTimeout(function() {
                var successAlert = document.getElementById('successAlert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }
            }, 3000);
        </script>
    @endpush
</div>
