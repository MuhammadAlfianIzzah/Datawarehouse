<x-admin-layout>
    <x-slot name="title">Export data pertahun</x-slot>
    <div class="container bg-white py-4 px-3">
        <div class="row mb-3">
            <div class="col-6">
                Export data tahun: {{ request('year') ?? 'All year' }}: <a
                    href="{{ route('export-pertahun-cetak', ['year' => request('year') ?? null]) }}"
                    class="btn btn-success"> <i class="fa-solid fa-file-excel"></i> Cetak</a>
            </div>
            <div class="col-6 text-end">
                <form class="d-none d-sm-inline-block form-inline navbar-search">
                    <form action="" method="GET">
                        <div class="input-group">

                            <select class="form-select" name="year">
                                <option @if (request('year') == 2020) selected @endif value="2020">2020</option>
                                <option @if (request('year') == 2021) selected @endif value="2021">2021</option>
                                <option @if (request('year') == 2022) selected @endif value="2022">2022</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </form>

            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Total sale</th>
                            <th scope="col">Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $key => $sale)
                            <tr>
                                <th scope="row">{{ ($sales->currentpage() - 1) * $sales->perpage() + $key + 1 }}
                                <td>{{ $sale->customer->nama }} <span class="text-info">
                                        {{ $sale->customer->type }}</span></td>
                                <td>
                                    {{ $sale->product->nama }}
                                </td>
                                <td>Rp. {{ number_format($sale->total_sale, 2, ',', '.') }}</td>
                                {{-- <td>{{ $sale->total_sale }}</td> --}}
                                <td>{{ $sale->profit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sales->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
