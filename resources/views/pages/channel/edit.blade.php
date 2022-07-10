<x-admin-layout>
    <x-slot name="title">
        Edit Channel {{ $channel->id }}
    </x-slot>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex accusantium nam, soluta quo cumque, autem esse fugit
        vitae doloremque minima mollitia nobis, eius perspiciatis.</p>
    <div class="container bg-white py-4 px-3">
        <div class="row">
            <form action="{{ route('channel-update', [$channel->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID Produk</label>
                        <input name="id" type="text" class="form-control" id="id"
                            value="{{ old('id') ?? ($channel->id ?? '') }}">
                        @error('id')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input name="nama" type="text" class="form-control" id="nama"
                            value="{{ old('nama') ?? ($channel->nama ?? '') }}">
                        @error('nama')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Update Channel
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
