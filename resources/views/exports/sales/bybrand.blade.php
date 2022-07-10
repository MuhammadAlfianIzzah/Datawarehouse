<h1>Data Fact sales by brand {{ request('year') ?? 'all year' }}</h1>
<table>
    <thead>
        <tr>
            <th class="border">customer</th>
            <th>channel</th>
            <th>date</th>
            <th>product_id</th>
            <th>brand</th>
            <th>price_sale</th>
            <th>capital_price</th>
            <th>quantity</th>
            <th>total_sale</th>
            <th>capital_total</th>
            <th>profit</th>
            <th>terjual</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->customer->nama }}</td>
                <td>{{ $sale->channel->nama }}</td>
                <td>{{ $sale->dates->date }}</td>
                <td>{{ $sale->product->price }}</td>
                <td>{{ $sale->brand->nama }}</td>
                <td>{{ $sale->price_sale }}</td>
                <td>{{ $sale->capital_price }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ $sale->total_sale }}</td>
                <td>{{ $sale->capital_total }}</td>
                <td>{{ $sale->profit }}</td>
                <td>{{ $sale->terjual }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
