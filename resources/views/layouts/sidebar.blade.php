 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
     <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href="https://www.harmen-botts.com/" class="logo logo-dark">
             <span class="logo-sm">
                 <img src="{{ asset('assets/images/logo.jpg') }}" class="img-fluid" height="250" width="250">
             </span>
             <span class="logo-lg">
                 <img src="{{ asset('assets/images/logo.jpg') }}" class="img-fluid" height="250" width="250">
             </span>
         </a>
         <!-- Light Logo-->
         <a href="https://www.harmen-botts.com/" class="logo logo-light">
             <span class="logo-sm">
                 <img src="{{ asset('assets/images/logo.jpg') }}" class="img-fluid" height="250" width="250">
             </span>
             <span class="logo-lg">
                 <img src="{{ asset('assets/images/logo.jpg') }}" class="img-fluid" height="250" width="250">
             </span>
         </a>
         <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
             id="vertical-hover">
             <i class="ri-record-circle-line"></i>
         </button>
     </div>

     <div id="scrollbar">
         <div class="container-fluid">

             <div id="two-column-menu">
             </div>
             <ul class="navbar-nav" id="navbar-nav">
                 <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                 <li class="nav-item {{ request()->routeIs('dashboard') ? 'bg-dash-sidebar' : '' }}">
                     <a class="nav-link menu-link  {{ request()->routeIs('dashboard') ? '' : '' }}   {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                         href="{{ route('dashboard') }}">
                         <i class="ri-dashboard-2-line"></i>
                         <span data-key="t-dashboards">
                             @if (auth()->user()->hasRole('Administrateur'))
                                 ESPACE ADMINISTATEUR
                             @else
                                 ESPACE CONSULTANT
                             @endIF
                         </span>
                     </a>

                 </li> <!-- end Dashboard Menu -->

                 @can(['Menu accès BaseCDT', 'Liste des candidats'])
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs('candidates.index') ? 'active' : '' }}"
                             href="{{ route('candidates.index') }}">
                             <i class="ri-apps-2-line"></i> <span data-key="t-apps">Accès BaseCDT</span>
                         </a>

                     </li>
                 @endcan
                 <!-- end   Accès BaseCDT Menu -->
                 @can('Menu activité')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->is(['summary', 'summary/*', 'detail', 'detail/*']) ? 'active' : '' }}"
                             href="#activite" data-bs-toggle="collapse" role="button"
                             aria-expanded="{{ request()->is(['summary', 'summary/*', 'detail', 'detail/*']) ? 'true' : 'false' }}"
                             aria-controls="activite">
                             <i class="ri-apps-2-line"></i> <span data-key="t-apps">Activité</span>
                         </a>
                         <div class="collapse menu-dropdown {{ request()->is(['summary', 'summary/*', 'detail', 'detail/*']) ? 'show' : '' }}"
                             id="activite">
                             <ul class="nav nav-sm flex-column">
                                 @can('Menu synthèse')
                                     <li class="nav-item">
                                         <a href="{{ route('summary') }}"
                                             class="nav-link {{ request()->routeIs('summary*') ? 'active' : '' }}"
                                             data-key="t-chat">Connexions</a>
                                     </li>
                                 @endcan
                                 {{-- @can('Menu Détails')
                                     <li class="nav-item">
                                         <a href="{{ route('detail') }}"
                                             class="nav-link {{ request()->routeIs('detail*') ? 'active' : '' }}"
                                             data-key="t-chat">Détails</a>
                                     </li>
                                 @endcan --}}
                             </ul>
                         </div>
                     </li>
                 @endcan
                 @can('Menu capture / gestion')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs(['candidates.create', 'import.candidat', 'state*']) ? 'active' : '' }}"
                             href="#sidebarApps" data-bs-toggle="collapse" role="button"
                             aria-expanded="{{ request()->routeIs(['candidates.create', 'import.candidat', 'state*']) ? 'true' : 'false' }}"
                             aria-controls="sidebarApps">
                             <i class="ri-apps-2-line"></i> <span data-key="t-apps">Capture / Gestion</span>
                         </a>
                         <div class="collapse menu-dropdown {{ request()->routeIs(['candidates.create', 'import.candidat', 'state*']) ? 'show' : '' }}"
                             id="sidebarApps">
                             <ul class="nav nav-sm flex-column">
                                 @can('Menu saisie')
                                     <li class="nav-item">
                                         <a href="#saisie" class="nav-link {{ request()->routeIs('candidates.create', 'import.candidat') ? 'active' : '' }} " data-bs-toggle="collapse" role="button"
                                             aria-expanded="{{ request()->routeIs('candidates.create', 'import.candidat') ? 'true' : 'false' }}"
                                             aria-controls="saisie" data-key="t-signin">
                                             Saisie
                                         </a>
                                         
                                         <div class="collapse menu-dropdown {{ request()->routeIs('candidates.create', 'import.candidat') ? 'show' : '' }}"
                                             id="saisie">
                                             <ul class="nav nav-sm flex-column">
                                                 @can('Ajouter un candidat')
                                                     <li class="nav-item">
                                                         <a href="{{ route('candidates.create') }}"
                                                             class="nav-link {{ request()->routeIs('candidates.create') ? 'active' : '' }}"
                                                             data-key="t-chat">Formulaire </a>
                                                     </li>
                                                 @endcan
                                                 @can('Importer des candidats')
                                                     <li class="nav-item">
                                                         <a href="{{ route('import.candidat') }}"
                                                             class="nav-link {{ request()->routeIs('import.candidat') ? 'active' : '' }}"
                                                             data-key="t-chat">Upload </a>
                                                     </li>
                                                 @endcan
                                             </ul>
                                         </div>
                                     </li>
                                 @endcan
                                 @can('Menu etats')
                                     <li class="nav-item">
                                         <a href="#etats" class="nav-link {{ request()->routeIs('state*') ? 'active' : '' }}" data-bs-toggle="collapse" role="button"
                                             aria-expanded="{{ request()->routeIs('state*') ? 'true' : 'false' }}"
                                             aria-controls="etats" data-key="t-signin">
                                             Etats
                                         </a>
                                         <div class="collapse menu-dropdown {{ request()->routeIs('state*') ? 'show' : '' }}"
                                             id="etats">
                                             <ul class="nav nav-sm flex-column">
                                                 <li class="nav-item">
                                                     <a href="{{ route('state', 'Certifié') }}"
                                                         class="nav-link {{ request()->route()->named('state') && request()->route('state') === 'Certifié' ? 'active' : '' }}"
                                                         data-key="t-chat">Certifié </a>
                                                 </li>
                                                 <li class="nav-item">
                                                     <a href="{{ route('state', 'Attente') }}"
                                                         class="nav-link {{ request()->route()->named('state') && request()->route('state') === 'Attente' ? 'active' : '' }}"
                                                         data-key="t-chat">En attente </a>
                                                 </li>
                                                 <li class="nav-item">
                                                     <a href="{{ route('state', 'Doublon') }}"
                                                         class="nav-link {{ request()->route()->named('state') && request()->route('state') === 'Doublon' ? 'active' : '' }}"
                                                         data-key="t-chat">Doublons </a>
                                                 </li>
                                             </ul>

                                         </div>
                                     </li>
                                 @endcan
                             </ul>
                         </div>
                     </li>
                 @endcan
                 @can('Menu paramètres')
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ request()->routeIs(['user.profile', 'users.index', 'roles.index', 'roles.permissions', 'nextsteps.index', 'compagnies.index', 'metiers', 'disponibilities.index', 'civs.index','candidate_statuts.index','candidate_states.index']) ? 'active' : '' }}"
                             href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false"
                             aria-controls="sidebarAuth">
                             <i class="ri-settings-3-line"></i> <span data-key="t-authentication">Paramètres</span>
                         </a>
                         <div class="collapse menu-dropdown {{ request()->routeIs(['user.profile', 'users.index', 'roles.index', 'roles.permissions', 'nextsteps.index', 'compagnies.index', 'metiers', 'disponibilities.index', 'civs.index','candidate_statuts.index','candidate_states.index']) ? 'show' : '' }}"
                             id="sidebarAuth">
                             <ul class="nav nav-sm flex-column">
                                 <li class="nav-item">
                                     <a href="{{ route('user.profile') }}"
                                         class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}"
                                         data-key="t-signup"> Mon profil
                                     </a>
                                 </li>
                                 @can('Menu utilisateur')
                                     <li class="nav-item">
                                         <a href="#sidebarSignInUsers" class="nav-link" data-bs-toggle="collapse"
                                             role="button"  aria-expanded="{{ request()->routeIs('users.index', 'roles.index', 'roles.permissions') ? 'true' : 'false' }}" aria-controls="sidebarSignInUsers"
                                             data-key="t-signin">
                                             Utilisateurs
                                         </a>
                                         <div class="collapse menu-dropdown {{ request()->routeIs(['users.index', 'roles.index', 'roles.permissions']) ? 'show' : '' }}"
                                             id="sidebarSignInUsers">
                                             <ul class="nav nav-sm flex-column">
                                                 @can('Liste des utilisateurs')
                                                     <li class="nav-item">
                                                         <a href="{{ route('users.index') }}"
                                                             class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Liste</a>
                                                     </li>
                                                 @endcan
                                                 @can('Gestion des rôles')
                                                     <li class="nav-item">
                                                         <a href="{{ route('roles.index') }}"
                                                             class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                                             data-key="t-signup">Rôles
                                                         </a>
                                                     </li>
                                                 @endcan
                                                 @can('Gestion des permissions')
                                                     <li class="nav-item">
                                                         <a href="{{ route('roles.permissions') }}"
                                                             class="nav-link {{ request()->routeIs('roles.permissions') ? 'active' : '' }}"
                                                             data-key="t-signup">Permissions
                                                         </a>
                                                     </li>
                                                 @endcan
                                             </ul>
                                         </div>
                                     </li>
                                 @endcan
                                 @can('Menu paramètre BaseCDT')
                                     <li class="nav-item">
                                         <a href="#sidebarSignInBaseCDT" class="nav-link" data-bs-toggle="collapse"
                                             role="button" aria-expanded="{{ request()->routeIs('nextsteps.index', 'compagnies.index', 'metiers', 'disponibilities.index', 'civs.index','candidate_statuts.index','candidate_states.index') ? 'true' : 'false' }}" aria-controls="sidebarSignInBaseCDT"
                                             data-key="t-signin">
                                             BaseCDT
                                         </a>
                                         <div class="collapse menu-dropdown {{ request()->routeIs(['nextsteps.index', 'compagnies.index', 'metiers', 'disponibilities.index', 'civs.index','candidate_statuts.index','candidate_states.index']) ? 'show' : '' }}"
                                             id="sidebarSignInBaseCDT">
                                             <ul class="nav nav-sm flex-column">
                                                 @can('Gestion des étape suivante')
                                                     <li class="nav-item">
                                                         <a href="{{ route('nextsteps.index') }}"
                                                             class="nav-link {{ request()->routeIs('nextsteps.index') ? 'active' : '' }}"
                                                             data-key="t-signup"> NextStep
                                                         </a>
                                                     </li>
                                                 @endcan
                                                 @can('Gestion des sociétes')
                                                     <li class="nav-item">
                                                         <a href="{{ route('compagnies.index') }}"
                                                             class="nav-link {{ request()->routeIs('compagnies.index') ? 'active' : '' }}"
                                                             data-key="t-signup"> Sociétes
                                                         </a>
                                                     </li>
                                                 @endcan
                                                 {{-- @can('Gestion des Métier1')
                                                     <li class="nav-item">
                                                         <a href="{{ route('positions.index') }}"
                                                             class="nav-link {{ request()->routeIs('positions.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Métier1
                                                            </a>
                                                     </li>
                                                 @endcan --}}
                                                 @can('Gestion des Métier2')
                                                     <li class="nav-item">
                                                         <a href="{{ route('metiers') }}"
                                                             class="nav-link {{ request()->routeIs('metiers') ? 'active' : '' }}"
                                                             data-key="t-basic"> Métiers </a>
                                                     </li>
                                                 @endcan
                                                 {{-- @can('Gestion des Métier3')
                                                     <li class="nav-item">
                                                         <a href="{{ route('fields.index') }}"
                                                             class="nav-link {{ request()->routeIs('fields.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Métier3 </a>
                                                     </li>
                                                 @endcan --}}
                                                 @can('Gestion des disponibilites')
                                                     <li class="nav-item">
                                                         <a href="{{ route('disponibilities.index') }}"
                                                             class="nav-link {{ request()->routeIs('disponibilities.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Disponibilites </a>
                                                     </li>
                                                 @endcan
                                                 @can('Gestion des civilites')
                                                     <li class="nav-item">
                                                         <a href="{{ route('civs.index') }}"
                                                             class="nav-link {{ request()->routeIs('civs.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Civ. </a>
                                                     </li>
                                                 @endcan
                                                 @can('Gestion des statuts')
                                                     <li class="nav-item">
                                                         <a href="{{ route('candidate_statuts.index') }}"
                                                             class="nav-link {{ request()->routeIs('candidate_statuts.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Statut </a>
                                                     </li>
                                                 @endcan
                                                 @can('Gestion des etats')
                                                     <li class="nav-item">
                                                         <a href="{{ route('candidate_states.index') }}"
                                                             class="nav-link {{ request()->routeIs('candidate_states.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Etat </a>
                                                     </li>
                                                 @endcan
                                             </ul>
                                         </div>
                                     </li>
                                 @endcan
                             </ul>
                         </div>
                     </li>
                 @endcan
             </ul>
         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>
 <!-- Left Sidebar End -->
 <!-- Vertical Overlay-->
 <div class="vertical-overlay"></div>
