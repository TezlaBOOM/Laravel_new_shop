@extends('layouts.app')

@section('content')
<div class="container">
    @include('helpers.flash-messages')
    <div class="row">
        <div class="col-6">
            <h1><i class="fas fa-clipboard-list"></i> Zamówienia</h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena [PLN]</th>
                <th scope="col">Produkty</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <th scope="row">{{ $order->quantity }}</th>
                    <th scope="row">{{ $order->price }}</th>
                    <th scope="row">
                    @foreach($order->products as $product)
                            <ul> 
                                <li>{{ $product->name }} - {{ $product->description }}</li>
                           </ul>
                        @endforeach
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection