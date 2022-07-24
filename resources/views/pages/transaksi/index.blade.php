<x-admin-layout>
    <x-slot name="title">
        Transaksi
    </x-slot>

    <div class="row d-flex justify-content-between mb-2">
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahtransaksi">
                <i class="fa-solid fa-plus"></i>
            </button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importransaksi">
                <i class="fa-solid fa-file-import"></i>
            </button>
            <a href="{{ route('generate-data') }}" class="btn btn-danger"><i class="fa-solid fa-rotate"></i></a>
        </div>
        <div class="col-6 text-end">
            <form class="d-none d-sm-inline-block form-inline navbar-search">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="value" class="form-control bg-light small"
                            placeholder="Search for..." aria-label="Search">
                        <select class="form-select" name="key">
                            <option value="quantity">quantity</option>
                            <option value="profit">profit</option>
                            <option value="capital_total">capital_total</option>
                            <option value="total_sale">total_sale</option>
                            <option value="capital_price">capital_price</option>
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
    <div class="row bg-white py-3 px-2">
        <p>Data mentah: {{ $count }}</p>
        <div class="col-12 table-responsive">
            <table class="table caption-top">
                {{-- <caption>List of users</caption> --}}
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Produk</th>
                        <th scope="col">total sale</th>
                        <th scope="col">Keuntungan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $key => $sale)
                        <tr>
                            <th scope="row">{{ ($sales->currentpage() - 1) * $sales->perpage() + $key + 1 }}
                            </th>
                            <td>{{ $sale->date->date }}</td>
                            <td>{{ $sale->product->nama }} </td>
                            <td>Rp. {{ number_format($sale->total_sale, 2, ',', '.') }}</td>
                            <td>Rp. {{ number_format($sale->profit, 2, ',', '.') }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('transaksi-show', [$sale->id]) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    {{-- <button type="button" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button> --}}

                                    <form action="{{ route('transaksi-delete', $sale->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete">
                                            <i class="fa-solid fa-trash-can"></i>

                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delete" tabindex="-1"
                                            aria-labelledby="deleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title" id="deleteLabel">
                                                            Anda yakin akan menghapus produk
                                                            <strong>{{ $sale->nama }} ?</strong>
                                                        </div>

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{ $sales->withQueryString()->links() }}
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahtransaksi" aria-labelledby="tambahtransaksiLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="{{ route('transaksi-store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahtransaksiLabel">Tambah Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label for="customer_nama" class="form-label">Nama customer</label>
                            <input type="email" class="form-control" id="customer_nama" name="customer_nama">
                        </div>
                        <div class="mb-2">
                            <label for="customer_type">Type Customer</label>
                            <select class="form-select" name="customer_type" id="customer_type">
                                <option value="umum">Umum</option>
                                <option value="reseller">Reseller</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="channel_id">Channel</label>
                            <select class="form-select" name="channel_id" id="channel_id">
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="product_id">Produk</label>
                            <select class="form-select" name="product_id" id="product_id">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="brand_id">Brand</label>
                            <select class="form-select" name="brand_id" id="brand_id">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity">
                        </div>
                        <div class="mb-3">
                            <label for="capital_price" class="form-label">capital_price</label>
                            <input type="number" name="capital_price" class="form-control" id="capital_price">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
            @push('script')
                <script>
                    $(document).ready(function() {
                        // $('#customer_id').select2({
                        //     dropdownParent: $('#tambahtransaksi'),
                        //     width: '100%'
                        // });
                        $('#channel_id').select2({
                            dropdownParent: $('#tambahtransaksi'),
                            width: '100%'
                        });
                        $('#product_id').select2({
                            dropdownParent: $('#tambahtransaksi'),
                            width: '100%'
                        });
                        $('#brand_id').select2({
                            dropdownParent: $('#tambahtransaksi'),
                            width: '100%'
                        });
                    });
                </script>
            @endpush
        </div>
    </div>
    <!-- Modal import -->
    <div class="modal fade" id="importransaksi" tabindex="-1" aria-labelledby="importransaksiLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importransaksiLabel">Import data transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('transaksi-import') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Gunakan format excel</label>
                            <input name="file" class="form-control" type="file" id="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>
