@extends('admin.home.home')

@section('content')
<div id="count" class="d-flex  align-items-center justify-content-around mt-3">

    <div class="d-flex justify-content-center align-items-center bg-info px-2 py-3 rounded w-25 ">
        <i class="fa-solid fa-box me-4 fs-2 text-white"></i>
        <div class=" text-start text-white header fs-6">Product <br> <span>400</span></div>
    </div>
    <div class="d-flex justify-content-center align-items-center bg-info px-2 py-3 rounded w-25 ms-3">
        <i class="fa-solid fa-user me-4 fs-2 text-white"></i>
        <div class=" text-start text-white header fs-6">User <br> <span>4</span></div>
    </div>
    <div class="d-flex justify-content-center align-items-center bg-info px-3 py-3    rounded w-25 ms-3">
        <i class="fa-solid fa-dollar me-4 fs-2 text-white"></i>
        <div class=" text-start text-white header fs-6 text-nowrap">Total Sale <br> <span>4000</span></div>
    </div>

</div>
    <div class="container">
        <div class="row">
            <div class="m-2 col-12 col-md-5">
               

                <h1 class="fs-5 mt-3">categories</h1>

                <canvas id="categoriesChart" class="mt-3" width="400" height="250"></canvas>

                <h1 class="fs-5 mb-3 mt-5">User Order Last 6 months</h1>
                <canvas id="orderChart" class="mt-3" width="400" height="350"></canvas>
                

              





            </div>
            <div class="col-1"></div>
            <div class="m-2 col-12 col-md-5">

                <h1 class="fs-5 mt-3 mb-3 ">User Register Last 6 months</h1>
                <canvas id="userChart" class="mt-3" width="400" height="350"></canvas>

                <h1 class="fs-5 mt-5 mb-3">Recent 5 products</h1>


                <div id="carousel" class="carousel slide mt-3" style="width: 400px; ">
                    <div class="carousel-indicators">
                        @foreach ($products as $index => $product)
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{ $index }}"
                                @if ($index === 0) class="active" aria-current="true" @endif
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($products as $index => $product)
                            <div class="carousel-item @if ($index === 0) active @endif">
                                <img src="{{ $product->image_url }}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $product->name }}</h5>
                                    <p>{{ $product->price }} Kyats</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                
            </div>

        </div>

        <div class="col-12">
            <div class="mt-5">
                <p>Last Order</p>
                <table class="table table-striped table-bordered table-hover">
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
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                                <td>{{ $transaction->user->phone ?? 'N/A' }}</td>

                                <td><img width="50" src="{{ $transaction->product->image_url ?? 'N/A' }}"
                                        alt=""></td>
                                <td>{{ $transaction->product->name ?? 'N/A' }}</td>
                                <td>{{ $transaction->sale_price ?? 'N/A' }} kyats</td>
                                <td>{{ $transaction->total_qty ?? 'N/A' }} </td>
                                <td>{{ $transaction->total_qty * $transaction->sale_price ?? 'N/A' }} kyats</td>
                                <td>{{ $transaction->created_at->format('Y-m-d H:i:s') ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Get the context of the canvas element
        const ctx = document.getElementById('userChart').getContext('2d');
        const order = document.getElementById('orderChart').getContext('2d');
        const categories = document.getElementById('categoriesChart').getContext('2d');

        const data = {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Monthly User',
                // data: {!! json_encode($monthlyUserCount) !!},
                data: [1, 2, 10, 6, 8, 3],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Create a bar chart
        const myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        stepSize: 1 // Set step size to 1 to display full numbers on the y-axis
                    }
                }
            }
        });

        const orderData = {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Monthly Order',
                // data: {!! json_encode($monthlyOrderCount) !!},
                data: [1, 2, 10, 6, 8, 3],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }


        const orderChart = new Chart(order, {
            type: 'bar',
            data: orderData,
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        })


        const categoriesData = {
            labels: {!! json_encode($categoryNames) !!},
            datasets: [{
                label: 'Category',
                data: {!! json_encode($categoryCounts) !!},
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(102, 204, 102)',
                    'rgb(255, 128, 0)',
                    'rgb(0, 128, 128)',
                    'rgb(128, 0, 128)'
                ],

                hoverOffset: 4
            }]
        }


        const categoriesChart = new Chart(categories, {
            type: 'doughnut',
            data: categoriesData,
        })
    </script>
@endsection
