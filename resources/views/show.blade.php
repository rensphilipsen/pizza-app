@extends('layouts.app')

@section('content')

    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Order Tracker</h6>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <order-progress status="{{ $order->status->name }}"
                        initial="{{ $order->status->percent }}"
                        order_id="{{ $order->id }}"></order-progress>

        <order-alert user_id="{{ auth()->user()->id }}"></order-alert>

        <hr>

        <div class="order-details">
            <strong>Order ID:</strong> {{ $order->id }} <br>
            <strong>Size:</strong> {{ $order->size }} <br>
            <strong>Toppings:</strong> {{ $order->toppings }} <br>

            @if ($order->instructions != '')
                <strong>Instructions:</strong> {{ $order->instructions }}
            @endif

        </div>

        <a class="btn btn-primary" href="{{ route('user.orders') }}">Back to Orders</a>
    </div>
@endsection
