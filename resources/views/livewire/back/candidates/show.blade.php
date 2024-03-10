<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Détail du candidat',
        'breadcrumbItems' => [
            ['text' => 'Candidats', 'url' => '#'],
            ['text' => 'Liste', 'url' => Route('candidates.index')],
            ['text' => 'Détail', 'url' => '#', 'active' => true],
        ],
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4">
                <div class="bg-secondary-subtle">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-auto">
                                        <div class="avatar-md">
                                            <div class="avatar-title bg-white rounded-circle">
                                                <img src="{{ asset('assets/images/brands/slack.png') }}" alt=""
                                                    class="avatar-xs">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold">{{ $candidate->first_name ?? 'Non définie'}}
                                                {{ $candidate->last_name ?? 'Non définie'}}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i>
                                                    {{ $candidate->company }}</div>
                                                <div class="vr"></div>
                                                <div>Date de création : <span
                                                        class="fw-medium">{{ $candidate->created_at->format('d/m/Y') ?? 'Non définie'}}
                                                    </span></div>
                                                <div class="vr"></div>
                                                <div>Statut : <span
                                                        class="fw-medium badge rounded-pill bg-primary fs-12">{{ $candidate->cdt_status ?? 'Non définie'}}</span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-auto">
                                <div class="hstack gap-1 flex-wrap">
                                    <button type="button" class="btn py-0 fs-16 favourite-btn active">
                                        <i class="ri-star-fill"></i>
                                    </button>
                                    <button type="button" class="btn py-0 fs-16 text-body">
                                        <i class="ri-share-line"></i>
                                    </button>
                                    <button type="button" class="btn py-0 fs-16 text-body">
                                        <i class="ri-flag-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Civ :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->title ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Prénom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->first_name ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Nom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->last_name ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Poste
                                                                (Fonction1) :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ optional($candidate->position)->name ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Société :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->company ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Mail :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->email ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Nom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->last_name ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Téléphone 1 :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->phone ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Téléphone 2 :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->phone_2  ?? 'Non définie'}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">CP/Dpt :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">{{ $candidate->postal_code ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Statut CDT :</p>
                                                            <div class="badge bg-primary fs-12">{{  $candidate->cdt_status ?? 'Non définie' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                                <!-- end card -->
                            </div>
                            <!-- ene col -->
                            <div class="col-xl-3 col-lg-4">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex border-bottom-dashed">
                                        <h4 class="card-title mb-0 flex-grow-1">Attachments</h4>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-soft-info btn-sm"><i
                                                    class="ri-upload-2-fill me-1 align-bottom"></i> Upload</button>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        <div class="vstack gap-2">
                                            <div class="border rounded border-dashed p-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm">
                                                            <div
                                                                class="avatar-title bg-light text-secondary rounded fs-24">
                                                                <i class="ri-folder-zip-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="fs-15 mb-1"><a href="#"
                                                                class="text-body text-truncate d-block">App-pages.zip</a>
                                                        </h5>
                                                        <div>2.2MB</div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="d-flex gap-1">
                                                            <button type="button"
                                                                class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                    class="ri-download-2-line"></i></button>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                            Rename</a></li>
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                            Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border rounded border-dashed p-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm">
                                                            <div
                                                                class="avatar-title bg-light text-secondary rounded fs-24">
                                                                <i class="ri-file-ppt-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="fs-15 mb-1"><a href="#"
                                                                class="text-body text-truncate d-block">Velzon-admin.ppt</a>
                                                        </h5>
                                                        <div>2.4MB</div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="d-flex gap-1">
                                                            <button type="button"
                                                                class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                    class="ri-download-2-line"></i></button>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                            Rename</a></li>
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                            Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border rounded border-dashed p-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm">
                                                            <div
                                                                class="avatar-title bg-light text-secondary rounded fs-24">
                                                                <i class="ri-folder-zip-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="fs-15 mb-1"><a href="#"
                                                                class="text-body text-truncate d-block">Images.zip</a>
                                                        </h5>
                                                        <div>1.2MB</div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="d-flex gap-1">
                                                            <button type="button"
                                                                class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                    class="ri-download-2-line"></i></button>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                            Rename</a></li>
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                            Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border rounded border-dashed p-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm">
                                                            <div
                                                                class="avatar-title bg-light text-secondary rounded fs-24">
                                                                <i class="ri-image-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="fs-15 mb-1"><a href="#"
                                                                class="text-body text-truncate d-block">bg-pattern.png</a>
                                                        </h5>
                                                        <div>1.1MB</div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="d-flex gap-1">
                                                            <button type="button"
                                                                class="btn btn-icon text-muted btn-sm fs-18"><i
                                                                    class="ri-download-2-line"></i></button>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-fill"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                            Rename</a></li>
                                                                    <li><a class="dropdown-item" href="#"><i
                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                            Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-2 text-center">
                                                <button type="button" class="btn btn-success">View more</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
</div>
