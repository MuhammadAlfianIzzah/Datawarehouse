<h1>Data Fact sales {{ request('year') ?? 'all year' }}</h1>
<table>
    <thead>
        <tr>
            <th class="border">customer_name</th>
            <th>Channel</th>
            <th>Date</th>
            <th>Produk</th>
            <th>price_sale</th>
            <th>brand</th>
            <th>capital_price</th>
            <th>quantity</th>
            <th>total_sale</th>
            <th>capital_total</th>
            <th>profit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->customer->nama }}</td>
                <td>{{ $sale->channel->nama }}</td>
                <td>{{ $sale->dates->date }}</td>
                <td>{{ $sale->product->nama }}</td>
                <td>{{ $sale->price_sale }}</td>
                <td>{{ $sale->brand->nama }}</td>
                <td>{{ $sale->capital_price }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ $sale->total_sale }}</td>
                <td>{{ $sale->capital_total }}</td>
                <td>{{ $sale->profit }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
