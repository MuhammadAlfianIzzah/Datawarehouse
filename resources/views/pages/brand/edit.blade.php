<x-admin-layout>
    <x-slot name="title">
        Edit brand {{ $brand->id }}
    </x-slot>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex accusantium nam, soluta quo cumque, autem esse fugit
        vitae doloremque minima mollitia nobis, eius perspiciatis.</p>
    <div class="container bg-white py-4 px-3">
        <div class="row">
            <form action="{{ route('brand-update', [$brand->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID Produk</label>
                        <input name="id" type="text" class="form-control" id="id"
                            value="{{ old('id') ?? ($brand->id ?? '') }}">
                        @error('id')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input name="nama" type="text" class="form-control" id="nama"
                            value="{{ old('nama') ?? ($brand->nama ?? '') }}">
                        @error('nama')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Update brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
