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

            <select class="form-control w-md">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20" selected>20</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="p-2">
            <div class="search-box ms-2">
                <input type="text" class="form-control" placeholder="Rechercher...">
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
    </div>
    {{-- end filter --}}
    <div class="row mt-5">
        @forelse ($candidates as $candidate)
            <div class="col-xxl-3 col-sm-6 project-card">
                <div class="card">
                    <div class="card-body">

                        <div class="p-3 mt-n3 mx-n3 bg-danger-subtle rounded-top">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="mb-0 fs-15"><a href="apps-projects-overview.html"
                                            class="text-body">Multipurpose landing template</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="d-flex gap-1 align-items-center my-n2">
                                        <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                                            <span class="avatar-title bg-transparent fs-15">
                                                <i class="ri-star-fill"></i>
                                            </span>
                                        </button>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i data-feather="more-horizontal" class="icon-sm"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="apps-projects-overview.html"><i
                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                <a class="dropdown-item" href="apps-projects-create.html"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#removeProjectModal"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-3">
                            <div class="row gy-3">
                                <div class="col-6">
                                    <div>
                                        <p class="text-muted mb-1">Status</p>
                                        <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <p class="text-muted mb-1">Deadline</p>
                                        <h5 class="fs-14">18 Sep, 2021</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <p class="text-muted mb-0 me-2">Team :</p>
                                <div class="avatar-group">
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                                        data-bs-trigger="hover" data-bs-placement="top" title="Donna Kline">
                                        <div class="avatar-xxs">
                                            <div class="avatar-title rounded-circle bg-danger">
                                                D
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                                        data-bs-trigger="hover" data-bs-placement="top" title="Lee Winton">
                                        <div class="avatar-xxs">
                                            <img src="assets/images/users/avatar-5.jpg" alt=""
                                                class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                                        data-bs-trigger="hover" data-bs-placement="top" title="Johnny Shorter">
                                        <div class="avatar-xxs">
                                            <img src="assets/images/users/avatar-6.jpg" alt=""
                                                class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                                        data-bs-trigger="hover" data-bs-placement="top" title="Add Members">
                                        <div class="avatar-xxs">
                                            <div
                                                class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                +
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex mb-2">
                                <div class="flex-grow-1">
                                    <div>Progress</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div>50%</div>
                                </div>
                            </div>
                            <div class="progress progress-sm animated-progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                                </div><!-- /.progress-bar -->
                            </div><!-- /.progress -->
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        @empty
            <div class="py-4 mt-4 text-center" id="noresult">
                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                    colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px"></lord-icon>
                <h5 class="mt-4">Désolé! Aucun résultat trouvé</h5>
            </div>
        @endforelse
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row g-0 text-center text-sm-start align-items-center mb-4">
        <div class="col-sm-6">
            <div>
                <p class="mb-sm-0 text-muted">Showing <span class="fw-semibold">1</span> to <span
                        class="fw-semibold">10</span> of <span class="fw-semibold text-decoration-underline">12</span>
                    entries</p>
            </div>
        </div>
        <!-- end col -->
        <div class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0 col-sm-6">
            {{ $candidates->links() }}
        </div><!-- end col -->
    </div><!-- end row -->


</div>
