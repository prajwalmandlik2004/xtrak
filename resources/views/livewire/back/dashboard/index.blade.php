<div>
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                            Nombre de candidats</p>
                                    </div>

                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                class="counter-value" data-target="{{ $nbCandidates }}">0</span>
                                        </h4>

                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-white bg-opacity-10 rounded fs-3">
                                            <i class="bx bx-user text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                            Nombre d'utilisateurs</p>
                                    </div>

                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                class="counter-value" data-target="{{ $nbUsers }}">0</span>
                                        </h4>

                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-white bg-opacity-10 rounded fs-3">
                                            <i class="bx bx-user-circle text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->


                </div> <!-- end row-->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Nombre de candidat par mois</h4>
                                {{-- <div>
                                    <select class="form-control w-md" wire:model.live='year' >
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div id="nb_candidate_chart_by_month"
                                    data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Évolution des candidats pendant les cinq dernières années</h4>
                                {{-- <div>
                                    <select class="form-control w-md" wire:model.live='year' >
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div><!-- end card header -->
                            <div class="card-body p-0 pb-2">
                                <div id="evolution_candidate_chart_by_year"
                                    data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Les candidats ajoutés récemment
                                </h4>
                                {{-- <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate
                                        Report
                                    </button>
                                </div> --}}
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Prénom</th>
                                                <th scope="col">Poste</th>
                                                <th scope="col">Société</th>
                                                <th scope="col">Mail</th>
                                                <th scope="col">Téléphone 1</th>
                                                <th scope="col">Téléphone 2</th>
                                                <th scope="col">CP/Dpt</th>
                                                <th scope="col">Statut CDT</th>
                                                <th scope="col">Date d'ajout</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($candidatesRecentsAddeds as $candidate)
                                                <tr>
                                                    <td>
                                                        <a href="apps-ecommerce-order-details.html"
                                                            class="fw-medium link-primary">{{ $loop->iteration }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $candidate->last_name ?? 'Non renseigné' }}
                                                    </td>
                                                    <td>{{ $candidate->first_name ?? 'Non renseigné' }}</td>
                                                    <td>
                                                        {{ optional($candidate->position)->name ?? 'Non renseigné' }}
                                                    </td>
                                                    <td>{{ $candidate->company ?? 'Non renseigné' }}</td>
                                                    <td>
                                                        {{ $candidate->email ?? 'Non renseigné' }}
                                                    </td>
                                                    <td>
                                                        {{ $candidate->phone ?? 'Non renseigné' }}
                                                    </td>
                                                    <td>
                                                        {{ $candidate->phone_2 ?? 'Non renseigné' }}
                                                    </td>
                                                    <td>
                                                        {{ $candidate->postal_code ?? 'Non renseigné' }}
                                                    </td>
                                                    <td>
                                                        {{ $candidate->cdt_status ?? 'Non renseigné' }}
                                                    </td>
                                                    <td>
                                                        {{ $candidate->created_at->format('d/m/Y') }}
                                                    </td>
                                                </tr><!-- end tr -->
                                            @empty
                                                <tr>
                                                    <td colspan="11" class="text-center">Aucun candidat ajouté
                                                        récemment</td>
                                                </tr>
                                            @endforelse

                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
</div>
@push('script-chart')
    <script>
        function getChartColorsArray(chartId) {
            if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                if (colors) {
                    colors = JSON.parse(colors);
                    return colors.map(function(value) {
                        var newValue = value.replace(" ", "");
                        if (newValue.indexOf(",") === -1) {
                            var color = getComputedStyle(document.documentElement).getPropertyValue(
                                newValue
                            );
                            if (color) return color;
                            else return newValue;
                        } else {
                            var val = value.split(",");
                            if (val.length == 2) {
                                var rgbaColor = getComputedStyle(
                                    document.documentElement
                                ).getPropertyValue(val[0]);
                                rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                                return rgbaColor;
                            } else {
                                return newValue;
                            }
                        }
                    });
                } else {
                    console.warn('data-colors atributes not found on', chartId);
                }
            }
        }
        var nbCandidateChartByMonthColor = getChartColorsArray("nb_candidate_chart_by_month");

        if (nbCandidateChartByMonthColor) {
            var nbCandidateByMonth = @json($nbCandidateByMonth);
            var options = {
                series: [{
                    name: 'Nombre',
                    data: Object.values(nbCandidateByMonth)
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: ['Janvier', 'Février', 'Mars', 'Avril', 'Main', 'Juin', 'Juillet', 'Août', 'Septembre',
                        'Octobre', 'Novembre', 'Décembre'
                    ],
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return val;
                        }
                    }

                },
                title: {
                    text: 'Evolution des candidats par mois',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#nb_candidate_chart_by_month"), options);
            chart.render();


        }
        var evolutionCandidateChartByYearColor = getChartColorsArray("evolution_candidate_chart_by_year");

        if (evolutionCandidateChartByYearColor) {
            var evolutionCandidateByYear = @json($evolutionCandidateByYear);
            var options = {
                series: [{
                    name: "Nombre de candidats",
                    data: Object.values(evolutionCandidateByYear)
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Évolution des candidats pendant les cinq dernières années',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: <?php echo json_encode(array_values($years)); ?>
                }
            };

            var chart = new ApexCharts(document.querySelector("#evolution_candidate_chart_by_year"), options);
            chart.render();
        }
    </script>
@endpush
