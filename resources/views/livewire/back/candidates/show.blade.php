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
                                            <h4 class="fw-bold">{{ $candidate->first_name ?? 'Non définie' }}
                                                {{ $candidate->last_name ?? 'Non définie' }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i>
                                                    {{ $candidate->company }}</div>
                                                <div class="vr"></div>
                                                <div>Date de création : <span
                                                        class="fw-medium">{{ $candidate->created_at->format('d/m/Y') ?? 'Non définie' }}
                                                    </span></div>
                                                <div class="vr"></div>
                                                <div>Statut : <span
                                                        class="fw-medium badge rounded-pill bg-primary fs-12">{{ $candidate->cdt_status ?? 'Non définie' }}</span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-auto">
                                <div class="hstack gap-1 flex-wrap">
                                    <a href="{{ Route('candidates.edit', $candidate) }}" type="button"
                                        class="btn py-0 fs-16 text-body">
                                        Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-8 col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Civ :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->title ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Prénom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->first_name ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Nom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->last_name ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Poste
                                                                (Fonction1) :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ optional($candidate->position)->name ?? 'Non définie' }}
                                                            </h5>
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
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->company ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Mail :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->email ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Nom :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->last_name ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Téléphone 1 :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->phone ?? 'Non définie' }}</h5>
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
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->phone_2 ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">CP/Dpt :
                                                            </p>
                                                            <h5 class="fs-15 mb-0">
                                                                {{ $candidate->postal_code ?? 'Non définie' }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium fs-13">Statut CDT :
                                                            </p>
                                                            <div class="badge bg-primary fs-12">
                                                                {{ $candidate->cdt_status ?? 'Non définie' }}</div>
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
                            <div class="col-xl-4 col-lg-4">
                                @livewire('back.files.candidate-file', ['candidate' => $candidate])
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
