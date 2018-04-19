@extends('layouts.app')

@section('content')
    <h5 class="pb-2 mb-0">Admin dashboard</h5>

    <div class="my-3 p-3 bg-white rounded box-shadow">

        <div class="panel-body">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if ($orders->count() == 0)
                <p>No orders yet.</p>
                <a class="btn btn-success" href="{{ route('user.orders.create') }}">Order Pizza</a>

            @else

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Size</th>
                            <th>Toppings</th>
                            <th>Instructions</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->size }}</td>
                                <td>{{ $order->toppings }}</td>
                                <td>{{ $order->instructions }}</td>
                                <td><a href="{{ route('admin.orders.edit', $order) }}">{{ $order->status->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div> <!-- end table-responsive -->

            @endif


        </div>
    </div>
@endsection
