<div style="display: flex; justify-content: center;">
    <div style="width: 50%;">
        <div style="border-bottom: 1px dashed #000; padding: 20px;">
            <div style="display: flex;">
                <div style="flex: 1;">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="" style="max-width: 200px;">
                </div>
                <div style="flex: 1; text-align: center;">
                    <span style="font-weight: bold;">CONFIDENTIEL</span>
                </div>
                <div style="flex: 1; text-align: right;">
                    <div style="font-size: 12px;">
                        <span style="color: #6c757d;">Réf:</span>
                        <span>{{ $candidate->cre_ref ?? '---' }}</span>
                    </div>
                    <div style="font-size: 12px;">
                        <span style="color: #6c757d;">Auteur:</span>
                        <span>{{ $candidate->auteur->trigramme ?? '' }}</span>
                    </div>
                    <div style="font-size: 12px;">
                        <span style="color: #6c757d;">Date:</span>
                        <span>{{ $candidate->cre_created_at ? \Carbon\Carbon::parse($candidate->cre_created_at)->format('d-m-Y') : '--' }}</span>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px; text-align: center;">
                <span style="font-size: 20px; font-weight: bold;">COMPTE RENDU D'ENTRETIEN DE {{ $candidate->civ->name ?? '---' }}.</span>
                <span style="font-size: 20px;" class="badge bg-light text-body">{{ $candidate->first_name }} {{ $candidate->last_name }}</span>
            </div>
            <div style="margin-top: 10px; text-align: center;">
                <span style="font-size: 20px; font-weight: bold;">POSTE : </span>
                <span style="font-size: 20px;" class="badge bg-light text-body">{{ $candidate->position->name }}</span>
            </div>
        </div>
        <div style="padding: 20px;">
            <ol>
                @forelse ($cres as $cre)
                    <li>
                        <span style="font-weight: bold;">{{ $cre->question }} :</span>
                        <br>
                        <span style="font-size: 20px;" class="badge bg-light text-body">{{ $cre->response }}</span>
                    </li>
                @empty
                    <div class="alert alert-warning" role="alert" style="font-size: 16px; text-align: center;">
                        Aucun compte rendu d'entretien n'est disponible pour le moment.
                    </div>
                @endforelse
            </ol>
        </div>
        <div style="display: flex; justify-content: flex-end; padding: 20px;">
            <button wire:click='generatePdf' class="btn btn-primary" style="font-size: 16px;"><i class="ri-download-2-line align-bottom me-1"></i> Télécharger</button>
        </div>
    </div>
</div>
