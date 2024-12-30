<div class="p-6 bg-gray-100 min-h-screen">

    @include('components.breadcrumb', [
    'title' => auth()->user()->hasRole('Administrateur') ? 'Espace Administrateur' : (
    auth()->user()->hasRole('Manager') ? 'Espace Manager' : (
    auth()->user()->hasRole('CST+') ? 'Espace Consultant+' : 'Espace Consultant')),
    'breadcrumbItems' => [['text' => 'Landing', 'url' => '#']],
    ])

    <h1 class="headings">Welcome to Xtrak 👋</h1>

    <div class="flex justify-end gap-4 mb-6">
        <button id="openAllBtn" class="btn-green text-white px-4 py-2 rounded hover:bg-green-600 transition-all">Open all</button>
        <button id="closeAllBtn" class="btn-red text-white px-4 py-2 rounded hover:bg-red-600 transition-all">Close all</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-6">
            @php
            $leftSections = [
            'Tables' => ['CDTtable' => '/tables/cdt', 'TRGtable' => '/tables/trg', 'OPPtable' => '/tables/opp', 'CTCtable' => '/tables/ctc', 'PREFtable' => '/tables/pref', 'ANNtable' => '/tables/ann', 'CAMtable' => '/tables/cam', 'MAItable' => '/tables/mai'],
            'Views' => ['CDTvue' => '/dashboard', 'CDT_CST+' => '/views/cdt-cst-plus', 'CDT_CST' => '/views/cdt-cst', 'TRGvue' => '/views/trg', 'OPPvue' => '/views/opp', 'CTCvue' => '/views/ctc', 'PREFvue' => '/views/pref', 'ANNvue' => '/views/ann', 'CAMvue' => '/views/cam', 'MAIvue' => '/views/mai'],
            'Forms' => ['CDTform' => '/candidates/create', 'TRGform' => '/forms/trg', 'OPPform' => '/forms/opp', 'CTCform' => '/forms/ctc', 'PREFform' => '/forms/pref', 'ANNform' => '/forms/ann', 'CAMform' => '/forms/cam', 'MAIform' => '/forms/mai'],
            'Vaults' => ['BackUp1' => '/vaults/backup1', 'BackUp2' => '/vaults/backup2'],
            ];
            @endphp

            @foreach ($leftSections as $title => $items)
            <div class="bg-blue-50 shadow rounded-lg">
                <div class="p-4 flex justify-between items-center">
                    <h2 class="font-semibold text-lg text-blue-800">{{ $title }}</h2>
                    <button class="toggle-btn text-blue-500 transition-all" data-target="#{{ Str::slug($title) }}">
                        <span class="toggle-icon">+</span>
                    </button>
                </div>
                <div id="{{ Str::slug($title) }}" class="dropdown hidden">
                    <ul class="pl-6 pb-4 space-y-2">
                        @foreach ($items as $itemName => $itemUrl)
                        <li><a href="{{ $itemUrl }}" class="text-blue-500 hover:underline">{{ $itemName }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        <div class="space-y-6">
            @php
            $rightSections = [
            'KPIs' => ['CDT appelés' => '/kpis/cdt-called', 'CDT mailés' => '/kpis/cdt-mailed', 'TRG appelés' => '/kpis/trg-called', 'TRG mailés' => '/kpis/trg-mailed', 'STATS' => '/kpis/stats'],
            'Queries' => ['Generator' => '/queries/generator', 'Query1' => '/queries/query1', 'Query2' => '/queries/query2'],
            'Activity' => ['Connection' => '/connexions', 'Upload' => '/import-candidat'],
            'Parameters' => ['Presentation' => '/parameters/presentation', 'Profile' => '/parameters/profile']
            ];
            @endphp

            @foreach ($rightSections as $title => $items)
            <div class="bg-blue-50 shadow rounded-lg">
                <div class="p-4 flex justify-between items-center">
                    <h2 class="font-semibold text-lg text-blue-800">{{ $title }}</h2>
                    <button class="toggle-btn text-blue-500 transition-all" data-target="#{{ Str::slug($title) }}">
                        <span class="toggle-icon">+</span>
                    </button>
                </div>
                <div id="{{ Str::slug($title) }}" class="dropdown hidden">
                    <ul class="pl-6 pb-4 space-y-2">
                        @foreach ($items as $itemName => $itemUrl)
                        <li><a href="{{ $itemUrl }}" class="text-blue-500 hover:underline">{{ $itemName }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButtons = document.querySelectorAll('.toggle-btn');
            const openAllBtn = document.getElementById('openAllBtn');
            const closeAllBtn = document.getElementById('closeAllBtn');
            const dropdowns = document.querySelectorAll('.dropdown');

            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const target = document.querySelector(button.getAttribute('data-target'));
                    const icon = button.querySelector('.toggle-icon');
                    target.classList.toggle('hidden');
                    icon.textContent = target.classList.contains('hidden') ? '+' : '-';
                });
            });

            openAllBtn.addEventListener('click', () => {
                dropdowns.forEach(dropdown => dropdown.classList.remove('hidden'));
                toggleButtons.forEach(button => button.querySelector('.toggle-icon').textContent = '-');
            });

            closeAllBtn.addEventListener('click', () => {
                dropdowns.forEach(dropdown => dropdown.classList.add('hidden'));
                toggleButtons.forEach(button => button.querySelector('.toggle-icon').textContent = '+');
            });
        });
    </script>

    <style>
        .hidden {
            display: none;
        }
    </style>
</div>