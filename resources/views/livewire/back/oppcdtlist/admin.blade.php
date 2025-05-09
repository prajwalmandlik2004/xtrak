<div>
    @include('components.breadcrumb', [
    'title' => auth()->user()->hasRole('Manager') ? '' : '',
    'breadcrumbItems' => [['text' => 'ADM', 'url' => ''] ,['text' => 'Landing', 'url' => '/landing'] ,['text' => 'Views', 'url' => ''] ,['text' => 'OPPvue', 'url' => '/oppdashboard'] , ['text' => 'OPP_CDTlist', 'url' => '/oppcdtlist']],
    ])

    <div class="row">
        <div style="margin-bottom:-20px; margin-top:-10px;" class="col-md-12">
            <div class="d-flex">
                <div class="p-1 flex-grow-1">

                    <div style="margin-top: -1%;margin-left:-10px;" class="p-2 mb-4 d-flex justify-content-between">
                        <div>
                        </div>
                        <div>
                            <a href="{{ route('trgdashboard') }}" class="me-2 text-black {{ request()->routeIs('trgdashboard.*') ? 'text-decoration-underline fw-bold' : '' }}">TRG</a> -
                            <a href="{{ route('dashboard') }}" class="mx-2 text-black {{ request()->routeIs('dashboard.*') ? 'text-decoration-underline fw-bold' : '' }}">CDT</a> -
                            <a href="{{ route('oppdashboard') }}" class="mx-2 text-black {{ request()->routeIs('oppdashboard.*') ? 'text-decoration-underline fw-bold' : '' }}">OPP</a> -
                            <a href="{{ route('mcpdashboard') }}" class="mx-2 text-black {{ request()->routeIs('mcpdashboard.*') ? 'text-decoration-underline fw-bold' : '' }}">MCP</a> -
                            <a href="{{ route('ctcdashboard') }}" class="mx-2 text-black {{ request()->routeIs('ctcdashboard.*') ? 'text-decoration-underline fw-bold' : '' }}">CTC</a> -
                            <a href="{{ route('dashboard') }}" class="mx-2 text-black  {{ request()->routeIs('dashboard.*') ? 'text-decoration-underline fw-bold' : '' }}">ANN</a> -
                            <a href="{{ route('cstdashboard') }}" class="ms-2 text-black {{ request()->routeIs('cstdashboard.*') ? 'text-decoration-underline fw-bold' : '' }}">CST</a>
                        </div>
                    </div>




                    <div class="button-group-main">
                        <div class="button-group-left-main">
                            <h5 style="margin-left:-22px; background-color:#6F61C0; border-radius:5px; color:white;padding:12px;margin-top:-2px">OPP_CDTlist</h5>
                            
                            @if($links->count() == 1)
                            @foreach($links as $link)
                            <div class="mt-1">
                                <input style="width:80px; padding:5px;" type="text" placeholder="{{ $link->opportunity->opp_code ?? '--' }}"></input>
                            </div>
                            <div class="mt-1">
                                <input style="width:120px;padding:5px;" type="text" placeholder="{{ $link->opportunity->name ?? '--' }}"></input>
                            </div>
                            @endforeach
                            @else 
                            <div class="mt-2">
                                <h5>ALL OPEN STATUS OPPS</h5>
                            </div>
                            @endif

                            <div class="one">
                                <button id="linkNewCDT" style="background-color:#6F61C0;color:white;" type="button" class="btn"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="one">
                                <a href="/cdtevtlist">
                                    <button type="button" class="btn btn-evt">EVT <i style="margin-left:5px;" class="fa-regular fa-file-lines"></i> </button>
                                </a>
                                <button type="button" class="btn btn-evt" onclick="openModal()">EVT <i style="margin-left:5px;" class="fa-regular fa-square-plus"></i></button>
                            </div>
                            <div class="two">
                                <a href="/mcplist">
                                    <button type="button" class="btn btn-mcp">MCP <i style="margin-left:5px;" class="fa-regular fa-file-lines"></i></button>
                                </a>
                                <tyleclas id="linkNewCDT" type="button" class="btn btn-mcp"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="three">
                                <button style="color:red;" type="button" class="btn btn-call" onclick="openModal()"><i class="fa-solid fa-phone fa-lg"></i></button>
                                <a href="">
                                    <button type="button" class="btn btn-mail"><i class="fa-regular fa-envelope fa-lg"></i></button>
                                </a>
                                <button type="button" class="btn btn-erase" wire:click="resetForm"><i class="fa-solid fa-eraser fa-lg"></i></button>
                                <button wire:click="" id="delete-button-container" style="background:#F93827;" class="btn btn-danger">
                                    <i class="fa-regular fa-trash-can fa-lg"></i>
                                </button>
                                <button style="background:#4CC9FE;" type="button" class="btn btn-close1"><i class="fa-regular fa-floppy-disk fa-lg"></i></button>
                                <a href="/landing">
                                    <button type="button" class="btn btn-close1"><i class="fas fa-times fa-lg"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-14 mt-4 mb-3">
            <div class="table-responsive">
                <table class="table table-bordered border-secondary table-nowrap">

                    <tbody>
                        <tr>
                            <td style="width:10px;">
                                <input id="selectionButton" type="checkbox" class="large-checkbox">
                            </td>

                            <td>
                                <input type="text" class="form-control" placeholder="Rechercher" wire:model.live='search'>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="CodeOPP" wire:model.live='codeopp'>

                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder=" Libellé poste" wire:model.live='libelle'>

                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="Société..." wire:model.live='company'>

                            </td>
                            <td>
                                <select class="form-control w-md" wire:model.live='statut'>
                                    <option value="" selected>Selectionner</option>
                                    <option value="Open">Open</option>
                                    <option value="Closed">Closed</option>
                                    <option value="Filled">Filled</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="CP/Dpt" wire:model.live='position'>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="Remarque(s)" wire:model.live='remarks'>
                            </td>
                            <td style="width:10px;">
                                <button class="btn btn-danger ms-2" wire:click="resetFilters">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- end page title -->

        <div style="margin-top:-1%;" class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div>
                            <button wire:click="" class="btn btn-danger" id="delete-button-container" style="display: none;">
                                <i class="bi bi-trash-fill"></i>Supprimer
                            </button>
                        </div>
                        @if (!auth()->user()->hasRole('Manager'))

                        @endif
                    </div>
                </div>
                <div style="margin-top:-2%;" class="card-body">

                    @if (session()->has('message'))
                    <div style="width:23%;" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif


                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered table-hover table-hover-primary align-middle table-nowrap mb-0">
                           <thead class="text-black sticky-top">
                            <tr>
                                        <th style="width:2%; background-color:yellow;" scope="col">
                                            <input type="checkbox" id="select-all-checkbox" class="candidate-checkbox"
                                                style="display:none;" wire:model="selectAll">
                                        </th>
                                        <th style="background-color:yellow;" scope="col">Link Date</th>
                                        <th style="background-color:yellow;" scope="col">Actions</th>
