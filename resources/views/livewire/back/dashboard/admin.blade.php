<div>
    {{-- créer par MAHAMADOU ALI ABDOUL RAZAK +226 70147315 --}}
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Espace administrateur',
        'breadcrumbItems' => [['text' => 'BaseCDT', 'url' => '#']],
    ])
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex">
                <div class="p-2 flex-grow-1">
                    <a href="{{ route('candidates.create') }}" class="btn "><i class="ri-add-line align-bottom me-1"></i>
                        Saisir des candidats via formulaire</a>

                    <a href="{{ route('import.candidat') }}" class="btn ms-5"><i
                            class="ri-add-line align-bottom me-1"></i>
                        Uploader une base de candidats</a>
                </div>

            </div>
        </div>

        <div class="col-md-12 mt-4 mb-3">
            <div class="table-responsive">
                <h5 class="mb-0">Paramètres de tri des candidats</h5>
                <table class="table table-bordered border-secondary table-nowrap">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="width:100px">Effacer les filtres</th>
                            <th scope="col">Recherche</th>
                            <th scope="col">N lignes</th>
                            <!-- <th scope="col">Nom</th>
                            <th scope="col">Date</th> -->
                            <th scope="col">Etat</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Fonction</th>
                            <th scope="col">CP/Dpt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button class="btn btn-danger ms-4" wire:click="resetFilters">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="Rechercher..." wire:model.live='search'>
                               
                            </td>
                            <td>
                                <select class="form-control w-md" wire:model.live='nbPaginate'>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30" selected>30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </td>

                            <!-- <td>
                                <select class="form-control w-md" wire:model.live='filterName'>
                                    <option value="" class="bg-secondary text-white" selected>
                                        Selectionner
                                    </option>
                                    <option value="asc">A -> Z</option>
                                    <option value="desc">Z -> A</option>
                                </select>
                            </td> -->
                            <!-- <td>
                                <select class="form-control w-md" wire:model.live='filterDate'>
                                    <option value="" class="bg-secondary text-white" selected>
                                        Selectionner
                                    </option>
                                    <option value="asc">Plus récent en haut</option>
                                    <option value="desc">Plus ancien en haut</option>
                                </select>
                            </td> -->
                            <td>
                                <select class="form-control w-md" wire:model.live='candidate_state_id'>
                                    <option value="" class="bg-secondary text-white" selected>
                                        Selectionner
                                    </option>
                                    <option value="" selected>Tous</option>
                                    @foreach ($candidateStates as $candidateState)
                                        <option value="{{ $candidateState->id }}"> {{ $candidateState->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control w-md" wire:model.live='candidate_statut_id'>
                                    <option value="" selected> Statut</option>
                                    @foreach ($candidateStatuses as $candidateStatus)
                                        <option value="{{ $candidateStatus->id }}" selected>
                                            {{ $candidateStatus->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </td>
                            <td>
                                <select class="form-control w-md" wire:model.live='position_id'>
                                    <option value="" selected>Fonction</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="Veuillez entrer la valeur" wire:model.live='cp'>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- end page title -->

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h4
                                class="card-title
                            d-flex justify-content-between align-items-center fw-bold fs-2">
                                BaseCDT</h4>
                        </div>
                        <div class="action" id="delete-button-container" style="display: none;">
                                <ul class="list-inline hstack gap-2 mb-0">
                                    <li class="list-inline-item">
                                        <a wire:click=""
                                            class="text-danger d-inline-block remove-item-btn">
                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                        </a>
                                    </li>
                                </ul>
                        </div>
                        <div class="" id="exporter">
                            <button wire:click="downloadExcel" wire:loading.attr="disabled" wire:target="downloadExcel"
                                type="button" class="btn btn-primary position-relative">
                                <i class="ri-file-download-line me-1"></i>
                                <span class="download-text">Exporter</span>
                                <span wire:loading wire:target="downloadExcel"
                                    class="position-absolute top-50 start-50 translate-middle">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Exportation...</span>
                                </span>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                            <thead class="bg-secondary text-white sticky-top">
                            <tr>
                                        <th scope="col"><input type="checkbox" id="select-all-checkbox" class="candidate-checkbox" style="display:none;"></th>
                                        <th scope="col" wire:click="sortBy('updated_at')">
                                            Date MAJ
                                        </th>
                                        <th scope="col">Aut</th>
                                        <th scope="col">Civilité</th>
                                        <th scope="col" wire:click="sortBy('first_name')">
                                            Prénom
                                        </th>
                                        <th scope="col" wire:click="sortBy('last_name')">
                                            Nom
                                        </th>
                                        <th scope="col">Fonction</th>
                                        <th scope="col">Société</th>
                                        <th scope="col">Tél</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">CP/Dpt</th>
                                        <th scope="col">Ville</th>
                                        <th scope="col">Pays</th>
                                        <th scope="col">UrlCTC</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Disponibilité</th>
                                        <!-- <th scope="col">Etat</th> -->
                                        <th scope="col">Next step</th>
                                        <th scope="col">NSdate</th>
                                        <th scope="col">CV</th>
                                        <th scope="col">CRE</th>
                                        <th scope="col">Commentaire</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Suivi</th>
                                        <!-- <th scope="col">Action</th> -->
                                    </tr>
                            </thead>
                            <tbody>
                                    @forelse ($candidates as $index => $candidate)
                                        <tr data-id="{{ $candidate->id }}"
                                            class="{{ $selectedCandidateId == $candidate->id ? 'table-info' : ($index % 2 == 0 ? '' : 'cdtnonactiveontable') }}">
                                            <td class="checkbox-cell">
                                                <input type="checkbox" class="candidate-checkbox" value="{{ $candidate->id }}" style="display:none;">
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($candidate->updated_at)->format('d/m/y') ?? '--' }}</td>
                                            <td>{{ $candidate->auteur->trigramme ?? '--' }}</td>
                                            <td>{{ $candidate->civ->name ?? '--' }}</td>
                                            <td>{{ $candidate->first_name ?? '--' }}</td>
                                            <td>{{ $candidate->last_name ?? '--' }}</td>
                                            <td>{{ $candidate->position->name ?? '--' }}</td>
                                            <td>{{ $candidate->compagny->name ?? '--' }}</td>
                                            <td>{{ $candidate->phone ?? '--' }}</td>
                                            <td>{{ $candidate->email ?? '--' }}</td>
                                            <td>{{ $candidate->postal_code ?? '--' }}</td>
                                            <td>{{ $candidate->city ?? '--' }}</td>
                                            <td>{{ $candidate->country ?? '--' }}</td>
                                            <td>{{ $candidate->url_ctc ?? '--' }}</td>
                                            <td>{{ $candidate->candidateStatut->name ?? '--' }}</td>
                                            <td>{{ $candidate->disponibility->name ?? '--' }}</td>
                                            <!-- <td>{{ $candidate->candidateState->name ?? '--' }}</td> -->
                                            <td>{{ $candidate->nextStep->name ?? '--' }}</td>
                                            <td>{{ $candidate->nsDate->name ?? '--' }}</td>
                                            <td>
                                                @if ($candidate->files()->exists())
                                                    @php
                                                        $cvFile = $candidate->files()->where('file_type', 'cv')->first();
                                                    @endphp
                                                    @if ($cvFile)
                                                        OK
                                                    @else
                                                        n/a
                                                    @endif
                                                @else
                                                    n/a
                                                @endif
                                            </td>
                                            <td>
                                                @if ($candidate->cres()->exists())
                                                    OK
                                                @else
                                                    n/a
                                                @endif
                                            </td>
                                            <td>{{ $candidate->commentaire ?? '--' }}</td>
                                            <td>{{ $candidate->description ?? '--' }}</td>
                                            <td>{{ $candidate->suivi ?? '--' }}</td>
                                        </tr>
                                        
                                    @empty
                                        <tr>
                                            <td colspan="17" class="text-center">
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
    let lastClickTime = 0;
    let clickTimeout;
    const doubleClickDelay = 300; // Milliseconds
    const deleteButtonContainer = document.getElementById('delete-button-container');
    let checkboxesDisplayed = false;
    let selectedCandidateIds = []; // Initialize selectedCandidateIds as an array
    let candidateId;
    const exportButton = document.getElementById('exporter');

    // Hide all checkboxes initially
    document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
        checkbox.style.display = 'none';
    });
    // Update the delete button click handler
