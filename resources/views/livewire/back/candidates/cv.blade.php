<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Détails du Curriculum Vitae du candidat',
        'breadcrumbItems' => [['text' => 'Curriculum Vitae du candidat', 'url' => '#']],
    ])

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h4 class="card-title text-primary">Curriculum Vitae</h4>
                                </div>
                                <div class="col-md-8 d-flex justify-content-end">
                                    <div class="hstack gap-2 justify-content-center d-print-none ">
                                        <a wire:click="downloadFile('{{ $cvFile->path }}','{{ $cvFile->name }}')"
                                            class="btn btn-success"><i class="ri-download-2-line align-bottom me-1"></i>
                                            Télécharger</a>
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary me-1"><i
                                                class="mdi mdi-arrow-left me-1"></i>Retour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($cvFile->type === 'word' || $cvFile->type === 'pdf')
                                <iframe src="{{ $filePath }}" width="100%"
                                    height="800"></iframe>
                            @else
                                <span>La visualisation est disponible qu'avec un document word ou pdf.</span>
                            @endif

                        </div>
                    </div>
                    <!--end col-lg-8-->
                </div>
                <!--end row-->
            </div>

        </div>
    </div>
</div>
