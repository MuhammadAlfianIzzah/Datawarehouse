<x-admin-layout>
    <x-slot name="title">Produk {{ $product->nama }}</x-slot>
    <div class="bg-white container py-4 px-4">
        <div class="row mb-2">
            <div class="col-10">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, necessitatibus at enim deserunt corrupti
                ab.
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <p> <span class="fw-bold">Nama:</span> {{ $product->nama }}</p>
                        <p> <span class="fw-bold">Type:</span> {{ $product->type }}</p>

                        <p> <span class="fw-bold">Price:</span> Rp. {{ number_format($product->price, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-4">
                <p> <span class="fw-bold">Terjual:</span> {{ $product->sold->count() }}</p>
                <p> <span class="fw-bold">dengan keuntungan:</span> Rp.
                    {{ number_format($product->sold->sum('profit'), 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>
