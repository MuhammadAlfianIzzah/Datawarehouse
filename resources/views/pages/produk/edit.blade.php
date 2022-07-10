<x-admin-layout>
    <x-slot name="title">
        Edit Produk {{ $product->id }}
    </x-slot>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex accusantium nam, soluta quo cumque, autem esse fugit
        vitae doloremque minima mollitia nobis, eius perspiciatis.</p>
    <div class="container bg-white py-4 px-3">
        <div class="row">
            <form action="{{ route('produk-update', [$product->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID Produk</label>
                        <input name="id" type="text" class="form-control" id="id"
                            value="{{ old('id') ?? ($product->id ?? '') }}">
                        @error('id')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input name="nama" type="text" class="form-control" id="nama"
                            value="{{ old('nama') ?? ($product->nama ?? '') }}">
                        @error('nama')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type Produk</label>
                        <input type="text" name="type" class="form-control" id="type"
                            value="{{ old('type') ?? ($product->type ?? '') }}">
                        @error('type')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga Produk</label>
                        <input type="number" value="{{ old('price') ?? ($product->price ?? '') }}"
                            class="form-control" name="price" id="price">
                        @error('price')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Update produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
