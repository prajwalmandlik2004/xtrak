<div>
    <div class="card">
        <div class="card-header align-items-center d-flex border-bottom-dashed">
            <h4 class="card-title mb-0 flex-grow-1">Documents</h4>
            <div class="flex-shrink-0">
                <button type="button"  wire:click="openModal()"  data-bs-toggle="modal" data-bs-target="#modal"  class="btn btn-soft-info btn-sm"><i class="ri-upload-2-fill me-1 align-bottom"></i>
                    Nouveau</button>
            </div>
        </div>
        <div class="col-md-5 ">
            <div class="p-2 ">
                <div class="search-box ms-2">
                    <input type="text" class="form-control" placeholder="Rechercher..." wire:model.live='search'>
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="vstack gap-2">
                @forelse ($files as $file)
                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-file-ppt-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-15 mb-1"><a href="#"
                                        class="text-body text-truncate d-block">{{ $file->name }}</a>
                                </h5>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">

                                    <a class="btn btn-icon text-muted btn-sm fs-18"
                                        href="{{ asset('storage') . '/' . $file->path }}"
                                        download="{{ $file->name }}">
                                        <i class="ri-download-2-line"></i>
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>

                                                <a class="dropdown-item" wire:click="openModal('{{ $file->id }}')"
                                                    data-bs-toggle="modal" data-bs-target="#modal"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rénomer</a>
                                            </li>
                                            <li><a wire:click="confirmDelete('{{ $file->name }}', '{{ $file->id }}')"
                                                    class="dropdown-item" href="#"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Supprimer</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-4 mt-4 text-center" id="noresult">
                        <h5 class="mt-4">Aucun document trouvé</h5>
                    </div>
                @endforelse

                <div class="mt-2 text-end">
                    {{ $files->links() }}
                </div>
            </div>
        </div>
        <!-- end card body -->


    </div>

    <x-modal>
        <x-slot name="title">
            {{ 'Modification du nom du document' }}
        </x-slot>
        <x-slot name="body">

            <form wire:submit.prevent="storeData()">
                @csrf
                <div class="modal-body">
                    <div class="mb-2 mt-2">
                        <label for="name" class="form-label">Nom du document <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror "
                            wire:model.live='name' placeholder="Veuillez entrer le nom du document" />


                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    @if (!$isUpdate)
                        <div>
                            <label for="newFiles" class="form-label">Documents</label>
                            <input wire:model="newFiles" class="form-control @error('newFiles') is-invalid @enderror"
                                type="file" multiple>
                            @error('newFiles')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary ">Modifier</button>
                </div>

            </form>
        </x-slot>
    </x-modal>

</div>
