@extends('layouts.app')

@section('content')
    <h5 class="pb-2 mb-0">My orders</h5>

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

                <order-alert user_id="{{ auth()->user()->id }}"></order-alert>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
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
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->size }}</td>
                                <td>{{ $order->toppings }}</td>
                                <td>{{ $order->instructions }}</td>
                                <td>
                                    <a href="{{ route('user.orders.show', $order) }}">{{ $order->status->name }}</a>
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
