<div>
    <!-- start page title -->
    @include('components.breadcrumb', [
        'title' => 'Détails du CRE',
        'breadcrumbItems' => [['text' => 'Détail du CRE', 'url' => '#']],
    ])

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex">
                                <div class="p-2 flex-fill">
                                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="" class="img-fluid"
                                        height="200" width="200">


                                </div>
                                <div class="p-2 flex-fill mt-4">
                                    <span><strong>CONFIDENTIEL</strong></span>
                                </div>
                                <div class="p-2 flex-fill">
                                    <h6><span class="text-muted fw-normal">Réf: </span><span
                                            id="legal-register-no">{{ $candidate->cre_ref ?? '---' }}</span></h6>
                                    <h6><span class="text-muted fw-normal">Auteur:
                                        </span><span>{{ $candidate->auteur->trigramme ?? '' }}</span></h6>
                                        <h6><span class="text-muted fw-normal">Date:
                                        </span><span>   {{ $candidate->cre_created_at ? \Carbon\Carbon::parse($candidate->cre_created_at)->format('d-m-Y') : '--' }}</span></h6>
                                </div>
                            </div>
                            <div class=" mt-4 ms-1">
                                <div>
                                    <span class="fs-20"><strong>COMPTE RENDU D'ENTRETIEN DE
                                            {{ $candidate->civ->name ?? '---' }}. </strong>
                                    </span>

                                    <span class="badge bg-light-subtle text-body fs-20">{{ $candidate->first_name }}
                                        {{ $candidate->last_name }}</span>
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    <span class="fs-20"><strong>POSTE : </strong>
                                    </span>

                                    <span
                                        class="badge bg-light-subtle text-body fs-20">{{ $candidate->position->name }}</span>
                                </div>

                            </div>
                        </div>
                        <!--end card-header-->
                    </div><!--end col-->



                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <ol>
                                @forelse ($cres as $cre)
                                    <li>
                                        <span class="text-body"> {{ $cre->question }} :</span>
                                        <br>
                                        <span class="badge bg-light-subtle text-body fs-20">{{ $cre->response }}</span>
                                    </li>
                                @empty
                                    <div class="alert alert-warning" role="alert">
                                        Aucun compte rendu d'entretien n'est disponible pour le moment.
                                    </div>
                                @endforelse
                            </ol>

                            <div class="hstack gap-2 justify-content-end d-print-none mt-5">
                                {{-- <a href="javascript:window.print()" class="btn btn-success"><i
                                        class="ri-printer-line align-bottom me-1"></i> Imprimer</a> --}}
                                <button wire:click='generatePdf' class="btn btn-primary"><i
                                        class="ri-download-2-line align-bottom me-1"></i> Télécharger</button>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>
