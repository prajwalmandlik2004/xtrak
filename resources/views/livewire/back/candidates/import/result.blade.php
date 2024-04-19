<div>
    <div class="row">
        <div class="@if (!empty($accepted) && !empty($rejected)) col-md-6 @else col-md-12 @endif ">
            @if (!empty($accepted))
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Les données acceptés avec succès
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                            class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                            <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                       
                                        <th scope="col">Civilité</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Statut CDN</th>
                                        <th scope="col">Statut</th>
                                        {{-- <th scope="col">Certification</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accepted as $value)
                                        <tr>
                                            @php
                                                $candidate = \App\Models\Candidate::find($value['id']);
                                            @endphp
                                            <th scope="row"> <a class="text-body"
                                                    href="{{ Route('candidates.show', $candidate) }}">{{ $loop->iteration }}
                                                </a></th>
                                            
                                            <td> <a class="text-body"
                                                    href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->civ->name ?? '' }}
                                                </a></td>
                                            <td> <a
                                                    class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->last_name }}</a>
                                            </td>
                                            <td> <a class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->first_name }}
                                                </a></td>
                                            <td> <a
                                                    class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->email }}</a>
                                            </td>
                                            <td> <a class="text-body"href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->phone }}
                                                </a></td>
                                            <td> <a class="text-body"
                                                    href="{{ Route('candidates.show', $candidate) }}">{{ $candidate->cdt_status }}</a>
                                            </td>
                                            <td>En Attente</td>

                                            {{-- <td>
                                                @if ($candidate->certificate)
                                                                        <span class="badge rounded-pill bg-success"
                                                                            id="certificate-{{ 0 }}"
                                                                            onclick="toggleCertificate({{ 0 }})">
                                                                            <span
                                                                                id="hidden-certificate-{{ 0 }}">••••••••</span>
                                                                            <span
                                                                                id="visible-certificate-{{ 0 }}"
                                                                                style="display: none;">{{ $candidate->certificate }}</span>
                                                                        </span>
                                                                    @else
                                                                        ---
                                                                    @endif
                                                <div id="message-{{ $loop->index }}" style="display: none;"></div> --}}
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
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
            @endif
        </div>
        <div class="@if (!empty($accepted) && !empty($rejected)) col-md-6 @else col-md-12 @endif">
            @if (!empty($rejected))
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Doublons non intégrés
                        </div>
                    </div>
                    <div class="card-body">
                        
                            <div class="table-responsive">
                                <table
                                    class="table table-striped  table-hover table-hover-primary align-middle table-nowrap mb-0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Civilité</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prénom</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Téléphone</th>
                                            <th scope="col">CP/Dpt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rejected as $value)
                                            <tr>
                                                <td> {{ $loop->iteration }}
                                                </td>

                                                <td> {{ $value['Civ'] ?? '' }}
                                                </td>
                                                <td> {{ $value['Nom'] ?? '' }}
                                                </td>
                                                <td> {{ $value['Prénom'] ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $value['Mail'] ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $value['Tél1'] ?? '' }}
                                                </td>
                                                <td> {{ $value['CP/Dpt'] ?? '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                       
                    </div>
            @endif
        </div>
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
