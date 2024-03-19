 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
     <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href="https://www.harmen-botts.com/" class="logo logo-dark">
             <span class="logo-sm">
                 <img src="{{ asset('assets/images/logo.png') }}" alt="" height="50">
             </span>
             <span class="logo-lg">
                 <img src="{{ asset('assets/images/logo.png') }}" alt="" height="50">
             </span>
         </a>
         <!-- Light Logo-->
         <a href="https://www.harmen-botts.com/" class="logo logo-light">
             <span class="logo-sm">
                 <img src="{{ asset('assets/images/logo.png') }}" alt="" height="50">
             </span>
             <span class="logo-lg">
                 <img src="{{ asset('assets/images/logo.png') }}" alt="" height="50">
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
                 <li class="nav-item bg-dash-sidebar">
                     <a class="nav-link menu-link  text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}"
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
                 {{-- @if (auth()->user()->hasRole('Administrateur')) --}}
                     @can('Gestion des candidats')
                         <li class="nav-item">
                             <a class="nav-link menu-link {{ request()->routeIs('candidates.index') ? 'active' : '' }}"
                                 href="{{ route('candidates.index') }}">
                                 <i class="ri-apps-2-line"></i> <span data-key="t-apps">Accès BaseCDT</span>
                             </a>

                         </li>
                     @endcan
                 {{-- @else --}}
                     @can('Gestion des candidats')
                         <li class="nav-item">
                             <a class="nav-link menu-link {{ request()->routeIs('cst.upload') ? 'active' : '' }}"
                                 href="{{ route('cst.upload') }}">
                                 <i class="ri-apps-2-line"></i> <span data-key="t-apps">Uploadés
                                 </span>
                             </a>

                         </li>
                     @endcan
                 {{-- @endIF --}}
                 <li class="nav-item">
                     <a class="nav-link menu-link " href="#sidebarApps" data-bs-toggle="collapse" role="button"
                         aria-expanded="false" aria-controls="sidebarApps">
                         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Activité</span>
                     </a>
                     <div class="collapse menu-dropdown" id="sidebarApps">
                         <ul class="nav nav-sm flex-column">

                             @can('Ajouter un candidat')
                                 <li class="nav-item">
                                     <a href="{{ route('summary') }}"
                                         class="nav-link {{ request()->routeIs('summary') ? 'active' : '' }}"
                                         data-key="t-chat">Synthèse </a>
                                 </li>
                             @endcan
                             {{-- <li class="nav-item">
                               <a href="{{ route('cres.index') }}"
                                   class="nav-link {{ request()->routeIs('cres.index') ? 'active' : '' }}"
                                   data-key="t-chat">C.R.E </a>
                           </li> --}}
                             @can('Importer des candidats')
                                 <li class="nav-item">
                                     <a href="{{ route('detail') }}"
                                         class="nav-link {{ request()->routeIs('detail') ? 'active' : '' }}"
                                         data-key="t-chat">Détails</a>
                                 </li>
                             @endcan
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link menu-link " href="#sidebarApps" data-bs-toggle="collapse" role="button"
                         aria-expanded="false" aria-controls="sidebarApps">
                         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Capture / Gestion</span>
                     </a>
                     <div class="collapse menu-dropdown" id="sidebarApps">
                         <ul class="nav nav-sm flex-column">

                             @can('Ajouter un candidat')
                                 <li class="nav-item">
                                     <a href="{{ route('candidates.create') }}"
                                         class="nav-link {{ request()->routeIs('candidates.create') ? 'active' : '' }}"
                                         data-key="t-chat"> Formulaire </a>
                                 </li>
                             @endcan
                             {{-- <li class="nav-item">
                                <a href="{{ route('cres.index') }}"
                                    class="nav-link {{ request()->routeIs('cres.index') ? 'active' : '' }}"
                                    data-key="t-chat">C.R.E </a>
                            </li> --}}
                             @can('Importer des candidats')
                                 <li class="nav-item">
                                     <a href="{{ route('import.candidat') }}"
                                         class="nav-link {{ request()->routeIs('import.candidat') ? 'active' : '' }}"
                                         data-key="t-chat">Upload bases </a>
                                 </li>
                             @endcan
                         </ul>
                     </div>
                 </li>

                 @can('Menu paramètres')
                     <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Paramètres</span></li>

                     <li class="nav-item">
                         <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                             aria-expanded="false" aria-controls="sidebarAuth">
                             <i class="ri-settings-3-line"></i> <span data-key="t-authentication">Paramètres</span>
                         </a>
                         <div class="collapse menu-dropdown" id="sidebarAuth">
                             <ul class="nav nav-sm flex-column">
                                 <li class="nav-item">
                                     <a href="{{ route('user.profile') }}"
                                         class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}"
                                         data-key="t-signup"> Mon profil
                                     </a>
                                 </li>

                                 @can('Gestion des utilisateurs')
                                     <li class="nav-item">
                                         <a href="#sidebarSignIn" class="nav-link" data-bs-toggle="collapse" role="button"
                                             aria-expanded="false" aria-controls="sidebarSignIn" data-key="t-signin">
                                             Utilisateurs
                                         </a>
                                         <div class="collapse menu-dropdown" id="sidebarSignIn">
                                             <ul class="nav nav-sm flex-column">
                                                 @can('Liste des utilisateurs')
                                                     <li class="nav-item">
                                                         <a href="{{ route('users.index') }}"
                                                             class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Liste </a>
                                                     </li>
                                                     <li class="nav-item">
                                                         <a href="{{ route('positions.index') }}"
                                                             class="nav-link {{ request()->routeIs('positions.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Postes </a>
                                                     </li>
                                                     <li class="nav-item">
                                                         <a href="{{ route('specialities.index') }}"
                                                             class="nav-link {{ request()->routeIs('specialities.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Spécialites </a>
                                                     </li>
                                                     <li class="nav-item">
                                                         <a href="{{ route('fields.index') }}"
                                                             class="nav-link {{ request()->routeIs('fields.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Domaines </a>
                                                     </li>
                                                     <li class="nav-item">
                                                         <a href="{{ route('disponibilities.index') }}"
                                                             class="nav-link {{ request()->routeIs('disponibilities.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Disponibilites </a>
                                                     </li>
                                                     <li class="nav-item">
                                                         <a href="{{ route('civs.index') }}"
                                                             class="nav-link {{ request()->routeIs('civs.index') ? 'active' : '' }}"
                                                             data-key="t-basic"> Civilites </a>
                                                     </li>
                                                 @endcan
                                             </ul>
                                         </div>
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
                                 @can('Gestion des rôles et permissions')
                                     <li class="nav-item">
                                         <a href="{{ route('roles.permissions') }}"
                                             class="nav-link {{ request()->routeIs('roles.permissions') ? 'active' : '' }}"
                                             data-key="t-signup"> Rôles et Permissions
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="{{ route('roles.index') }}"
                                             class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                             data-key="t-signup"> Rôles
                                         </a>
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
