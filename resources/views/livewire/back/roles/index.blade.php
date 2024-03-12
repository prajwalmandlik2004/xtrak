<div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des rôles</h4>
                <!-- Appel du modal -->
                @can('Ajouter un rôle')
                    <a href="{{ route('roles.create') }}" class="btn btn-rounded btn-primary btn-info"> <span
                            class="btn-icon-start text-primary">
                            <i class="fa fa-plus color-success"></i>
                        </span>
                        Nouveau</a>
                @endcan
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-2">
                        <select wire:ignore wire:model='nbPaginate' class="default-select form-control wide mb-3">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="offset-md-7 col-md-3">
                        <div class="input-group input-group-md">
                            <input type="text" name="table_search" class="form-control " wire:model.debounce='search'
                                placeholder="Rechercher">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th><strong>No</strong></th>
                                <th><strong>Rôles</strong></th>
                                <th><strong>Permissions</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $role->name }}

                                    </td>
                                    <td>
                                        @foreach (optional($role)->permissions as $index => $permission)
                                            @if ($index < 4)
                                                <span class="badge light badge-dark mb-2">{{ $permission->name }}</span>
                                                @if ($index < 3 && $index < count($role->permissions) - 1)
                                                    ,
                                                @elseif ($index == 3 && count($role->permissions) > 4)
                                                    <button type="button" class="badge badge-secondary mb-2"
                                                        data-bs-toggle="modal" data-bs-target=".modal">voir
                                                        plus</button>
                                                @endif
                                            @endif
                                        @endforeach
                                        <x-modal>
                                            <x-slot name="title">
                                                {{ $role->name }}
                                            </x-slot>
                                            <x-slot name="body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Liste des permissions
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="basic-list-group">
                                                            <ul class="list-group">
                                                                @foreach ($role->permissions as $index => $permission)
                                                                    <li class="list-group-item">
                                                                        {{ $permission->name }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-slot>
                                            </x>
                                    </td>

                                    {{-- <td>{{ $role->created_at->format('d/m/Y') }}</td> --}}

                                    <td>
                                        <div class="d-flex">
                                            @can('Modifier un rôle')
                                                <a href="{{ route('roles.edit', $role) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"> <i
                                                        class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Supprimer un rôle')
                                                <button class="btn btn-danger shadow btn-xs sharp"
                                                    wire:click="confirmDelete('{{ $role->name }}', '{{ $role->id }}')"><i
                                                        class="fa fa-trash"></i></button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty

                                <tr class="text-center mt-5">
                                    <td colspan="3">Aucune donnée</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer ">
                <div class="float-right "> {{ $roles->links() }}</div>
            </div>
        </div>
    </div>
</div>
