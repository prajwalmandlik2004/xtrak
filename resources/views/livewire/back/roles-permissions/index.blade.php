<div>
    @include('components.breadcrumb', [
        'title' => 'Listes des rôles et permissions',
        'breadcrumbItems' => [
            ['text' => 'Paramètres', 'url' => '#'],
            ['text' => 'Listes des rôles et permissions', 'url' => Route('roles.permissions')],
        ],
    ])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listes des rôles et permissions</h3>
                </div>
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Autorisations</th>
                                @foreach ($roles as $role)
                                    <th scope="col">{{ $role->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    @foreach ($roles as $role)
                                        <td>
                                            <input type="checkbox" style="transform: scale(1.5);"
                                                wire:change="updateRolePermission({{ $role->id }}, {{ $permission->id }})"
                                                @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
