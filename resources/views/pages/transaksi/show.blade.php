<x-admin-layout>
    <x-slot name="title">
        Transaksi Detail
    </x-slot>
    <div class="container bg-white py-4 px-3">
        <div class="row">
            <div class="col-9">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus at adipisci est laudantium possimus!
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Detail transaksi
                            </div>
                            <div class="card-body">
                                <p>
                                    <i class="fa-solid fa-person"></i> <span class="fw-bold"> Customer</span>:
                                    {{ $sales->customer->nama }} || <span class="text-info">
                                        {{ $sales->customer->type }}</span>
                                </p>
                                <div class="border p-2">
                                    <p><span class="fw-bold">Produk</span>: {{ $sales->product->nama }}</p>
                                    <p><span class="fw-bold">Type</span>: {{ $sales->product->type }}</p>
                                    <p><span class="fw-bold">Harga</span>:
                                        Rp. {{ number_format($sales->product->price, 2, ',', '.') }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Calculate
                            </div>
                            <div class="card-body">
                                <p>
                                    <span class="fw-bold">Quantity:</span> {{ $sales->quantity }}
                                </p>
                                <p>
                                    <span class="fw-bold">Price Sale:</span> {{ $sales->price_sale }}
                                </p>
                                <p>
                                    <span class="fw-bold">Total Sale:</span> {{ $sales->total_sale }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-10">
                Profit penjualan: {{ $sales->profit }}
            </div>
        </div>
    </div>
</x-admin-layout>
