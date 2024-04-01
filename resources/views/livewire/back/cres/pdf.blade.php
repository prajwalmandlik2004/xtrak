<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Compte Rendu</title>
<style>
    .custom-row {
        display: flex;
        justify-content: center;
    }

    .custom-col-sm-6 {
        flex-basis: 50%;
        max-width: 50%;
    }

    .custom-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-top: 20px;
        width: 100%;
    }

    .custom-card-header {
        padding: 20px;
        border-bottom: 1px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .custom-card-body {
        padding: 20px;
    }

    .custom-logo {
        height: 200px;
        width: 200px;
    }

    .custom-badge {
        background-color: #f8f9fa;
        color: #000;
        font-size: 20px;
        padding: 5px 10px;
        border-radius: 4px;
        margin-right: 5px;
    }

    .custom-alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffeeba;
        padding: .75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: .25rem;
    }

    .custom-btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }
</style>
</head>
<body>

<div class="custom-row justify-content-center">
    <div class="custom-col-sm-6">
        <div class="custom-card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="custom-card-header">
                        <div class="d-flex">
                            <div class="p-2 flex-fill">
                                <img src="{{ asset('assets/images/logo.jpg') }}" alt="" class="img-fluid custom-logo">
                            </div>
                            <div class="p-2 flex-fill mt-4">
                                <span class="font-weight-bold">CONFIDENTIEL</span>
                            </div>
                            <div class="p-2 flex-fill">
                                <h6><span class="text-muted fw-normal">Réf: </span><span id="legal-register-no">{{ $candidate->cre_ref ?? '---' }}</span></h6>
                                <h6><span class="text-muted fw-normal">Auteur: </span><span>{{ $candidate->auteur->trigramme ?? '' }}</span></h6>
                                <h6><span class="text-muted fw-normal">Date: </span><span>{{ $candidate->cre_created_at ? \Carbon\Carbon::parse($candidate->cre_created_at)->format('d-m-Y') : '--' }}</span></h6>
                            </div>
                        </div>
                        <div class=" mt-4 ms-1">
                            <div>
                                <span class="fs-20"><strong>COMPTE RENDU D'ENTRETIEN DE {{ $candidate->civ->name ?? '---' }}. </strong></span>
                                <span class="custom-badge bg-light-subtle text-body fs-20 text-wrap">{{ $candidate->first_name }} {{ $candidate->last_name }}</span>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <span class="fs-20"><strong>POSTE : </strong></span>
                                <span class="custom-badge bg-light-subtle text-body fs-20 text-wrap">{{ $candidate->position->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="custom-card-body">
                        <ol>
                            @forelse ($cres as $cre)
                                <li>
                                    <span class="text-body d-block mb-2 fs-15">{{ $cre->question }} :</span>
                                    <span class="custom-badge bg-light-subtle text-body fs-13 text-wrap">{{ $cre->response }}</span>
                                </li>
                            @empty
                                <div class="custom-alert-warning" role="alert">
                                    Aucun compte rendu d'entretien n'est disponible pour le moment.
                                </div>
                            @endforelse
                        </ol>
                        <div class="hstack gap-2 justify-content-end d-print-none mt-5">
                            <button class="custom-btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Télécharger</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
