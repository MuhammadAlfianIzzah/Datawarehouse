<x-admin-layout>
    <x-slot name="title">
        Brand
    </x-slot>
    <div class="row d-flex justify-content-between mb-2">
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdata">
                <i class="fa-solid fa-plus"></i>
            </button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importbrand">
                <i class="fa-solid fa-file-import"></i>
            </button>
        </div>
        <div class="col-6 text-end">
            <form class="d-none d-sm-inline-block form-inline navbar-search">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control bg-light small"
                            placeholder="Search for..." aria-label="Search">
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
        <div class="col-12 table-responsive">
            <table class="table caption-top">
                {{-- <caption>List of users</caption> --}}
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">KD</th>
                        <th scope="col">Nama</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $key => $brand)
                        <tr>
                            <th scope="row">{{ ($brands->currentpage() - 1) * $brands->perpage() + $key + 1 }}
                            </th>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->nama }}</td>
                            {{-- <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('brand-edit', [$brand->id]) }}" class="btn btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('brand-delete', $brand->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $brand->id }}">
                                            <i class="fa-solid fa-trash-can"></i>

                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delete{{ $brand->id }}" tabindex="-1"
                                            aria-labelledby="delete{{ $brand->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title" id="delete{{ $brand->id }}Label">
                                                            Anda yakin akan menghapus produk
                                                            <strong>{{ $brand->id }} ?</strong>
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
                            </td> --}}
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{ $brands->withQueryString()->links() }}
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="{{ route('brand-store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahdataLabel">Tambah Channel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id" class="form-label">Id Channel</label>
                            <input name="id" type="text" class="form-control" id="id"
                                aria-describedby="emailHelp">
                            @error('id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Channel</label>
                            <input name="nama" type="text" class="form-control" id="nama"
                                aria-describedby="emailHelp">
                            @error('nama')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal import -->
    <div class="modal fade" id="importbrand" tabindex="-1" aria-labelledby="importbrandLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importbrandLabel">Import data produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('brand-import') }}" method="POST" enctype="multipart/form-data">
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