<!--                                         <th style="background-color:yellow;" scope="col">OPPcode</th>
                                        <th style="background-color:yellow;" scope="col">CDTcode</th> -->
                                        <th style="background-color:yellow;" scope="col" wire:click="sortBy('updated_at')">Date MAJ</th>
                                        <th style="background-color:yellow;" scope="col">Aut</th>
                                        <th style="background-color:yellow;" scope="col">Civ</th>
                                        <th style="background-color:yellow;" scope="col" wire:click="sortBy('first_name')">Prénom</th>
                                        <th style="background-color:yellow;" scope="col" wire:click="sortBy('last_name')">Nom</th>
                                        <th style="background-color:yellow;" scope="col">Fonction</th>
                                        <!-- <th scope="col">Société</th> -->
                                        <th style="background-color:yellow;" scope="col">Tél</th>
                                        <th style="background-color:yellow;" scope="col">Email</th>
                                        <th style="background-color:yellow;" scope="col">CP/Dpt</th>
                                        <!-- <th scope="col">Ville</th>
                                        <th scope="col">Pays</th> -->
                                        <!-- <th style="background-color:yellow;" scope="col">Etat</th> -->
                                        <th style="background-color:yellow;" scope="col">Disponibilité</th>
                                        <!-- <th scope="col">Etat</th> -->
                                        <th style="background-color:yellow;" scope="col">Next step</th>
                                        <!-- <th scope="col">NSdate</th> -->
                                        <!-- <th style="background-color:yellow;" scope="col">CV</th>
                                        <th style="background-color:yellow;" scope="col">CRE</th> -->
                                        <th style="background-color:yellow;" scope="col">Statut</th>
                                        <th style="background-color:yellow;" scope="col">Commentaire</th>
                                        <th style="background-color:yellow;" scope="col">Description</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @if($links->count() > 0)
                                @foreach($links as $link)
                                <tr>
                                    <td class="checkbox-cell">
                                        <input type="checkbox" class="candidate-checkbox"
                                            style="display:none;pointer-events: none;">
                                    </td>
                                    <td>{{ $link->created_at->format('d/m/y') }}</td>
                                    <td>
                                        <button
                                            class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to remove this link ⚠')) { @this.deleteCdtLink({{ $link->id }}); }">
                                            <i class="fas fa-unlink"></i>
                                        </button>
                                    </td>
