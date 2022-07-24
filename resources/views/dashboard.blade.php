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
            <form action="" method="GET" class="col-5 d-flex">
                <select name="year" class="form-select" aria-label="Default select example">
                    <option @if (request('year') == '') selected @endif value="">Keseluruhan</option>
                    <option @if (request('year') == 2022) selected @endif value="2022">2022</option>
                    <option @if (request('year') == 2021) selected @endif value="2021">2021</option>
                    <option @if (request('year') == 2020) selected @endif value="2020">2020</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </x-slot>
    @php
        $produk = [
            'count' => [$terlaku[1]->total, $terlaku[2]->total, $terlaku[3]->total],
            'name' => [$terlaku[1]->product->nama, $terlaku[2]->product->nama, $terlaku[3]->product->nama],
        ];
    @endphp


    <div class="row">
        {{-- Report  Sales by Brand 2022 --}}
        <div class="col-xl-8 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Report Sales by Brand
                        {{ request('year') ?? 'Year round' }}
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" style="height: 150px">
                        <canvas id="bybrand"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- by channel --}}
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Report Sales by Channel
                        {{ request('year') ?? 'Year round' }} </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" style="height: 150px">
                        <canvas id="bychannel"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- by channel --}}

        <!-- Pendapatan 2022 -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Report Sales by month
                        {{ request('year') ?? 'Year round' }}
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" style="height: 150px">
                        <canvas id="perbulan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- by channel --}}
        <div class="col-xl col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Report Sales by Channel
                        {{ request('year') ?? 'Year round' }} </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" style="height: 150px">
                        <canvas id="byyear"></canvas>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <span>
                                <span class="badge text-bg-primary">Produk yang terjual</span>
                                {{ number_format($transaksi->count('product_id'), 0, ',', '.') }}
                            </span>
                            <span>
                                <span class="badge text-bg-success">Profit / tahunan</span>
                                Rp. {{ number_format($transaksi->sum('profit'), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- by channel --}}


    </div>
    {{-- {{ dd($pertahun[2020]->sum('capital_price')) }} --}}

    @push('script')
        <script>
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

            let export_brand = @json($bybrand);
            let brand = {
                id: [],
                nama: [],
                capital_price: [],
                profit: [],
                terjual: [],
                total_sale: [],
            };
            export_brand.forEach(function(b) {
                brand.id.push(b.brand_id);
                brand.nama.push(b.brand_nama);
                brand.capital_price.push(b.capital_price);
                brand.profit.push(b.profit);
                brand.terjual.push(b.terjual);
                brand.total_sale.push(b.total_sale);
            });

            var bybrand = {

                labels: brand.nama,
                datasets: [{
                    label: "Terjual",
                    lineTension: 0,
                    backgroundColor: "lightblue",
                    // borderColor: "rgb(255, 99, 132)",
                    borderWidth: 4,
                    // pointBackgroundColor: "#535353",
                    data: brand.terjual
                }, ]
            };
            //var myChart  perbulan=
            new Chart(document.getElementById('bybrand'), {
                type: 'bar',
                data: bybrand,
                options: {
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

                            }
                        }]
                    }
                }
            });


            //  channell
            let export_channel = @json($bychannel);
            let channel = {
                id: [],
                nama: [],
                capital_price: [],
                profit: [],
                terjual: [],
                total_sale: [],
            };
            export_channel.forEach(function(b) {
                channel.id.push(b.channel_id);
                channel.nama.push(b.channel_nama);
                channel.capital_price.push(b.capital_price);
                channel.profit.push(b.profit);
                channel.terjual.push(b.terjual);
                channel.total_sale.push(b.total_sale);
            });

            var bychannel = {

                labels: channel.nama,
                datasets: [{
                    label: "Terjual",
                    lineTension: 0,
                    backgroundColor: "lightblue",
                    // borderColor: "rgb(255, 99, 132)",
                    borderWidth: 4,
                    // pointBackgroundColor: "#535353",
                    data: channel.terjual
                }, ]
            };
            //var myChart  channel=
            new Chart(document.getElementById('bychannel'), {
                type: 'horizontalBar',
                data: bychannel,
                options: {
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

                            }
                        }]
                    }
                }
            });
            var byyear = {
                labels: ["Produk yang terjual"],
                datasets: [{
                    label: "Terjual",
                    lineTension: 0,
                    backgroundColor: "lightblue",
                    borderWidth: 4,
                    data: [@json($transaksi->count('produk_id'))]
                }, ]
            };
            //var myChart  byyear=
            new Chart(document.getElementById('byyear'), {
                type: 'pie',
                data: byyear,
                options: {
                    responsive: true,
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

                }
            });
        </script>
    @endpush
</x-admin-layout>
