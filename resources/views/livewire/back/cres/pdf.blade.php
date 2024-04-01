<style>
    .container {
        display: flex;
        justify-content: center;
    }

    .card {
        width: 50%;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-top: 20px;
    }

    .card-header {
        border-bottom: 1px dashed #000;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        max-width: 200px;
    }

    .confidential {
        font-weight: bold;
    }

    .info {
        font-size: 12px;
        color: #6c757d;
    }

    .title {
        font-size: 20px;
        font-weight: bold;
    }

    .badge {
        font-size: 20px;
    }

    .list {
        padding: 20px;
    }

    .download-btn {
        text-align: right;
        padding: 20px;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div>
                <img src="{{ asset('assets/images/logo.jpg') }}" alt="" class="logo">
            </div>
            <div>
                <span class="confidential">CONFIDENTIEL</span>
            </div>
            <div>
                <div class="info">
                    <span>Réf: {{ $candidate->cre_ref ?? '---' }}</span><br>
                    <span>Auteur: {{ $candidate->auteur->trigramme ?? '' }}</span><br>
                    <span>Date: {{ $candidate->cre_created_at ? \Carbon\Carbon::parse($candidate->cre_created_at)->format('d-m-Y') : '--' }}</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <span class="title">COMPTE RENDU D'ENTRETIEN DE {{ $candidate->civ->name ?? '---' }}</span>
                <span class="badge bg-light text-body">{{ $candidate->first_name }} {{ $candidate->last_name }}</span>
            </div>
            <div>
                <span class="title">POSTE :</span>
                <span class="badge bg-light text-body">{{ $candidate->position->name }}</span>
            </div>
            <div class="list">
                <ol>
                    @forelse ($cres as $cre)
                        <li>
                            <span class="title">{{ $cre->question }} :</span>
                            <br>
                            <span class="badge bg-light text-body">{{ $cre->response }}</span>
                        </li>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            Aucun compte rendu d'entretien n'est disponible pour le moment.
                        </div>
                    @endforelse
                </ol>
            </div>
            <div class="download-btn">
                <button wire:click='generatePdf' class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Télécharger</button>
            </div>
        </div>
    </div>
</div>