function updateDeleteButton() {
    if (deleteButtonContainer) {
        deleteButtonContainer.setAttribute('wire:click', `confirmDeleteChecked('${selectedCandidateIds.join(',')}')`);
        deleteButtonContainer.style.cursor = 'pointer'; // Change cursor to a hand when it hovers over the delete button

        // If deleteButtonContainer is displayed, hide the export button
        if (deleteButtonContainer.style.display === 'block') {
            exportButton.style.display = 'none';
        } else {
            exportButton.style.display = 'block';
        }
    }
}
    // Handle row click event
    document.querySelectorAll('tr[data-id]').forEach(function(row) {
        row.addEventListener('click', function(event) {
            candidateId = row.getAttribute('data-id');
            let currentTime = new Date().getTime();

            if (currentTime - lastClickTime < doubleClickDelay) {
                // Double-click detected
                clearTimeout(clickTimeout); // Clear the timeout for the single-click action
                window.location.href = "{{ url('/candidates') }}/" + candidateId;
            } else {
                // Single-click
                lastClickTime = currentTime;
                clickTimeout = setTimeout(function() {
                    // Show all checkboxes on the first click
                    if (!checkboxesDisplayed) {
                        document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                            checkbox.style.display = '';
                        });
                        checkboxesDisplayed = true;
                    }
                    deleteButtonContainer.style.display = 'block';

                    // Toggle selection class and check/uncheck the checkbox for the clicked row
                    let checkbox = row.querySelector('.candidate-checkbox');
                    if (checkbox) {
                        checkbox.checked = !checkbox.checked; // Toggle checkbox
                        row.classList.toggle('table-info', checkbox.checked); // Toggle row highlight
                        if (checkbox.checked) {
                            selectedCandidateIds.push(candidateId); // Add ID to selected IDs
                        } else {
                            selectedCandidateIds = selectedCandidateIds.filter(id => id !== candidateId); // Remove ID from selected IDs
                        }
                        updateDeleteButton(); // Update delete button with new selected IDs
                    }
                }, doubleClickDelay); // Delay for distinguishing between single and double click
            }
        });
    });

    // Handle direct checkbox click to toggle selection class
    document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('click', function(event) {
            let row = checkbox.closest('tr[data-id]');
            let candidateId = row.getAttribute('data-id');
            if (row) {
                row.classList.toggle('table-info', checkbox.checked);
                if (checkbox.checked) {
                    selectedCandidateIds.push(candidateId); // Add ID to selected IDs
                } else {
                    selectedCandidateIds = selectedCandidateIds.filter(id => id !== candidateId); // Remove ID from selected IDs
                }
                updateDeleteButton(); // Update delete button with new selected IDs
            }
            event.stopPropagation(); // Prevent the row click event from firing
        });
    });

   // Handle select all checkbox
