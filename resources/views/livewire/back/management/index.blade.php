<div>

    {{-- créer par MAHAMADOU ALI AdbDOUL RAZAK +226 70147315 --}}
    <!-- start page title -->
    @include('components.breadcrumb', [
    'title' => auth()->user()->hasRole('Manager') ? 'FormOPP' : 'FormOPP',
    'breadcrumbItems' => [['text' => 'Views', 'url' => '#'] , ['text' => 'OPPvue', 'url' => '#'] , ['text' => 'OPPform', 'url' => '#']],
    ])

    <div class="row">
        <div class="col-md-12">

              <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr class="text-left">
                            <th style="width:80px;" scope="col">Civ.</th>
                            <th style="width:150px;" aria-activedescendant="" scope="col">First Name</th>
                            <th style="width:150px;" class="select-cpdpt" scope="col">Last Name</th>
                            <th style="width:200px;" aria-controls="" scope="col">Title</th>
                            <th style="width:150px;" scope="col">CDT Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" placeholder="" wire:model.live='civ'>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="" wire:model.live='first_name'>

                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="" wire:model.live='last_name'>

                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="" wire:model.live='fonction'>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="" wire:model.live='cdt_code'>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 1 ? 'active' : '' }} fw-bold {{ $step != 1 ? 'enabled' : '' }}"
                                href="/opportunity">
                                Description
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                href="/job">
                                F.P.
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 2 ? 'active' : '' }} fw-bold {{ $step != 2 ? 'enabled' : '' }}"
                                data-bs-toggle="tab" href="/management" role="tab">
                                CDT mgt
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 4 ? 'active' : '' }} fw-bold {{ $step != 4 ? 'enabled' : '' }}"
                                href="/opportunity/create">
                                Hiring Process
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 3 ? 'active' : '' }} fw-bold {{ $step != 3 ? 'enabled' : '' }}"
                                href="/opportunity#invoicement">
                                Facturation
                            </a>
                        </li>
                    </ul>
                </div>


                <div class="d-flex">
                    <div class="me-3">
                        <button style="display:none;" type="button" class="btn btn-outline-dark" id="selectionButton">
                            <i class="bi bi-check-square-fill"></i> Sélection
                        </button>
                    </div>

                    <!-- <div class="me-3">
                            <button type="button" class="btn btn-outline-dark" id="uncheckedButton">
                                <i class="bi bi-check-square"></i> Désélection
                            </button>
                        </div> -->
                    <!-- <div class="flex-grow-1 text-center">
                            <h4 class="card-title fw-bold fs-2">
                                Management
                            </h4>
                        </div> -->
                    <!-- verifier si la personne authentifiée n'est pas manager avant d'afficher le bouton -->
                    @if (!auth()->user()->hasRole('Manager'))
                    <div id="exporter">
                        <!-- <button id="export-button" onclick="exportSelectedCandidates()" class="btn btn-primary position-relative">
                                <i class="ri-file-download-line me-1"></i>
                                <span class="download-text">Exporter</span>
                                <span wire:loading wire:target="downloadExcel" class="position-absolute top-50 start-50 translate-middle">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <span class="visually-hidden">Exportation...</span>
                                </span>
                            </button> -->
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        class="table table-striped table-bordered table-hover table-hover-primary align-middle table-nowrap mb-0">
                        <thead style="background-color: #D8D9DA;" class="text-black sticky-top">
                            <tr>
                                <th scope="col"><input type="checkbox" id="select-all-checkbox" class="candidate-checkbox"
                                        style="display:none;" wire:model="selectAll"></th>
                                <th scope="col" wire:click="sortBy('updated_at')">
                                    Date MAJ
                                </th>
                                <th scope="col">CodeCDT</th>
                                <th scope="col">Civ</th>
                                <th scope="col" wire:click="sortBy('first_name')">
                                    Prénom
                                </th>
                                <th style="width:150px;" scope="col" wire:click="sortBy('last_name')">
                                    Nom
                                </th>
                                <th scope="col">Fonction</th>
                                <th scope="col">Dispo.</th>
                                <th scope="col">Délai</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Next step</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($candidates as $index => $candidate)
                            <tr data-id="{{ $candidate->id }}"
                                class="{{ $selectedCandidateId == $candidate->id ? 'table-info' : ($index % 2 == 0 ? '' : 'cdtnonactiveontable') }}"
                                wire:dblclick.prevent="selectCandidate('{{ $candidate->id }}', '{{ $candidates->currentPage() }}')">
                                <td class="checkbox-cell">
                                    <input type="checkbox" class="candidate-checkbox" value="{{ $candidate->id }}"
                                        style="display:none;pointer-events: none;" wire:model="checkboxes.{{ $candidate->id }}">
                                </td>
                                <td>{{ \Carbon\Carbon::parse($candidate->updated_at)->format('d/m/y') ?? '--' }}</td>
                                <td>{{ $candidate->code_cdt ?? '--' }}</td>
                                <!-- <td>{{ $candidate->auteur->trigramme ?? '--' }}</td> -->
                                <td>{{ $candidate->civ->name ?? '--' }}</td>
                                <td>{{ $candidate->first_name ?? '--' }}</td>
                                <td id="Lcol">{{ $candidate->last_name ?? '--' }}</td>
                                <td id="Lcol">{{ $candidate->position->name ?? '--' }}</td>
                                <td>{{ $candidate->disponibility->name ?? '--' }}</td>
                                <td>{{ $candidate->delai->name ?? '--' }}</td>
                                <td>{{ $candidate->candidateStatut->name ?? '--' }}</td>
                                <td>{{ $candidate->nextStep->name ?? '--' }}</td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="50" class="text-center">
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

    <div class="card-footer mb-4">
          <div class="d-flex justify-content-end">
            <button style="background:yellow; border:none; color:#000; margin-left:1%;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                class="btn btn-success link-btn">
                CDTlist</button>
            <button style="background:yellow; border:none; color:#000; margin-left:1%;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                class="btn btn-success link-btn" id="linkNewCDT">
                > New </button>
            <button style="background-color:red; margin-left:5%;" wire:click="" class="btn btn-danger" id="delete-button-container">
                UNLINK
            </button>
            <button style="background:#F9C0AB; color:black; border:none;margin-left:5%;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                class="btn btn-danger">
                EVTlist</button>
            <button style="background:#F9C0AB; color:black; border:none;margin-left:1%;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                class="btn btn-danger">
                > New</button>
            <button style="background:#010066; color:white; border:none;" wire:loading.remove wire:target="storeCandidateData" type="submit"
                class="btn btn-success btn-label right ms-auto nexttab"><i
                    class="align-middle ri-arrow-right-line label-icon fs-16 ms-2"></i>
                Close</button>
        </div>


    </div>

    <style>
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
            font-size: 13px;
        }

        .cdt-ok-btn {
            background: #118B50;
            border: 1px solid #999;
            padding: 2px 8px;
            cursor: pointer;
            font-size: 13px;
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



    let currentlyVisibleCertificateIndex = null;

    function toggleCertificate(index) {
        var hiddenCertificate = document.getElementById('hidden-certificate-' + index);
        var visibleCertificate = document.getElementById('visible-certificate-' + index);
        var messageDiv = document.getElementById('message-' + index);

        if (currentlyVisibleCertificateIndex !== null && currentlyVisibleCertificateIndex !== index) {
            var previousHiddenCertificate = document.getElementById('hidden-certificate-' + currentlyVisibleCertificateIndex);
            var previousVisibleCertificate = document.getElementById('visible-certificate-' + currentlyVisibleCertificateIndex);
            var previousMessageDiv = document.getElementById('message-' + currentlyVisibleCertificateIndex);

            previousHiddenCertificate.style.display = "inline";
            previousVisibleCertificate.style.display = "none";
            previousMessageDiv.style.display = "none";
        }

        if (hiddenCertificate.style.display === "none") {
            hiddenCertificate.style.display = "inline";
            visibleCertificate.style.display = "none";
            messageDiv.style.display = "none";
            currentlyVisibleCertificateIndex = null;
        } else {
            hiddenCertificate.style.display = "none";
            visibleCertificate.style.display = "inline";
            currentlyVisibleCertificateIndex = index;

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
        var selectionButton = document.getElementById('selectionButton');
        selectionButton.addEventListener('click', toggleCheckboxes);
        // uncheckedButton.addEventListener('click', deleteAllCheckboxes) 
        let selectedCandidateIds = [];
        let candidateId;
        const doubleClickDelay = 300;
        var clickTimeout;

        // Scroll to the row with the table-info class if available
        let selectedRow = document.querySelector('.table-info');
        if (selectedRow) {
            selectedRow.scrollIntoView({
                block: 'nearest'
            });
        }

        // MAJ selection apres export
        Livewire.on('exportCompleted', () => {
            document.querySelectorAll('.candidate-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });

            toggleButtons();
            updateSelectionButtonAndSelectAllCheckbox();
        });

        document.querySelectorAll('tr[data-id]').forEach(function(row) {
            var candidateId = row.getAttribute('data-id');

            //making checkbox clickable
            var checkbox = row.querySelector('.candidate-checkbox');
            checkbox.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent the row click event from firing
            });

            row.addEventListener('click', function() {
                clearTimeout(clickTimeout); // Clear previous timeout

                clickTimeout = setTimeout(function() {
                    var checkbox = row.querySelector('.candidate-checkbox');
                    if (checkbox && checkbox.style.display === 'block') {
                        // If checkboxes are visible, just toggle the checkbox and remove 'table-info' class from all rows
                        checkbox.checked = !checkbox.checked;
                        document.querySelectorAll('tr[data-id]').forEach(function(otherRow) {
                            otherRow.classList.remove('table-info');
                        });
                    } else {
                        // If the clicked row already has the 'table-info' class, remove it, otherwise add it
                        if (row.classList.contains('table-info')) {
                            row.classList.remove('table-info');
                            if (checkbox) { // Check if the checkbox exists
                                checkbox.checked = false;
                            }
                        } else {
                            // Remove 'table-info' class and uncheck all other rows
                            document.querySelectorAll('tr[data-id]').forEach(function(otherRow) {
                                otherRow.classList.remove('table-info');
                                var otherCheckbox = otherRow.querySelector('.candidate-checkbox');
                                if (otherCheckbox) { // Check if the checkbox exists
                                    otherCheckbox.checked = false;
                                }
                            });

                            // Add 'table-info' class and check the clicked row
                            row.classList.add('table-info');
                            if (checkbox) { // Check if the checkbox exists
                                checkbox.checked = true;
                            }
                        }
                    }

                    // Check if any checkbox is checked and toggle the buttons
                    toggleButtons();
                    deleteSelectedCandidates();
                    updateSelectAllCheckbox();

                    // Update selection button and select-all checkbox
                    updateSelectionButtonAndSelectAllCheckbox();

                }, doubleClickDelay);
            });
            var checkbox = row.querySelector('.candidate-checkbox');
            checkbox.addEventListener('change', function(e) {
                // Check if any checkbox is checked and toggle the buttons
                toggleButtons();
                deleteSelectedCandidates();
            });
        });

        // check & uncheck all checkboxes
        document.getElementById('select-all-checkbox').addEventListener('change', function(e) {
            var isChecked = e.target.checked;
            document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                checkbox.checked = isChecked;
                checkbox.style.display = isChecked ? 'block' : 'none';
            });
            toggleButtons();
            deleteSelectedCandidates();
        });
        // Select all checkboxes functionality
        document.getElementById('select-all-checkbox').addEventListener('change', function() {
            var isChecked = this.checked;
            document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                checkbox.checked = isChecked;
                checkbox.style.display = 'block'; // Keep checkboxes visible
            });
            toggleButtons();
            updateSelectionButtonAndSelectAllCheckbox();
        });

    });

    /*************************************************************************************/
    // Toggle selection checkboxes
    function toggleCheckboxes() {
        let areCheckboxesVisible = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.style.display === 'block');
        document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
            checkbox.style.display = areCheckboxesVisible ? 'none' : 'block';
            if (areCheckboxesVisible) checkbox.checked = false; // Uncheck all checkboxes if toggling to hide
        });

        // Update selection button text
        const selectionButton = document.getElementById('selectionButton');
        if (areCheckboxesVisible) {
            selectionButton.innerHTML = '<i class="bi bi-check-square-fill"></i> Sélection';
            document.getElementById('select-all-checkbox').style.display = 'none';
            document.getElementById('select-all-checkbox').checked = false;
        } else {
            selectionButton.innerHTML = '<i class="bi bi-check-square"></i> Désélection';
            document.getElementById('select-all-checkbox').style.display = 'block';
        }

        // Update delete button visibility
        updateDeleteButtonVisibility();
    }
    // Update delete button visibility
    function updateDeleteButtonVisibility() {
        var deleteButtonContainer = document.getElementById('delete-button-container');
        let isAnyCheckboxChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.checked && c.style.display === 'block');
        if (isAnyCheckboxChecked) {
            deleteButtonContainer.style.display = 'block';
        } else {
            deleteButtonContainer.style.display = 'none';
        }
    }
    //function to toggle the buttons
    function toggleButtons() {
        var anyChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.checked);
        var deleteButtonContainer = document.getElementById('delete-button-container');
        var exporter = document.getElementById('exporter');

        if (anyChecked) {
            deleteButtonContainer.style.display = 'block';
            // exporter.style.display = 'none';
        } else {
            deleteButtonContainer.style.display = 'none';
            // exporter.style.display = 'block';
        }
    }

    function deleteSelectedCandidates() {
        let selectedCandidateIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
            .map(checkbox => checkbox.closest('tr').getAttribute('data-id'))
            .filter(id => id !== null && id !== '');
        console.log(selectedCandidateIds);

        let deleteButtonContainer = document.getElementById('delete-button-container');
        if (deleteButtonContainer) {
            deleteButtonContainer.setAttribute('wire:click', `confirmDeleteChecked('${selectedCandidateIds.join(',')}')`);
            deleteButtonContainer.style.cursor = 'pointer';
        }
    }

    function updateSelectionButtonAndSelectAllCheckbox() {
        let isAnyCheckboxVisible = false;
        document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
            // Check if at least one checkbox is visible
            if (checkbox.style.display === 'block') {
                isAnyCheckboxVisible = true;
            }
        });

        // Update selection button text
        const selectionButton = document.getElementById('selectionButton');
        if (isAnyCheckboxVisible) {
            selectionButton.innerHTML = '<i class="bi bi-check-square"></i> Désélection';
            // Show the select-all checkbox
            document.getElementById('select-all-checkbox').style.display = 'block';
        } else {
            selectionButton.innerHTML = '<i class="bi bi-check-square-fill"></i> Sélection';
            // Hide the select-all checkbox
            document.getElementById('select-all-checkbox').style.display = 'none';

        }
    }


    // **************unchecked all checkbox***************
    function deleteAllCheckboxes() {
        document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
            checkbox.checked = false;
        });
        // update delete button visibility
        toggleButtons();
    }
    // *********************************************************************
    function updateSelectAllCheckbox() {
        var allChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).every(c => c.checked);
        var anyVisible = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.style.display === 'block');
        document.getElementById('select-all-checkbox').checked = allChecked;

        // Update select-all checkbox visibility
        document.getElementById('select-all-checkbox').style.display = anyVisible ? 'block' : 'none';
    }

    //filtrage
    document.addEventListener('DOMContentLoaded', function() {
        const filterInputs = document.querySelectorAll('input[wire:model.live], select[wire:model.live]');

        filterInputs.forEach(input => {
            input.addEventListener('change', function() {
                sessionStorage.setItem(input.getAttribute('wire:model.live'), input.value);
            });
        });

        // Charger les valeurs des filtres depuis le stockage de session
        filterInputs.forEach(input => {
            const storedValue = sessionStorage.getItem(input.getAttribute('wire:model.live'));
            if (storedValue !== null) {
                input.value = storedValue;
                input.dispatchEvent(new Event('change'));
            }
        });
    });
    /***********************************************************************************************/
    function exportSelectedCandidates() {
        let selectedCandidateIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
            .map(checkbox => checkbox.closest('tr').getAttribute('data-id'))
            .filter(id => id !== null && id !== '');

        // Appeler la méthode Livewire avec les IDs sélectionnés
        @this.call('downloadExcel', selectedCandidateIds);
    }
</script>
@endpush
</div>
