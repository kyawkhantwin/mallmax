@extends("admin.home.home")

@section('content')

    
    @if (!$orders)
    <div class="d-flex align-items-center justify-content-center" style="height: 70vh">
        No Transaction Yet
    </div>
    @else
    <h3 class="ms-2">Transaction </h1>

    <table class="table table-striped table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>User</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->user->phone ?? 'N/A' }}</td>

                    <td><img width="50" src="{{ $order->product->image_url ?? 'N/A' }}"
                            alt=""></td>
                    <td>{{ $order->product->name ?? 'N/A' }}</td>
                    <td>{{ $order->sale_price ?? 'N/A' }} kyats</td>
                    <td>{{ $order->total_qty ?? 'N/A' }} </td>
                    <td>{{ $order->total_qty * $order->sale_price ?? 'N/A' }} kyats</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i:s') ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$orders -> links()}}
    @endif
@endsection