document.getElementById('select-all-checkbox').addEventListener('change', function(event) {
    let checkboxes = document.querySelectorAll('.candidate-checkbox');
    if (event.target.checked) {
        // If the select-all checkbox is checked, add all candidate IDs to selected IDs
        selectedCandidateIds = [];
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = true;
            let row = checkbox.closest('tr[data-id]');
            if (row) {
                row.classList.add('table-info');
                let candidateId = row.getAttribute('data-id');
                selectedCandidateIds.push(candidateId);
            }
        });
    } else {
        // If the select-all checkbox is unchecked, reset selected IDs
        selectedCandidateIds = [];
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
            let row = checkbox.closest('tr[data-id]');
            if (row) {
                row.classList.remove('table-info');
            }
        });
    }
    updateDeleteButton(); // Update delete button with new selected IDs

    // Check if any checkbox is checked
    let anyChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.checked);
    // Show or hide deleteButtonContainer based on whether any checkbox is checked
    deleteButtonContainer.style.display = anyChecked ? 'block' : 'none';
});

   // Handle direct checkbox click to toggle selection class
document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('click', function(event) {
        let row = checkbox.closest('tr[data-id]');
        let candidateId = row.getAttribute('data-id');
        if (row) {
            row.classList.toggle('table-info', checkbox.checked);
            if (checkbox.checked) {
                // If checkbox is checked, add ID to selected IDs
                if (!selectedCandidateIds.includes(candidateId)) {
                    selectedCandidateIds.push(candidateId);
                }
            } else {
                // If checkbox is unchecked, remove ID from selected IDs
                selectedCandidateIds = selectedCandidateIds.filter(id => id !== candidateId);
            }
            updateDeleteButton(); // Update delete button with new selected IDs
        }
        event.stopPropagation(); // Prevent the row click event from firing

        // If checkbox is unchecked, uncheck the select-all checkbox
        if (!checkbox.checked) {
            document.getElementById('select-all-checkbox').checked = false;
        }

        // Check if any checkbox is checked
        let anyChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.checked);
        // Show or hide deleteButtonContainer based on whether any checkbox is checked
        deleteButtonContainer.style.display = anyChecked ? 'block' : 'none';
    });
});
});
        </script>
    @endpush
</div>
