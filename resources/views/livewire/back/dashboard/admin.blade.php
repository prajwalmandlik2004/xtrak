<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Les candidats récemment ajoutés
                    </h4>
                    
                    <div class="d-flex">
                        <div class="p-2">
                            <select class="form-control w-md" wire:model.live='filterName'>
                                <option value="" class="bg-secondary text-white" selected>Nom
                                </option>
                                <option value="asc">A -> Z</option>
                                <option value="desc">Z -> A</option>
                            </select>
                        </div>
                        <div class="p-2">
                            <select class="form-control w-md" wire:model.live='filterDate'>
                                <option value="" class="bg-secondary text-white" selected>Date
                                </option>
                                <option value="asc">Plus récent en haut</option>
                                <option value="desc">Plus ancien en haut</option>
                            </select>
                        </div>
                        <div class="p-2">
                            <select class="form-control w-md" wire:model.live='state'>
                                <option value="" class="bg-secondary text-white" selected>Etat
                                </option>
                                <option value="Certifié">Certifié</option>
                                <option value="Attente">Attente</option>
                                <option value="Doublon">Doublon</option>
                            </select>
                        </div>
                        
                        <div class="p-2">

                            <select class="form-control w-md" wire:model.live='cdtStatus'>
                                <option value="" selected> Status</option>
                                <option value="Close">Close</option>
                                <option value="Open">Open</option>
                                <option value="In Progress">In Progress</option>

                            </select>
                        </div>
                        
                        <div class="p-2">
                            <div class="search-box ms-2">
                                <input type="text" class="form-control" placeholder="Rechercher..."
                                    wire:model.live='search'>
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-fixed table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0 ">
                            <thead class="bg-secondary text-white sticky-top">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Auteur</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Poste</th>
                                    <th scope="col">Société</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Téléphone 1</th>
                                    <th scope="col">Téléphone 2</th>
                                    <th scope="col">CP/Dpt</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($candidates as $candidate)
                                    <tr>

                                        <td>
                                            {{ $candidate->created_at->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            {{ $candidate->auteur->first_name ?? '--' }}
                                            {{ $candidate->auteur->last_name ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $candidate->last_name ?? '--' }}
                                        </td>
                                        <td>{{ $candidate->first_name ?? '--' }}</td>
                                        <td>
                                            {{ optional($candidate->position)->name ?? '--' }}
                                        </td>
                                        <td>{{ $candidate->company ?? '--' }}</td>
                                        <td>
                                            {{ $candidate->email ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $candidate->phone ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $candidate->phone_2 ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $candidate->postal_code ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $candidate->cdt_status ?? '--' }}
                                        </td>

                                    </tr><!-- end tr -->
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Aucun candidat ajouté
                                            récemment</td>
                                    </tr>
                                @endforelse

                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                </div> <!-- .card-->
                
            </div> <!-- .col-->
        </div> <!-- end row-->
    </div>
</div>
