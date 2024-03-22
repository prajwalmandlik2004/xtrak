<div>


<div class="row justify-content-center">
    <div class="col-md-12 text-center">
        <div class="page-title align-items-center">
            <span class="badge border border-dark text-body">
                <h2 class="mb-0">Données d’activité</h2>
            </span>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8"> 
        <div class="card mt-5">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0">Synthèse :

                </h4>

            </div>
            <div class="card-body">
                <!-- Bordered Tables -->
                <table class="table table-bordered table-nowrap">
                    <thead>
                        <tr>
                            {{-- <th scope="col">SYNTHESE CONNEXIONS/SAISIES</th> --}}
                            <th scope="col">Statut</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Dernière connexion</th>
                            <th scope="col">Etat</th>

                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th style="width: 60px;">{{ $user->roles()->first()->name }}</th>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td style="width: 50px;">{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                </td>

                                <td style="width: 50px;" class="py-3 px-6 text-center">
                                    @if ($user->last_seen >= now()->subSeconds(30))
                                    <span class="badge border border-light rounded-circle bg-success p-2 fs-4">
                                    </span>
                                    @else
                                    <span class="badge border border-light rounded-circle bg-danger p-2 fs-4">
                                    </span>
                                    @endif
                                </td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      
    </div>
</div>

@push('page-script')
<script>
    setInterval(function() {
        Livewire.emit('userActivityUpdated');
    }, 1000);
</script>
@endpush
</div>