<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <x-slot name="sidepanel">
        <div class="row justify-content-end">
            <form action="" method="GET" class="col-4 d-flex">
                <select name="year" class="form-select" aria-label="Default select example">
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </x-slot>
    @php
        $produk = [
            'count' => [$terlaku[1]->total, $terlaku[2]->total, $terlaku[3]->total],
            'name' => [$terlaku[1]->products->nama, $terlaku[2]->products->nama, $terlaku[3]->products->nama],
        ];
    @endphp
    {{-- <div class="row mb-2">
        <div class="col-lg-6">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" class="btn btn-danger">2022</button>
                <button type="button" class="btn btn-warning">2021</button>
                <button type="button" class="btn btn-success">2020</button>
            </div>
        </div>
    </div> --}}

    {{-- <select class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select> --}}
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan Pertahun</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="{{ route('export') }}">Export</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product terlaris {{ request('year') ?? 2022 }}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="famousproduct"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> {{ $produk['name'][0] }}
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> {{ $produk['name'][1] }}
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> {{ $produk['name'][2] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan {{ request('year') ?? 2022 }} </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="perbulan"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- {{ dd($pertahun[2020]->sum('capital_price')) }} --}}

    @push('script')
        <script>
            // var ctx = document.getElementById('myAreaChart');
            var pertahun = {
                labels: ['2020', "2021", "2022"],
                datasets: [{
                    label: "Sales Rp. ",
                    lineTension: 0,
                    backgroundColor: "#ffffff",
                    borderColor: "rgb(255, 99, 132)",
                    borderWidth: 4,
                    pointBackgroundColor: "#535353",
                    data: [@json($pertahun[2020]->sum('profit')), @json($pertahun[2021]->sum('profit')), @json($pertahun[2022]->sum('profit'))]
                }]
            };
            var perbulan = {
                labels: ['January', "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "November", "December"
                ],
                datasets: [{
                        label: "Profit",
                        lineTension: 0,
                        backgroundColor: "red",
                        borderColor: "rgb(255, 99, 132)",
                        borderWidth: 4,
                        pointBackgroundColor: "#535353",
                        data: [
                            @json($perbulan['January']->profit ?? 0),
                            @json($perbulan['February']->profit ?? 0),
                            @json($perbulan['March']->profit ?? 0),
                            @json($perbulan['April']->profit ?? 0),
                            @json($perbulan['May']->profit ?? 0),
                            @json($perbulan['June']->profit ?? 0),
                            @json($perbulan['July']->profit ?? 0),
                            @json($perbulan['August']->profit ?? 0),
                            @json($perbulan['September']->profit ?? 0),
                            @json($perbulan['October']->profit ?? 0),
                            @json($perbulan['November']->profit ?? 0),
                            @json($perbulan['December']->profit ?? 0)
                        ]
                    }, {
                        label: 'Total sale',
                        lineTension: 0,
                        backgroundColor: "#ffffff",
                        borderColor: "rgb(255, 99, 132)",
                        borderWidth: 4,
                        pointBackgroundColor: "#535353",
                        data: [
                            @json($perbulan['January']->total_sale ?? 0),
                            @json($perbulan['February']->total_sale ?? 0),
                            @json($perbulan['March']->total_sale ?? 0),
                            @json($perbulan['April']->total_sale ?? 0),
                            @json($perbulan['May']->total_sale ?? 0),
                            @json($perbulan['June']->total_sale ?? 0),
                            @json($perbulan['July']->total_sale ?? 0),
                            @json($perbulan['August']->total_sale ?? 0),
                            @json($perbulan['September']->total_sale ?? 0),
                            @json($perbulan['October']->total_sale ?? 0),
                            @json($perbulan['November']->total_sale ?? 0),
                            @json($perbulan['December']->total_sale ?? 0)
                        ]
                    },
                    {
                        label: 'Capital price',
                        lineTension: 0,
                        backgroundColor: "lightblue",
                        // borderColor: "rgb(255, 99, 132)",
                        borderWidth: 4,
                        pointBackgroundColor: "#535353",
                        data: [
                            @json($perbulan['January']->capital_price ?? 0),
                            @json($perbulan['February']->capital_price ?? 0),
                            @json($perbulan['March']->capital_price ?? 0),
                            @json($perbulan['April']->capital_price ?? 0),
                            @json($perbulan['May']->capital_price ?? 0),
                            @json($perbulan['June']->capital_price ?? 0),
                            @json($perbulan['July']->capital_price ?? 0),
                            @json($perbulan['August']->capital_price ?? 0),
                            @json($perbulan['September']->capital_price ?? 0),
                            @json($perbulan['October']->capital_price ?? 0),
                            @json($perbulan['November']->capital_price ?? 0),
                            @json($perbulan['December']->capital_price ?? 0)
                        ]
                    }
                ]
            };

            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                let rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
            //var myChart =
            new Chart(document.getElementById('famousproduct'), {
                type: 'pie',
                data: {
                    labels: @json($produk['name']),
                    datasets: [{
                        label: "Sales Rp. ",
                        // lineTension: 0,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        borderColor: "rgba(108,108,108,1)",
                        borderWidth: 1,
                        pointBackgroundColor: "#535353",
                        data: @json($produk['count'])
                    }]
                },
                options: {
                    animation: false,
                    legend: {
                        display: false
                    },
                    maintainAspectRatio: false,
                    responsive: true,
                    responsiveAnimationDuration: 0,

                }
            });
            //var myChart  pertahun=
            new Chart(document.getElementById('myAreaChart'), {
                type: 'line',
                data: pertahun,
                options: {
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            }
                        }
                    },
                    // responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Chart.js Line Chart'
                        }
                    },
                    animation: false,
                    legend: {
                        display: false
                    },
                    maintainAspectRatio: false,
                    responsive: true,
                    responsiveAnimationDuration: 0,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10,
                                callback: function(value, index, values) {
                                    return value.toLocaleString("id-ID", {
                                        style: "currency",
                                        currency: "IDR"
                                    }); //! panggil function addComas tadi disini
                                }
                            }
                        }]
                    }
                }
            });

            //var myChart  perbulan=
            new Chart(document.getElementById('perbulan'), {
                type: 'bar',
                data: perbulan,
                options: {
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            }
                        }
                    },
                    // responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Chart.js Line Chart'
                        }
                    },
                    animation: false,

                    maintainAspectRatio: false,
                    responsive: true,
                    responsiveAnimationDuration: 0,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10,
                                callback: function(value, index, values) {
                                    return value.toLocaleString("id-ID", {
                                        style: "currency",
                                        currency: "IDR"
                                    }); //! panggil function addComas tadi disini
                                }
                            }
                        }]
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>