<!--                                     <td>{{ $link->opportunity->opp_code ?? '--' }}</td>
                                    <td>{{ $link->candidate->code_cdt ?? '--' }}</td> -->
                                    <td>{{ $link->candidate->updated_at->format('d/m/y') ?? '--' }}</td>
                                    <td>{{ $link->candidate->auteur->trigramme ?? '--' }}</td>
                                    <td>{{ $link->candidate->civ->name ?? '--' }}</td>
                                    <td>{{ $link->candidate->first_name ?? '--' }}</td>
                                    <td id="Lcol">{{ $link->candidate->last_name ?? '--' }}</td>
                                    <td id="Lcol">{{ $link->candidate->position->name ?? '--' }}</td>
                                    <td>{{ $link->candidate->phone ?? '--' }}</td>
                                    <td>{{ $link->candidate->email ?? '--' }}</td>
                                    <td>{{ $link->candidate->postal_code ?? '--' }}</td>
                                    <td>{{ $link->candidate->disponibility->name ?? '--' }}</td>
                                    <td>{{ $link->candidate->nextStep->name ?? '--' }}</td>
                                    <td>{{ $link->candidate->candidateStatut->name ?? '--' }}</td>
                                    <td>{{ $link->candidate->commentaire ?? '--' }}</td>
                                    <td>{{ $link->candidate->description ?? '--' }}</td>
                                   
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="20" class="text-center">No linked data available</td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            {{ $links->links() }}
        </div>




        <div style="margin-top:-15%;display:none;" class="modal-overlay" id="customModal" tabindex="-1">
            <div class="modal-dialog  cdt-modal-dialog">
                <div class="modal-content cdt-modal-content">
                    <div class="cdt-modal-header">
                        <span>Enter CTC code:</span>
                        <button id="closeModal" type="button" class="cdt-close-btn" data-bs-dismiss="modal">×</button>
                    </div>
                    <div class="cdt-modal-body">
                        <div class="cdt-input-group">
                            <input type="text" class="cdt-input" id="cdtCode" value="">
                            <button class="cdt-ok-btn" id="okButton">OK</button>
                        </div>
                        <div class="cdt-message"></div>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top:-15%;display:none;" class="modal-overlay" id="customModalOPP" tabindex="-1">
            <div class="modal-dialog  cdt-modal-dialog">
                <div class="modal-content cdt-modal-content">
                    <div class="cdt-modal-header">
                        <span>Enter OPP code:</span>
                        <button id="closeModalOPP" type="button" class="cdt-close-btn" data-bs-dismiss="modal">×</button>
                    </div>
                    <div class="cdt-modal-body">
                        <div class="cdt-input-group">
                            <input type="text" class="cdt-input" id="cdtCode" value="">
                            <button class="cdt-ok-btn" id="okButtonOPP">OK</button>
                        </div>
                        <div class="cdt-message"></div>
                    </div>
                </div>
            </div>
        </div>


        <div id="evtModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 style="background:#FFB4A2;width:18%;padding:7px;text-align:center">TRG_EVTform</h2>
                </div>
                <div class="icons-row">
                    <div class="icon-item">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-pen"></i>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="status-buttons">
                    <button class="status-btn">OCC</button>
                    <button class="status-btn">NRP</button>
                    <button class="status-btn">NRJ</button>
                    <button class="status-btn">WRN</button>
                    <button class="status-btn">NHS</button>
                </div>

                <div id="evtForm">
                    <div class="form-row">
                        <div class="form-group statut-field">
                            <label>TRG_Code</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group objet-field">
                            <label>Company</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group statut-field">
                            <label>CTC_Code</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group retour-field">
                            <label>First Name </label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group retour-field">
                            <label>Last Name</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group statut-field">
                            <label>Function</label>
                            <input type="text" class="form-control1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group date-field">
                            <label>Date</label>
                            <input type="date" class="form-control1" value="">
                        </div>
                        <div class="form-group type-field">
                            <label>Type</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group io-field">
                            <label>I/O</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group objet-field">
                            <label>Objet</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group statut-field">
                            <label>Statut</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group retour-field">
                            <label>Retour</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group statut-field">
                            <label>Temper</label>
                            <input type="text" class="form-control1">
                        </div>
                    </div>

                    <div class="comment-section">
                        <div class="form-group comment-field">
                            <label>Comment</label>
                            <!-- <textarea class="form-control2"></textarea> -->
                            <input type="text" class="form-control1">
                        </div>
                        <div class="right-section">
                            <div class="next-ech-row">
                                <div class="form-group next-field">
                                    <label>Next</label>
                                    <input type="text" class="form-control1">
                                </div>
                                <div class="form-group ech-field">
                                    <label>Ech</label>
                                    <input type="text" class="form-control1">
                                </div>
                                <div class="form-group ech-field">
                                    <label>Priority</label>
                                    <input type="text" class="form-control1">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="comment-section">
                        <div class="form-group retour-field">
                            <label>Last Comment</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="right-section">
                            <div class="next-ech-row">
                                <div class="form-group last-field">
                                    <label>Date Last Com.</label>
                                    <input type="text" class="form-control1">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Other Comment</label>
                            <textarea class="form-control1"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Note1</label>
                            <textarea class="form-control1"></textarea>
                        </div>
                    </div>

                    <div class="button-group">
                        <div class="button-group-left">
                            <div class="one">
                                <button type="button" class="btn btn-evt">EVTlist</button>
                                <button type="button" class="btn btn-evt"> > New</button>
                            </div>
                            <div class="two">
                                <button type="button" class="btn btn-valid">Valid</button>
                                <button type="button" class="btn btn-inputmain">Input</button>
                            </div>
                            <div class="three">
                                <button type="button" class="btn btn-erase" onclick="eraseForms()">Erase</button>
                                <button type="button" class="btn btn-close1" onclick="closeModal()">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .btn-mcp {
                background-color: #7D0A0A;
                color: white;
            }

            .btn-mcp:hover {
                background-color: #7D0A0A;
                color: white;
            }

            .btn-mail {
                background-color: #A084E8;
                color: white;
            }

            .btn-call {
                background-color: white;
                border: 1px solid black;
            }

            .btn-mail:hover {
                background-color: #A084E8;
                color: white;
            }

            .btn-call:hover {
                background-color: white;
                border: 1px solid black;
            }

            .btn-cst {
                background-color: #15F5BA;
                color: black;
            }

            .btn-cst:hover {
                background-color: #15F5BA;
                color: black;
            }

            .large-checkbox {
                width: 20px;
                height: 30px;
                cursor: pointer;
                margin-top: 3px;
                margin-left: 10px;
            }

            .btn-danger {
                background-color: red;
            }

            .btn-evt {
                background-color: #F9C0AB;
                color: black;
            }

            .btn-evt:hover {
                background-color: #F9C0AB;
                color: black;
            }

            .btn-opp {
                background-color: #614BC3;
                color: white;
            }

            .btn-opp:hover {
                background-color: #614BC3;
                color: white;
            }

            .btn-inputmain {
                background-color: #06D001;
                color: white;
            }

            .btn-inputmain:hover {
                background-color: #06D001;
                color: white;
            }

            /* .modal-content {
                background: none;
                border-radius: 8px;
                width: 300px;
                text-align: left;
            } */

            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1050;
            }

            .modal-content {
                position: relative;
                background-color: #fff;
                margin: 5% auto;
                padding: 20px 25px;
                width: 100%;
                max-width: 900px;
                border-radius: 2px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }


            .modal-header {
                margin-bottom: 5px;
                margin-left: -12px;
            }

            .modal-header h2 {
                color: #333;
                font-size: 1.4em;
                font-weight: 500;
                margin-right: 10px;
            }

            .icons-row {
                display: flex;
                gap: 25px;
                margin-top: 5px;
                margin-bottom: -20px;
                padding-left: 5px;
            }

            .icon-item {
                font-size: 18px;
                color: #555;
            }

            .divider {
                height: 1px;
                background-color: #ddd;
                margin: 12px 0;
            }

            .status-buttons {
                display: flex;
                gap: 20px;
                margin-top: -5px;
                margin-bottom: 20px;
                font-size: 1rem;
                justify-content: flex-end;
            }

            .status-btn {
                padding: 2px 8px;
                border: none;
                text-decoration: underline;
                background: none;
                cursor: pointer;
                font-weight: 500;
                color: #333;
                font-size: 0.9em;
            }

            .form-row {
                display: flex;
                gap: 15px;
                margin-top: 5px;
                margin-bottom: 15px;
                align-items: flex-start;
            }

            .form-group {
                display: flex;
                flex-direction: column;
            }

            .date-field {
                width: 90px;
            }

            .type-field {
                width: 60px;
            }

            .io-field {
                width: 60px;
            }

            .date-field {
                width: 115px;
            }

            .objet-field {
                width: 200px;
            }

            .retour-field {
                width: 200px;
            }

            .last-field {
                width: 300px;
            }

            /* .other-comment {
                width: 500px;
            }

            .note1 {
                width: 500px;
            } */

            .statut-field {
                width: 80px;
            }

            .comment-section {
                display: flex;
                gap: 15px;
            }

            .comment-field {
                flex: 1;
                max-width: 60%;
            }

            .right-section {
                flex: 1;
                max-width: 40%;
            }

            .next-ech-row {
                display: flex;
                gap: 15px;
                margin-bottom: 10px;
            }

            .next-field,
            .ech-field {
                flex: 1;
            }

            label {
                color: black;
            }

            .form-control1 {
                width: 100%;
                padding: 8px 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 13px;
                background-color: #f8f8f8;
            }

            .form-control2 {
                width: 100%;
                padding: 6px 8px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 13px;
                background-color: #f8f8f8;
            }

            textarea.form-control1 {
                min-height: 100px;
                resize: vertical;
            }

            textarea.form-control2 {
                min-height: 177px;
                resize: vertical;
            }

            .button-group {
                display: flex;
                justify-content: space-between;
                margin-top: -30px;
                padding: 0 20px;
            }

            .button-group-left {
                display: flex;
                gap: 25px;
            }

            .button-group-main {
                display: flex;
                justify-content: space-between;
                margin-top: 15px;
                margin-bottom: 10px;
                padding: 0 20px;
            }

            .button-group-left-main {
                display: flex;
                gap: 40px;
            }

            .button-group-right {
                display: flex;
            }

            .btn-input {
                background-color: #16C47F;
                color: black;
            }

            .btn-input:hover {
                background-color: #16C47F;
                color: black;
            }

            .btn-erase {
                background-color: #ff5722;
                color: white;
            }

            .btn-valid {
                background-color: #69247C;
                color: white;
            }

            .btn-valid:hover {
                background-color: #6F61C0;
                color: white;
            }

            .btn-erase:hover {
                background-color: #ff5722;
                color: white;
            }

            .btn-historique {
                background-color: #2196f3;
                color: white;
            }

            .btn-historique:hover {
                background-color: #2196f3;
                color: white;
            }

            .btn-close1 {
                background-color: #000080;
                color: white;
            }

            .btn-close1:hover {
                background-color: #000080;
                color: white;
            }


            .evt-button {
                background: #FF77B7;
                border: none;
                color: white;
                padding: 8px 16px;
                border-radius: 4px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
            }

            .evt-button i {
                font-size: 14px;
            }

            .cdt-modal-dialog {
                max-width: 300px;
                z-index: 1050;
            }

            .cdt-modal-content {
                padding: 0;
                border: 1px solid #999;
                border-radius: 0;
                box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
                background: #f0f0f0;
            }

            .cdt-modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 6px 8px;
                background: linear-gradient(to bottom, #fff, #e4e4e4);
                /* border-bottom: 1px solid #999; */
            }

            .cdt-modal-header span {
                font-size: 15px;
                color: #000;
            }

            .cdt-close-btn {
                background: red;
                border: none;
                font-size: 18px;
                line-height: 1;
                padding: 0 4px;
                cursor: pointer;
                color: white;
            }

            .cdt-modal-body {
                padding: 10px;
                background: #f0f0f0;
            }

            .cdt-input-group {
                display: flex;
                gap: 4px;
                margin-bottom: 6px;
            }

            .cdt-input {
                flex-grow: 1;
                padding: 3px 6px;
                border: 1px solid #999;
                font-size: 13px;
            }

            .cdt-ok-btn {
                background: #118B50;
                border: 1px solid #999;
                padding: 2px 8px;
                cursor: pointer;
                font-size: 13px;
                color: white;
            }

            .cdt-message {
                font-size: 15px;
                color: #666;
                padding: 2px 0;
            }
        </style>

    </div>
    @push('page-script')
    <script>
        document.getElementById("linkNewCDT").addEventListener("click", function() {
            document.getElementById("customModal").style.display = "flex";
        });

        document.getElementById("closeModal").addEventListener("click", function() {
            document.getElementById("customModal").style.display = "none";
        });

        document.getElementById("okButton").addEventListener("click", function() {
            document.getElementById("customModal").style.display = "none";
        });

        document.getElementById("linkNewOPP").addEventListener("click", function() {
            document.getElementById("customModalOPP").style.display = "flex";
        });

        document.getElementById("closeModalOPP").addEventListener("click", function() {
            document.getElementById("customModalOPP").style.display = "none";
        });

        document.getElementById("okButtonOPP").addEventListener("click", function() {
            document.getElementById("customModalOPP").style.display = "none";
        });

        function coming() {
            alert("Coming Soon 🛑");
        }



        let currentlyVisibleCertificateIndex = null;

        function toggleCertificate(index) {
            var hiddenCertificate = document.getElementById('hidden-certificate-' + index);
            var visibleCertificate = document.getElementById('visible-certificate-' + index);
            var messageDiv = document.getElementById('message-' + index);

            if (currentlyVisibleCertificateIndex !== null && currentlyVisibleCertificateIndex !== index) {
                var previousHiddenCertificate = document.getElementById('hidden-certificate-' + currentlyVisibleCertificateIndex);
                var previousVisibleCertificate = document.getElementById('visible-certificate-' + currentlyVisibleCertificateIndex);
                var previousMessageDiv = document.getElementById('message-' + currentlyVisibleCertificateIndex);

                previousHiddenCertificate.style.display = "inline";
                previousVisibleCertificate.style.display = "none";
                previousMessageDiv.style.display = "none";
            }

            if (hiddenCertificate.style.display === "none") {
                hiddenCertificate.style.display = "inline";
                visibleCertificate.style.display = "none";
                messageDiv.style.display = "none";
                currentlyVisibleCertificateIndex = null;
            } else {
                hiddenCertificate.style.display = "none";
                visibleCertificate.style.display = "inline";
                currentlyVisibleCertificateIndex = index;

                navigator.clipboard.writeText(visibleCertificate.textContent).then(function() {
                    messageDiv.textContent = 'Copie réussie !';
                    messageDiv.style.display = "block";
                    setTimeout(function() {
                        messageDiv.style.display = "none";
                    }, 1000);
                }, function(err) {
                    messageDiv.textContent = 'Erreur lors de la copie : ' + err;
                    messageDiv.style.display = "block";
                    setTimeout(function() {
                        messageDiv.style.display = "none";
                    }, 1000);
                });
            }
        }


        function openModal() {
            document.getElementById('evtModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('evtModal').style.display = 'none';
        }

        function eraseForm() {
            const modal = document.getElementById('evtForm');
            const inputs = modal.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.value = '';
            });
        }


        window.onclick = function(event) {
            const modal = document.getElementById('evtModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        document.getElementById('evtForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectionButton = document.getElementById('selectionButton');
            selectionButton.addEventListener('click', toggleCheckboxes);
            // uncheckedButton.addEventListener('click', deleteAllCheckboxes) 
            let selectedCandidateIds = [];
            let candidateId;
            const doubleClickDelay = 300;
            var clickTimeout;

            // Scroll to the row with the table-info class if available
            let selectedRow = document.querySelector('.table-info');
            if (selectedRow) {
                selectedRow.scrollIntoView({
                    block: 'nearest'
                });
            }

            // MAJ selection apres export
            Livewire.on('exportCompleted', () => {
                document.querySelectorAll('.candidate-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });

                toggleButtons();
                updateSelectionButtonAndSelectAllCheckbox();
            });

            document.querySelectorAll('tr[data-id]').forEach(function(row) {
                var candidateId = row.getAttribute('data-id');

                //making checkbox clickable
                var checkbox = row.querySelector('.candidate-checkbox');
                checkbox.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent the row click event from firing
                });

                row.addEventListener('click', function() {
                    clearTimeout(clickTimeout); // Clear previous timeout

                    clickTimeout = setTimeout(function() {
                        var checkbox = row.querySelector('.candidate-checkbox');
                        if (checkbox && checkbox.style.display === 'block') {
                            // If checkboxes are visible, just toggle the checkbox and remove 'table-info' class from all rows
                            checkbox.checked = !checkbox.checked;
                            document.querySelectorAll('tr[data-id]').forEach(function(otherRow) {
                                otherRow.classList.remove('table-info');
                            });
                        } else {
                            // If the clicked row already has the 'table-info' class, remove it, otherwise add it
                            if (row.classList.contains('table-info')) {
                                row.classList.remove('table-info');
                                if (checkbox) { // Check if the checkbox exists
                                    checkbox.checked = false;
                                }
                            } else {
                                // Remove 'table-info' class and uncheck all other rows
                                document.querySelectorAll('tr[data-id]').forEach(function(otherRow) {
                                    otherRow.classList.remove('table-info');
                                    var otherCheckbox = otherRow.querySelector('.candidate-checkbox');
                                    if (otherCheckbox) { // Check if the checkbox exists
                                        otherCheckbox.checked = false;
                                    }
                                });

                                // Add 'table-info' class and check the clicked row
                                row.classList.add('table-info');
                                if (checkbox) { // Check if the checkbox exists
                                    checkbox.checked = true;
                                }
                            }
                        }

                        // Check if any checkbox is checked and toggle the buttons
                        toggleButtons();
                        deleteSelectedCandidates();
                        updateSelectAllCheckbox();

                        // Update selection button and select-all checkbox
                        updateSelectionButtonAndSelectAllCheckbox();

                    }, doubleClickDelay);
                });
                var checkbox = row.querySelector('.candidate-checkbox');
                checkbox.addEventListener('change', function(e) {
                    // Check if any checkbox is checked and toggle the buttons
                    toggleButtons();
                    deleteSelectedCandidates();
                });
            });

            // check & uncheck all checkboxes
            document.getElementById('select-all-checkbox').addEventListener('change', function(e) {
                var isChecked = e.target.checked;
                document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                    checkbox.checked = isChecked;
                    checkbox.style.display = isChecked ? 'block' : 'none';
                });
                toggleButtons();
                deleteSelectedCandidates();
            });
            // Select all checkboxes functionality
            document.getElementById('select-all-checkbox').addEventListener('change', function() {
                var isChecked = this.checked;
                document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                    checkbox.checked = isChecked;
                    checkbox.style.display = 'block'; // Keep checkboxes visible
                });
                toggleButtons();
                updateSelectionButtonAndSelectAllCheckbox();
            });

        });

        /*************************************************************************************/
        // Toggle selection checkboxes
        function toggleCheckboxes() {
            let areCheckboxesVisible = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.style.display === 'block');
            document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                checkbox.style.display = areCheckboxesVisible ? 'none' : 'block';
                if (areCheckboxesVisible) checkbox.checked = false; // Uncheck all checkboxes if toggling to hide
            });

            // Update selection button text
            const selectionButton = document.getElementById('selectionButton');
            if (areCheckboxesVisible) {
                selectionButton.innerHTML = '<i class="bi bi-check-square-fill"></i> Sélection';
                document.getElementById('select-all-checkbox').style.display = 'none';
                document.getElementById('select-all-checkbox').checked = false;
            } else {
                selectionButton.innerHTML = '<i class="bi bi-check-square"></i> Désélection';
                document.getElementById('select-all-checkbox').style.display = 'block';
            }

            // Update delete button visibility
            updateDeleteButtonVisibility();
        }
        // Update delete button visibility
        function updateDeleteButtonVisibility() {
            var deleteButtonContainer = document.getElementById('delete-button-container');
            let isAnyCheckboxChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.checked && c.style.display === 'block');
            if (isAnyCheckboxChecked) {
                deleteButtonContainer.style.display = '';
            } else {
                deleteButtonContainer.style.display = '';
            }
        }
        //function to toggle the buttons
        function toggleButtons() {
            var anyChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.checked);
            var deleteButtonContainer = document.getElementById('delete-button-container');
            var exporter = document.getElementById('exporter');

            if (anyChecked) {
                deleteButtonContainer.style.display = '';
                // exporter.style.display = 'none';
            } else {
                deleteButtonContainer.style.display = '';
                // exporter.style.display = 'block';
            }
        }

        function deleteSelectedCandidates() {
            let selectedCandidateIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
                .map(checkbox => checkbox.closest('tr').getAttribute('data-id'))
                .filter(id => id !== null && id !== '');
            console.log(selectedCandidateIds);

            let deleteButtonContainer = document.getElementById('delete-button-container');
            if (deleteButtonContainer) {
                deleteButtonContainer.setAttribute('wire:click', `confirmDeleteChecked('${selectedCandidateIds.join(',')}')`);
                deleteButtonContainer.style.cursor = 'pointer';
            }
        }

        function updateSelectionButtonAndSelectAllCheckbox() {
            let isAnyCheckboxVisible = false;
            document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                // Check if at least one checkbox is visible
                if (checkbox.style.display === 'block') {
                    isAnyCheckboxVisible = true;
                }
            });

            // Update selection button text
            const selectionButton = document.getElementById('selectionButton');
            if (isAnyCheckboxVisible) {
                selectionButton.innerHTML = '<i class="bi bi-check-square"></i> Désélection';
                // Show the select-all checkbox
                document.getElementById('select-all-checkbox').style.display = 'block';
            } else {
                selectionButton.innerHTML = '<i class="bi bi-check-square-fill"></i> Sélection';
                // Hide the select-all checkbox
                document.getElementById('select-all-checkbox').style.display = 'none';

            }
        }


        // **************unchecked all checkbox***************
        function deleteAllCheckboxes() {
            document.querySelectorAll('.candidate-checkbox').forEach(function(checkbox) {
                checkbox.checked = false;
            });
            // update delete button visibility
            toggleButtons();
        }
        // *********************************************************************
        function updateSelectAllCheckbox() {
            var allChecked = Array.from(document.querySelectorAll('.candidate-checkbox')).every(c => c.checked);
            var anyVisible = Array.from(document.querySelectorAll('.candidate-checkbox')).some(c => c.style.display === 'block');
            document.getElementById('select-all-checkbox').checked = allChecked;

            // Update select-all checkbox visibility
            document.getElementById('select-all-checkbox').style.display = anyVisible ? 'block' : 'none';
        }

        //filtrage
        document.addEventListener('DOMContentLoaded', function() {
            const filterInputs = document.querySelectorAll('input[wire:model.live], select[wire:model.live]');

            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    sessionStorage.setItem(input.getAttribute('wire:model.live'), input.value);
                });
            });

            // Charger les valeurs des filtres depuis le stockage de session
            filterInputs.forEach(input => {
                const storedValue = sessionStorage.getItem(input.getAttribute('wire:model.live'));
                if (storedValue !== null) {
                    input.value = storedValue;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });
        /***********************************************************************************************/
    </script>
    @endpush
</div>
